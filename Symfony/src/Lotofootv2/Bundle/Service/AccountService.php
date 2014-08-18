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
    
	public function all()
    {
    	$query = $this->em->createQuery(
		    'SELECT a
		    FROM Lotofootv2Bundle:Account a
		    ORDER BY a.id');
    	
    	return $query->getResult();
    }
    
    public function usernameExists($username){
    	return $this->findByUsername($username)!=null;
    }
    
	public function findById($id){
    	$query = $this->em->createQuery(
		    'SELECT a
		    FROM Lotofootv2Bundle:Account a
		    WHERE a.id = :id'
		)->setParameter('id', $id);
    	
    	return $query->getOneOrNullResult();
    }
    
	public function findByUsername($username){
    	$query = $this->em->createQuery(
		    'SELECT a
		    FROM Lotofootv2Bundle:Account a
		    WHERE lower(a.username) = :username'
		)->setParameter('username', strtolower($username));
    	
    	return $query->getOneOrNullResult();
    }
    
	public function updateMail($account, $mail){
    	$a = $this->findById($account->getId());
    	
    	$a->setEmail($mail);
    	
    	$this->em->persist($a);
    	$this->em->flush();
    }

    public function updateTeam($account, $team){
        $a = $this->findById($account->getId());
        
        $a->setTeam($team);
        
        $this->em->persist($a);
        $this->em->flush();
    }
    
    
	public function switchActivation($id){
    	$a = $this->findById($id);
    	$a->setActive(!$a->isEnabled());
    	
    	$this->em->persist($a);
    	$this->em->flush();
    	
    	return $a;
    }
}
