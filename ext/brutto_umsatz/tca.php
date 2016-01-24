<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_bruttoumsatz_woehrl'] = array (
	'ctrl' => $TCA['tx_bruttoumsatz_woehrl']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden, monat, laufend_w, vorjahr_w, prozent_zu_vj_w, laufend_s, vorjahr_s, prozent_zu_vj_s,prozent_zu_vj'
	),
	'feInterface' => $TCA['tx_bruttoumsatz_woehrl']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'monat' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_woehrl.monat',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
		'laufend_w' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_woehrl.laufend_w',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'double2',
			)
		),
		'vorjahr_w' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_woehrl.vorjahr_w',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'double2',
			)
		),
		'prozent_zu_vj_w' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_woehrl.prozent_zu_vj_w',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'double2',
			)
		),
		'laufend_s' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_woehrl.laufend_s',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'double2',
			)
		),
		'vorjahr_s' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_woehrl.vorjahr_s',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'double2',
			)
		),
		'prozent_zu_vj_s' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_woehrl.prozent_zu_vj_s',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'double2',
			)
		),
		'prozent_zu_vj' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_woehrl.prozent_zu_vj',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'double2',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, monat, laufend_w, vorjahr_w, prozent_zu_vj_w,laufend_s, vorjahr_s, prozent_zu_vj_s,prozent_zu_vj')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);

?>