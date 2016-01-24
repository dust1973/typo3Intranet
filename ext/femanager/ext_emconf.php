<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "femanager".
 *
 * Auto generated 17-07-2014 15:15
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'femanager',
	'description' => '
		TYPO3 Frontend User Registration and Management based on
		Extbase and Fluid with Namespaces and a lot of features and
		extension possibilities. Extension basicly works like sr_feuser_register
	',
	'category' => 'plugin',
	'version' => '1.3.0',
	'state' => 'stable',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'Alex Kellner',
	'author_email' => 'alexander.kellner@in2code.de',
	'author_company' => 'in2code.de - Wir leben TYPO3',
	'constraints' => 
	array (
		'depends' => 
		array (
			'extbase' => '6.0.0-6.2.99',
			'fluid' => '6.0.0-6.2.99',
			'typo3' => '6.0.0-6.2.99',
		),
		'suggests' => 
		array (
			'sr_freecap' => '2.0.4-2.99.99',
			'static_info_tables' => '6.0.0-6.99.99',
		),
		'conflicts' => 
		array (
		),
	),
);

