<?php
namespace BoergenerWebdesign\BwTetris\Domain\Repository;

class HintRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    // Order by BE sorting
    protected $defaultOrderings = array(
        'start' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );
}