<?php
namespace BoergenerWebdesign\BwTetris\Domain\Repository;

class HighscoreRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    // Order by BE sorting
    protected $defaultOrderings = array(
        'points' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
    );

    /**
     * @param int $score
     * @param string $mode
     * @param string $name
     */
    public function findOneByScoreModeAndName($score, $mode, $name) {
        $query = $this->createQuery();
        $query -> matching(
            $query -> logicalAnd([
                $query -> greaterThanOrEqual('points', $score),
                $query -> equals('mode', $mode),
                $query -> equals('name', $name)
            ])
        );
        $result = $query -> execute();
        return $result -> current();
    }

    /**
     * @param int $score
     * @param string $mode
     */
    public function findByMode($mode) {
        $query = $this->createQuery();
        $query -> matching($query -> equals('mode', $mode));
        $query -> setOrderings([
            'points' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
        ]);
        $result = $query -> execute();
        return $result;
    }
}