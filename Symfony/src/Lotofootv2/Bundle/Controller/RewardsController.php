<?php

namespace Lotofootv2\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RewardsController extends Controller
{
	
	/**
     * @Route("/rewards", name="_rewards")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle::rewards.html.twig');
    }

}
