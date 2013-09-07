<?php

namespace Lotofootv2\Bundle\Controller\User\League;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VoteController extends Controller
{
	/**
     * @Route("/league/vote", name="_league_vote")
     */
    public function indexAction()
    {
		$day = $this->get('league_service')->getOpenedLeagueDay();
		
		return $this->render('Lotofootv2Bundle:User\League:vote.html.twig', array('leagueDay' => $day));
    }
}
