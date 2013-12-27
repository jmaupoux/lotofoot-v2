<?php

namespace Lotofootv2\Bundle\Service;

use Lotofootv2\Bundle\Entity\TournamentStepHistory;

use Lotofootv2\Bundle\Entity\TournamentHistory;

use Lotofootv2\Bundle\Entity\TournamentMatch;

use Lotofootv2\Bundle\Entity\Tournament;

use Lotofootv2\Bundle\Entity\TournamentPlayer;

use Lotofootv2\Bundle\Entity\TournamentStep;

use Lotofootv2\Bundle\Entity\LeagueHistory;

use Lotofootv2\Bundle\Entity\LeagueDay;

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
    	
    	$accs = array_slice($this->league_service->getRunningLeagueAccounts(), 0, 16); 	
    	
    	foreach ($accs as $acc){
    		$tourp = new TournamentPlayer();
    		$tourp->setAccountId($acc->getId());
    		$tourp->setTourStepId($tour_step->getId());
    		//on attribue un group : 1er vs 16 etc
    		$tourp->setGroupNumber(($acc->getRank()>8)?(17 - $acc->getRank()):($acc->getRank()));
    		$this->em->persist($tourp);
    	}
    	
    	$this->em->flush();
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
    
    public function processCLStep($matches){
    	$step = $this->getOpenCLTourStep();
        
        $accounts = $this->getTourStepPlayers($step->getId());
        
        $histories = array();
        
        for($i=0;$i<count($accounts);$i++){
            $account_id = $accounts[$i]->getAccountId();
            $points = 0;
            
            if(!$this->isAllowed($account_id, $step->getTourId())){
            	continue;
            }
            
            $votes = $this->getTourStepVotes($step->getId(), $account_id);
            
            for($v=0;$v<count($votes);$v++){
                $vote = $votes[$v];
                
                $votePoints = 0;
                
                for($m=0;$m<count($matches);$m++){
                    $match = $matches[$m];
                    
                    if($match->getId() == $vote->getTourMatchId()){
                        if($match->getScore() == $vote->getScore()){
                            $votePoints = 3;
                        }
                        if($match->getResult() == $vote->getResult()){
                            $votePoints += 1;
                        }
                        break;
                    }
                }
                
                $vote->setPoints($votePoints);
                $points += $votePoints;     
            }
            
            $history = null;
         
            if($step->getState() == "A"){
            	$history = new TournamentStepHistory();
                $history->setTourStepId($step->getId());
                $history->setAccountId($account_id);
                $history->setPointsA($points);
            }else{
                $history = $this->getTourStepHistory($step->getId(), $account_id);
            	
                $history->setPointsR($points);
                $history->setTotalPoints($history->getPointsA()+$history->getPointsR());
            }
            
            $this->em->persist($history);
        }
        
        if($step->getState() == "A"){
        	$step->setState("R");
        	$this->em->persist($step);
        	$this->em->flush();
        	
        }else{
        	$this->em->flush();
        	
        	$this->closeStep();
        }

    }
    
    public function getTourStepHistory($step_id, $account_id){
    	$query = $this->em->createQuery(
                    'SELECT h
                    FROM Lotofootv2Bundle:TournamentStepHistory h 
                    WHERE h.tour_step_id = :step_id
                    AND h.account_id = :account_id'
                )->setParameter('step_id', $step_id)
                ->setParameter('account_id', $account_id);
                
               return $query->getOneOrNullResult();
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
            
            $h1 = $this->getTourStepHistory($step->getId(), $account1->getAccountId());
            $h2 = $this->getTourStepHistory($step->getId(), $account2->getAccountId());
            
            $tp = new TournamentPlayer();
            $tp->setTourStepId($nextStep->getId());
            $tp->setGroupNumber($groupNumber);
            
            $groupAdded++;
            if($groupAdded == 2){
            	$groupNumber++;
            	$groupAdded = 0;
            }
            
            if($h1->getTotalPoints() > $h2->getTotalPoints()){
            	$tp->setAccountId($h1->getAccountId());
            }elseif($h1->getTotalPoints() < $h2->getTotalPoints()){
                $tp->setAccountId($h2->getAccountId());
            }else{
            	// TODO BUT VAINQUEUR
            	$tp->setAccountId($h1->getAccountId());
            }            

            $this->em->persist($tp);
            
            $i++;
        }
        
        $this->em->flush();
    }
}
