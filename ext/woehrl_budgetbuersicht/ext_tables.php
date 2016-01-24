<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Budgetuebersicht'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Budgetübersicht 6.0');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlbudgetbuersicht_domain_model_haus', 'EXT:woehrl_budgetbuersicht/Resources/Private/Language/locallang_csh_tx_woehrlbudgetbuersicht_domain_model_haus.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlbudgetbuersicht_domain_model_haus');
$GLOBALS['TCA']['tx_woehrlbudgetbuersicht_domain_model_haus'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_budgetbuersicht/Resources/Private/Language/locallang_db.xlf:tx_woehrlbudgetbuersicht_domain_model_haus',
		'label' => 'kostenstelle',
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
		'searchFields' => 'kostenstelle,budget_kst,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Haus.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlbudgetbuersicht_domain_model_haus.gif'
	),
);






