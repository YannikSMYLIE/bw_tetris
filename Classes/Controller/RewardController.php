<?php
namespace BoergenerWebdesign\BwTetris\Controller;

class RewardController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
    /**
     * Zeigt die Tafel
     * @param array $result
     */
    public function listAction(array $result = null) : void {
        if(!$result) {
            $this -> view -> assign('wrong', false);
            $result = [
                [0,0,0],
                [0,0,0],
                [0,0,0],
            ];
        } else {
            $this -> view -> assign('wrong', true);
        }
        $this -> view -> assign('result', $result);
    }

    /**
     * Überprüft die Eingabe
     * @param array $result
     */
    public function checkAction(array $result) : void {
        // Korrektheit prüfen
        $korrekt = [
            [0,1,2],
            [2,3,4],
            [1,5,0],
        ];
        foreach($result as $keyX => $row) {
            foreach($row as $keyY => $value) {
                if($korrekt[$keyX][$keyY] != $result[$keyX][$keyY]) {
                    $this -> redirect('list', null, null, ['result' => $result]);
                }
            }
        }

        // Auf den Schatz verlinken
        $uriBuilder = $this->uriBuilder;
        $uri = $uriBuilder
            ->setTargetPageUid($this -> settings["rewardPage"])
            ->build();
        $this->redirectToUri($uri);
    }
}
