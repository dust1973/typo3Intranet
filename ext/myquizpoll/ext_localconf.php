<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_myquizpoll_question=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_myquizpoll_category=1
');

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_myquizpoll_pi1.php', '_pi1', 'list_type', 0);

$TYPO3_CONF_VARS['FE']['eID_include']['myquizpoll_eID'] = 'EXT:myquizpoll/pi1/poll_eID.php';
$TYPO3_CONF_VARS['FE']['eID_include']['myquiz_eID'] = 'EXT:myquizpoll/pi1/quiz_eID.php';
$TYPO3_CONF_VARS['FE']['eID_include']['starrating'] = 'EXT:myquizpoll/pi1/class.tx_myquizpoll_eidstarrating.php';

t3lib_extMgm::addTypoScript($_EXTKEY,'setup','
	tt_content.shortcut.20.0.conf.tx_myquizpoll_question = < plugin.'.t3lib_extMgm::getCN($_EXTKEY).'_pi1
	tt_content.shortcut.20.0.conf.tx_myquizpoll_question.CMD = singleView
',43);
?>