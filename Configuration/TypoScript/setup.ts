
plugin.tx_bwtetris {
  view {
    templateRootPaths.0 = EXT:bw_tetris/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_bwtetris.view.templateRootPath}
    partialRootPaths.0 = EXT:bw_tetris/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_bwtetris.view.partialRootPath}
    layoutRootPaths.0 = EXT:bw_tetris/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_bwtetris.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_bwtetris.persistence.storagePid}
  }
    settings = {$plugin.tx_bwtetris.settings}
}

# Partial
page.10.partialRootPaths.10 = EXT:bw_tetris/Resources/Ext/bw_tetris_tmp/Private/Partials/

# Benutzername
lib.user = COA_INT
lib.user {
    1 = TEXT
    1.data = global:_COOKIE|name
}