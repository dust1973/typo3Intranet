<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_woehrlseminare_domain_model_subscriber'] = array(
	'ctrl' => $TCA['tx_woehrlseminare_domain_model_subscriber']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden,gender,vorname, name, email,haus, telephone,position, kostenstelle, customerid, number, message,emaildesvorgesetzten, editcode, crdate, event',
	),
	'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,gender, vorname,name, email,haus, telephone,position, kostenstelle, customerid, number, message,emaildesvorgesetzten, editcode, crdate, event,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_woehrlseminare_domain_model_subscriber',
				'foreign_table_where' => 'AND tx_woehrlseminare_domain_model_subscriber.pid=###CURRENT_PID### AND tx_woehrlseminare_domain_model_subscriber.sys_language_uid IN (-1,0)',
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
        'gender' => array (
            'exclude' => 1,
            'label'  => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.gender',
            'config' => array (
                'type'    => 'select',
                'default' => 'Bitte wählen',
                'items'   => array(
                    array('LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.gender.m', '1'),
                    array('LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.gender.f', '2')
                )
            )
        ),
        'vorname' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.vorname',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'email' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'haus' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.haus',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'position' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.position',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'telephone' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.telephone',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'kostenstelle' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.kostenstelle',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('-- Label --', 0),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ),
        ),
        'customerid' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.customerid',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'int,trim,required'
            ),
        ),
        'number' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.number',
            'config' => array(
                'type' => 'input',
                'size' => 4,
                'default' => 1,
                'eval' => 'int'
            ),
        ),
        'message' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.message',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 2,
                'eval' => 'trim,required'
            ),
        ),
        'emaildesvorgesetzten' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.emaildesvorgesetzten',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'editcode' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.editcode',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'crdate' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.crdate',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'datetime',
                'checkbox' => 1,
                'default' => time()
            ),
        ),
        'event' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:woehrl_seminare/Resources/Private/Language/locallang_db.xlf:tx_woehrlseminare_domain_model_subscriber.event',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_woehrlseminare_domain_model_event',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        'event' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
    ),
);


$TCA['tx_woehrlseminare_domain_model_subscriber']['columns']['kostenstelle']['config']['items'] = array(
    array('8-001-6030 - Nürnberg', '8-001-6030'),
    array('8-002-6030 - Bamberg', '8-002-6030'),
    array('8-003-6030 - Erlangen', '8-003-6030'),
    array('8-004-6030 - Roth', '8-004-6030'),
    array('8-005-6030 - Würzburg', '8-005-6030'),
    array('8-007-6030 - München', '8-007-6030'),
    array('8-008-6030 - Weiden', '8-008-6030'),
    array('8-009-6030 - Nbg. Langwasser', '8-009-6030'),
    array('8-010-6030 - Straubing', '8-010-6030'),
    array('8-011-6030 - Bad Neustadt', '8-011-6030'),
    array('8-012-6030 - Ansbach', '8-012-6030'),
    array('8-013-6030 - Fürth', '8-013-6030'),
    array('8-014-6030 - Ulm', '8-014-6030'),
    array('8-015-6030 - Landshut', '8-015-6030'),
    array('8-016-6030 - München-Feringa', '8-016-6030'),
    array('8-017-6030 - Voelk,Wuerzburg', '8-017-6030'),
    array('8-019-6030 - Leipzig Nova Eventis', '8-019-6030'),
    array('8-020-6030 - Neuperlach', '8-020-6030'),
    array('8-021-6030 - Augsburg', '8-021-6030'),
    array('8-022-6030 - Passau', '8-022-6030'),
    array('8-023-6030 - Bamberg', '8-023-6030'),
    array('8-024-6030 - Hof', '8-024-6030'),
    array('8-025-6030 - Schweinfurt', '8-025-6030'),
    array('8-026-6030 - Plauen', '8-026-6030'),
    array('8-027-6030 - Traunreut', '8-027-6030'),
    array('8-028-6030 - Neumarkt', '8-028-6030'),
    array('8-030-6030 - Westpark Ingolstadt', '8-030-6030'),
    array('8-031-6030 - Dresden', '8-031-6030'),
    array('8-032-6030 - Zwickau', '8-032-6030'),
    array('8-033-6030 - Bayreuth', '8-033-6030'),
    array('8-034-6030 - Magdeburg', '8-034-6030'),
    array('8-035-6030 - Deggendorf', '8-035-6030'),
    array('8-037-6030 - Berlin', '8-037-6030'),
    array('8-038-6030 - Coburg', '8-038-6030'),
    array('8-039-6030 - Amberg', '8-039-6030'),
    array('8-041-6030 - Regensburg', '8-041-6030'),
    array('8-045-6030 - Grosskunden', '8-045-6030'),
    array('8-078-6030 - Akademie', '8-078-6030'),
    array('8-060-6030 - Esprit Store', '8-060-6030'),
    array('8-064-6030 - Outlet Augsburg', '8-064-6030'),

    array('8-150-8020 - Bau/ZML', '8-150-8020'),
    array('8-150-4020 - Marketing/Werbung', '8-150-4020'),
    array('8-150-1020 - Revision', '8-150-1020'),
    array('8-150-4040 - Deko/VM', '8-150-4040'),
    array('8-150-5030 - Controlling', '8-150-5030'),
    array('8-150-5020  - Finanz-, Rechnungswesen', '8-150-5020'),
    array('8-150-4030 - Kommunikation/PR/Markenstrategie', '8-150-4030'),
    array('8-150-1000 - Vorstand', '8-150-1000'),
    array('8-150-1030 - Recht', '8-150-1030'),
    array('8-150-3070 - Buying Support', '8-150-3070'),
    array('8-166-6030 - Logistik', '8-166-6030'),
    array('8-150-5040 - IT', '8-150-5040'),
    array('8-150-6020 - Personal', '8-150-6020'),
    array('8-150-2010 - Verkaufsleitung', '8-150-2010'),
    array('8-150-3050 - Einkauf U-eins', '8-150-3050'),
    array('8-150-3010 - Einkauf HAKA', '8-150-3010'),
    array('8-150-3020 - Einkauf DOB', '8-150-3020'),
    array('8-150-3040 - Einkauf Wäesche', '8-150-3040'),
    array('8-150-3030 - Einkauf Kids', '8-150-3030'),
    array('8-150-3060 - Einkauf Sport', '8-150-3060'),
    array('8-150-3062 - Einkaufsleitung', '8-150-3062'),

);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>
