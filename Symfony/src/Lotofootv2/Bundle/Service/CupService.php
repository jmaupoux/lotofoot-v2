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
    	$conn = $this->db_conn;
		$sql = '
		UPDATE lfv2_account a SET
		    a.cup_points = (SELECT sum(v.points) FROM lfv2_cup_vote v  WHERE v.account_id = a.id group by v.account_id),
            a.stat_cup_matchs = (SELECT count(v.id) FROM lfv2_cup_vote v  WHERE v.account_id = a.id group by v.account_id),
            a.stat_cup_scores = (SELECT count(v.id)
                FROM lfv2_cup_vote v WHERE v.scoreOk = true AND v.account_id = a.id),
            a.stat_cup_results = (SELECT count(v.id)
                FROM lfv2_cup_vote v WHERE v.resultOk = true AND v.account_id = a.id)
           ';
		$rows = $conn->query($sql);
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
            ORDER BY a.cupPoints DESC, a.statCupScores DESC, a.statCupResults DESC, a.id ASC'
        );
        
        return $query->getResult();
    }
}
