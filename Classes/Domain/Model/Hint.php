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
class Hint extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * highscoreRepository
     *
     * @var \BoergenerWebdesign\BwTetris\Domain\Repository\HighscoreRepository
     * @inject
     */
    protected $highscoreRepository = NULL;


    /**
     * points
     *
     * @var int
     */
    protected $points = 0;

    /**
     * mode
     *
     * @var string
     */
    protected $mode = '';

    /**
     * start
     *
     * @var \DateTime
     */
    protected $start = null;

    /**
     * text
     *
     * @var string
     */
    protected $text = '';

    /**
     * images
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @cascade remove
     */
    protected $images = null;

    /**
     * files
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @cascade remove
     */
    protected $files = null;

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
     * @param string $points
     * @return void
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

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
     * Returns the start
     *
     * @return \DateTime $start
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Sets the start
     *
     * @param \DateTime $start
     * @return void
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;
    }

    /**
     * Returns the text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the images
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Domain\Model\FileReference $images)
    {
        $this->images = $images;
    }

    /**
     * Returns the files
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $files
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Sets the files
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $files
     * @return void
     */
    public function setFiles(\TYPO3\CMS\Extbase\Domain\Model\FileReference $files)
    {
        $this->files = $files;
    }

    /**
     * @var \BoergenerWebdesign\BwTetris\Domain\Model\Reward
     */
    protected $reward = null;
    public function getReward() {
        return $this -> reward;
    }

    public function getIsUnlocked() {
        $notAntonia = isset($_COOKIE["name"]) && $_COOKIE["name"] != "Antonia";

        $currentTime = new \DateTime();
        $highscore = $this -> highscoreRepository -> findOneByScoreModeAndName($this -> getPoints(), $this -> getMode(), "Antonia");

        return $this -> getStart() <= $currentTime && $highscore || $notAntonia;
    }

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $video;
    /**
     * Returns the video
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Sets the video
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference video
     * @return void
     */
    public function setVideo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $video)
    {
        $this->video = $video;
    }
}
