<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Haustrainer Forum'
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Woehrl Forum 6.2');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlforum_domain_model_eintrag', 'EXT:woehrl_forum/Resources/Private/Language/locallang_csh_tx_woehrlforum_domain_model_eintrag.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlforum_domain_model_eintrag');
$GLOBALS['TCA']['tx_woehrlforum_domain_model_eintrag'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_eintrag',
		'label' => 'autor',
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
		'searchFields' => 'autor,betreff,i_p_adresse,zuletztbearbeitet,anzahlder_bearbeitungen,nachricht,kategorie,thema,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Eintrag.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlforum_domain_model_eintrag.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlforum_domain_model_kategorie', 'EXT:woehrl_forum/Resources/Private/Language/locallang_csh_tx_woehrlforum_domain_model_kategorie.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlforum_domain_model_kategorie');
$GLOBALS['TCA']['tx_woehrlforum_domain_model_kategorie'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_kategorie',
		'label' => 'name',
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
		'searchFields' => 'name,beschreibung,gruppe,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Kategorie.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlforum_domain_model_kategorie.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlforum_domain_model_gruppe', 'EXT:woehrl_forum/Resources/Private/Language/locallang_csh_tx_woehrlforum_domain_model_gruppe.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlforum_domain_model_gruppe');
$GLOBALS['TCA']['tx_woehrlforum_domain_model_gruppe'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_gruppe',
		'label' => 'name',
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
		'searchFields' => 'name,beschreibung,frontend_benutzer,frontend_gruppen,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Gruppe.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlforum_domain_model_gruppe.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlforum_domain_model_theme', 'EXT:woehrl_forum/Resources/Private/Language/locallang_csh_tx_woehrlforum_domain_model_theme.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlforum_domain_model_theme');
$GLOBALS['TCA']['tx_woehrlforum_domain_model_theme'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_theme',
		'label' => 'geschlossen',
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
		'searchFields' => 'geschlossen,betreff,autor,erstellt,wieoftwurdedas_themaangesehen,anzahlder_anworten,erste_nachricht,letzter_nachricht,kategorie,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Theme.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlforum_domain_model_theme.gif'
	),
);
