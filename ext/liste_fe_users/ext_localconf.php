<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Woehrl.' . $_EXTKEY,
	'Pi1',
	array(
		'user' => 'list',
		
	),
	// non-cacheable actions
	array(
		'User' => '',
		
	)
);
