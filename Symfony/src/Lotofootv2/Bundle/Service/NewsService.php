<?php

namespace Lotofootv2\Bundle\Service;

use Lotofootv2\Bundle\Entity\News;

use Monolog\Logger;

use Doctrine\ORM\EntityManager;

class NewsService
{
	private $em;
	private $logger;
	
	public function __construct(EntityManager $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }
	
    public function createUpdateNews($news)
    {
    	if($news->getNumber() == 0){
	    	$number = 1;
	    	
	    	$previous = $this->getLastNews();
	    	if($previous != null){
	    		$number = $previous->getNumber()+1;
	    	}
	    	
	    	$news->setNumber($number);
    	}
    	
    	$this->em->persist($news);
    	$this->em->flush();
    }
    
	public function getLastNews()
    {
		$query = $this->em->createQuery(
		    'SELECT n
		    FROM Lotofootv2Bundle:News n
		    ORDER BY n.number DESC');
		$query->setMaxResults(1);
    	
    	return $query->getOneOrNullResult();
    }
    
	public function getNextNews($number)
    {
    	$query = $this->em->createQuery(
		    'SELECT n
		    FROM Lotofootv2Bundle:News n
		    WHERE n.number > :number 
		    ORDER BY n.number ASC')
    		->setParameter('number', $number);
    	$query->setMaxResults(1);
    	
    	return $query->getOneOrNullResult();
    }
    
	public function getPreviousNews($number)
    {
    	$query = $this->em->createQuery(
		    'SELECT n
		    FROM Lotofootv2Bundle:News n
		    WHERE n.number < :number 
		    ORDER BY n.number DESC')
    		->setParameter('number', $number);
    	$query->setMaxResults(1);
    	
    	return $query->getOneOrNullResult();
    }
}
