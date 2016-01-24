<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_woehrlseminare_domain_model_location'] = array(
	'ctrl' => $TCA['tx_woehrlseminare_domain_model_location']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, description, link, parent',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, description, link, parent,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_woehrlseminare_domain_model_location',
				'foreign_table_where' => 'AND tx_woehrlseminare_domain_model_location.pid=###CURRENT_PID### AND tx_woehrlseminare_domain_model_location.sys_language_uid IN (-1,0)',
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
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_location.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_location.description',
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
		'link' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_location.link',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'parent' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_location.parent',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlseminare_domain_model_location',
				'foreign_table_where' => ' AND (tx_woehrlseminare_domain_model_location.sys_language_uid = 0 OR tx_woehrlseminare_domain_model_location.l10n_parent = 0) AND tx_woehrlseminare_domain_model_location.pid = ###CURRENT_PID### ORDER BY tx_woehrlseminare_domain_model_location.sorting',

				'renderMode' => 'tree',
				'subType' => 'db',
				'treeConfig' => array(
					'parentField' => 'parent',
					'appearance' => array(
						'expandAll' => TRUE,
						'showHeader' => FALSE,
						'width' => 500,
					),
				),
				'maxitems' => 2,
			),
		),
		'location' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

$TCA['tx_woehrlseminare_domain_model_location']['columns']['parent'] = array(
    'exclude' => 0,
    'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_location.parent',
    'config' => array(
        'type' => 'select',
        'foreign_table' => 'tx_woehrlseminare_domain_model_location',
        'foreign_table_where' => ' AND (tx_woehrlseminare_domain_model_location.sys_language_uid = 0 OR tx_woehrlseminare_domain_model_location.l10n_parent = 0) AND tx_woehrlseminare_domain_model_location.pid = ###CURRENT_PID### ORDER BY tx_woehrlseminare_domain_model_location.sorting',

        'renderMode' => 'tree',
        'subType' => 'db',
        'treeConfig' => array(
            'parentField' => 'parent',
            'appearance' => array(
                'expandAll' => TRUE,
                'showHeader' => FALSE,
            ),
        ),
        'maxitems' => 2,
    ),
);
?>
