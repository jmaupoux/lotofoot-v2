<?php

namespace Lotofootv2\Bundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class HomeController extends Controller
{
    public function indexAction()
    {
    	return $this->render('Lotofootv2Bundle:User:home.html.twig', array('name' => $this->getUser()->getUsername()));
    }
}
