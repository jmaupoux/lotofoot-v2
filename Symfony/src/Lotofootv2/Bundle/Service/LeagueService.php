<?php

namespace Lotofootv2\Bundle\Service;

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
}
