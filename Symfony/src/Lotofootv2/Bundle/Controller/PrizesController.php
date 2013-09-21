<?php

namespace Lotofootv2\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PrizesController extends Controller
{
	
	/**
     * @Route("/prizes", name="_prizes")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle::prizes.html.twig');
    }

}
