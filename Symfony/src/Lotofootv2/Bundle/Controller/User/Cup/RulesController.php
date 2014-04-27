<?php

namespace Lotofootv2\Bundle\Controller\User\Cup;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RulesController extends Controller
{
	
	/**
     * @Route("/cup/rules", name="_cup_rules")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle:User\Cup:rules.html.twig');
    }

}
