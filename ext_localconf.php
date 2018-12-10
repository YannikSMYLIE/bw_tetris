<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'BoergenerWebdesign.BwTetris',
            'Game',
            [
                'Static' => 'selectMode, default, carousel, cube, old'
            ],
            // non-cacheable actions
            [
                'Static' => 'selectMode, default, carousel, cube, old'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'BoergenerWebdesign.BwTetris',
            'Highscore',
            [
                'Highscore' => 'list,create'
            ],
            // non-cacheable actions
            [
                'Highscore' => 'list,create'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'BoergenerWebdesign.BwTetris',
            'Rewards',
            [
                'Reward' => 'list'
            ],
            // non-cacheable actions
            [
                'Reward' => 'list'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'BoergenerWebdesign.BwTetris',
            'SelectUser',
            [
                'Static' => 'select, set'
            ],
            // non-cacheable actions
            [
                'Static' => 'select, set'
            ]
        );
    },
    $_EXTKEY
);
