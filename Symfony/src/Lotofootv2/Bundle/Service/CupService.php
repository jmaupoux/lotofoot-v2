<?php

namespace Lotofootv2\Bundle\Service;

use Lotofootv2\Bundle\Entity\LeagueHistory;

use Lotofootv2\Bundle\Entity\LeagueDay;

use Monolog\Logger;

use Doctrine\ORM\EntityManager;

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
    
    public function getOpenMatchs()
    {
        $query = $this->em->createQuery(
            'SELECT m
            FROM Lotofootv2Bundle:CupMatch m
            WHERE m.corrected = :corrected 
            ORDER BY m.deadline'
        )->setParameter('corrected', false);
        
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
}
