<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

t3lib_extMgm::allowTableOnStandardPages("tx_SBumfrage_list");


t3lib_extMgm::addToInsertRecords("tx_SBumfrage_list");

$TCA["tx_SBumfrage_list"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list",		
		"label" => "name",	
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",	
		"delete" => "deleted",	
		"enablecolumns" => Array (		
			"disabled" => "hidden",	
			"starttime" => "starttime",	
			"endtime" => "endtime",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_SBumfrage_list.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, starttime, endtime, name, title, question, answers, votes, pages, keyword, keyword2, keyword3",
	)
);


t3lib_div::loadTCA("tt_content");
$TCA["tt_content"]["types"]["list"]["subtypes_excludelist"][$_EXTKEY."_pi1"]="layout,select_key";


t3lib_extMgm::addPlugin(Array("LLL:EXT:SBumfrage/locallang.php:pi1_title", $_EXTKEY."_pi1"),"list_type");


if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_SBumfrage_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY)."pi1/class.tx_SBumfrage_pi1_wizicon.php";
?>