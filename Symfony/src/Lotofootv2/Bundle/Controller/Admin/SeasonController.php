<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Lotofootv2\Bundle\Entity\Season;

class SeasonController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$query = $em->createQuery(
		    'SELECT s
		    FROM Lotofootv2Bundle:Season s
		    WHERE s.state = :state'
		)->setParameter('state', 1);
		
		$season = $query->getOneOrNullResult();
		
		$this->get('logger')->info('This will be written in logs'.$season);
		
		return $this->render('Lotofootv2Bundle:Admin:season.html.twig', array('season' => $season));    	
    }
    
    public function createAction(Request $request)
    {
    	$season = new Season();
    	$season->setName($request->request->get('name'));
    	$season->setDay(0);
    	$season->setNumber($request->request->get('number'));
    	$season->setState(1);
    	
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($season);
    	$em->flush();
    	
    	return $this->redirect($this->generateUrl('_admin_season'));
    }
}
