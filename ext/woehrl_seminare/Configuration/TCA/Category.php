<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_woehrlseminare_domain_model_category'] = array(
	'ctrl' => $TCA['tx_woehrlseminare_domain_model_category']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, parent',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, genius_bar, title, description, parent,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_woehrlseminare_domain_model_category',
				'foreign_table_where' => 'AND tx_woehrlseminare_domain_model_category.pid=###CURRENT_PID### AND tx_woehrlseminare_domain_model_category.hidden = 0 AND tx_woehrlseminare_domain_model_category.sys_language_uid IN (-1,0) ORDER BY tx_woehrlseminare_domain_model_category.title',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_category.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
        /*
		'genius_bar' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			//~ 'displayCond' => 'FIELD:sys_language_uid:=:0',
			'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_category.genius_bar',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
        */
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_category.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
		'parent' => array(
			'exclude' => 0,
			//~ 'displayCond' => 'FIELD:sys_language_uid:=:0',
			'l10n_mode' => 'exclude',
			//~ 'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_category.parent',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlseminare_domain_model_category',
				'foreign_table_where' => 'AND tx_woehrlseminare_domain_model_category.genius_bar = ###REC_FIELD_genius_bar### AND (tx_woehrlseminare_domain_model_category.sys_language_uid = 0 OR tx_woehrlseminare_domain_model_category.l10n_parent = 0) AND tx_woehrlseminare_domain_model_category.pid = ###CURRENT_PID### AND tx_woehrlseminare_domain_model_category.hidden = 0 ORDER BY tx_woehrlseminare_domain_model_category.sorting ASC',
				'renderMode' => 'tree',
				'subType' => 'db',
				'treeConfig' => array(
					'parentField' => 'parent',
					'appearance' => array(
						'expandAll' => TRUE,
						'showHeader' => FALSE,
						'maxLevels' => 10,
						'width' => 500,
					),
				),
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems'      => 2,
			),
		),
		'category' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);

?>
