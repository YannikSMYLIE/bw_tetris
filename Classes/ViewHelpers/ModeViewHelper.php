<?php
namespace BoergenerWebdesign\BwTetris\ViewHelpers;

class ModeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    /**
     * @param string $name
     */
    public function render($name = "") {
        switch($name) {
            case "default": return "Original"; break;
            case "carousel": return "Karussell"; break;
            case "cube": return "Würfel"; break;
            case "old": return "Altersheim"; break;
            default: "N/A"; break;
        }
    }
}