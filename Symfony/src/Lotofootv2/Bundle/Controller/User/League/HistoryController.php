<?php

namespace Lotofootv2\Bundle\Controller\User\League;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HistoryController extends Controller
{
	/**
     * @Route("/league/history", name="_league_history")
     */
    public function indexAction()
    {   
    	$dayPointsHistory = $this->get('league_service')->getDayPointsHistory();
    	$rankingHistory = $this->get('league_service')->getRankingHistory();
    	
    	
    	return $this->render('Lotofootv2Bundle:User\League:history.html.twig', 
    		array('dayPointsHistory' => $dayPointsHistory,
    				'rankingHistory' => $rankingHistory)
    	);
    }
}
