<?php

namespace Lotofootv2\Bundle\Controller\User\League;

use Lotofootv2\Bundle\Entity\LeagueVote;
use Lotofootv2\Bundle\LotofootUtil;

use Lotofootv2\Bundle\Entity\LeagueMatch;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use \DateTime;

class ResultsController extends Controller
{
	/**
     * @Route("/league/results", name="_league_results")
     * @Method("GET")
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
    	
    	//no day found
    	if($leagueDay == null){
    		return $this->render('Lotofootv2Bundle:User\League:vote.html.twig', array('leagueDay' => $day));
    	}
    	
    	if($leagueDay->getDeadline() > new DateTime()){
    		return $this->voteOpenAction($request, $leagueDay);
    	}else{
    		return $this->redirect($this->generateUrl('_league_vote_recap', array('d'=>$leagueDay->getNumber())));
    	}
    }

}
