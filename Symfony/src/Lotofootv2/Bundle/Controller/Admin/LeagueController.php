<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Lotofootv2\Bundle\Service\LeagueService;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Lotofootv2\Bundle\Entity\League;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LeagueController extends Controller
{
	/**
     * @Route("/admin/league", name="_admin_league")
     */
    public function indexAction()
    {
    	$ls = $this->get('league_service');
    	$league = $ls->getRunningLeague();
		
		$this->get('logger')->info('This will be written in logs'.$league);
		
		return $this->render('Lotofootv2Bundle:Admin:league.html.twig', array('league' => $league));    	
    }
    
    /**
     * @Route("/admin/league/create", name="_admin_league_create")
     */
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
