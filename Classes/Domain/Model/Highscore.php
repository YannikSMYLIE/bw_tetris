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
 * Highscore
 */
class Highscore extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * mode
     *
     * @var string
     */
    protected $mode = '';

    /**
     * points
     *
     * @var int
     */
    protected $points = '';

    /**
     * Returns the mode
     *
     * @return string $mode
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Sets the mode
     *
     * @param string $mode
     * @return void
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * Returns the points
     *
     * @return int $points
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Sets the points
     *
     * @param int $points
     * @return void
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }


    /**
     * @var string
     */
    protected $name = '';
    /**
     * @param string $name
     */
    public function setName($name) {
        $this -> name = $name;
    }
    /**
     * @return string
     */
    public function getName() {
        return $this -> name;
    }

    /**
     * @var \DateTime
     */
    protected $date = null;
    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date) {
        $this -> date = $date;
    }
    /**
     * @return \DateTime
     */
    public function getDate() {
        return $this -> date;
    }


    /**
     * @var int
     */
    protected $stoneL;
    /**
     * @return int
     */
    public function getStoneL() {
        return $this -> stoneL;
    }
    /**
     * @param $stoneL int
     */
    public function setStoneL($stoneL) {
        $this -> stoneL = $stoneL;
    }

    /**
     * @var int
     */
    protected $stoneJ;
    /**
     * @return int
     */
    public function getStoneJ() {
        return $this -> stoneJ;
    }
    /**
     * @param $stoneJ int
     */
    public function setStoneJ($stoneJ) {
        $this -> stoneJ = $stoneJ;
    }

    /**
     * @var int
     */
    protected $stoneZ;
    /**
     * @return int
     */
    public function getStoneZ() {
        return $this -> stoneZ;
    }
    /**
     * @param $stoneZ int
     */
    public function setStoneZ($stoneZ) {
        $this -> stoneZ = $stoneZ;
    }

    /**
     * @var int
     */
    protected $stoneS;
    /**
     * @return int
     */
    public function getStoneS() {
        return $this -> stoneS;
    }
    /**
     * @param stoneS int
     */
    public function setStoneS($stoneS) {
        $this -> stoneS = $stoneS;
    }

    /**
     * @var int
     */
    protected $stoneI;
    /**
     * @return int
     */
    public function getStoneI() {
        return $this -> stoneI;
    }
    /**
     * @param $stoneI int
     */
    public function setStoneI($stoneI) {
        $this -> stoneI = $stoneI;
    }

    /**
     * @var int
     */
    protected $stoneO;
    /**
     * @return int
     */
    public function getStoneO() {
        return $this -> stoneO;
    }
    /**
     * @param $stoneO int
     */
    public function setStoneO($stoneO) {
        $this -> stoneO = $stoneO;
    }

    /**
     * @var int
     */
    protected $stoneT;
    /**
     * @return int
     */
    public function getStoneT() {
        return $this -> stoneT;
    }
    /**
     * @param $stoneT int
     */
    public function setStoneT($stoneT) {
        $this -> stoneT = $stoneT;
    }

    /**
     * @var int
     */
    protected $keyLeft;
    /**
     * @return int
     */
    public function getKeyLeft() {
        return $this -> keyLeft;
    }
    /**
     * @param $keyLeft int
     */
    public function setKeyLeft($keyLeft) {
        $this -> keyLeft = $keyLeft;
    }

    /**
     * @var int
     */
    protected $keyRight;
    /**
     * @return int
     */
    public function getKeyRight() {
        return $this -> keyRight;
    }
    /**
     * @param $keyRight int
     */
    public function setKeyRight($keyRight) {
        $this -> keyRight = $keyRight;
    }

    /**
     * @var int
     */
    protected $rotate;
    /**
     * @return int
     */
    public function getRotate() {
        return $this -> rotate;
    }
    /**
     * @param $rotate int
     */
    public function setRotate($rotate) {
        $this -> rotate = $rotate;
    }

    /**
     * @var int
     */
    protected $beginOfGame;
    /**
     * @return int
     */
    public function getBeginOfGame() {
        return $this -> beginOfGame;
    }
    /**
     * @param $beginOfGame int
     */
    public function setBeginOfGame($beginOfGame) {
        $this -> beginOfGame = $beginOfGame;
    }

    /**
     * @var int
     */
    protected $endOfGame;
    /**
     * @return int
     */
    public function getEndOfGame() {
        return $this -> endOfGame;
    }
    /**
     * @param $endOfGame int
     */
    public function setEndOfGame($endOfGame) {
        $this -> endOfGame = $endOfGame;
    }
}
