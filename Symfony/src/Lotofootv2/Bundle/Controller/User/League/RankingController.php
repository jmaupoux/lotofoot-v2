<?php

namespace Lotofootv2\Bundle\Controller\User\League;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RankingController extends Controller
{
	/**
     * @Route("/league/ranking", name="_league_ranking")
     */
    public function indexAction()
    {
    	$accounts = $this->get('league_service')->getRunningLeagueAccounts();
    	
    	return $this->render('Lotofootv2Bundle:User\League:ranking.html.twig', array('accounts' => $accounts));
    }
}
