<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$TCA['tx_bruttoumsatz_woehrl'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_woehrl',		
		'label'     => 'monat',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY tstamp',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_bruttoumsatz_woehrl.gif',
	),
);

/*$TCA['tx_bruttoumsatz_sinnleffers'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_sinnleffers',		
		'label'     => 'monat',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY tstamp',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_bruttoumsatz_sinnleffers.gif',
	),
);

$TCA['tx_bruttoumsatz_markttrend'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:brutto_umsatz/locallang_db.xml:tx_bruttoumsatz_markttrend',		
		'label'     => 'monat',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY tstamp',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_bruttoumsatz_markttrend.gif',
	),
);*/


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:brutto_umsatz/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');
?>