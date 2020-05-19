<?php
namespace BoergenerWebdesign\BwTetris\Controller;

class ControlsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $feUserRepository = NULL;
    /**
     * @var \BoergenerWebdesign\BwTetris\Domain\Repository\ControllsRepository
     * @inject
     */
    protected $controllsRepository = NULL;

    /**
     * Zeigt die aktuelle Tastaturbelegung an.
     */
    public function showAction() : void {
        /** @var \BoergenerWebdesign\BwTetris\Domain\Model\Controlls $controlls */
        $controlls = $this -> controllsRepository -> findOneByFeUser($this -> getFeUser());
        if(!$controlls) {
            $controlls = new \BoergenerWebdesign\BwTetris\Domain\Model\Controlls();
        }
        $this -> view -> assignMultiple([
            'controls' => $controlls
        ]);
    }

    /**
     * Stellt ein Interface zum Bearbeiten der Tastaturbelegung zur Verfügung.
     */
    public function editAction() : void {
        /** @var \BoergenerWebdesign\BwTetris\Domain\Model\Controlls $controlls */
        $controlls = $this -> controllsRepository -> findOneByFeUser($this -> getFeUser());
        if(!$controlls) {
            $controlls = new \BoergenerWebdesign\BwTetris\Domain\Model\Controlls();
        }
        $this -> view -> assignMultiple([
            'oldControls' => $controlls
        ]);
    }

    /**
     * Aktualisiert die Tastaturbelegung für den aktuellen Benutzer.
     * @param \BoergenerWebdesign\BwTetris\Domain\Model\Controlls $controls
     */
    public function updateAction(\BoergenerWebdesign\BwTetris\Domain\Model\Controlls $controls) : void {
        // Alte Steuerung entfernen
        /** @var \BoergenerWebdesign\BwTetris\Domain\Model\Controlls $controls */
        $oldControls = $this -> controllsRepository -> findOneByFeUser($this -> getFeUser());
        if($oldControls) {
            $this -> controllsRepository -> remove($oldControls);
        }

        // Neue Steuerung hinzufügen
        $controls -> setFeUser($this -> getFeUser());
        $this -> controllsRepository -> add($controls);

        $this -> redirect('show');
    }

    /**
     * Gibt den aktuellen FrontEnd Benutzerz zurück oder null.
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser|null
     */
    private function getFeUser() : ?\TYPO3\CMS\Extbase\Domain\Model\FrontendUser {
        if(isset($GLOBALS['TSFE']->fe_user->user) && $GLOBALS['TSFE']->fe_user->user['uid']) {
            return $this->feUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
        }
        return null;
    }
}