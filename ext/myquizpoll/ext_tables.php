<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::allowTableOnStandardPages('tx_myquizpoll_question');

$TCA['tx_myquizpoll_question'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question',		
		'label'     => 'title',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE, 
		'origUid' => 't3_origuid',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l10n_parent',	
		'transOrigDiffSourceField' => 'l10n_diffsource',	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',	
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_myquizpoll_question.gif',
	),
);

t3lib_extMgm::allowTableOnStandardPages('tx_myquizpoll_voting');

$TCA['tx_myquizpoll_voting'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_voting',		
		'label'     => 'answer_no',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY crdate',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_myquizpoll_voting.gif',
	),
);

t3lib_extMgm::allowTableOnStandardPages('tx_myquizpoll_result');

$TCA['tx_myquizpoll_result'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result',		
		'label'     => 'name',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY crdate',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_myquizpoll_result.gif',
	),
);

t3lib_extMgm::allowTableOnStandardPages('tx_myquizpoll_relation');

$TCA['tx_myquizpoll_relation'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation',		
		'label'     => 'uid',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l10n_parent',	
		'transOrigDiffSourceField' => 'l10n_diffsource',	
		'default_sortby' => 'ORDER BY crdate',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_myquizpoll_relation.gif',
	),
);


t3lib_extMgm::allowTableOnStandardPages('tx_myquizpoll_category');

$TCA['tx_myquizpoll_category'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_category',		
		'label'     => 'name',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY name',	
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_myquizpoll_category.gif',
	),
);


$version = class_exists('t3lib_utility_VersionNumber') ?
t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version) : t3lib_div::int_from_ver(TYPO3_version);
if ($version < 4008000)
    t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,recursive';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:'.$_EXTKEY.'/flexform.xml'); 

t3lib_extMgm::addPlugin(array(
	'LLL:EXT:myquizpoll/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');

if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_myquizpoll_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_myquizpoll_pi1_wizicon.php';
}

t3lib_extMgm::addStaticFile($_EXTKEY,'pi1/static/','My quiz and poll: default styles');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/defaultsettings/', 'My quiz and poll: default settings');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/starrating/','My quiz and poll: star rating (question type)');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/uistars/','My quiz and poll: star rating (rating)');

$TCA['pages']['columns']['module']['config']['items'][] = array('My Quiz and Poll', 'myquizpoll', t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon_myquizpoll_folder.gif');
if ($version >= 4004000) {
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-myquizpoll', t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon_myquizpoll_folder.gif');
} else {
	$ICON_TYPES['myquizpoll'] = array('icon' => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon_myquizpoll_folder.gif');
}

if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('web_txmyquizpollM1', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');		
	t3lib_extMgm::addModule('web', 'txmyquizpollM1', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}
?>