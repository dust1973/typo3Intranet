<?php
namespace Causal\IgLdapSsoAuth\Task;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Causal\IgLdapSsoAuth\Exception\ImportUsersException;
use Causal\IgLdapSsoAuth\Library\Authentication;
use Causal\IgLdapSsoAuth\Library\Configuration;
use Causal\IgLdapSsoAuth\Library\Ldap;

/**
 * Synchronizes users for selected context and configuration.
 *
 * Context may be FE, BE or both. A single configuration may be chosen or all of them.
 *
 * @author     Francois Suter <typo3@cobweb.ch>
 * @package    TYPO3
 * @subpackage ig_ldap_sso_auth
 */
class ImportUsers extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	/**
	 * Synchronization context (may be FE, BE or both).
	 *
	 * @var string
	 */
	protected $context = 'both';

	/**
	 * Selected LDAP configuration (may be 0 (for all) or a configuration uid).
	 *
	 * @var integer
	 */
	protected $configuration = 0;

	/**
	 * Defines how missing users (i.e. TYPO3 users which are no longer found on the LDAP server)
	 * should be handled. Can be "disable", "delete" or "nothing".
	 *
	 * @var string
	 */
	protected $missingUsersHandling = 'nothing';

	/**
	 * Defines how restored users (i.e. TYPO3 users which were deleted or disabled on the TYPO3 side,
	 * but still exist on the LDAP server) should be handled. Can be "enable", "undelete", "both" or "nothing".
	 *
	 * @var string
	 */
	protected $restoredUsersHandling = 'nothing';

	/**
	 * Defines whether missing users in TYPO3 should be imported ("imported") or if only already existing
	 * users in TYPO3 should be synchronized ("sync") with LDAP.
	 *
	 * @var string
	 */
	protected $mode = 'import';

	/**
	 * Performs the synchronization of LDAP users according to selected parameters.
	 *
	 * @return boolean Returns TRUE on successful execution, FALSE on error
	 * @throws ImportUsersException
	 */
	public function execute() {

		// Assemble a list of configuration and contexts for import
		/** @var \Causal\IgLdapSsoAuth\Domain\Repository\ConfigurationRepository $configurationRepository */
		$configurationRepository = GeneralUtility::makeInstance('Causal\\IgLdapSsoAuth\\Domain\\Repository\\ConfigurationRepository');
		if (empty($this->configuration)) {
			$ldapConfigurations = $configurationRepository->findAll();
		} else {
			$configuration = $configurationRepository->findByUid($this->configuration);
			$ldapConfigurations = array();
			if ($configuration !== NULL) {
				$ldapConfigurations[] = $configuration;
			}
		}
		if ($this->context === 'both') {
			$executionContexts = array('fe', 'be');
		} else {
			$executionContexts = array($this->context);
		}

		$mode = $this->getMode();

		// Start a database transaction with all our changes
		// Syntax is compatible with MySQL, Oracle, MSSQL and PostgreSQL
		$this->getDatabaseConnection()->sql_query('START TRANSACTION');

		// Loop on each configuration and context and import the related users
		$failures = 0;
		foreach ($ldapConfigurations as $configuration) {
			foreach ($executionContexts as $aContext) {
				/** @var \Causal\IgLdapSsoAuth\Utility\UserImportUtility $importUtility */
				$importUtility = GeneralUtility::makeInstance(
					'Causal\\IgLdapSsoAuth\\Utility\\UserImportUtility',
					$configuration,
					$aContext
				);

				$config = $importUtility->getConfiguration();
				if (empty($config['users']['filter'])) {
					// Current context is not configured for this LDAP configuration record
					static::getLogger()->debug(sprintf('Configuration record %s is not configured for context "%s"', $configuration->getUid(), $aContext));
					unset($importUtility);
					continue;
				}

				// Start by connecting to the designated LDAP/AD server
				$success = Ldap::getInstance()->connect(Configuration::getLdapConfiguration());
				// Proceed with import if successful
				if (!$success) {
					$failures++;
					unset($importUtility);
					continue;
				}

				$ldapUsers = $importUtility->fetchLdapUsers();

				// Consider that fetching no users from LDAP is an error
				if (count($ldapUsers) === 0) {
					static::getLogger()->error(sprintf(
						'No users (%s) found for configuration record %s', $aContext, $configuration->getUid()
					));
					$failures++;
				} else {
					// Disable or delete users, according to settings
					if ($this->missingUsersHandling === 'disable') {
						static::getLogger()->debug(sprintf(
							'Disabling users (%s) for configuration record %s', $aContext, $configuration->getUid()
						));
						$importUtility->disableUsers();
					} elseif ($this->missingUsersHandling === 'delete') {
						static::getLogger()->debug(
							sprintf('Deleting users (%s) for configuration record %s', $aContext, $configuration->getUid()
						));
						$importUtility->deleteUsers();
					}

					// Proceed with import (handle partial result sets until every LDAP record has been returned)
					do {
						$typo3Users = $importUtility->fetchTypo3Users($ldapUsers);

						// Loop on all users and import them
						foreach ($ldapUsers as $index => $aUser) {
							if ($mode === 'sync' && empty($typo3Users[$index]['uid'])) {
								// New LDAP user => skip it since only existing TYPO3 users should get synchronized
								continue;
							}

							// Merge LDAP and TYPO3 information
							$user = Authentication::merge($aUser, $typo3Users[$index], $config['users']['mapping']);

							// Import the user using information from LDAP
							$importUtility->import($user, $aUser, $this->restoredUsersHandling);
						}

						static::getLogger()->info(sprintf(
							'Configuration record %s: processed %s LDAP users (%s)', $configuration->getUid(), count($ldapUsers), $aContext
						));

						// Free memory before going on
						$typo3Users = NULL;
						$ldapUsers = NULL;
						$ldapUsers = $importUtility->hasMoreLdapUsers()
							? $importUtility->fetchLdapUsers(TRUE)
							: array();
					} while (count($ldapUsers) > 0);
				}

				// Clean up
				unset($importUtility);
				Ldap::getInstance()->disconnect();
			}
		}

		// If some failures were registered, rollback the whole transaction and report error
		if ($failures > 0) {
			$this->getDatabaseConnection()->sql_query('ROLLBACK');
			$message = 'Some or all imports failed. Synchronisation was aborted. Check your settings or your network connection';
			static::getLogger()->error($message);
			throw new ImportUsersException($message, 1410774015);

		} else {
			// Everything went fine, commit the changes
			$this->getDatabaseConnection()->sql_query('COMMIT');
		}
		return TRUE;
	}

	/**
	 * This method returns the context and configuration as additional information.
	 *
	 * @return	string	Information to display
	 */
	public function getAdditionalInformation() {
		$languageService = $this->getLanguageService();

		if (empty($this->configuration)) {
			$configurationName = $languageService->sL('LLL:EXT:ig_ldap_sso_auth/Resources/Private/Language/locallang.xlf:task.import_users.field.configuration.all');
		} else {
			$configurationName = $this->getConfigurationName();
		}
		$info = sprintf(
			$languageService->sL('LLL:EXT:ig_ldap_sso_auth/Resources/Private/Language/locallang.xlf:task.import_users.additionalinformation'),
			$languageService->sL('LLL:EXT:ig_ldap_sso_auth/Resources/Private/Language/locallang.xlf:task.import_users.field.mode.' . $this->getMode() . '.short'),
			$languageService->sL('LLL:EXT:ig_ldap_sso_auth/Resources/Private/Language/locallang.xlf:task.import_users.field.context.' . strtolower($this->getContext())),
			$configurationName
		);
		return $info;
	}

	/**
	 * Sets the mode.
	 *
	 * @param string $mode
	 */
	public function setMode($mode) {
		$this->mode = $mode;
	}

	/**
	 * Returns the mode.
	 *
	 * @return string
	 */
	public function getMode() {
		return $this->mode;
	}

	/**
	 * Sets the context parameter.
	 *
	 * @param string $context
	 */
	public function setContext($context) {
		$this->context = $context;
	}

	/**
	 * Returns the context parameter.
	 *
	 * @return string
	 */
	public function getContext() {
		return $this->context;
	}

	/**
	 * Sets the configuration.
	 *
	 * @param int $configuration
	 */
	public function setConfiguration($configuration) {
		$this->configuration = (int)$configuration;
	}

	/**
	 * Returns the current configuration.
	 *
	 * @return int
	 */
	public function getConfiguration() {
		return $this->configuration;
	}

	/**
	 * Sets the missing users handling flag.
	 *
	 * NOTE: behavior defaults to "nothing".
	 *
	 * @param string $missingUsersHandling Can be "disable", "delete" or "nothing".
	 */
	public function setMissingUsersHandling($missingUsersHandling) {
		$this->missingUsersHandling = $missingUsersHandling;
	}

	/**
	 * Returns the missing users handling flag.
	 *
	 * @return string
	 */
	public function getMissingUsersHandling() {
		return $this->missingUsersHandling;
	}

	/**
	 * Sets the restored users handling flag.
	 *
	 * NOTE: behavior defaults to "nothing".
	 *
	 * @param string $restoredUsersHandling Can be "enable", "undelete", "both" or "nothing".
	 */
	public function setRestoredUsersHandling($restoredUsersHandling) {
		$this->restoredUsersHandling = $restoredUsersHandling;
	}

	/**
	 * Returns the restored users handling flag.
	 *
	 * @return string
	 */
	public function getRestoredUsersHandling() {
		return $this->restoredUsersHandling;
	}

	/**
	 * Returns the name of the current configuration.
	 *
	 * @return string
	 */
	public function getConfigurationName() {
		/** @var \Causal\IgLdapSsoAuth\Domain\Repository\ConfigurationRepository $configurationRepository */
		$configurationRepository = GeneralUtility::makeInstance('Causal\\IgLdapSsoAuth\\Domain\\Repository\\ConfigurationRepository');
		$ldapConfiguration = $configurationRepository->findByUid($this->configuration);
		if ($ldapConfiguration === NULL) {
			return '';
		} else {
			return $ldapConfiguration->getName();
		}
	}

	/**
	 * Returns the database connection.
	 *
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDatabaseConnection() {
		return $GLOBALS['TYPO3_DB'];
	}

	/**
	 * Returns the LanguageService.
	 *
	 * @return \TYPO3\CMS\Lang\LanguageService
	 */
	protected function getLanguageService() {
		return $GLOBALS['LANG'];
	}

	/**
	 * Returns a logger.
	 *
	 * @return \TYPO3\CMS\Core\Log\Logger
	 */
	static protected function getLogger() {
		/** @var \TYPO3\CMS\Core\Log\Logger $logger */
		static $logger = NULL;
		if ($logger === NULL) {
			$logger = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Log\\LogManager')->getLogger(__CLASS__);
		}
		return $logger;
	}

}
