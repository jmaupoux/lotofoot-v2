<?php

namespace Lotofootv2\Bundle\Controller\User\Stats;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TeamsController extends Controller
{
	
	/**
     * @Route("/stats/teams", name="_stats_teams")
     */
    public function indexAction()
    {
    	$registry = array();
    	
    	//[0] = ['A', [ ['Ajaccio', 70], ['Arsenal', 71]...
    	foreach( range('A', 'Z') as $letter){
    		array_push($registry, array($letter, array()));
    	}
    	
		$registry = $this->register($registry,'Allemagne','');
		$registry = $this->register($registry,'Angleterre','');
		$registry = $this->register($registry,'Arabie Saoudite','');
		$registry = $this->register($registry,'Argentine','');
		$registry = $this->register($registry,'Australie','');
		$registry = $this->register($registry,'Belgique','');
		$registry = $this->register($registry,'Brésil','');
		$registry = $this->register($registry,'Colombie','');
		$registry = $this->register($registry,'Corée du Sud','');
		$registry = $this->register($registry,'Costa Rica','');
		$registry = $this->register($registry,'Croatie','');
		$registry = $this->register($registry,'Danemark','');
		$registry = $this->register($registry,'Egypte','');
		$registry = $this->register($registry,'Espagne','');
		$registry = $this->register($registry,'France','');
		$registry = $this->register($registry,'Iran','');
		$registry = $this->register($registry,'Islande','');
		$registry = $this->register($registry,'Japon','');
		$registry = $this->register($registry,'Maroc','');
		$registry = $this->register($registry,'Mexique','');
		$registry = $this->register($registry,'Nigeria','');
		$registry = $this->register($registry,'Panama','');
		$registry = $this->register($registry,'Pérou','');
		$registry = $this->register($registry,'Pologne','');
		$registry = $this->register($registry,'Portugal','');
		$registry = $this->register($registry,'Russie','');
		$registry = $this->register($registry,'Sénégal','');
		$registry = $this->register($registry,'Serbie','');
		$registry = $this->register($registry,'Suède','');
		$registry = $this->register($registry,'Suisse','');
		$registry = $this->register($registry,'Tunisie','');
		$registry = $this->register($registry,'Uruguay','');
    	
    	
       	return $this->render('Lotofootv2Bundle:User/Stats:teams.html.twig', array('registry' => $registry, 'myteam' => $this->getUser()->getTeam()));
    }
    
    private function register($registry, $name, $code){
    	array_push($registry[ord($name[0])-65][1], array($name, $code));
    	return $registry;
    }

}
