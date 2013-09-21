<?php

namespace Lotofootv2\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RulesController extends Controller
{
	
	/**
     * @Route("/rules", name="_rules")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle::rules.html.twig');
    }

}
