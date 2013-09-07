<?php

namespace Lotofootv2\Bundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
	/**
     * @Route("/home", name="_home")
     */
    public function indexAction()
    {
    	return $this->render('Lotofootv2Bundle:User:home.html.twig', array('name' => $this->getUser()->getUsername()));
    }
}
