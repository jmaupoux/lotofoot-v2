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
    	
    	$registry = $this->register($registry, 'Ajaccio', '35');
    	$registry = $this->register($registry, 'Arsenal', '71');
    	$registry = $this->register($registry, 'Aston Villa', '70');
    	
    	$registry = $this->register($registry, 'Bastia', '16');
    	$registry = $this->register($registry, 'Bordeaux', '18');
    	
    	$registry = $this->register($registry, 'Cardiff City', '789');
    	$registry = $this->register($registry, 'Chelsea', '73');
    	$registry = $this->register($registry, 'Crystal Palace', '589');
    	
    	$registry = $this->register($registry, 'Everton', '68');
    	$registry = $this->register($registry, 'Evian', '1897');
    	
    	$registry = $this->register($registry, 'Fulham', '748');
    	
    	$registry = $this->register($registry, 'Guingamp', '37');
    	
    	$registry = $this->register($registry, 'Hull City', '4441');
    	
    	$registry = $this->register($registry, 'Lille', '43');
    	$registry = $this->register($registry, 'Liverpool', '2048');
    	$registry = $this->register($registry, 'Lorient', '11');
    	$registry = $this->register($registry, 'Lyon', '22');
    	
    	$registry = $this->register($registry, 'Manchester City', '725');
    	$registry = $this->register($registry, 'Manchester United', '87');
    	$registry = $this->register($registry, 'Marseille', '6');
    	$registry = $this->register($registry, 'Monaco', '25');
    	$registry = $this->register($registry, 'Montpellier', '17');

    	$registry = $this->register($registry, 'Nantes', '15');
    	$registry = $this->register($registry, 'Newscastle United', '75');
    	$registry = $this->register($registry, 'Nice', '46');
    	$registry = $this->register($registry, 'Norwich City', '678');
    	
    	$registry = $this->register($registry, 'Paris Saint-Germain', '26');
    	
    	$registry = $this->register($registry, 'Reims', '211');
    	$registry = $this->register($registry, 'Rennes', '15');
    	
    	$registry = $this->register($registry, 'Saint-Etienne', '38');
    	$registry = $this->register($registry, 'Sochaux', '10');
    	$registry = $this->register($registry, 'Southampton', '69');
    	$registry = $this->register($registry, 'Stoke City', '564');
    	$registry = $this->register($registry, 'Sunderland', '686');
    	$registry = $this->register($registry, 'Swansea', '10000000000000000000001885');
    	
    	$registry = $this->register($registry, 'Tottenham', '86');
    	$registry = $this->register($registry, 'Toulouse', '12');
    	
    	$registry = $this->register($registry, 'Valenciennes', '415');
    	
    	$registry = $this->register($registry, 'West Bromwich Albion', '750');
    	$registry = $this->register($registry, 'West Ham', '77');
    	
       	return $this->render('Lotofootv2Bundle::stats_teams.html.twig', array('registry' => $registry));
    }
    
    private function register($registry, $name, $code){
    	array_push($registry[ord($name[0])-65][1], array($name, $code));
    	return $registry;
    }

}
