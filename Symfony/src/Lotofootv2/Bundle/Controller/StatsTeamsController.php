<?php

namespace Lotofootv2\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class StatsTeamsController extends Controller
{
	
	/**
     * @Route("/stats_teams", name="_stats_teams")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle::stats_teams.html.twig');
    }

}
