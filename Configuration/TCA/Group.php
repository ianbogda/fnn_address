<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_fnnaddress_domain_model_group'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_fnnaddress_domain_model_group']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, persons, organisations',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, persons, organisations, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_fnnaddress_domain_model_group',
				'foreign_table_where' => 'AND tx_fnnaddress_domain_model_group.pid=###CURRENT_PID### AND tx_fnnaddress_domain_model_group.sys_language_uid IN (-1,0)',
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
			'exclude' => 1,
			'label' => 'LLL:EXT:fnn_address/Resources/Private/Language/locallang_backend.xlf:tx_fnnaddress_domain_model_group.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'persons' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fnn_address/Resources/Private/Language/locallang_backend.xlf:tx_fnnaddress_domain_model_group.persons',
			'config' => array(
				'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_fnnaddress_domain_model_person',
				'allowed' => 'tx_fnnaddress_domain_model_person',
				'MM' => 'tx_fnnaddress_group_person_mm',
				'size' => 10,
				'maxitems' => 100,
                'wizards' => array(
                    'suggest' => array(
                        'type' => 'suggest',
                    )
                )
			),
		),
		'organisations' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fnn_address/Resources/Private/Language/locallang_backend.xlf:tx_fnnaddress_domain_model_group.organisations',
			'config' => array(
				'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_fnnaddress_domain_model_organisation',
				'allowed' => 'tx_fnnaddress_domain_model_organisation',
				'MM' => 'tx_fnnaddress_group_organisation_mm',
				'size' => 10,
				'maxitems' => 100,
                'wizards' => array(
                    'suggest' => array(
                        'type' => 'suggest',
                    )
                )
			),
		),
		
	),
);
