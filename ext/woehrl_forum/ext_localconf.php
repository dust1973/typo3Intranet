<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Woehrl.' . $_EXTKEY,
	'Pi1',
	array(
		'Eintrag' => 'list, show, insert',
		
	),
	// non-cacheable actions
	array(
		'Eintrag' => 'create, update, delete',
		'Kategorie' => 'create, update, delete',
		'Gruppe' => 'create, update, delete',
		'Theme' => 'create, update, delete',
		
	)
);
