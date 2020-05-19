<?php
defined('TYPO3_MODE') || die('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']["EXTENSIONS"]["bw_tetris"]["modes"] = [
    'Default' => 'Original',
    'Carousel' => 'Karussell',
    //'Cube' => 'Würfel',
    'Old' => 'Altersheim'
];

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'BoergenerWebdesign.BwTetris',
            'Game',
            [
                'Static' => 'listModes, default, carousel, cube, old'
            ],
            // non-cacheable actions
            [
                'Static' => 'default, carousel, cube, old'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'BoergenerWebdesign.BwTetris',
            'Highscore',
            [
                'Highscore' => 'list,save'
            ],
            // non-cacheable actions
            [
                'Highscore' => 'list,save'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'BoergenerWebdesign.BwTetris',
            'Rewards',
            [
                'Reward' => 'list,check'
            ],
            // non-cacheable actions
            [
                'Reward' => 'list,check'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'BoergenerWebdesign.BwTetris',
            'Controls',
            [
                'Controls' => 'show,edit,update'
            ],
            // non-cacheable actions
            [
                'Controls' => 'show,edit,update'
            ]
        );
    },
    $_EXTKEY
);
