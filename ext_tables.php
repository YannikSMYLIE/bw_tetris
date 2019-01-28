<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bwtetris_domain_model_highscore', 'EXT:bw_tetris/Resources/Private/Language/locallang_csh_tx_bwtetris_domain_model_highscore.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bwtetris_domain_model_highscore');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bwtetris_domain_model_reward', 'EXT:bw_tetris/Resources/Private/Language/locallang_csh_tx_bwtetris_domain_model_reward.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bwtetris_domain_model_reward');
    },
    $_EXTKEY
);
