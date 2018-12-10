
plugin.tx_bwtetris_game {
  view {
    templateRootPaths.0 = EXT:bw_tetris/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_bwtetris_game.view.templateRootPath}
    partialRootPaths.0 = EXT:bw_tetris/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_bwtetris_game.view.partialRootPath}
    layoutRootPaths.0 = EXT:bw_tetris/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_bwtetris_game.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_bwtetris_game.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_bwtetris_highscore < plugin.tx_bwtetris_game
plugin.tx_bwtetris_rewards < plugin.tx_bwtetris_game
plugin.tx_bwtetris_selectuser < plugin.tx_bwtetris_game
