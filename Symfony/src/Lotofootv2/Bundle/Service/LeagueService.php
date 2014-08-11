<?php

namespace Lotofootv2\Bundle\Service;

use Lotofootv2\Bundle\Entity\LeagueHistory;

use Lotofootv2\Bundle\Entity\LeagueDay;

use Monolog\Logger;

use Doctrine\ORM\EntityManager;

class LeagueService
{
	private $em;
	private $logger;
	private $rewardService;
	
	private $current_season = 2;
	
	public function __construct(EntityManager $em, Logger $logger, RewardService $rewardService)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->rewardService = $rewardService;
    }
	
    public function getRunningLeague()
    {
    	$query = $this->em->createQuery(
		    'SELECT l
		    FROM Lotofootv2Bundle:League l
		    WHERE l.opened = :opened'
		)->setParameter('opened', true);
    	
    	return $query->getOneOrNullResult();
    }
    
    public function getRunningLeagueAccounts()
    {
    	$query = $this->em->createQuery(
		    'SELECT a
		    FROM Lotofootv2Bundle:Account a
		    WHERE a.isActive = :active
		    ORDER BY a.rank'
		)->setParameter('active', true);
    	
    	return $query->getResult();
    }
    
	public function getNotCorrectedLeagueDay()
    {
    	$query = $this->em->createQuery(
		    'SELECT d
		    FROM Lotofootv2Bundle:League l, Lotofootv2Bundle:LeagueDay d 
		    WHERE l.opened = :opened
		    AND d.league_id = l.id 
		    AND d.corrected = :corrected'
		)->setParameter('opened', true)
		->setParameter('corrected', false);
		
		return $query->getOneOrNullResult();
    }
    
	public function getOpenedLeagueDay()
    {
    	$query = $this->em->createQuery(
		    'SELECT d
		    FROM Lotofootv2Bundle:League l, Lotofootv2Bundle:LeagueDay d 
		    WHERE l.opened = :opened
		    AND d.corrected = :corrected
		    AND d.deadline > CURRENT_TIMESTAMP()'
		)->setParameter('opened', true)
		->setParameter('corrected', false);
		
		return $query->getOneOrNullResult();
    }
    
	public function publishWord($word,$king_tag)
    {
    	$query = $this->em->createQuery(
		    'UPDATE Lotofootv2Bundle:LeagueDay l SET l.word = :word, l.king_tag = :king_tag WHERE l.corrected = false AND l.deadline > CURRENT_TIMESTAMP()'
		)->setParameter('word', $word)->setParameter('king_tag', $king_tag);
		
		return $query->getResult();
    }
    
	public function getHasNotVoted($dayId)
    {
    	$query = $this->em->createQuery(
		    'SELECT a
		    FROM Lotofootv2Bundle:Account a  
		    WHERE a.isActive = true
		    AND 13 != (SELECT count(v) FROM Lotofootv2Bundle:LeagueMatch m, Lotofootv2Bundle:LeagueVote v
		    	WHERE v.account_id = a.id
		    	AND m.league_day_id=:dayId
		    	AND v.league_match_id = m.id
		    	AND v.score != \'\' and v.result != \'\')'
		)->setParameter('dayId', $dayId);
		
		return $query->getResult();
    }
    
	public function getHasVoted($dayId)
    {
    	$query = $this->em->createQuery(
		    'SELECT a
		    FROM Lotofootv2Bundle:Account a  
		    WHERE a.isActive = true
		    AND 13 = (SELECT count(v) FROM Lotofootv2Bundle:LeagueMatch m, Lotofootv2Bundle:LeagueVote v
		    	WHERE v.account_id = a.id
		    	AND m.league_day_id=:dayId
		    	AND v.league_match_id = m.id
		    	AND v.score != \'\' and v.result != \'\')'
		)->setParameter('dayId', $dayId);
		
		return $query->getResult();
    }
    
	public function getLastLeagueDay()
    {
		$query = $this->em->createQuery(
		    'SELECT ld
		    FROM Lotofootv2Bundle:LeagueDay ld
		    ORDER BY ld.number DESC');
		$query->setMaxResults(1);
    	
    	return $query->getOneOrNullResult();
    }
    
	public function getLeagueDayByNumber($number)
    {
		$query = $this->em->createQuery(
		    'SELECT ld
		    FROM Lotofootv2Bundle:LeagueDay ld
		    WHERE ld.number = :number')
		->setParameter('number', $number);
		$query->setMaxResults(1);
    	
    	return $query->getOneOrNullResult();
    }
    
	public function getNextLeagueDay($number)
    {
    	$query = $this->em->createQuery(
		    'SELECT ld
		    FROM Lotofootv2Bundle:LeagueDay ld
		    WHERE ld.number > :number 
		    ORDER BY ld.number ASC')
    		->setParameter('number', $number);
    	$query->setMaxResults(1);
    	
    	return $query->getOneOrNullResult();
    }
    
	public function getPreviousLeagueDay($number)
    {
    	$query = $this->em->createQuery(
		    'SELECT ld
		    FROM Lotofootv2Bundle:LeagueDay ld
		    WHERE ld.number < :number 
		    ORDER BY ld.number DESC')
    		->setParameter('number', $number);
    	$query->setMaxResults(1);
    	
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
		    FROM Lotofootv2Bundle:LeagueDay l')->getSingleScalarResult();
    	
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
    	foreach($votes as $vote){
    		
			$queryDel = $this->em->createQuery(
		    'DELETE FROM Lotofootv2Bundle:LeagueVote v 
		    WHERE v.account_id = :accountId 
		    AND v.league_match_id = :lmid'
			)->setParameter('accountId', $vote->getAccountId())
			->setParameter('lmid', $vote->getLeagueMatchId());
			
			$queryDel->getResult();
			
			$this->em->persist($vote);
		}
		
		$this->em->flush();
    }
    
    public function processLeagueDay($matches){    	
    	$histories = $this->computeLeagueDayPoints($matches);
    	$this->em->flush();
    	$accounts = $this->updateRanks($histories);
    	$this->em->flush();
    	$this->updateRewards($accounts);
    	$this->em->flush();
    }
    
    private function computeLeagueDayPoints($matches){
    	$leagueDay = $this->getNotCorrectedLeagueDay();
    	
    	$accounts = $this->getRunningLeagueAccounts();
    	
    	$histories = array();
    	
    	for($i=0;$i<count($accounts);$i++){
    		$account = $accounts[$i];
    		$points = 0;
    		$dayResults = 0;
    		$dayScores = 0;
    		$dayBonus = false;
    		
    		$votes = $this->getLeagueDayVotes($leagueDay->getId(), $account->getId());
    		
    		if(count($votes) > 0){
    			$account->setStatDays($account->getStatDays()+1);
    		}
    		
    		for($v=0;$v<count($votes);$v++){
    			$vote = $votes[$v];
    			
    			$votePoints = 0;
    			
    			for($m=0;$m<count($matches);$m++){
    				$match = $matches[$m];
    				
    				if($match->getId() == $vote->getLeagueMatchId()){
    					if($match->getScore() == $vote->getScore()){
    						$votePoints = 2;
    						$dayScores = $dayScores+1;
    					}
    					if($match->getResult() == $vote->getResult()){
    						$votePoints += 1;
    						$dayResults = $dayResults+1;
    					}
    					if($match->getBonus()){
    						if($votePoints == 3){
    							$account->setStatBonuses($account->getStatBonuses()+1);
    							$dayBonus = true;
    						}    						
    						$votePoints *= 3;
    					}
    					break;
    				}
    			}
    			
    			$vote->setPoints($votePoints);
    			$points += $votePoints;		
    		}
    		    		
    		//rewards for results found
    		if($dayResults == 10){
    			$points += 1;
    		}else if($dayResults == 11){
    			$points += 2;
    		}else if($dayResults == 12){
    			$points += 3;
    		}else if($dayResults == 13){
    			$points += 5;
    		}
    		
    		$this->logger->debug('Points : '.$points.' for : '.$account->getUsername().'');
    		
    		if($account->getPoints() < 50 && ($account->getPoints()+$points) >=50){
    			$this->rewardService->reward50($account->getId());
    		}
    		if($account->getPoints() < 100 && ($account->getPoints()+$points) >=100){
    			$this->rewardService->reward100($account->getId());
    		}
    		if($account->getPoints() < 500 && ($account->getPoints()+$points) >=500){
    			$this->rewardService->reward500($account->getId());
    		}
    		
    		$account->setStatResults($account->getStatResults()+$dayResults);
    		$account->setStatScores($account->getStatScores()+$dayScores);
    		
    		$account->setPoints($account->getPoints()+$points);
    		
    		$history = new LeagueHistory();
    		$history->setAccountId($account->getId());
    		$history->setLeagueDayId($leagueDay->getId());
    		$history->setPoints($points);
    		$history->setTotalPoints($account->getPoints());
    		$history->setHasBonus($dayBonus);
    		$history->setScores($dayScores);
    		$history->setResults($dayResults);
    		
    		if(count($votes) > 0){
    			$history->setVoted(true);
    		}else{
    			$history->setVoted(false);
    		}
    		
    		array_push($histories, $history);
    	}
    	
    	$leagueDay->setCorrected(true);
    	
    	return $histories;
    }
    
	public function updateRanks($histories)
    {
    	$queryAccounts =  $this->em->createQuery(
		    'SELECT a FROM Lotofootv2Bundle:Account a
		    WHERE a.isActive = true
		    ORDER BY a.points DESC, a.statBonuses DESC, a.statScores DESC, a.statResults DESC, a.id ASC');

    	$accounts = $queryAccounts->getResult();
    	
    	$i = 1;
    	foreach($accounts as $account){    		
    		$oldRank = $account->getRank();
    		$account->setRank($i);
    		
    		//first vote
    		if($oldRank == 99){
    			$account->setProgression(0);
    		}else{
    			$account->setProgression($oldRank-$account->getRank());
    		}
    		
    		foreach($histories as $h){
    			if($h->getAccountId() == $account->getId()){
    				$h->setRank($i);
    				$this->em->persist($h);
    				break;
    			}
    		}
    		$i++;
    	}
    	
    	return $accounts;
    }
    
	public function updateRewards($accounts)
    {
		$this->rewardService->cleanUpDailies();
		$this->em->flush();
		$this->rewardService->rewardAllDailies($accounts);
		$this->em->flush();
    }
    
	public function getDayPointsHistory()
    {
    	$accounts = $this->getRunningLeagueAccounts();
    	
    	$fullHistory = array();
    	
    	foreach($accounts as $acc){
	    	$queryHistories =  $this->em->createQuery(
			    'SELECT h.points,d.number FROM Lotofootv2Bundle:LeagueHistory h,Lotofootv2Bundle:LeagueDay d
			    WHERE h.account_id = :accountId
			    AND d.id = h.league_day_id
			    ORDER BY h.league_day_id ASC')
	    		->setParameter('accountId', $acc->getId());

	    	$accHistories = $queryHistories->getScalarResult();
	    	
	    	$extractPoints = function($item) {
	    		$arr = array();
	    		array_push($arr, intval($item['number']), intval($item['points']));
	    		
	    		return $arr;
			};
	    	
	    	$accHistories = array_map($extractPoints, $accHistories);
	    	
	    	array_push($fullHistory, array('name'=>$acc->getUsername(), 'data'=>$accHistories, 'visible'=>false));
    	}
		 
		 return $fullHistory;
    }
    
	public function getRankingHistory()
    {
    	$accounts = $this->getRunningLeagueAccounts();
    	
    	$fullHistory = array();
    	
    	foreach($accounts as $acc){
	    	$queryHistories =  $this->em->createQuery(
			    'SELECT h.rank,d.number FROM Lotofootv2Bundle:LeagueHistory h,Lotofootv2Bundle:LeagueDay d
			    WHERE h.account_id = :accountId
			    AND d.id = h.league_day_id
			    ORDER BY h.league_day_id ASC')
	    		->setParameter('accountId', $acc->getId());

	    	$accHistories = $queryHistories->getScalarResult();
	    	
	    	$extractPoints = function($item) {
	    		$arr = array();
	    		array_push($arr, intval($item['number']), intval($item['rank']));
	    		
	    		return $arr;
			};
	    	
	    	$accHistories = array_map($extractPoints, $accHistories);
	    	
	    	array_push($fullHistory, array('name'=>$acc->getUsername(), 'data'=>$accHistories, 'visible'=>false));
    	}
		 
		 return $fullHistory;
    }
    
	public function getLeagueDayHistories($leagueDayId)
    {
    	$query = $this->em->createQuery(
		    'SELECT l
		    FROM Lotofootv2Bundle:LeagueHistory l 
		    WHERE l.league_day_id = :league_day_id
		    ORDER BY l.points DESC, l.has_bonus DESC, l.scores DESC, l.results DESC, l.account_id ASC'
		)->setParameter('league_day_id', $leagueDayId);
		
		return $query->getResult();
    }
    
    public function test(){
        $query = $this->em->createQuery(
            'SELECT a
            FROM Lotofootv2Bundle:Account a
            ORDER BY a.id');
        
        $accounts = $query->getResult();
    	
        $this->rewardService->rewardAddict($accounts);
    }
}
