<?php

namespace Lotofootv2\Bundle\Controller\User\League;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class RankingDayController extends Controller
{
	/**
     * @Route("/league/ranking/day", name="_league_ranking_day")
     */
    public function indexAction(Request $request)
    {
    	$leagueDay = null;
    	if($request->query->get('next')){
    		$leagueDay = $this->get('league_service')->getNextLeagueDay($request->query->get('next'));
    	}
    	else if($request->query->get('prev')){
    		$leagueDay = $this->get('league_service')->getPreviousLeagueDay($request->query->get('prev'));
    	}
    	    	
    	if($leagueDay == null){
    		$leagueDay = $this->get('league_service')->getLastLeagueDay();
    	}
    	
    	if($leagueDay == null){
    		return ;//TODO
    	}
    	
    	if(!$leagueDay->getCorrected()){
    		$leagueDay = $this->get('league_service')->getPreviousLeagueDay($leagueDay->getNumber());
	    	if($leagueDay == null){
	    		return ;//TODO
	    	}
    	}
   		
    	$histories = $this->get('league_service')->getLeagueDayHistories($leagueDay->getId());
    	
    	$accounts = $this->get('league_service')->getRunningLeagueAccounts();
    	
    	foreach($accounts as $acc){
    		$request->request->set('acc_'.$acc->getId(), $acc->getUsername());
    	}

    	return $this->render('Lotofootv2Bundle:User\League:ranking_day.html.twig', array('day' => $leagueDay, 'histories' => $histories));
    }
}
