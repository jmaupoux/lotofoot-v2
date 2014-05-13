<?php

namespace Lotofootv2\Bundle\Service;

use Lotofootv2\Bundle\Entity\LeagueHistory;

use Lotofootv2\Bundle\Entity\LeagueDay;

use Monolog\Logger;

use Doctrine\ORM\EntityManager;
use \Datetime;

class CupService
{
	private $em;
	private $logger;
	private $db_conn;
	
	public function __construct(EntityManager $em, Logger $logger, $db_conn)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->db_conn = $db_conn;
    }
    
	public function createCup($cup)
    {
    	$this->em->persist($cup);
    	$this->em->flush();    	
    }
    
    public function getRunningCup()
    {
        $query = $this->em->createQuery(
            'SELECT c
            FROM Lotofootv2Bundle:Cup c
            WHERE c.opened = :opened'
        )->setParameter('opened', true);
        
        return $query->getOneOrNullResult();     
    }
    
    public function getNotCorrectedMatchs()
    {
        $query = $this->em->createQuery(
            'SELECT m
            FROM Lotofootv2Bundle:CupMatch m
            WHERE m.corrected = false  
            ORDER BY m.deadline'
        );
        
        return $query->getResult();     
    }
    
    public function getClosedMatchs()
    {
        $query = $this->em->createQuery(
            'SELECT m
            FROM Lotofootv2Bundle:CupMatch m
            WHERE m.deadline < :date 
            ORDER BY m.deadline DESC'
        )->setParameter('date', new DateTime());
        
        return $query->getResult();     
    }
    
    public function getOpenMatchs()
    {
        $query = $this->em->createQuery(
            'SELECT m
            FROM Lotofootv2Bundle:CupMatch m
            WHERE m.deadline > :date
            ORDER BY m.deadline'
        )->setParameter('date', new DateTime());
        
        return $query->getResult();     
    }
    
    public function getAccountVotes($account_id)
    {
        $query = $this->em->createQuery(
            'SELECT v
            FROM Lotofootv2Bundle:CupVote v
            WHERE v.account_id = :account_id'
        )->setParameter('account_id', $account_id);
        
        return $query->getResult();     
    }
    
    public function createMatches($matches){
    	
    	$c = $this->getRunningCup();
    	
    	foreach($matches as $m){
    		$m->setCupId($c->getId());
	        $this->em->persist($m);
	        $this->em->flush();
    	}
    }
    
    public function vote($votes){
    	foreach($votes as $vote){
            
            $queryDel = $this->em->createQuery(
            'DELETE FROM Lotofootv2Bundle:CupVote c 
            WHERE c.account_id = :accountId 
            AND c.cup_match_id = :cmid'
            )->setParameter('accountId', $vote->getAccountId())
            ->setParameter('cmid', $vote->getCupMatchId());
            
            $queryDel->getResult();
            
            $this->em->persist($vote);
        }
        
        $this->em->flush();
    }
    
    
    public function processCorrection($matches){    	
        $this->compute($matches);
        $this->em->flush();
        $this->updateAccounts();
        $this->em->flush();
    }
    
    public function compute($matches){
    	for($i=0;$i<count($matches);$i++){
    		$m = $matches[$i];
    		
    		$votes = $this->getVotesForMatch($m);
    		
    		for($j =0;$j<count($votes);$j++){
    			$v = $votes[$j];
    			
    			$votePoints = 0;
    			
    	        if($m->getScore() == $v->getScore()){
                    $votePoints = 2;
                    $v->setScoreOk(true);
                }
                if($m->getResult() == $v->getResult()){
                    $votePoints += 1;
                    $v->setResultOk(true);
                }
                
                $votePoints = $votePoints*$m->getFactor();
                
                $v->setPoints($votePoints);
    		}
    	}
    }
    
    public function updateAccounts(){
    	//stats
    	$conn = $this->db_conn;
		$sql = '
		UPDATE lfv2_account a SET
		    a.cup_points = (SELECT sum(v.points) FROM lfv2_cup_vote v  WHERE v.account_id = a.id group by v.account_id),
            a.stat_cup_matchs = (SELECT count(v.id) FROM lfv2_cup_vote v  WHERE v.account_id = a.id and v.score != \'\' and v.result != \'\' group by v.account_id),
            a.stat_cup_scores = (SELECT count(v.id)
                FROM lfv2_cup_vote v WHERE v.scoreOk = true AND v.account_id = a.id),
            a.stat_cup_results = (SELECT count(v.id)
                FROM lfv2_cup_vote v WHERE v.resultOk = true AND v.account_id = a.id)
           ';
		$rows = $conn->query($sql);
		
		//rank
        $queryAccounts =  $this->em->createQuery(
            'SELECT a FROM Lotofootv2Bundle:Account a
            WHERE a.isActive = true
            ORDER BY a.cupPoints DESC, a.statCupScores DESC, a.statCupResults DESC, a.id ASC');

        $accounts = $queryAccounts->getResult();
        
        $i = 1;
        foreach($accounts as $account){         
            $account->setCupRank($i);
            $i++;
        }
    }

    
    public function getVotesForMatch($m){
        $query = $this->em->createQuery(
            'SELECT v
            FROM Lotofootv2Bundle:CupVote v
            WHERE v.cup_match_id = :match_id'
        )->setParameter('match_id', $m->getId());
        
        return $query->getResult();   
    }
    
    public function getRankingAccounts(){
    	$query = $this->em->createQuery(
            'SELECT a
            FROM Lotofootv2Bundle:Account a 
            WHERE a.isActive = true 
            ORDER BY a.cupPoints DESC, a.statCupScores DESC, a.statCupResults DESC, a.id ASC'
        );
        
        return $query->getResult();
    }
    
    public function getStatsCorrectedMatchs(){
        $conn = $this->db_conn;
        $sql = '
        SELECT m.id, m.deadline, m.team_home, m.team_visitor, avg(v.points) as moyenne, count(v.id) as votants, count(v2.id) as nbresult, count(v3.id) as nbscore
        FROM lfv2_cup_match m 
        LEFT OUTER JOIN lfv2_cup_vote v ON v.league_match_id = m.id 
        LEFT OUTER JOIN lfv2_cup_vote v2 ON v2.league_match_id = m.id AND v2.resultOk = true
        LEFT OUTER JOIN lfv2_cup_vote v3 ON v3.league_match_id = m.id AND v3.scoreOk = true
        WHERE m.corrected = true
        GROUP BY m.id
        ORDER BY m.deadline DESC
        ';
        $rows = $conn->query($sql);
        
        return $rows;
    }
    
    public function getNextMatchToVote(){
    	$query = $this->em->createQuery(
        'SELECT m 
        FROM Lotofootv2Bundle:CupMatch m 
        WHERE m.deadline > :now
        ORDER BY m.deadline ASC')->setParameter('now', new DateTime());
    	
    	$res = $query->getResult();
    	
    	if(count($res) > 0){
    		return $res[0];
    	}
    	
    	return null;
    }
    
    public function getHasNotVoted()
    {
    	$m = $this->getNextMatchToVote();
    	
        if($m == null){
            return null;
        }
    	
        $query = $this->em->createQuery(
            'SELECT a
            FROM Lotofootv2Bundle:Account a
            WHERE a.isActive = true
            AND not exists(SELECT v FROM Lotofootv2Bundle:CupVote v
                WHERE v.account_id = a.id
                AND v.cup_match_id = :matchid
                AND v.score != \'\' AND v.result != \'\')
            '
        )->setParameter('matchid', $m->getId());
        
        return $query->getResult();
    }
    
    public function getHasVoted()
    {
        $m = $this->getNextMatchToVote();
        
        if($m == null){
        	return null;
        }
        
        $query = $this->em->createQuery(
            'SELECT a
            FROM Lotofootv2Bundle:Account a
            WHERE a.isActive = true
            AND exists(SELECT v FROM Lotofootv2Bundle:CupVote v
                WHERE v.account_id = a.id
                AND v.cup_match_id = :matchid
                AND v.score != \'\' AND v.result != \'\')
            '
        )->setParameter('matchid', $m->getId());
        
        return $query->getResult();
    }
}
