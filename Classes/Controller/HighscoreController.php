<?php
namespace BoergenerWebdesign\BwTetris\Controller;

/***
 *
 * This file is part of the "Tetris" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Yannik Börgener &lt;kontakt@boergener.de&gt;, boergener webdesign
 *
 ***/

/**
 * RewardController
 */
class HighscoreController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * highscoreRepository
     *
     * @var \BoergenerWebdesign\BwTetris\Domain\Repository\HighscoreRepository
     * @inject
     */
    protected $highscoreRepository = NULL;


    /**
     * action list
     *
     * @param string $mode
     * @param boolean $backlink
     * @return void
     */
    public function listAction($mode = "default", $backlink = false)
    {
        $show = 15;
        $scores = [];

        //  Echte Highscores einlesen
        $realScores = [];
        $highscore = $this->highscoreRepository->findByMode($mode);
        for($read = 0; $highscore -> current() && $read < $show; $read++) {
            if(!array_key_exists($highscore -> current() -> getPoints(), $realScores)) {
                $realScores[$highscore -> current() -> getPoints()] = [];
            }
            $realScores[$highscore -> current() -> getPoints()][] = $highscore -> current();
            $highscore -> next();
        }
        uksort ( $realScores , function($a, $b) {
            return (int)$a < (int)$b;
        });

        $scores = [];
        foreach($realScores as $pointLevel) {
            array_values($pointLevel);
            $scores = array_merge($scores, $pointLevel);
        }

        // Platzhalter einfügen
        for($i = $show; count($scores) < $show; $i--) {
            $score = new \BoergenerWebdesign\BwTetris\Domain\Model\Highscore();
            $score -> setPoints(($i+1) * 10);
            switch(rand(0, 2)) {
                case 0: $score -> setName("C-3PO"); break;
                case 1: $score -> setName("BB-8"); break;
                case 2: $score -> setName("R2-D2"); break;
            }
            $score -> setDate(new \DateTime());
            $scores[$score -> getPoints()] = $score;
        }

        $this->view->assignMultiple([
            'scores' => array_slice($scores, 0, 15),
            'mode' => $mode,
            'startAt' => $show - count($scores),
            'backlink' => $backlink
        ]);
    }

    /**
     * @param \BoergenerWebdesign\BwTetris\Domain\Model\Highscore $newHighscore
     */
    public function createAction(\BoergenerWebdesign\BwTetris\Domain\Model\Highscore $newHighscore) {
        $newHighscore -> setDate(new \DateTime);
        $newHighscore -> setEndOfGame(time());
        $this -> highscoreRepository -> add($newHighscore);
        $this -> redirect('list', null, null, ['mode' => $newHighscore -> getMode(), 'backlink' => true]);
    }
}
