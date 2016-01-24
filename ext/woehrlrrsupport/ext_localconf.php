<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WOEHRL.' . $_EXTKEY,
	'Pi1',
	array(
		'Settings' => 'list, edit, update, show',
		'Logs' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Settings' => 'list, edit, update, show',
		'Logs' => 'list, show',
		
	)
);
