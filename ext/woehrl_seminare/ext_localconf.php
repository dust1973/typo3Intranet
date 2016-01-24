<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$_EXTKEY,
	'Eventlist',
	array(
		'Event' => 'list, show, showNotFound, new, update, create, delete',

	),
	// non-cacheable actions
	array(
		'Event' => 'new, update, create, delete',

	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$_EXTKEY,
	'Eventsubscribe',
	array(
		'Subscriber' => 'new, create, delete, eventNotFound',
		'Kostenstelle' => 'new, create, delete',
	),
	// non-cacheable actions
	array(
		'Subscriber' => 'new, create, delete',
		'Kostenstelle' => 'new, create, delete',

	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$_EXTKEY,
	'Eventuserpanel',
	array(
		'Event' => 'listOwn, show',
		'Subscriber' => 'list, show',

	),
	// non-cacheable actions
	array(
		'Event' => 'listOwn',

	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$_EXTKEY,
	'Eventgeniusbar',
	array(
		'Category' => 'list, gbList',

	),
	// non-cacheable actions
	array(
		'Category' => '',

	)
);

$TYPO3_CONF_VARS['FE']['eID_include']['slubCal'] = 'EXT:woehrl_seminare/Ajaxproxy/Ajaxproxy.php';

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

if (TYPO3_MODE === 'BE') {
	// prefill BE user data in event form
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tceforms.php']['getMainFieldsClass'][]  = 'EXT:' . $_EXTKEY . '/Classes/Slots/Tceforms.php:tx_woehrlseminare_Slots_Tceforms';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tceforms.php']['getSingleFieldClass'][] = 'EXT:' . $_EXTKEY . '/Classes/Slots/Tceforms.php:tx_woehrlseminare_Slots_Tceforms';

	require_once (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Slots/HookPreProcessing.php');
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'tx_woehrlseminare_Slots_HookPreProcessing';

	require_once (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Slots/HookPostProcessing.php');
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'tx_woehrlseminare_Slots_HookPostProcessing';

	// include cli command controller
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'tx_woehrlseminare_Command_CheckeventsCommandController';
}
?>
