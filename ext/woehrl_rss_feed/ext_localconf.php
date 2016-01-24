<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WOEHRL.' . $_EXTKEY,
	'Pi1',
	array(
		'Feed' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Feed' => 'list',
		
	)
);
