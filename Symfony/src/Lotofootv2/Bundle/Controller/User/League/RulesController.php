<?php

namespace Lotofootv2\Bundle\Controller\User\League;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RulesController extends Controller
{
	
	/**
     * @Route("/league/rules", name="_league_rules")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle:User\League:rules.html.twig');
    }

}
