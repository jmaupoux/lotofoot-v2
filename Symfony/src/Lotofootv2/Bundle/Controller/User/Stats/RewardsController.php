<?php

namespace Lotofootv2\Bundle\Controller\User\Stats;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RewardsController extends Controller
{
	/**
     * @Route("/stats/rewards", name="_stats_rewards")
     */
    public function indexAction()
    {
    	$rewards = $this->get('reward_service')->getRewardedAccounts();
    	
    	$this->get('logger')->info('ttt'.count($rewards));
    	
       return $this->render('Lotofootv2Bundle:User/Stats:rewards.html.twig', array('rewards' => $rewards));
    }
}
