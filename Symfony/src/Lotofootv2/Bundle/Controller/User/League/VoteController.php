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

class VoteController extends Controller
{
	/**
     * @Route("/league/vote", name="_league_vote")
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
    		$matches = $this->get('league_service')->getLeagueDayMatches($leagueDay->getId());
    		
	    	for($i=0;$i<count($matches);$i++){
	            if($matches[$i]->getDeadline() > new DateTime()){
	            	return $this->voteOpenAction($request, $leagueDay);
	            }
	    	}
    		
    		return $this->redirect($this->generateUrl('_league_vote_recap', array('d'=>$leagueDay->getNumber())));
    	}
    }
    
    private function voteOpenAction(Request $request, $day){
    	$accountId = $this->getUser()->getId();
					
		$matches = $this->get('league_service')->getLeagueDayMatches($day->getId());
		$votes = $this->get('league_service')->getLeagueDayVotes($day->getId(), $accountId);
		
		for($i=0;$i<count($votes);$i++){
			$request->request->set('score_'.$votes[$i]->getLeagueMatchId(), $votes[$i]->getScore());
			$request->request->set('result_'.$votes[$i]->getLeagueMatchId(), $votes[$i]->getResult());
		}
		
		$info = null;
		if($request->query->get('m') == 1){
			$info = "Votes enregistrés";
		}
		$warn = null;
    	if($request->query->has('f') && $request->query->get('f') == 0){
			$warn = "Attention, vous n'avez pas parié sur l'ensemble de la journée !";
		}
		
		return $this->render('Lotofootv2Bundle:User\League:vote.html.twig', 
			array(
			'leagueDay' => $day,
			'matches' => $matches,
			'info' => $info,
			'warn' => $warn,
			'is_king' => $this->isPunchliner($request, $day)
			)
		);
    }
    
    private function isPunchliner($request, $leagueDay){
    	$leagueDayPast = $this->get('league_service')->getPreviousLeagueDay($leagueDay->getNumber());
    	if($leagueDayPast == null){
    		return false;
    	}
    	
    	$histories = $this->get('league_service')->getLeagueDayHistories($leagueDayPast->getId());
    	
    	return $histories[0]->getAccountId() == $this->getUser()->getId();
    }
    
    /**
     * @Route("/league/vote/recap", name="_league_vote_recap")
     */
    public function recapAction(Request $request)
    {
    	if(!$request->query->get('d')){
    		return $this->redirect($this->generateUrl('_league_vote'));
    	}
    	
    	$day = $this->get('league_service')->getLeagueDayByNumber($request->query->get('d'));
    	
    	if($day == null){
    		return $this->redirect($this->generateUrl('_league_vote'));
    	}
    	
    	$accountId = $this->getUser()->getId();
    	$matches = $this->get('league_service')->getLeagueDayMatches($day->getId());
		$votes = $this->get('league_service')->getLeagueDayVotes($day->getId(), $accountId);
		
		$points = 0;
		
    	for($i=0;$i<count($votes);$i++){
			$request->request->set('score_'.$votes[$i]->getLeagueMatchId(), $votes[$i]->getScore());
			$request->request->set('result_'.$votes[$i]->getLeagueMatchId(), $votes[$i]->getResult());
			$request->request->set('points_'.$votes[$i]->getLeagueMatchId(), $votes[$i]->getPoints());
			$points+=$votes[$i]->getPoints();
		}
		
		return $this->render('Lotofootv2Bundle:User\League:vote_recap.html.twig', 
			array(
			'leagueDay' => $day,
			'matches' => $matches,
			'total' => $points,
			'is_king' => $this->isPunchliner($request, $day)
			)
		);
    }
    
	/**
     * @Route("/league/vote/word", name="_league_vote_word")
     * @Method("POST")
     */
    public function wordAction(Request $request)
    {	
    	$day = $this->get('league_service')->getOpenedLeagueDay();
    	
    	if($day == null || !$this->isPunchliner($request, $day)){
    		return $this->redirect($this->generateUrl('_league_vote'));
    	}
    	
    	$word = stripslashes($request->request->get('word'));
    	
    	$this->get('league_service')->publishWord($word,$this->getUser()->getUsername());
		
    	return $this->redirect($this->generateUrl('_league_vote'));
    }
    
    /**
     * @Route("/league/vote", name="_league_vote_post")
     * @Method("POST")
     */
    public function voteAction(Request $request)
    {	
    	$day = $this->get('league_service')->getOpenedLeagueDay();
		
		$matches = $this->get('league_service')->getLeagueDayMatches($day->getId());
    
		$votes = array();
		
		$full = 1;
		
		for($i=0;$i<count($matches);$i++){
			if($matches[$i]->getDeadline() < new DateTime()){
				continue;
			}
			
			if(LotofootUtil::clearSpaces($request->request->get('score_'.$matches[$i]->getId())) != '' 
				&& ! LotofootUtil::validScore($request->request->get('score_'.$matches[$i]->getId()))){
    			return $this->render('Lotofootv2Bundle:User\League:vote.html.twig', 
    				array('error' => 'Score incorrect pour le match : '.($i+1),
    				'leagueDay' => $day,
    				'matches' => $matches)
    			);
    		}
			if(LotofootUtil::clearSpaces($request->request->get('result_'.$matches[$i]->getId())) != '' 
				&& ! LotofootUtil::validResult($request->request->get('result_'.$matches[$i]->getId()))){
    			return $this->render('Lotofootv2Bundle:User\League:vote.html.twig', 
    				array('error' => 'Résultat incorrect pour le match : '.($i+1),
    				'leagueDay' => $day,
    				'matches' => $matches)
    			);
    		}
			
			$vote = new LeagueVote();	
			$vote->setDate(new DateTime());
			$vote->setAccountId($this->getUser()->getId());
			$vote->setLeagueMatchId($matches[$i]->getId());
			$vote->setResult(
				LotofootUtil::clearSpaces($request->request->get('result_'.$matches[$i]->getId()))
			);
			$vote->setScore(
				LotofootUtil::clearSpaces($request->request->get('score_'.$matches[$i]->getId()))
			);
			
			if($vote->getResult() == '' || $vote->getResult() == null ||
				$vote->getScore() == '' || $vote->getScore() == null ){
				$full = 0;
			}
			
			array_push($votes, $vote);
		}
		
		$this->get('league_service')->voteLeagueDay($votes);
		
    	return $this->redirect($this->generateUrl('_league_vote', array('m' => 1, 'f' => $full)));
    }
}
