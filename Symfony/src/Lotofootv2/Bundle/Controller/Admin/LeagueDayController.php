<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LeagueDayController extends Controller
{
	/**
     * @Route("/admin/league/day", name="_admin_league_day")
     */
    public function indexAction()
    {		
		$leagueDay = $this->get('league_service')->getNotCorrectedLeagueDay();
			
    	return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('leagueDay' => $leagueDay));
    }
}
