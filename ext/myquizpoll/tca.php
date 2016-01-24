<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_myquizpoll_question'] = array (
	'ctrl' => $TCA['tx_myquizpoll_question']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,fe_group,title,title_hide,name,qtype,category,answer1,correct1,points1,joker1_1,joker2_1,category1,answer2,correct2,points2,joker1_2,joker2_2,category2,answer3,correct3,points3,joker1_3,joker2_3,category3,answer4,correct4,points4,joker1_4,joker2_4,category4,answer5,correct5,points5,joker1_5,joker2_5,category5,answer6,correct6,points6,joker1_6,joker2_6,category6,explanation,joker3,points,category_next,image,alt_text'
	),
	'columns' => array (
		't3ver_label' => array (		
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'max'  => '30',
			)
		),
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_myquizpoll_question',
				'foreign_table_where' => 'AND tx_myquizpoll_question.pid=###CURRENT_PID### AND tx_myquizpoll_question.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
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
		'title' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.title',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required,trim',
			)
		),
		'title_hide' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.title_hide',		
			'config' => array (
				'type' => 'check',
			)
		),
		'name' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.name',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly'       => 1,
						'type'          => 'script',
						'title'         => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon'          => 'wizard_rte2.gif',
						'script'        => 'wizard_rte.php',
					),
				),
			)
		),
		'qtype' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.qtype',		
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.qtype.I.0', '0'),
					array('LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.qtype.I.1', '1'),
					array('LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.qtype.I.2', '2'),
					array('LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.qtype.I.3', '3'),
					array('LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.qtype.I.4', '4'),
					array('LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.qtype.I.5', '5'),
					array('LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.qtype.I.6', '6'),
					array('LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.qtype.I.7', '7'),
				),
				'size' => 1,	
				'maxitems' => 1,
				'default' => 1,
			)
		),
		'category' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.category',		
			'config' => array (
				'type' => 'select',	
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',	
				'foreign_table_where' => 'AND tx_myquizpoll_category.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'answer1' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.answer1',		
			'config' => array (
				'type' => 'input',	
				'size' => '40'
			)
		),
		'correct1' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.correct1',		
			'config' => array (
				'type' => 'check',
			)
		),
		'points1' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.points1',		
			'config' => array (
				'type'     => 'input',
				'size'     => '5',
				'max'      => '7',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-100'
				),
				'default' => 0
			)
		),
		'joker1_1' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker1_1',		
			'config' => array (
				'type' => 'check',
			)
		),
		'joker2_1' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker2_1',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '100',
					'lower' => '0'
				),
				'default' => 0
			)
		),
		'category1' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.category1',		
			'config' => array (
				'type' => 'select',	
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',	
				'foreign_table_where' => 'AND tx_myquizpoll_category.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'answer2' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.answer2',		
			'config' => array (
				'type' => 'input',	
				'size' => '40'
			)
		),
		'correct2' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.correct2',		
			'config' => array (
				'type' => 'check',
			)
		),
		'points2' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.points2',		
			'config' => array (
				'type'     => 'input',
				'size'     => '5',
				'max'      => '7',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-100'
				),
				'default' => 0
			)
		),
		'joker1_2' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker1_2',		
			'config' => array (
				'type' => 'check',
			)
		),
		'joker2_2' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker2_2',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '100',
					'lower' => '0'
				),
				'default' => 0
			)
		),
		'category2' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.category2',		
			'config' => array (
				'type' => 'select',	
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',	
				'foreign_table_where' => 'AND tx_myquizpoll_category.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'answer3' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.answer3',		
			'config' => array (
				'type' => 'input',	
				'size' => '40'
			)
		),
		'correct3' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.correct3',		
			'config' => array (
				'type' => 'check',
			)
		),
		'points3' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.points3',		
			'config' => array (
				'type'     => 'input',
				'size'     => '5',
				'max'      => '7',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-100'
				),
				'default' => 0
			)
		),
		'joker1_3' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker1_3',		
			'config' => array (
				'type' => 'check',
			)
		),
		'joker2_3' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker2_3',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '100',
					'lower' => '0'
				),
				'default' => 0
			)
		),
		'category3' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.category3',		
			'config' => array (
				'type' => 'select',	
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',	
				'foreign_table_where' => 'AND tx_myquizpoll_category.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'answer4' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.answer4',		
			'config' => array (
				'type' => 'input',	
				'size' => '40'
			)
		),
		'correct4' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.correct4',		
			'config' => array (
				'type' => 'check',
			)
		),
		'points4' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.points4',		
			'config' => array (
				'type'     => 'input',
				'size'     => '5',
				'max'      => '7',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-100'
				),
				'default' => 0
			)
		),
		'joker1_4' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker1_4',		
			'config' => array (
				'type' => 'check',
			)
		),
		'joker2_4' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker2_4',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '100',
					'lower' => '0'
				),
				'default' => 0
			)
		),
		'category4' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.category4',		
			'config' => array (
				'type' => 'select',	
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',	
				'foreign_table_where' => 'AND tx_myquizpoll_category.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'answer5' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.answer5',
			'config' => array (
				'type' => 'input',
				'size' => '40'
			)
		),
		'correct5' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.correct5',
			'config' => array (
				'type' => 'check',
			)
		),
		'points5' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.points5',
			'config' => array (
				'type'     => 'input',
				'size'     => '5',
				'max'      => '7',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-100'
				),
				'default' => 0
			)
		),
		'joker1_5' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker1_5',
			'config' => array (
				'type' => 'check',
			)
		),
		'joker2_5' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker2_5',
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '100',
					'lower' => '0'
				),
				'default' => 0
			)
		),
		'category5' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.category5',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',
				'foreign_table_where' => 'AND tx_myquizpoll_category.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_category.uid',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'answer6' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.answer6',
			'config' => array (
				'type' => 'input',
				'size' => '40'
			)
		),
		'correct6' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.correct6',
			'config' => array (
				'type' => 'check',
			)
		),
		'points6' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.points6',
			'config' => array (
				'type'     => 'input',
				'size'     => '5',
				'max'      => '7',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-100'
				),
				'default' => 0
			)
		),
		'joker1_6' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker1_6',
			'config' => array (
				'type' => 'check',
			)
		),
		'joker2_6' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker2_6',
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '100',
					'lower' => '0'
				),
				'default' => 0
			)
		),
		'category6' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.category6',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',
				'foreign_table_where' => 'AND tx_myquizpoll_category.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_category.uid',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'explanation' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.explanation',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly'       => 1,
						'type'          => 'script',
						'title'         => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon'          => 'wizard_rte2.gif',
						'script'        => 'wizard_rte.php',
					),
				),
			)
		),
		'joker3' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.joker3',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'max' => '255',	
				'eval' => 'trim',
			)
		),
		'points' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.points',		
			'config' => array (
				'type'     => 'input',
				'size'     => '5',
				'max'      => '7',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-100'
				),
				'default' => 1
			)
		),
		'category_next' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.category_next',		
			'config' => array (
				'type' => 'select',	
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',	
				'foreign_table_where' => 'AND tx_myquizpoll_category.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'image' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.image',		
			'config' => array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => 'gif,png,jpeg,jpg',	
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],	
				'uploadfolder' => 'uploads/tx_myquizpoll',
				'show_thumbs' => 1,	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'alt_text' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_question.alt_text',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'max' => '255',	
				'eval' => 'trim',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title;;2;;2-2-2, name;;;richtext[paste|bold|italic|underline|formatblock|class|left|center|right|orderedlist|unorderedlist|outdent|indent|link|image]:rte_transform[mode=ts];3-3-3, image;;18, qtype;;3, answer1;;4, correct1;;5, answer2;;6, correct2;;7, answer3;;8, correct3;;9, answer4;;10, correct4;;11, answer5;;12, correct5;;13, answer6;;14, correct6;;15, points;;16, explanation;;17;richtext[paste|bold|italic|underline|formatblock|class|left|center|right|orderedlist|unorderedlist|outdent|indent|link|image]:rte_transform[mode=ts]')
	),
	'palettes' => array (
		'1' => array('showitem' => 'fe_group'),
		'2' => array('showitem' => 'title_hide'),
		'3' => array('showitem' => 'category'),
		"4" => array("showitem" => "category1"),
		"5" => array("showitem" => "points1, joker1_1, joker2_1"),
		"6" => array("showitem" => "category2"),
		"7" => array("showitem" => "points2, joker1_2, joker2_2"),
		"8" => array("showitem" => "category3"),
		"9" => array("showitem" => "points3, joker1_3, joker2_3"),
		"10" => array("showitem" => "category4"),
		"11" => array("showitem" => "points4, joker1_4, joker2_4"),
		"12" => array("showitem" => "category5"),
		"13" => array("showitem" => "points5, joker1_5, joker2_5"),
		"14" => array("showitem" => "category6"),
		"15" => array("showitem" => "points6, joker1_6, joker2_6"),
		"16" => array("showitem" => "category_next"),
		"17" => array("showitem" => "joker3"),
		'18' => array("showitem" => "alt_text")
	)
);


