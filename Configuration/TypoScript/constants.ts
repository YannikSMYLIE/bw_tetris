
plugin.tx_bwtetris {
  view {
    # cat=plugin.tx_bwtetris/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:bw_tetris/Resources/Private/Templates/
    # cat=plugin.tx_bwtetris/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:bw_tetris/Resources/Private/Partials/
    # cat=plugin.tx_bwtetris/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:bw_tetris/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_bwtetris//a; type=string; label=Default storage PID
    storagePid =
  }
  settings {
    loginPage = 0
      gamePage = 0
  }
}