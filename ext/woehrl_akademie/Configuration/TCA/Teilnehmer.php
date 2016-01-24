<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_woehrlakademie_domain_model_teilnehmer'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_woehrlakademie_domain_model_teilnehmer']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, anrede, vorname, nachname, filiale, position, personal_nr, kostenstelle, email, telefon, genehmigt, emaildesvorgesezten',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, anrede, vorname, nachname, filiale, position, personal_nr, kostenstelle, email, telefon, genehmigt, emaildesvorgesezten, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_woehrlakademie_domain_model_teilnehmer',
				'foreign_table_where' => 'AND tx_woehrlakademie_domain_model_teilnehmer.pid=###CURRENT_PID### AND tx_woehrlakademie_domain_model_teilnehmer.sys_language_uid IN (-1,0)',
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

		'anrede' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.anrede',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'vorname' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.vorname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'nachname' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.nachname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'filiale' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.filiale',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'position' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.position',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'personal_nr' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.personal_nr',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'kostenstelle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.kostenstelle',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'telefon' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.telefon',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'genehmigt' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.genehmigt',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'emaildesvorgesezten' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:woehrl_akademie/Resources/Private/Language/locallang_db.xlf:tx_woehrlakademie_domain_model_teilnehmer.emaildesvorgesezten',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
	),
);