$TCA['tx_myquizpoll_voting'] = array (
	'ctrl' => $TCA['tx_myquizpoll_voting']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,ip,answer_no,question_id,foreign_val'
	),
	'columns' => array (
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_myquizpoll_voting',
				'foreign_table_where' => 'AND tx_myquizpoll_voting.pid=###CURRENT_PID### AND tx_myquizpoll_voting.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'ip' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.ip',		
			'config' => array (
				'type' => 'input',	
				'size' => '20',	
				'eval' => 'trim',
			)
		),
		'question_id' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_voting.question_id',	
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tx_myquizpoll_question',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'foreign_val' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_voting.foreign_val',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255'
			)
		),
		'answer_no' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_voting.answer_no',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '100',
					'lower' => '0'
				),
				'default' => 0
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, ip,question_id,foreign_val,answer_no')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);


$TCA['tx_myquizpoll_result'] = array (
	'ctrl' => $TCA['tx_myquizpoll_result']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,name,email,homepage,ip,p_or_a,p_max,percent,o_max,o_percent,qids,cids,fids,sids,joker1,joker2,joker3,firsttime,lasttime,lastcat,nextcat,fe_uid,start_uid'
	),
	'columns' => array (
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_myquizpoll_result',
				'foreign_table_where' => 'AND tx_myquizpoll_result.pid=###CURRENT_PID### AND tx_myquizpoll_result.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'name' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
		'email' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.email',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
		'homepage' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.homepage',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
		'ip' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.ip',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'trim',
			)
		),
		'p_or_a' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.p_or_a',		
			'config' => array (
				'type'     => 'input',
				'size'     => '7',
				'max'      => '8',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-1000000'
				),
				'default' => 0
			)
		),
		'p_max' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.p_max',		
			'config' => array (
				'type'     => 'input',
				'size'     => '7',
				'max'      => '8',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-1000000'
				),
				'default' => 0
			)
		),
		'percent' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.percent',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '100',
					'lower' => '-100'
				),
				'default' => 0
			)
		),
		'o_max' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.o_max',		
			'config' => array (
				'type'     => 'input',
				'size'     => '7',
				'max'      => '8',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-1000000'
				),
				'default' => 0
			)
		),
		'o_percent' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.o_percent',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '100',
					'lower' => '-100'
				),
				'default' => 0
			)
		),
		'qids' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.qids',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tx_myquizpoll_question',	
				'size' => 4,	
				'minitems' => 0,
				'maxitems' => 200,
			)
		),
		'cids' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.cids',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tx_myquizpoll_question',	
				'size' => 3,	
				'minitems' => 0,
				'maxitems' => 200,
			)
		),
		'fids' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.fids',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tx_myquizpoll_question',	
				'size' => 3,	
				'minitems' => 0,
				'maxitems' => 200,
			)
		),
		'sids' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.sids',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tx_myquizpoll_question',	
				'size' => 3,	
				'minitems' => 0,
				'maxitems' => 100,
			)
		),
		'joker1' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.joker1',		
			'config' => array (
				'type' => 'check',
			)
		),
		'joker2' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.joker2',		
			'config' => array (
				'type' => 'check',
			)
		),
		'joker3' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.joker3',		
			'config' => array (
				'type' => 'check',
			)
		),
		'firsttime' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.firsttime',		
			'config' => array (
				'type'     => 'input',
				'size'     => '12',
				'max'      => '20',
				'eval'     => 'datetime',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'lasttime' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.lasttime',		
			'config' => array (
				'type'     => 'input',
				'size'     => '12',
				'max'      => '20',
				'eval'     => 'datetime',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'lastcat' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.lastcat',		
			'config' => array (
				'type' => 'select',	
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',	
				'foreign_table_where' => 'ORDER BY tx_myquizpoll_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'nextcat' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.nextcat',		
			'config' => array (
				'type' => 'select',	
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',	
				'foreign_table_where' => 'ORDER BY tx_myquizpoll_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'fe_uid' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.fe_uid',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'fe_users',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'start_uid' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.start_uid',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'pages',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name;;;richtext[]:rte_transform[mode=ts], email, homepage, ip, p_or_a;;2, qids;;3, cids, fids, sids, firsttime, lasttime, lastcat, nextcat, fe_uid, start_uid')
	),
	'palettes' => array (
		'1' => array('showitem' => ''),
		"2" => array("showitem" => "p_max, percent, o_max, o_percent"),
		"3" => array("showitem" => "joker1, joker2, joker3")
	)
);



$TCA['tx_myquizpoll_relation'] = array (
	'ctrl' => $TCA['tx_myquizpoll_relation']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,user_id,question_id,textinput,checked1,checked2,checked3,checked4,checked5,checked6,points,nextcat'
	),
	'columns' => array (
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_myquizpoll_relation',
				'foreign_table_where' => 'AND tx_myquizpoll_relation.pid=###CURRENT_PID### AND tx_myquizpoll_relation.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'user_id' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.user_id',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_myquizpoll_result',	
				'foreign_table_where' => 'AND tx_myquizpoll_result.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_result.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'question_id' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.question_id',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_myquizpoll_question',	
				'foreign_table_where' => 'AND tx_myquizpoll_question.pid=###CURRENT_PID### ORDER BY tx_myquizpoll_question.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'textinput' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.textinput',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '3',
			)
		),
		'checked1' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.checked1',
			'config' => array (
				'type' => 'check',
			)
		),
		'checked2' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.checked2',
			'config' => array (
				'type' => 'check',
			)
		),
		'checked3' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.checked3',
			'config' => array (
				'type' => 'check',
			)
		),
		'checked4' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.checked4',
			'config' => array (
				'type' => 'check',
			)
		),
		'checked5' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.checked5',
			'config' => array (
				'type' => 'check',
			)
		),
		'checked6' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.checked6',
			'config' => array (
				'type' => 'check',
			)
		),
		'points' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_relation.points',		
			'config' => array (
				'type'     => 'input',
				'size'     => '7',
				'max'      => '8',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000000',
					'lower' => '-1000000'
				),
				'default' => 0
			)
		),
		'nextcat' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_result.nextcat',		
			'config' => array (
				'type' => 'select',	
				'items' => array (
					array('',0),
				),
				'foreign_table' => 'tx_myquizpoll_category',	
				'foreign_table_where' => 'ORDER BY tx_myquizpoll_category.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, user_id, question_id, textinput, checked1, checked2, checked3, checked4, checked5, checked6, points, nextcat')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_myquizpoll_category'] = array (
	'ctrl' => $TCA['tx_myquizpoll_category']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'name,pagetime,notes,celement'
	),
	'columns' => array (
		'name' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_category.name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'max' => '255',	
				'eval' => 'trim',
			)
		),
		'pagetime' => array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_category.pagetime',
			'config' => array (
				'type'     => 'input',
				'size'     => '5',
				'max'      => '8',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '10000',
					'lower' => '0'
				),
				'default' => 0
			)
		),
		'notes' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:myquizpoll/locallang_db.xml:tx_myquizpoll_category.notes',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
			)
		),
		'celement' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:testme/locallang_db.xml:tx_myquizpoll_category.celement',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tt_content',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'name;;;richtext[]:rte_transform[mode=ts];1-1-1, pagetime, notes, celement')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);


// picasa extension
if(t3lib_extMgm::isLoaded('picasaimagebrowser')) {
	$wizConfig = array(
		'type' => 'popup',
		'icon' => 'EXT:picasaimagebrowser/picasa.gif',
		'script' => 'EXT:picasaimagebrowser/mod_imagewizard/index.php',
		'params' => array(),
		'JSopenParams' => 'height=500,width=500,status=1,menubar=0,scrollbars=1',
	);
	$TCA['tx_myquizpoll_question']['columns']['image']['config']['wizards']['tx_picasaimagebrowser'] = $wizConfig;
}
?>