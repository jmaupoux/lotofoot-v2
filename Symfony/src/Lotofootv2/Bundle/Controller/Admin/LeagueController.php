<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Lotofootv2\Bundle\Entity\League;

class LeagueController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery(
		    'SELECT l
		    FROM Lotofootv2Bundle:League l
		    WHERE l.state = :state'
		)->setParameter('state', 1);
		
		$league = $query->getOneOrNullResult();
		
		$this->get('logger')->info('This will be written in logs'.$league);
		
		return $this->render('Lotofootv2Bundle:Admin:league.html.twig', array('league' => $league));    	
    }
    
    public function createAction(Request $request)
    {
    	$league = new League();
    	$league->setName($request->request->get('name'));
    	$league->setCurrentDay(0);
    	$league->setNumber($request->request->get('number'));
    	$league->setState(1);
    	
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($league);
    	$em->flush();
    	
    	return $this->redirect($this->generateUrl('_admin_league'));
    }
}
