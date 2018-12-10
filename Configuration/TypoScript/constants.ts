
plugin.tx_bwtetris_game {
  view {
    # cat=plugin.tx_bwtetris_game/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:bw_tetris/Resources/Private/Templates/
    # cat=plugin.tx_bwtetris_game/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:bw_tetris/Resources/Private/Partials/
    # cat=plugin.tx_bwtetris_game/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:bw_tetris/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_bwtetris_game//a; type=string; label=Default storage PID
    storagePid =
  }
}

plugin.tx_bwtetris_highscore < plugin.tx_bwtetris_game
plugin.tx_bwtetris_rewards < plugin.tx_bwtetris_game
plugin.tx_bwtetris_selectuser < plugin.tx_bwtetris_game