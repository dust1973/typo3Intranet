<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'WÖHRL RSS-Newsreadern'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'WÖHRL RSS-Feed');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_woehrlrssfeed_domain_model_feed', 'EXT:woehrl_rss_feed/Resources/Private/Language/locallang_csh_tx_woehrlrssfeed_domain_model_feed.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_woehrlrssfeed_domain_model_feed');
$GLOBALS['TCA']['tx_woehrlrssfeed_domain_model_feed'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:woehrl_rss_feed/Resources/Private/Language/locallang_db.xlf:tx_woehrlrssfeed_domain_model_feed',
		'label' => 'uid',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => '',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Feed.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_woehrlrssfeed_domain_model_feed.gif'
	),
);
