<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_smspasscode_log'] = array (
	'ctrl' => $TCA['tx_smspasscode_log']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'starttime,endtime,fe_group,benutzername,log'
	),
	'feInterface' => $TCA['tx_smspasscode_log']['feInterface'],
	'columns' => array (
		'starttime' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array (
					'upper' => mktime(3, 14, 7, 1, 19, 2038),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'benutzername' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:smspasscode/locallang_db.xml:tx_smspasscode_log.benutzername',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'fe_users',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'log' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:smspasscode/locallang_db.xml:tx_smspasscode_log.log',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'starttime;;;;1-1-1, endtime, fe_group, benutzername, log')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);
?>