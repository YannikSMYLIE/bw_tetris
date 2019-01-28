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
class StaticController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * highscoreRepository
     *
     * @var \BoergenerWebdesign\BwTetris\Domain\Repository\HighscoreRepository
     * @inject
     */
    protected $highscoreRepository = NULL;


    public function selectModeAction() {
        $this -> checkUser();

        $notAntonia = isset($_COOKIE["name"]) && $_COOKIE["name"] != "Antonia";

        $carouselHighscore = $this -> highscoreRepository -> findOneByScoreModeAndName(3000, "default", "Antonia");
        $cubeHighscore = $this -> highscoreRepository -> findOneByScoreModeAndName(3500, "cube", "Antonia");
        $oldHighscore = $this -> highscoreRepository -> findOneByScoreModeAndName(1500, "old", "Antonia");

        $carouselTime = \DateTime::createFromFormat("d.m.Y H:i:s", "12.08.2018 00:00:00");
        $cubeTime = \DateTime::createFromFormat("d.m.Y H:i:s", "12.08.2018 00:00:00");
        $oldTime = \DateTime::createFromFormat("d.m.Y H:i:s", "12.08.2018 00:00:00");
        $nowTime = new \DateTime();

        $this -> view -> assignMultiple([
            'carousel' => true,
            'cube' => false,
            'old' => true,
            //'carousel' => $carouselHighscore != null && $nowTime >= $carouselTime || $notAntonia,
            //'cube' => $cubeHighscore != null && $nowTime >= $cubeTime || $notAntonia,
            //'old' => $oldHighscore != null && $nowTime >= $oldTime || $notAntonia,
        ]);

    }

    public function defaultAction() {
        $this -> checkUser();
        $this -> view -> assignMultiple([
            'name' => $_COOKIE["name"],
            'beginOfGame' => time()
        ]);
    }

    public function carouselAction() {
        $this -> checkUser();
        $this -> view -> assignMultiple([
            'name' => $_COOKIE["name"],
            'beginOfGame' => time()
        ]);
    }

    public function cubeAction() {
        $this -> checkUser();
        $this -> view -> assignMultiple([
            'name' => $_COOKIE["name"],
            'beginOfGame' => time()
        ]);
    }

    public function oldAction() {
        $this -> checkUser();
        $this -> view -> assignMultiple([
            'name' => $_COOKIE["name"],
            'beginOfGame' => time()
        ]);
    }

    public function selectAction() {
        unset($_COOKIE['name']);
        setcookie('name', null, -1, '/');
    }
    public function setAction() {
        if($this -> request -> getArgument("antonia")) {
            $name = "Antonia";
        } else {
            $name = $this -> request -> getArgument("name");
        }
        setcookie("name", $name);

        $url = $this
            ->controllerContext
            ->getUriBuilder()
            ->reset()
            ->setTargetPageUid($this -> settings["gamePage"])
            ->setCreateAbsoluteUri(true)
            ->buildFrontendUri();
        header("Location: ".$url);
    }

    private function checkUser() {
        if(!isset($_COOKIE["name"])) {
            $url = $this
                ->controllerContext
                ->getUriBuilder()
                ->reset()
                ->setTargetPageUid($this -> settings["loginPage"])
                ->setCreateAbsoluteUri(true)
                ->buildFrontendUri();
            header("Location: ".$url);
        }
    }
}
