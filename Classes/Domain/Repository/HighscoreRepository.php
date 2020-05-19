<?php
namespace BoergenerWebdesign\BwTetris\Domain\Repository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Extbase\Property\PropertyMapper;

class HighscoreRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    const names = ["C-3PO", "BB-8", "R2-D2"];

    // Order by BE sorting
    protected $defaultOrderings = array(
        'points' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
    );

    /**
     * Speichert einen Highscore im laufenden Spiel
     * @param \BoergenerWebdesign\BwTetris\Domain\Model\Highscore $highscore
     */
    public function save(\BoergenerWebdesign\BwTetris\Domain\Model\Highscore $highscore) : void {
        // Selbst wenn es bereits existiert über add gehen...
        $this -> add($highscore);
    }

    /**
     * Gibt eine Anzahl an Highscores in sortierte Reihenfolge aus.
     * @param string $mode
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
     * @param int $limit
     * @return array
     */
    public function findHighscores(string $mode, \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser = null, int $limit = 15) : array {
        $realScores = $this -> getByMode($mode, $feUser, $limit, true);

        $scores = array_merge(
            $realScores,
            $this -> createFakeScores($limit  - count($realScores))
        );
        return $scores;
    }

    /**
     * Ermittelt alle Punktestände eines gewissen Modus.
     * @param string $mode
     * @param int $limit
     */
    public function getByMode(string $mode, \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser = null, int $limit = 0, bool $asArray = false) {
        if(!$feUser) {
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_bwtetris_domain_model_highscore')->createQueryBuilder();
            $queryBuilder
                -> select('fe_user', 'uid')
                -> from('tx_bwtetris_domain_model_highscore')
                ->addSelectLiteral(
                    $queryBuilder -> expr() -> max('points', 'maxPoints')
                )
                -> orderBy('maxPoints', 'DESC')
                -> groupBy('fe_user')
                -> where(
                    $queryBuilder->expr()->neq('fe_user', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
                );
            $statement = $queryBuilder -> execute();
            $results = $statement -> fetchAll();

            $highscores = [];
            foreach($results as $highscoreData) {
                $userQuery = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_bwtetris_domain_model_highscore')->createQueryBuilder();
                $userQuery
                    -> select('fe_user', 'points', 'date', 'uid')
                    -> from('tx_bwtetris_domain_model_highscore')
                    -> where(
                        $queryBuilder->expr()->eq('fe_user', $highscoreData["fe_user"]),
                        $queryBuilder->expr()->eq('points', $highscoreData["maxPoints"])
                    );
                $userStatement = $userQuery -> execute();
                $record = $userStatement -> fetchAll()[0];

                $record["feUser"] = $record["fe_user"];
                unset($record["fe_user"]);
                /** @var \BoergenerWebdesign\BwTetris\Domain\Model\Highscore $highscore */
                $highscore = $this -> objectManager -> get(PropertyMapper::class)
                    ->convert(
                        $record,
                        \BoergenerWebdesign\BwTetris\Domain\Model\Highscore::class
                    );
                $highscore -> setDate(\DateTime::createFromFormat("Y-m-d H:i:s", $record["date"]));
                $highscores[] = $highscore;
            }
            return $highscores;






        } else {
            $query = $this->createQuery();
            $query -> matching(
                $query -> logicalAnd([
                    $query -> equals('mode', $mode),
                    $query -> equals('fe_user', $feUser -> getUid())
                ])
            );
            $query -> setOrderings([
                'points' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
            ]);
            if($limit) {
                $query -> setLimit($limit);
            }
            $result = $query -> execute();

            return $asArray ? $this -> queryresultToArray($result) : $result;
        }
    }

    /**
     * Erzeugt gefälschte Highscores.
     * @param int $amount
     * @return array
     */
    private function createFakeScores(int $amount) : array {
        $fakeScores = [];
        for($i = 0; $i < $amount; $i++) {
            $score = new \BoergenerWebdesign\BwTetris\Domain\Model\Highscore();
            $score -> setPoints(($amount - $i) * 10);
            $score -> setName(self::names[array_rand(self::names)]);
            $score -> setDate(new \DateTime());
            $fakeScores[] = $score;
        }
        return $fakeScores;
    }

    /**
     * Wandelt ein QueryResultSet in ein Array um.
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $result
     * @return array
     */
    private function queryresultToArray(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $result) : array {
        $array = [];
        foreach($result as $score) {
            $array[] = $score;
        }
        return $array;
    }



















    /**
     * Ermittelt wieviele Spiele der Spieler noch spielen darf.
     * @param int $userUid
     * @return int
     */
    public function gamesLeft(int $userUid) : int {
        if(!$userUid) return 0;

        // Einen Tag vorher ermitteln
        $minusOneDay = (new \DateTime()) -> sub(new \DateInterval("P1D"));

        // Highscores ermitteln
        $query = $this -> createQuery();
        $query -> matching(
            $query -> logicalAnd([
                $query -> greaterThanOrEqual('date', $minusOneDay -> format("Y-m-d H:i:s")),
                $query -> equals('fe_user', $userUid)
            ])
        );
        $result = $query -> execute();

        return 5 - $result -> count();
    }

    /**
     * Ermittelt wann ein neues Spiel freigeschaltet wird.
     * @param int $userUid
     * @return int
     */
    public function nextGame(int $userUid) : int {
        if(!$userUid) return 0;

        // Einen Tag vorher ermitteln
        $minusOneDay = (new \DateTime()) -> sub(new \DateInterval("P1D"));

        // Highscores ermitteln
        $query = $this -> createQuery();
        $query -> matching(
            $query -> logicalAnd([
                $query -> greaterThanOrEqual('date', $minusOneDay -> format("Y-m-d H:i:s")),
                $query -> equals('fe_user', $userUid)
            ])
        );
        $query -> setOrderings(['date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING]);
        $result = $query -> execute(true);

        if($result) {
            $datetime = \DateTime::createFromFormat("Y-m-d H:i:s", $result[0]["date"]);
            if($datetime) {
                $datetime -> add(new \DateInterval("P1D"));
                return $datetime ? $datetime -> format("U") : 0;
            }
        }
        return 0;


        return 5 - $result -> count();
    }
}