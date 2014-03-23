<?php

namespace Lotofootv2\Bundle\Controller\User\CL;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

use \Datetime;

class BoardController extends Controller
{
	/**
     * @Route("/cl/board", name="_cl_board")
     */
    public function indexAction(Request $request)
    {
        $tour =  $this->get('tournament_service')->getRunningTour();
        
        $data = array();
        
        if($tour != null){
        	$players = $this->get('tournament_service')->getTourPlayers($tour->getId());
        	
        	$accs = $this->get('account_service')->all();
        	
        	foreach($accs as $a){
        		//acc_accountid
        		$request->request->set('acc_'.$a->getId(), $a->getUsername());
        	}
        	
        	foreach($players as $p){
        		//step display
        		//step_stepid_groupnumber_groupposition
        		$base_key = 'step_'.$p->getTourStepNumber().'_'.$p->getGroupNumber().'_'.$p->getGroupPosition();
        		
        		$request->request->set($base_key.'_a', $p->getAccountId());
        		$request->request->set($base_key.'_pa', $p->getPointsA());
        		$request->request->set($base_key.'_pr', $p->getPointsR());
        		$request->request->set($base_key.'_pt', $p->getTotalPoints());
        	}
        }
    	
        return $this->render('Lotofootv2Bundle:User/CL:board.html.twig');
    }
    
    /**
     * @Route("/cl/board/results", name="_cl_board_results")
     */
    public function resultsAction(Request $request)
    {
    	
    	$tour_s = $this->get('tournament_service');
    	
        $tour_number = $request->query->get('tour_number');
        $group_number = $request->query->get('group_number');
    	
        $tour_steps = $tour_s->getTourStepsByNumber($tour_number);
        
        if($tour_steps == null || count($tour_steps) == 0){
        	return new Response("Aucune donnée");
        }
        
        $players = null;
        
        if(count($tour_steps) == 1){
        	$players = $tour_s->getTourStepPlayersByGroup($tour_steps[0]->getId(), $group_number);
        }else{//on a passé les players sur l'id du step n°2 (step retour)
        	$players = $tour_s->getTourStepPlayersByGroup($tour_steps[1]->getId(), $group_number);
        }
        
        $request->request->set('_acc_1', 'acc_'.$players[0]->getAccountId());
        $request->request->set('_acc_2', 'acc_'.$players[1]->getAccountId());
        
         $accs = $this->get('account_service')->all();
            
         foreach($accs as $a){
                //acc_accountid
             $request->request->set('acc_'.$a->getId(), $a->getUsername());
         }
        
        $data = array();
        
        for($i=0;$i<count($tour_steps);$i++){
        	$ts = $tour_steps[$i];

        	$matches = $tour_s->getTourStepMatches($ts->getId());
        	
        	if($ts->getState() == "A"){
        		$data['matchesA'] = $matches;
        	}else{
        		$data['matchesR'] = $matches;
        	}
        	
        	if($ts->getDeadline() < new DateTime()){
        		
        		for($p=0;$p<count($players);$p++){
        		    $votes = $tour_s->getTourStepVotes($ts->getId(), $players[$p]->getAccountId());
        		    
        		    for($v=0;$v<count($votes);$v++){
                        $vote = $votes[$v];
                        $request->request->set($vote->getTourMatchId().'_result_'.$players[$p]->getGroupPosition(), $vote->getResult());
                        $request->request->set($vote->getTourMatchId().'_score_'.$players[$p]->getGroupPosition(), $vote->getScore());
                        $request->request->set($vote->getTourMatchId().'_fgmin_'.$players[$p]->getGroupPosition(), $vote->getFirstGoalMin());
        		    }        		
        		}
        	}
        }
          
        return $this->render('Lotofootv2Bundle:User/CL:_chunk_result_cl.html.twig', $data);
    }
    
    /**
     * @Route("/cl/board/results_all", name="_cl_board_results_all")
     */
    public function resultsAllAction(Request $request)
    {
        
        $tour_s = $this->get('tournament_service');
        
        $tour_number = $request->query->get('tour_number');
        $tour_steps = $tour_s->getTourStepsByNumber($tour_number);
        
        if($tour_steps == null || count($tour_steps) == 0){
            return new Response("Aucune donnée");
        }
        
        $players = null;
        if(count($tour_steps) == 1){
            $players = $tour_s->getTourStepPlayers($tour_steps[0]->getId());
        }else{//on a passé les players sur l'id du step n°2 (step retour)
            $players = $tour_s->getTourStepPlayers($tour_steps[1]->getId());
        }

         $accs = $this->get('account_service')->all();
            
         foreach($accs as $a){
                //acc_accountid
             $request->request->set('acc_'.$a->getId(), $a->getUsername());
         }
        
        $data = array();
        
        $data['players'] = $players;
        
        for($i=0;$i<count($tour_steps);$i++){
            $ts = $tour_steps[$i];

            $matches = $tour_s->getTourStepMatches($ts->getId());
            
            if($ts->getState() == "A"){
                $data['matchesA'] = $matches;
            }else{
                $data['matchesR'] = $matches;
            }
            
            if($ts->getDeadline() < new DateTime()){
                
                for($p=0;$p<count($players);$p++){
                    $votes = $tour_s->getTourStepVotes($ts->getId(), $players[$p]->getAccountId());
                    
                    for($v=0;$v<count($votes);$v++){
                        $vote = $votes[$v];
                        $request->request->set($vote->getTourMatchId().'_result_'.$players[$p]->getAccountId(), $vote->getResult());
                        $request->request->set($vote->getTourMatchId().'_score_'.$players[$p]->getAccountId(), $vote->getScore());
                        $request->request->set($vote->getTourMatchId().'_fgmin_'.$players[$p]->getAccountId(), $vote->getFirstGoalMin());
                    }               
                }
            }
        }
          
        return $this->render('Lotofootv2Bundle:User/CL:_chunk_result_cl_all.html.twig', $data);
    }
}
