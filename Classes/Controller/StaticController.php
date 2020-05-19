<?php
namespace BoergenerWebdesign\BwTetris\Controller;

class StaticController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \BoergenerWebdesign\BwTetris\Domain\Repository\HighscoreRepository
     * @inject
     */
    protected $highscoreRepository = null;
    /**
     * @var \BoergenerWebdesign\BwTetris\Domain\Repository\ControllsRepository
     * @inject
     */
    protected $controllsRepository = NULL;
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $feUserRepository = NULL;

    /**
     * Auswahl welcher Modus gespielt werden soll.
     */
    public function listModesAction() {
        $this -> view -> assignMultiple([
            'modes' => $GLOBALS['TYPO3_CONF_VARS']["EXTENSIONS"]["bw_tetris"]["modes"],
            'gamesleft' => $this -> highscoreRepository -> gamesLeft($GLOBALS['TSFE']->fe_user->user["uid"] ?? 0),
            'nextgame' => $this -> highscoreRepository -> nextGame($GLOBALS['TSFE']->fe_user->user["uid"] ?? 0)
        ]);
    }

    /**
     * Normaler Modus
     */
    public function defaultAction() {
        if(!$this -> highscoreRepository -> gamesLeft($GLOBALS['TSFE']->fe_user->user["uid"] ?? 0)) {
            $this -> redirect('listModes');
        }

        $this -> view -> assignMultiple([
            'beginOfGame' => time(),
            'controls' => $this -> getControls()
        ]);
    }

    /**
     * Carousel Modus
     */
    public function carouselAction() {
        if(!$this -> highscoreRepository -> gamesLeft($GLOBALS['TSFE']->fe_user->user["uid"] ?? 0)) {
            $this -> redirect('listModes');
        }

        $this -> view -> assignMultiple([
            'beginOfGame' => time(),
            'controls' => $this -> getControls()
        ]);
    }

    /**
     * Würfelmodus
     */
    public function cubeAction() {
        if(!$this -> highscoreRepository -> gamesLeft($GLOBALS['TSFE']->fe_user->user["uid"] ?? 0)) {
            $this -> redirect('listModes');
        }

        $this -> view -> assignMultiple([
            'beginOfGame' => time(),
            'controls' => $this -> getControls()
        ]);
    }

    /**
     * Altersheim Modus
     */
    public function oldAction() {
        if(!$this -> highscoreRepository -> gamesLeft($GLOBALS['TSFE']->fe_user->user["uid"] ?? 0)) {
            $this -> redirect('listModes');
        }

        $this -> view -> assignMultiple([
            'beginOfGame' => time(),
            'controls' => $this -> getControls()
        ]);
    }


    public function getControls() : \BoergenerWebdesign\BwTetris\Domain\Model\Controlls {
        /** @var \BoergenerWebdesign\BwTetris\Domain\Model\Controlls $controlls */
        $controlls = null;
        if(isset($GLOBALS['TSFE']->fe_user->user) && $GLOBALS['TSFE']->fe_user->user['uid']) {
            $feUser = $this->feUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
            $controlls = $this -> controllsRepository -> findOneByFeUser($feUser);
        }
        if(!$controlls) {
            $controlls = new \BoergenerWebdesign\BwTetris\Domain\Model\Controlls();
        }
        return $controlls;
    }
}