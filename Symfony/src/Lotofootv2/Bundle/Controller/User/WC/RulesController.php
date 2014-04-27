<?php

namespace Lotofootv2\Bundle\Controller\User\WC;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RulesController extends Controller
{
	
	/**
     * @Route("/wc/rules", name="_wc_rules")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle:User\WC:rules.html.twig');
    }

}