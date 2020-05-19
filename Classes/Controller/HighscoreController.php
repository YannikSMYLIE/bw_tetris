<?php
namespace BoergenerWebdesign\BwTetris\Controller;

class HighscoreController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
    /**
     * @var \BoergenerWebdesign\BwTetris\Domain\Repository\HighscoreRepository
     * @inject
     */
    protected $highscoreRepository = NULL;
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $feUserRepository = NULL;

    /**
     * Initialisiert den Controller
     */
    public function initializeAction() : void {
        $querySettings = $this -> objectManager -> get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings -> setRespectStoragePage(FALSE);
        $this -> feUserRepository -> setDefaultQuerySettings($querySettings);
    }


    /**
     * @param string $mode
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
     * @param boolean $backlink
     * @return void
     */
    public function listAction($mode = "Default", \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser = null, $backlink = false) : void {
        $highscores = $this->highscoreRepository->findHighscores($mode, $feUser, 15);

        $this->view->assignMultiple([
            'scores' => $highscores,
            'currentMode' => $mode,
            'currentModeLc' => strtolower($mode),
            'feuser' => $GLOBALS['TSFE']->fe_user->user["uid"] ?? 0,
            'feusers' => $this -> getFeUsers(),
            'selectedUser' => $feUser,
            'modes' => $GLOBALS['TYPO3_CONF_VARS']["EXTENSIONS"]["bw_tetris"]["modes"],
            'gamesleft' => $this -> highscoreRepository -> gamesLeft($GLOBALS['TSFE']->fe_user->user["uid"] ?? 0),
            'backlink' => $backlink
        ]);
    }

    public function initializeSaveAction() : void {
        if(!$this -> request -> getArgument("highscore")["uid"]) {
            $propertyMappingConfiguration = $this->arguments['highscore']->getPropertyMappingConfiguration();
            $propertyMappingConfiguration -> skipProperties("uid");
        }
    }

    /**
     * Speichert einen Spielstand.
     * @param \BoergenerWebdesign\BwTetris\Domain\Model\Highscore $highscore
     * @throws \Exception
     */
    public function saveAction(\BoergenerWebdesign\BwTetris\Domain\Model\Highscore $highscore) : void {
        if(isset($GLOBALS['TSFE']->fe_user->user) && $GLOBALS['TSFE']->fe_user->user['uid']) {
            $feUser = $this -> feUserRepository -> findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
            $highscore -> setFeUser($feUser);
        }
        $highscore -> setDate(new \DateTime());
        $highscore -> setEndOfGame(time());
        $this -> highscoreRepository -> save($highscore);

        if($_GET["type"] == 171994) {
            // Persistieren
            $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
            $persistenceManager->persistAll();
            // Rückgabe
            header('Content-Type: application/json');
            echo json_encode([
                "uid" => $highscore -> getUid()
            ]);
            die();
        } else {
            $this -> redirect('list', null, null, ['mode' => $highscore -> getMode(), 'backlink' => true]);
        }
    }

    /**
     * Sortiert alle Spieler alphabetisch.
     * @return array
     */
    private function getFeUsers() : array {
        $feusers = [];
        foreach($this -> feUserRepository -> findAll() as $feuser) {
            $feusers[$feuser -> getUsername()] = $feuser;
        }
        ksort($feusers);
        return array_values($feusers);
    }
}
