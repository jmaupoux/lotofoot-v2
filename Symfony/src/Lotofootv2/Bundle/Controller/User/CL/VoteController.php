<?php

namespace Lotofootv2\Bundle\Controller\User\CL;

use Lotofootv2\Bundle\LotofootUtil;
use Lotofootv2\Bundle\Entity\TournamentVote;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use \Datetime;

class VoteController extends Controller
{
	/**
     * @Route("/cl/vote", name="_cl_vote")
     */
    public function indexAction(Request $request)
    {
        $tour_s = $this->get('tournament_service');
        $step = $tour_s->getOpenCLTourStep();
        
        if($step == null){
        	return $this->render('Lotofootv2Bundle:User/CL:vote.html.twig', array('step' => null, 'matches' => null));
        }
        
		$allowed = $tour_s->isAllowed($this->getUser()->getId(), $step->getTourId());
		$matches = $tour_s->getTourStepMatches($step->getId());
		
		if(!$allowed){
			return $this->render('Lotofootv2Bundle:User/CL:vote_ro.html.twig', array('step' => $step, 'matches' => $matches));
		}
        
		if($step->getDeadline() > new DateTime()){
            return $this->voteOpenAction($request, $step);
        }else{
        	return $this->recapAction($request, $step);
        }
    	
    }
    
    public function recapAction($request, $step){
    	$tour_s = $this->get('tournament_service');
    	$matches = $tour_s->getTourStepMatches($step->getId());
        
        $accountId = $this->getUser()->getId();
        $votes = $tour_s->getTourStepVotes($step->getId(), $accountId);
        
        $points = 0;
        
        for($i=0;$i<count($votes);$i++){
            $request->request->set('score_'.$votes[$i]->getTourMatchId(), $votes[$i]->getScore());
            $request->request->set('result_'.$votes[$i]->getTourMatchId(), $votes[$i]->getResult());
            $request->request->set('points_'.$votes[$i]->getTourMatchId(), $votes[$i]->getPoints());
            $points+=$votes[$i]->getPoints();
        }
    	
        return $this->render('Lotofootv2Bundle:User/CL:vote_recap.html.twig', array('step' => $step, 'matches' => $matches, 'total' => $points));    	
    }
    
    public function voteOpenAction($request, $step){
    	$tour_s = $this->get('tournament_service');
    	 
    	$matches = $matches = $tour_s->getTourStepMatches($step->getId());
        $votes = $tour_s->getTourStepVotes($step->getId(), $this->getUser()->getId());
        
        for($i=0;$i<count($votes);$i++){
            $request->request->set('score_'.$votes[$i]->getTourMatchId(), $votes[$i]->getScore());
            $request->request->set('result_'.$votes[$i]->getTourMatchId(), $votes[$i]->getResult());
        }
        
        $info = null;
        if($request->query->get('m') == 1){
            $info = "Votes enregistrés";
        }
        $warn = null;
        if($request->query->has('f') && $request->query->get('f') == 0){
            $warn = "Attention, vous n'avez pas parié sur l'ensemble de la journée !";
        }
        
        return $this->render('Lotofootv2Bundle:User\CL:vote.html.twig', 
            array(
            'step' => $step,
            'matches' => $matches,
            'info' => $info,
            'warn' => $warn
            )
        );
    }
    
    /**
     * @Route("/cl/vote/post", name="_cl_vote_post")
     */
    public function voteAction(Request $request)
    {
    	$tour_s = $this->get('tournament_service');
        $step = $tour_s->getOpenCLTourStep();
    
        $allowed = $tour_s->isAllowed($this->getUser()->getId(), $step->getTourId());
        if(!$allowed){
        	return $this->redirect($this->generateUrl('_cl_vote'));
        }
        
        $closed = ($step->getDeadline() < new DateTime());

        if($closed){
            return $this->redirect($this->generateUrl('_cl_vote'));
        }
        
        $matches = $this->get('tournament_service')->getTourStepMatches($step->getId());
    
        $votes = array();
        
        $full = 1;
        
        for($i=0;$i<count($matches);$i++){
            
            if(LotofootUtil::clearSpaces($request->request->get('score_'.$matches[$i]->getId())) != '' 
                && ! LotofootUtil::validScore($request->request->get('score_'.$matches[$i]->getId()))){
                return $this->render('Lotofootv2Bundle:User\CL:vote.html.twig', 
                    array('error' => 'Score incorrect pour le match : '.($i+1),
                    'step' => $step,
                    'matches' => $matches)
                );
            }
            if(LotofootUtil::clearSpaces($request->request->get('result_'.$matches[$i]->getId())) != '' 
                && ! LotofootUtil::validResult($request->request->get('result_'.$matches[$i]->getId()))){
                return $this->render('Lotofootv2Bundle:User\CL:vote.html.twig', 
                    array('error' => 'Résultat incorrect pour le match : '.($i+1),
                    'step' => $step,
                    'matches' => $matches)
                );
            }
            
            $vote = new TournamentVote();   
            $vote->setDate(new DateTime());
            $vote->setAccountId($this->getUser()->getId());
            $vote->setTourMatchId($matches[$i]->getId());
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
        
        $this->get('tournament_service')->voteStep($votes);
        
        return $this->redirect($this->generateUrl('_cl_vote', array('m' => 1, 'f' => $full)));
    }
}
