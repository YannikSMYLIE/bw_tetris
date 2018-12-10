<?php
namespace BoergenerWebdesign\BwTetris\Domain\Repository;

class RewardRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    // Order by BE sorting
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );
}