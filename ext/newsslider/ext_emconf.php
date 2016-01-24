<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "newsslider".
 *
 * Auto generated 15-07-2014 13:34
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'News slider',
	'description' => '3 jQuery slider-plugins for versatile news extension (tx_news), based on extbase & fluid.',
	'category' => 'plugin',
	'version' => '0.0.6',
	'state' => 'stable',
	'uploadfolder' => false,
	'createDirs' => '',
	'clearcacheonload' => false,
	'author' => 'Helmut Hackbarth',
	'author_email' => 'typo3@t3solution.de',
	'author_company' => 't3solution',
	'constraints' => 
	array (
		'depends' => 
		array (
			'typo3' => '6.2.2-6.2.99',
			'news' => '3.0.0-0.0.0',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

