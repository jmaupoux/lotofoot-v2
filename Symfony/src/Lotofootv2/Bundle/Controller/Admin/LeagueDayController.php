<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class LeagueDayController extends Controller
{
    public function indexAction()
    {
    	
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery(
		    'SELECT d
		    FROM Lotofootv2Bundle:League l, Lotofootv2Bundle:LeagueDay d 
		    WHERE l.state = :state
		    AND d.corrected = :corrected'
		)->setParameter('state', 1)
		->setParameter('corrected', false);
		
		$leagueDay = $query->getOneOrNullResult();
			
    	return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('leagueDay' => $leagueDay));
    }
}
