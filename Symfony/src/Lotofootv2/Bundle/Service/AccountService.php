<?php

namespace Lotofootv2\Bundle\Service;

use Lotofootv2\Bundle\Entity\News;

use Monolog\Logger;

use Doctrine\ORM\EntityManager;

class AccountService
{
	private $em;
	private $logger;
	
	public function __construct(EntityManager $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }
	
    public function create($account)
    {
    	$this->em->persist($account);
    	$this->em->flush();
    }
    
    public function usernameExists($username){
    	$query = $this->em->createQuery(
		    'SELECT a
		    FROM Lotofootv2Bundle:Account a
		    WHERE lower(a.username) = :username'
		)->setParameter('username', strtolower($username));
    	
    	return $query->getOneOrNullResult()!=null;
    }
}
