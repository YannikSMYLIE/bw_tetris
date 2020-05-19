<?php
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'BoergenerWebdesign.BwTetris',
    'Game',
    '[Tetris] Spiel'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'BoergenerWebdesign.BwTetris',
    'Highscore',
    '[Tetris] Highscore'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'BoergenerWebdesign.BwTetris',
    'Rewards',
    '[Tetris] Rewards'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'BoergenerWebdesign.BwTetris',
    'Controls',
    '[Tetris] Steuerung'
);

// FlexForms
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['bwtetris_game'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    "bwtetris_game",
    'FILE:EXT:bw_tetris/Configuration/FlexForm/game.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['bwtetris_rewards'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    "bwtetris_rewards",
    'FILE:EXT:bw_tetris/Configuration/FlexForm/rewards.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['bwtetris_highscore'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    "bwtetris_highscore",
    'FILE:EXT:bw_tetris/Configuration/FlexForm/highscore.xml'
);