# Plugin
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

# AJAX Call
bwtetris_ajax = PAGE
bwtetris_ajax {
  typeNum = 171994
  10 < tt_content.list.20.bwtetris_highscore
  config {
    disableAllHeaderCode = 1
    additionalHeaders = Content-type:application/json
    xhtml_cleaning = 0
    admPanel = 0
    debug = 0
    no_cache = 1
  }
}

# Includes
page {
  includeCSS {
    bw_tetris = EXT:bw_tetris/Resources/Public/Css/bw_tetris.scss
  }

  includeJSFooter {
    bw_tetris_helper = EXT:bw_tetris/Resources/Public/JavaScript/helper.js
    bw_tetris_elements = EXT:bw_tetris/Resources/Public/JavaScript/elements.js
    bw_tetris_peripherals = EXT:bw_tetris/Resources/Public/JavaScript/peripherals.js
    bw_tetris_game = EXT:bw_tetris/Resources/Public/JavaScript/game.js
    bw_tetris_controls = EXT:bw_tetris/Resources/Public/JavaScript/controls.js
    bw_tetris_nongame = EXT:bw_tetris/Resources/Public/JavaScript/nonegame.js
  }
}