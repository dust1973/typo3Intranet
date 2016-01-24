<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_woehrlakademie_domain_model_kurs'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_woehrlakademie_domain_model_kurs']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, kursnummer, title, kursbeginn, kursende, registrierungsbeginn, registrierungsende, subtitle, bodytext, max_teilnehmer_anzahl, preis, preview_image, files, documents, kurs_bewertung, location, kategorien, kompetenzen, zielgruppen, teilnehmer, dozent',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, kursnummer, title, kursbeginn, kursende, registrierungsbeginn, registrierungsende, subtitle, bodytext;;;richtext:rte_transform[mode=ts_links], max_teilnehmer_anzahl, preis, preview_image, files, documents, kurs_bewertung, location, kategorien, kompetenzen, zielgruppen, teilnehmer, dozent, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_woehrlakademie_domain_model_kurs',
				'foreign_table_where' => 'AND tx_woehrlakademie_domain_model_kurs.pid=###CURRENT_PID### AND tx_woehrlakademie_domain_model_kurs.sys_language_uid IN (-1,0)',
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

		'kursnummer' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.kursnummer',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'kursbeginn' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.kursbeginn',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'kursende' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.kursende',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'registrierungsbeginn' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.registrierungsbeginn',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'registrierungsende' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.registrierungsende',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'subtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.subtitle',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bodytext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.bodytext',
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
		),
		'max_teilnehmer_anzahl' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.max_teilnehmer_anzahl',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'preis' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.preis',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'preview_image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.preview_image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'previewImage',
				array('maxitems' => 1),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'files' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.files',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'documents' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.documents',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'documents',
				array('maxitems' => 1),
				'*'
			),
		),
		'kurs_bewertung' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.kurs_bewertung',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'location' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.location',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlakademie_domain_model_schulungsort',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'kategorien' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.kategorien',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlakademie_domain_model_kategorie',
				'MM' => 'tx_woehrlakademie_kurs_kategorie_mm',
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
							'table' => 'tx_woehrlakademie_domain_model_kategorie',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'kompetenzen' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.kompetenzen',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlakademie_domain_model_kompetenz',
				'MM' => 'tx_woehrlakademie_kurs_kompetenz_mm',
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
							'table' => 'tx_woehrlakademie_domain_model_kompetenz',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'zielgruppen' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.zielgruppen',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlakademie_domain_model_zielgruppe',
				'MM' => 'tx_woehrlakademie_kurs_zielgruppe_mm',
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
							'table' => 'tx_woehrlakademie_domain_model_zielgruppe',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'teilnehmer' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.teilnehmer',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlakademie_domain_model_teilnehmer',
				'MM' => 'tx_woehrlakademie_kurs_teilnehmer_mm',
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
							'table' => 'tx_woehrlakademie_domain_model_teilnehmer',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'dozent' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_kurs.dozent',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_woehrlakademie_domain_model_dozent',
				'MM' => 'tx_woehrlakademie_kurs_dozent_mm',
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
							'table' => 'tx_woehrlakademie_domain_model_dozent',
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
