<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore',
        'label' => 'points',
        'label_alt' => 'mode',
        'label_alt_force' => 1,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
		'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
		'searchFields' => 'mode,points,date,name',
        'iconfile' => 'EXT:bw_tetris/Resources/Public/Icons/tx_bwtetris_domain_model_highscore.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, mode, points, date, name',
    ],
    'types' => [
		'1' => ['showitem' => '
		     hidden, name, date, mode, points,
		     --div--;Statistik, stone_l, stone_j, stone_i, stone_o, stone_s, stone_z, stone_t, key_left, key_right, rotate, begin_of_game, end_of_game,
		     --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, sys_language_uid, l10n_parent, l10n_diffsource, starttime, endtime'],
    ],
    'columns' => [
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
                'foreign_table' => 'tx_bwtetris_domain_model_highscore',
                'foreign_table_where' => 'AND tx_bwtetris_domain_model_highscore.pid=###CURRENT_PID### AND tx_bwtetris_domain_model_highscore.sys_language_uid IN (-1,0)',
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
		'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
		'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
        ],
        'mode' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.mode',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'points' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.points',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
        'date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.date',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'default' => '0000-00-00'
            ],
        ],
        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.name',
            'config' => [
                'type' => 'input',
                'eval' => 'trim'
            ],
        ],
        // Statistik
        'stone_l' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.stone_l',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'stone_j' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.stone_j',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'stone_i' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.stone_i',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'stone_o' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.stone_o',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'stone_s' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.stone_s',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'stone_z' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.stone_z',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'stone_t' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.stone_t',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'key_left' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.key_left',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'key_right' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.key_right',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'rotate' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.rotate',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'begin_of_game' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.begin_of_game',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'end_of_game' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_tetris/Resources/Private/Language/locallang_db.xlf:tx_bwtetris_domain_model_highscore.end_of_game',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
    ],
];
