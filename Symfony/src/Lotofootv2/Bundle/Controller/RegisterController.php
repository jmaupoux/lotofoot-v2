<?php

namespace Lotofootv2\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RegisterController extends Controller
{
	
	/**
     * @Route("/register", name="_register")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle::register.html.twig');
    }
    
	/**
     * @Route("/register", name="_register_post")
     * @Method("POST")
     */
    public function registerAction()
    {
    	//TODO
    	
       return $this->redirect($this->generateUrl('_root'));
    }
}
