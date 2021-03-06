<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_woehrlforum_domain_model_eintrag'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_woehrlforum_domain_model_eintrag']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, autor, betreff, i_p_adresse, zuletztbearbeitet, anzahlder_bearbeitungen, nachricht, kategorie, thema',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, autor, betreff, i_p_adresse, zuletztbearbeitet, anzahlder_bearbeitungen, nachricht, kategorie, thema, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_woehrlforum_domain_model_eintrag',
				'foreign_table_where' => 'AND tx_woehrlforum_domain_model_eintrag.pid=###CURRENT_PID### AND tx_woehrlforum_domain_model_eintrag.sys_language_uid IN (-1,0)',
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

		'autor' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_eintrag.autor',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'betreff' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_eintrag.betreff',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'i_p_adresse' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_eintrag.i_p_adresse',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zuletztbearbeitet' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_eintrag.zuletztbearbeitet',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'anzahlder_bearbeitungen' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_eintrag.anzahlder_bearbeitungen',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'nachricht' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_eintrag.nachricht',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'kategorie' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_eintrag.kategorie',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlforum_domain_model_kategorie',
				'MM' => 'tx_woehrlforum_eintrag_kategorie_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_woehrlforum_domain_model_kategorie',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'thema' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_forum/Resources/Private/Language/locallang_db.xlf:tx_woehrlforum_domain_model_eintrag.thema',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlforum_domain_model_theme',
				'MM' => 'tx_woehrlforum_eintrag_theme_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_woehrlforum_domain_model_theme',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		
	),
);
