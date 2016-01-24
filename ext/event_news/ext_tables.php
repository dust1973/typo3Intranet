<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Eventcalender');
$tempColumns = Array (
            "new_field" => Array (
                    "exclude" => 1,
                    "label" => "LLL:EXT:event_news/Resources/Private/Language/locallang_db.xml:tx_eventnews_domain_model_news.new_field",
                    "config" => Array (
                            "type" => "input",
                            "size" => "30",
                            "eval" => "trim",
                    )
            ),
    );

    t3lib_div::loadTCA("tx_news_domain_model_news");
    t3lib_extMgm::addTCAcolumns("tx_news_domain_model_news",$tempColumns,1);
    t3lib_extMgm::addToAllTCAtypes("tx_news_domain_model_news","new_field;;;;1-1-1");
	
?>
