<?php
namespace BoergenerWebdesign\BwTetris\Domain\Model;

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
 * Reward
 */
class Reward extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    // Initialisierung StorageObjects
    public function __construct()
    {
        $this->hints = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * title
     *
     * @var string
     */
    protected $title = '';
    /**
     * @return string
     */
    public function getTitle() {
        return $this -> title;
    }

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BoergenerWebdesign\BwTetris\Domain\Model\Hint>
     */
    protected $hints;
    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BoergenerWebdesign\BwTetris\Domain\Model\Hint> $hints
     */
    public function getHints() {
        $array = [];
        foreach($this -> hints as $hint) {
            $array[] = $hint;
        }
        /** @var \BoergenerWebdesign\BwTetris\Domain\Model\Hint $a */
        /** @var \BoergenerWebdesign\BwTetris\Domain\Model\Hint $b */
        uasort($array, function($a, $b) {
            return $a -> getStart() > $b -> getStart();
        });

        return $array;
    }

    /**
     * @var bool
     */
    protected $autoComplete;
    public function getAutoComplete() {
        return $this -> autoComplete;
    }

    /**
     * @var bool
     */
    protected $completed;
    public function getCompleted() {
        if($this -> autoComplete) {
            /** @var \BoergenerWebdesign\BwTetris\Domain\Model\Hint $hint */
            foreach($this -> getHints() as $hint) {
                if(!$hint -> getIsUnlocked()) {
                    return false;
                }
            }
            return true;
        }

        return $this -> completed;
    }
}
