<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

$TCA["tx_SBumfrage_list"] = Array (
	"ctrl" => $TCA["tx_SBumfrage_list"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,starttime,endtime,name,title,question,answers,votes,pages,keyword,keyword2,keyword3"
	),
	"feInterface" => $TCA["tx_SBumfrage_list"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (		
			"exclude" => 1,	
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"starttime" => Array (		
			"exclude" => 1,	
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.starttime",
			"config" => Array (
				"type" => "input",
				"size" => "8",
				"max" => "20",
				"eval" => "date",
				"default" => "0",
				"checkbox" => "0"
			)
		),
		"endtime" => Array (		
			"exclude" => 1,	
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.endtime",
			"config" => Array (
				"type" => "input",
				"size" => "8",
				"max" => "20",
				"eval" => "date",
				"checkbox" => "0",
				"default" => "0",
				"range" => Array (
					"upper" => mktime(0,0,0,12,31,2020),
					"lower" => mktime(0,0,0,date("m")-1,date("d"),date("Y"))
				)
			)
		),
		"name" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list.name",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
				"eval" => "trim",
			)
		),
		"title" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list.title",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"question" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list.question",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",	
				"rows" => "5",
			)
		),
		"answers" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list.answers",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",	
				"rows" => "7",
			)
		),
		"votes" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list.votes",		
			"config" => Array (
				"type" => "input",	
				"size" => "4",
				"max" => "4",
				"eval" => "int",
				"checkbox" => "0",
				"range" => Array (
					"upper" => "1000",
					"lower" => "10"
				),
				"default" => 0
			)
		),
		"pages" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list.pages",		
			"config" => Array (
				"type" => "group",	
				"internal_type" => "db",	
				"allowed" => "pages",	
				"size" => 5,	
				"minitems" => 0,
				"maxitems" => 99,
			)
		),
		"keyword" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list.keyword",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
				"eval" => "trim",
			)
		),
		"keyword2" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list.keyword2",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"keyword3" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:SBumfrage/locallang_db.php:tx_SBumfrage_list.keyword3",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, name, title;;;;2-2-2, question;;;;3-3-3, answers, votes, pages, keyword, keyword2, keyword3")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "starttime, endtime")
	)
);
?>