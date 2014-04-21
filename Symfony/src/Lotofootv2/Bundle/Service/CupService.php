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
	
	public function __construct(EntityManager $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
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
    
    public function getClosedMatchs()
    {
        $query = $this->em->createQuery(
            'SELECT m
            FROM Lotofootv2Bundle:CupMatch m
            WHERE m.deadline < :deadline 
            ORDER BY m.deadline DESC'
        )->setParameter('deadline', new DateTime());
        
        return $query->getResult();     
    }
    
    public function getOpenMatchs()
    {
        $query = $this->em->createQuery(
            'SELECT m
            FROM Lotofootv2Bundle:CupMatch m
            WHERE m.deadline > :deadline
            ORDER BY m.deadline'
        )->setParameter('deadline', new DateTime());
        
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
}
