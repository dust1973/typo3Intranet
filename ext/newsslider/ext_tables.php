<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/***************
 * Add plugin to list
 */  
Tx_Extbase_Utility_Extension::registerPlugin(
    $_EXTKEY,
    'Pi1',
    'News-Slider'
);

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_slider.xml');

/***************
 * Default TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'News-Slider');

/***************
 * Locallang csh
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
		'tt_content.pi_flexform.newsslider_pi1.list', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh_flexforms.xml');

if (TYPO3_MODE == 'BE') {
  /***************
   * Add plugin to new element wizard
   */
   $TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_newsslider_wizicon'] = 
      \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Private/Php/class.tx_newsslider_wizicon.php';

  /***************
   * Extension Summary
   */
  $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info'][$pluginSignature]['newsslider'] 
    = 'EXT:newsslider/Classes/Layout/Entry.php:Entry->getExtensionSummary';
}
?>