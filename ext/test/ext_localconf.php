<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WOEHRL.' . $_EXTKEY,
	'Pi1',
	array(
		'TestA' => 'list, show, new, create, edit, update',
		'TestB' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'TestA' => 'create, update',
		'TestB' => 'create, update, delete',
		
	)
);
