<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Woehrl.' . $_EXTKEY,
	'Pi1',
	array(
		'Kurs' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Kurs' => 'create, update, delete',
		'Schulungsort' => 'create, update, delete',
		'Kategorie' => 'create, update, delete',
		'Kompetenz' => 'create, update, delete',
		'Zielgruppe' => 'create, update, delete',
		'Teilnehmer' => 'create, update, delete',
		'Dozent' => 'create, update, delete',
		
	)
);
