<?php

namespace Lotofootv2\Bundle\Controller\User\League;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class VoteController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery(
		    'SELECT d
		    FROM Lotofootv2Bundle:League l, Lotofootv2Bundle:LeagueDay d 
		    WHERE l.state = :state
		    AND d.corrected = :corrected
		    AND d.deadline > CURRENT_TIMESTAMP()'
		)->setParameter('state', 1)
		->setParameter('corrected', false);
		
		$day = $query->getOneOrNullResult();
		
		return $this->render('Lotofootv2Bundle:User\League:vote.html.twig', array('leagueDay' => $day));
    }
}
