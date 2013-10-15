<?php

namespace Lotofootv2\Bundle\Controller\User\CL;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RulesController extends Controller
{
	
	/**
     * @Route("/cl/rules", name="_cl_rules")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle:User\CL:rules.html.twig');
    }

}
