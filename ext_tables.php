<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'BoergenerWebdesign.BwTetris',
            'Game',
            'Tetris Spiel'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'BoergenerWebdesign.BwTetris',
            'Highscore',
            'Tetris Highscore'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'BoergenerWebdesign.BwTetris',
            'Rewards',
            'Tetris Rewards'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'BoergenerWebdesign.BwTetris',
            'SelectUser',
            'Select User'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Tetris');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bwtetris_domain_model_highscore', 'EXT:bw_tetris/Resources/Private/Language/locallang_csh_tx_bwtetris_domain_model_highscore.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bwtetris_domain_model_highscore');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bwtetris_domain_model_reward', 'EXT:bw_tetris/Resources/Private/Language/locallang_csh_tx_bwtetris_domain_model_reward.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bwtetris_domain_model_reward');

    },
    $_EXTKEY
);
