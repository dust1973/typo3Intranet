<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'WÖHRL Login Status'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'LoginStatus');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlloginstatus_domain_model_status', 'EXT:woehrl_loginstatus/Resources/Private/Language/locallang_csh_tx_woehrlloginstatus_domain_model_status.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlloginstatus_domain_model_status');
$GLOBALS['TCA']['tx_woehrlloginstatus_domain_model_status'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_loginstatus/Resources/Private/Language/locallang_db.xlf:tx_woehrlloginstatus_domain_model_status',
		'label' => 'user',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'user,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Status.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlloginstatus_domain_model_status.gif'
	),
);
$GLOBALS['TCA']['tt_content']['columns']['fe_group']['config']['maxitems'] = 30;
$GLOBALS['TCA']['tt_content']['columns']['fe_group']['config']['size'] = 30;