<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Akademie'
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Woehrl.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'pi2',	// Submodule key
		'',						// Position
		array(
			'Kurs' => 'list, show',
			
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_pi2.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'WÖHRL Akademie');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlakademie_domain_model_kurs', 'EXT:woehrl_akademie/Resources/Private/Language/locallang_csh_tx_woehrlakademie_domain_model_kurs.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlakademie_domain_model_kurs');
$GLOBALS['TCA']['tx_woehrlakademie_domain_model_kurs'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs',
		'label' => 'kursnummer',
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
		'searchFields' => 'kursnummer,title,kursbeginn,kursende,registrierungsbeginn,registrierungsende,subtitle,bodytext,max_teilnehmer_anzahl,preis,preview_image,files,documents,kurs_bewertung,location,kategorien,kompetenzen,zielgruppen,teilnehmer,dozent,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Kurs.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlakademie_domain_model_kurs.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlakademie_domain_model_schulungsort', 'EXT:woehrl_akademie/Resources/Private/Language/locallang_csh_tx_woehrlakademie_domain_model_schulungsort.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlakademie_domain_model_schulungsort');
$GLOBALS['TCA']['tx_woehrlakademie_domain_model_schulungsort'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_schulungsort',
		'label' => 'titel',
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
		'searchFields' => 'titel,strasse,plz,ort,telefon,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Schulungsort.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlakademie_domain_model_schulungsort.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlakademie_domain_model_kategorie', 'EXT:woehrl_akademie/Resources/Private/Language/locallang_csh_tx_woehrlakademie_domain_model_kategorie.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlakademie_domain_model_kategorie');
$GLOBALS['TCA']['tx_woehrlakademie_domain_model_kategorie'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kategorie',
		'label' => 'title',
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
		'searchFields' => 'title,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Kategorie.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlakademie_domain_model_kategorie.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlakademie_domain_model_kompetenz', 'EXT:woehrl_akademie/Resources/Private/Language/locallang_csh_tx_woehrlakademie_domain_model_kompetenz.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlakademie_domain_model_kompetenz');
$GLOBALS['TCA']['tx_woehrlakademie_domain_model_kompetenz'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kompetenz',
		'label' => 'titel',
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
		'searchFields' => 'titel,bodytext,image,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Kompetenz.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlakademie_domain_model_kompetenz.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlakademie_domain_model_zielgruppe', 'EXT:woehrl_akademie/Resources/Private/Language/locallang_csh_tx_woehrlakademie_domain_model_zielgruppe.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlakademie_domain_model_zielgruppe');
$GLOBALS['TCA']['tx_woehrlakademie_domain_model_zielgruppe'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_zielgruppe',
		'label' => 'art',
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
		'searchFields' => 'art,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Zielgruppe.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlakademie_domain_model_zielgruppe.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlakademie_domain_model_teilnehmer', 'EXT:woehrl_akademie/Resources/Private/Language/locallang_csh_tx_woehrlakademie_domain_model_teilnehmer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlakademie_domain_model_teilnehmer');
$GLOBALS['TCA']['tx_woehrlakademie_domain_model_teilnehmer'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer',
		'label' => 'anrede',
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
		'searchFields' => 'anrede,vorname,nachname,filiale,position,personal_nr,kostenstelle,email,telefon,genehmigt,emaildesvorgesezten,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Teilnehmer.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlakademie_domain_model_teilnehmer.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlakademie_domain_model_dozent', 'EXT:woehrl_akademie/Resources/Private/Language/locallang_csh_tx_woehrlakademie_domain_model_dozent.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlakademie_domain_model_dozent');
$GLOBALS['TCA']['tx_woehrlakademie_domain_model_dozent'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_dozent',
		'label' => 'vorname',
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
		'searchFields' => 'vorname,nachname,bild,beschreibung,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Dozent.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlakademie_domain_model_dozent.gif'
	),
);
