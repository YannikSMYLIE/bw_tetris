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
class RewardController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * rewardRepository
     *
     * @var \BoergenerWebdesign\BwTetris\Domain\Repository\RewardRepository
     * @inject
     */
    protected $rewardRepository = NULL;


    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $rewards = $this->rewardRepository->findAll();
        $this->view->assign('rewards', $rewards);
    }
}
