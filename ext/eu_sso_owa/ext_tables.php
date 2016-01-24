<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

t3lib_div::loadTCA("tt_content");
$TCA["tt_content"]["types"]["list"]["subtypes_excludelist"][$_EXTKEY."_pi1"]="select,layout";


t3lib_extMgm::addPlugin(Array("LLL:EXT:eu_sso_owa/locallang_db.php:tt_content.list_type", $_EXTKEY."_pi1"),"list_type");
?>