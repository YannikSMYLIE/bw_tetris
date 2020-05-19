<?php
namespace BoergenerWebdesign\BwTetris\ViewHelpers;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ModeViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('name', 'string', 'Name des Modus', true);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) : string {
        switch(strtolower($arguments["name"])) {
            case "default": return "Original"; break;
            case "carousel": return "Karussell"; break;
            case "cube": return "Würfel"; break;
            case "old": return "Altersheim"; break;
            default: "N/A"; break;
        }
    }
}