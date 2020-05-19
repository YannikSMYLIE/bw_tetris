<?php
namespace BoergenerWebdesign\BwTetris\Domain\Model;

class Controlls extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $feUser = null;
    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
     */
    public function setFeUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser) : void {
        $this->feUser = $feUser;
    }
    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    public function getFeUser() : ?\TYPO3\CMS\Extbase\Domain\Model\FrontendUser {
        return $this->feUser;
    }

    /**
     * @var int
     */
    protected $rotate = 32;
    /**
     * @return int
     */
    public function getRotate() : int {
        return $this->rotate;
    }
    /**
     * @param int $rotate
     */
    public function setRotate(int $rotate) : void {
        $this->rotate = $rotate;
    }

    /**
     * @var int
     */
    protected $right = 39;
    /**
     * @param int $right
     */
    public function setRight(int $right) : void {
        $this->right = $right;
    }
    /**
     * @return int
     */
    public function getRight() : int {
        return $this->right;
    }

    /**
     * @var int
     */
    protected $left = 37;
    /**
     * @param int $left
     */
    public function setLeft(int $left) : void {
        $this->left = $left;
    }
    /**
     * @return int
     */
    public function getLeft() : int {
        return $this->left;
    }

    /**
     * @var int
     */
    protected $down = 40;
    /**
     * @param int $down
     */
    public function setDown(int $down) : void {
        $this->down = $down;
    }
    /**
     * @return int
     */
    public function getDown() : int {
        return $this->down;
    }

    /**
     * @var int
     */
    protected $drop = 38;
    /**
     * @param int $drop
     */
    public function setDrop(int $drop) : void {
        $this->drop = $drop;
    }
    /**
     * @return int
     */
    public function getDrop() : int {
        return $this->drop;
    }

    /**
     * @var int
     */
    protected $pause = 80;
    /**
     * @param int $pause
     */
    public function setPause(int $pause) : void {
        $this->pause = $pause;
    }
    /**
     * @return int
     */
    public function getPause() : int {
        return $this->pause;
    }
}
