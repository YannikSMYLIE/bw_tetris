<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang.xlf:tx_bwtetris_domain_model_controlls',
        'label' => 'fe_user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
		'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [],
		'searchFields' => '',
        'iconfile' => 'EXT:bw_tetris/Resources/Public/Icons/Models/tx_bwtetris_domain_model_controlls.svg'
    ],
    'interface' => [
		'showRecordFieldList' => '',
    ],
    'types' => [
		'1' => ['showitem' => '
		    left,right,down,drop,rotate,pause,fe_user,
		     --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, hidden, sys_language_uid, l10n_parent, l10n_diffsource, starttime, endtime'],
    ],
    'columns' => [
        'left' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang.xlf:tx_bwtetris_domain_model_controlls.left',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int,required'
            ],
        ],
        'right' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang.xlf:tx_bwtetris_domain_model_controlls.right',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int,required'
            ],
        ],
        'down' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang.xlf:tx_bwtetris_domain_model_controlls.down',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int,required'
            ],
        ],
        'drop' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang.xlf:tx_bwtetris_domain_model_controlls.drop',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int,required'
            ],
        ],
        'rotate' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang.xlf:tx_bwtetris_domain_model_controlls.rotate',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int,required'
            ],
        ],
        'pause' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang.xlf:tx_bwtetris_domain_model_controlls.pause',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int,required'
            ],
        ],
        'fe_user' => [
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang.xlf:tx_bwtetris_domain_model_controlls.fe_user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
            ],
        ],
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_bwtetris_domain_model_controlls',
                'foreign_table_where' => 'AND tx_bwtetris_domain_model_controlls.pid=###CURRENT_PID### AND tx_bwtetris_domain_model_controlls.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
		't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
    ],
];
