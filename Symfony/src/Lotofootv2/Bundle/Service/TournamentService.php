<?php

namespace Lotofootv2\Bundle\Service;

use Lotofootv2\Bundle\Entity\TournamentMatch;

use Lotofootv2\Bundle\Entity\Tournament;

use Lotofootv2\Bundle\Entity\TournamentPlayer;

use Lotofootv2\Bundle\Entity\TournamentStep;

use Monolog\Logger;

use Doctrine\ORM\EntityManager;

class TournamentService
{
	private $em;
	private $logger;
	private $league_service;
	
	public function __construct(EntityManager $em, Logger $logger, LeagueService $league_service)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->league_service = $league_service;
    }

    public function createCL($name, $step_name){
    	$tour = new Tournament();
    	$tour->setName($name);
    	$tour->setType("CL");
    	
    	$this->em->persist($tour);
    	$this->em->flush();
    	
    	$tour_step = new TournamentStep();
    	$tour_step->setTourId($tour->getId());
    	$tour_step->setNumber(1);
    	$tour_step->setState("W");
    	$tour_step->setName($step_name);
    	$tour_step->setOpened(true);
    	
    	$this->em->persist($tour_step);
    	$this->em->flush();
    	
    	$accs = $this->getCLQualified();
    	
    	foreach ($accs as $acc){
    		$tourp = new TournamentPlayer();
    		$tourp->setAccountId($acc->getAccountId());
    		$tourp->setTourStepId($tour_step->getId());
    		$tourp->setTourStepNumber($tour_step->getNumber());
    		//on attribue un group : 1er vs 16 etc
    		$tourp->setGroupNumber(($acc->getRank()>8)?(17 - $acc->getRank()):($acc->getRank()));
    		$tourp->setGroupPosition(($acc->getRank()>8)?2:1);
    		$this->em->persist($tourp);
    	}
    	
    	$this->em->flush();
    }
    
    public function getCLQualified(){
    	$query = $this->em->createQuery(
            'SELECT h
            FROM Lotofootv2Bundle:LeagueHistory h, Lotofootv2Bundle:LeagueDay d 
            WHERE d.number = :number
            and h.league_day_id = d.id
            ORDER BY h.rank'
        )->setParameter('number', 12);
        
        return array_slice($query->getResult(), 0, 16);
    }
    
    public function getRunningTour(){
    	$query = $this->em->createQuery(
		    'SELECT t
		    FROM Lotofootv2Bundle:Tournament t
		    WHERE t.opened = :opened'
		)->setParameter('opened', true);
    	
    	return $query->getOneOrNullResult();
    }
    
    public function getOpenCLTourStep(){
        $query = $this->em->createQuery(
            'SELECT t
            FROM Lotofootv2Bundle:TournamentStep t, Lotofootv2Bundle:Tournament tour 
            WHERE t.opened = true
            AND t.tour_id = tour.id 
            AND tour.type = :type')->setParameter('type', 'CL');
        
        return $query->getOneOrNullResult();
    }
    
	public function getTourStep($tour_id){
    	$query = $this->em->createQuery(
		    'SELECT t
		    FROM Lotofootv2Bundle:TournamentStep t
		    WHERE t.opened = true 
		    AND t.tour_id = :tour_id'
		)->setParameter('tour_id', $tour_id);
    	
    	return $query->getOneOrNullResult();
    }
    
    public function getTourStepById($tour_step_id){
        $query = $this->em->createQuery(
            'SELECT t
            FROM Lotofootv2Bundle:TournamentStep t
            WHERE t.id = :tour_step_id'
        )->setParameter('tour_step_id', $tour_step_id);
        
        return $query->getOneOrNullResult();
    }
    
    public function getTourStepPlayers($step_id){
        $query = $this->em->createQuery(
            'SELECT p
            FROM Lotofootv2Bundle:TournamentPlayer p
            WHERE p.tour_step_id = :step_id 
            ORDER BY p.group_number'
        )->setParameter('step_id', $step_id);
        
        return $query->getResult();
    }
    
    public function isAllowed($account_id, $tour_id){
    	$query = $this->em->createQuery(
		    'SELECT t
		    FROM Lotofootv2Bundle:TournamentStep t, Lotofootv2Bundle:TournamentPlayer p
		    WHERE t.opened = true 
		    AND t.tour_id = :tour_id
		    AND p.tour_step_id = t.id
		    AND p.account_id = :account_id'
		)->setParameter('tour_id', $tour_id)
		->setParameter('account_id', $account_id);
    	
    	return ($query->getOneOrNullResult() != null);
    }
    
    public function createMatches($matches, $deadline){
    	$tour_step = $this->getTourStep($this->getRunningTour()->getId());
    	$tour_step->setDeadline($deadline);
    	$tour_step->setState("A");
    	
    	$this->em->persist($tour_step);
    	
    	foreach ($matches as $m){
    		$m->setTourStepId($tour_step->getId());
    		$this->em->persist($m);
    	}
    	
    	$this->em->flush();
    }
    
    public function getTourStepMatches($step_id){
    	$query = $this->em->createQuery(
            'SELECT m
            FROM Lotofootv2Bundle:TournamentMatch m 
            WHERE m.tour_step_id = :step_id
            ORDER BY m.number'
        )->setParameter('step_id', $step_id);
        
        return $query->getResult();
    }
    
    public function getTourStepVotes($step_id, $account_id){
    	$query = $this->em->createQuery(
            'SELECT v
            FROM Lotofootv2Bundle:TournamentVote v, Lotofootv2Bundle:TournamentMatch m 
            WHERE m.tour_step_id = :step_id
            AND m.id = v.tour_match_id
            AND v.account_id = :account_id
            ORDER BY m.number'
        )->setParameter('step_id', $step_id)
        ->setParameter('account_id', $account_id);
        
        return $query->getResult();
    }
    
    public function voteStep($votes){
        foreach($votes as $vote){
            
            $queryDel = $this->em->createQuery(
            'DELETE FROM Lotofootv2Bundle:TournamentVote v 
            WHERE v.account_id = :accountId 
            AND v.tour_match_id = :tmid'
            )->setParameter('accountId', $vote->getAccountId())
            ->setParameter('tmid', $vote->getTourMatchId());
            
            $queryDel->getResult();
            
            $this->em->persist($vote);
        }
        
        $this->em->flush();
    }
    
    public function processCLStep($matches, $deadline){
    	$step = $this->getOpenCLTourStep();
        
        $tour_players = $this->getTourStepPlayers($step->getId());
        
        $histories = array();
        
        for($i=0;$i<count($tour_players);$i++){
            $tp = $tour_players[$i];
            $points = 0;
            
            if(!$this->isAllowed($tp->getAccountId(), $step->getTourId())){
            	continue;
            }
            
            $votes = $this->getTourStepVotes($step->getId(), $tp->getAccountId());
            
            $has_first_goal = false;
            $first_goal_min = 240;//max. only 1
            
            for($v=0;$v<count($votes);$v++){
                $vote = $votes[$v];
                
                $votePoints = 0;
                
                for($m=0;$m<count($matches);$m++){
                    $match = $matches[$m];
                    
                    if($match->getId() == $vote->getTourMatchId()){
                        if($match->getScore() == $vote->getScore()){
                            $votePoints = 2;
                        }
                        if($match->getResult() == $vote->getResult()){
                            $votePoints += 1;
                        }
                        if($match->getIsFirstGoal()){
                        	$has_first_goal = true;
                        	$first_goal_min = abs($match->getFirstGoalMin() - $vote->getFirstGoalMin());
                        }
                        break;
                    }
                }
                
                $vote->setPoints($votePoints);
                $points += $votePoints;     
            }
         
            if($has_first_goal){
                $tp->setFirstGoalMin($first_goal_min);	
            }
            
            if($step->getState() == "A"){
                $tp->setPointsA($points);
            }else{
                $tp->setPointsR($points);
                $tp->setTotalPoints($tp->getPointsA()+$tp->getPointsR());
            }
            
            $this->em->persist($tp);
        }
        
        if($step->getState() == "A"){
        	$step->setOpened(false);
        	$this->em->persist($step);
        	$this->em->flush();
        	$this->doReturnStep($step, $deadline);
        }else{
        	$this->em->flush();
        	
        	$this->closeStep();
        }

    }
    
    public function getTourStepPlayer($step_id, $account_id){
    	$query = $this->em->createQuery(
                    'SELECT p
                    FROM Lotofootv2Bundle:TournamentPlayer p 
                    WHERE p.tour_step_id = :step_id
                    AND p.account_id = :account_id'
                )->setParameter('step_id', $step_id)
                ->setParameter('account_id', $account_id);
                
               return $query->getOneOrNullResult();
    }
    
    public function getTourPlayers($tour_id){
        $query = $this->em->createQuery(
                    'SELECT p
                    FROM Lotofootv2Bundle:TournamentPlayer p,  Lotofootv2Bundle:TournamentStep s
                    WHERE s.tour_id = :tour_id
                    AND p.tour_step_id = s.id'
                )->setParameter('tour_id', $tour_id);
                
               return $query->getResult();
    }
    
    private function doReturnStep($step, $deadline){
   	    $players = $this->getTourStepPlayers($step->getId());
   	    
   	    $nextStep = new TournamentStep();
   	    $nextStep->setNumber($step->getNumber());
   	    $nextStep->setOpened(true);
   	    $nextStep->setState("R");
   	    $nextStep->setName($step->getName()." Retour");
   	    $nextStep->setTourId($step->getTourId());
   	    $nextStep->setDeadline($deadline);
   	    
   	    $this->em->persist($nextStep);
        $this->em->flush(); 
   	    
   	    $matches = $this->getTourStepMatches($step->getId());
   	    
   	    foreach ($matches as $match){
   	    	$m = new TournamentMatch();
   	    	$m->setNumber($match->getNumber());
   	    	$m->setTeamHome($match->getTeamVisitor());
   	    	$m->setTeamVisitor($match->getTeamHome());
   	    	
   	    	$m->setTourStepId($nextStep->getId());
   	    	
   	    	$this->em->persist($m);
   	    }
   	    
        $players = $this->getTourStepPlayers($step->getId());
        
        foreach ($players as $player){
            $player->setTourStepId($nextStep->getId());
            
            $this->em->persist($player);
        }
   	    
   	    $this->em->flush(); 
    }
    
    private function closeStep(){
    	$step = $this->getOpenCLTourStep();    	
    	$step->setOpened(false);
    	$this->em->persist($step);
    	
    	$accounts = $this->getTourStepPlayers($step->getId());
    	
    	if(count($accounts) == 2){
    		return;
    	}
    	
    	$nextStep = new TournamentStep();
        $nextStep->setOpened(true);
        $nextStep->setState("W");
        $nextStep->setTourId($step->getTourId());
        $nextStep->setNumber($step->getNumber()+1);
        $nextStep->setName("step ".$nextStep->getNumber());
        $this->em->persist($nextStep);
        $this->em->flush();
    	
        $groupNumber = 1;
        $groupAdded = 0;
        
        for($i=0;$i<count($accounts);$i++){
            $account1 = $accounts[$i];
            $account2 = $accounts[$i+1];
            
            $h1 = $this->getTourStepPlayer($step->getId(), $account1->getAccountId());
            $h2 = $this->getTourStepPlayer($step->getId(), $account2->getAccountId());
            
            $tp = new TournamentPlayer();
            $tp->setTourStepId($nextStep->getId());
            $tp->setTourStepNumber($nextStep->getNumber());
            $tp->setGroupNumber($groupNumber);
            
            $groupAdded++;
            $tp->setGroupPosition($groupAdded);
            
            if($groupAdded == 2){
            	$groupNumber++;
            	$groupAdded = 0;
            }
            
            if($h1->getTotalPoints() > $h2->getTotalPoints()){
            	$tp->setAccountId($h1->getAccountId());
            }elseif($h1->getTotalPoints() < $h2->getTotalPoints()){
                $tp->setAccountId($h2->getAccountId());
            }elseif($h2->getFirstGoalMin() < $h1->getFirstGoalMin()){
            	$tp->setAccountId($h2->getAccountId());
            }else{
            	$tp->setAccountId($h1->getAccountId());
            }

            $this->em->persist($tp);
            
            $i++;
        }
        
        $this->em->flush();
    }
}
