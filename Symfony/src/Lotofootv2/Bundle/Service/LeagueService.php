<?php

namespace Lotofootv2\Bundle\Service;

use Lotofootv2\Bundle\Entity\LeagueDay;

use Monolog\Logger;

use Doctrine\ORM\EntityManager;

class LeagueService
{
	private $em;
	private $logger;
	
	public function __construct(EntityManager $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }
	
    public function getRunningLeague()
    {
    	$query = $this->em->createQuery(
		    'SELECT l
		    FROM Lotofootv2Bundle:League l
		    WHERE l.state = :state'
		)->setParameter('state', 1);
    	
    	return $query->getOneOrNullResult();
    }
    
	public function getNotCorrectedLeagueDay()
    {
    	$query = $this->em->createQuery(
		    'SELECT d
		    FROM Lotofootv2Bundle:League l, Lotofootv2Bundle:LeagueDay d 
		    WHERE l.state = :state
		    AND d.corrected = :corrected'
		)->setParameter('state', 1)
		->setParameter('corrected', false);
		
		return $query->getOneOrNullResult();
    }
    
	public function getOpenedLeagueDay()
    {
    	$query = $this->em->createQuery(
		    'SELECT d
		    FROM Lotofootv2Bundle:League l, Lotofootv2Bundle:LeagueDay d 
		    WHERE l.state = :state
		    AND d.corrected = :corrected
		    AND d.deadline > CURRENT_TIMESTAMP()'
		)->setParameter('state', 1)
		->setParameter('corrected', false);
		
		return $query->getOneOrNullResult();
    }
    
	public function createLeague($league)
    {
    	$league->setCurrentDay(0);
    	
    	$number = $this->em->createQuery(
		    'SELECT max(l.number)
		    FROM Lotofootv2Bundle:League l')->getSingleScalarResult();
    	
    	if($number > 0){
    		$number = $number + 1;
    	}else{
    		$number = 1;
    	}
    	
		$league->setNumber($number);
		
    	$this->em->persist($league);
    	$this->em->flush();
    	
    }
    
    public function newLeagueDay($matches, $deadline){
    	$leagueId = $this->getRunningLeague()->getId();
    	
    	$number = $this->em->createQuery(
		    'SELECT max(l.number)
		    FROM Lotofootv2Bundle:League l')->getSingleScalarResult();
    	
    	if($number > 0){
    		$number = $number + 1;
    	}else{
    		$number = 1;
    	}
    	
    	$leagueday = new LeagueDay();
   		$leagueday->setCorrected(false);
   		$leagueday->setDeadline($deadline);
   		$leagueday->setLeagueId($leagueId);
   		$leagueday->setNumber($number);
   		
   		$this->em->persist($leagueday);
   		$this->em->flush();
   		
   		for($i=0;$i<count($matches);$i++){
   			$matches[$i]->setLeagueDayId($leagueday->getId());
   			$this->em->persist($matches[$i]);
   		}
   		
   		$this->em->flush();
    }
	    
    public function getLeagueDayMatches($leagueDayId){
    	$query = $this->em->createQuery(
		    'SELECT m
		    FROM Lotofootv2Bundle:LeagueMatch m 
		    WHERE m.league_day_id = :ldi
		    ORDER BY m.number'
		)->setParameter('ldi', $leagueDayId);
		
		return $query->getResult();
    }
    
	public function getLeagueDayVotes($leagueDayId, $accountId){
    	$query = $this->em->createQuery(
		    'SELECT v
		    FROM Lotofootv2Bundle:LeagueVote v, Lotofootv2Bundle:LeagueMatch m 
		    WHERE v.account_id = :accountId 
		    AND v.league_match_id = m.id
		    AND m.league_day_id = :ldi'
		)->setParameter('accountId', $accountId)
		->setParameter('ldi', $leagueDayId);
		
		return $query->getResult();
    }
    
    public function voteLeagueDay($votes){
    	$queryDel = $this->em->createQuery(
		    'DELETE FROM Lotofootv2Bundle:LeagueVote v 
		    WHERE v.account_id = :accountId 
		    AND v.league_match_id = :lmid'
		)->setParameter('accountId', $votes[0]->getAccountId())
		->setParameter('lmid', $votes[0]->getLeagueMatchId());
		
		$queryDel->getResult();
		
		for($i=0;$i<count($votes);$i++){
			$this->em->persist($votes[$i]);
		}
		
		$this->em->flush();
    }
    
    public function computeLeagueDay($matches){
    	
    	$leagueDay = $this->getNotCorrectedLeagueDay();
    	
    	$queryAccounts =  $this->em->createQuery(
		    'SELECT a FROM Lotofootv2Bundle:Account a
		    WHERE a.isActive = true');

    	$accounts = $queryAccounts->getResult();
    	
    	for($i=0;$i<count($accounts);$i++){
    		$account = $accounts[$i];
    		$points = 0;
    		
    		$votes = $this->getLeagueDayVotes($leagueDay->getId(), $account->getId());
    		
    		for($v=0;$v<count($votes);$v++){
    			$vote = $votes[$v];
    			
    			$votePoints = 0;
    			
    			for($m=0;$m<count($matches);$m++){
    				$match = $matches[$m];
    				
    				if($match->getId() == $vote->getLeagueMatchId()){
    					if($match->getScore() == $vote->getScore()){
    						$votePoints = 3;
    					}
    					if($match->getResult() == $vote->getResult()){
    						$votePoints += 1;
    					}
    					if($match->getBonus()){
    						$votePoints *= 3;
    					}
    					break;
    				}
    			}
    			
    			$vote->setPoints($votePoints);
    			$points += $votePoints;		
    		}
    		
    		$account->setPoints($account->getPoints()+$points);
    	}
    	
    	$leagueDay->setCorrected(true);
    	
    	$this->em->flush();
    }
}
