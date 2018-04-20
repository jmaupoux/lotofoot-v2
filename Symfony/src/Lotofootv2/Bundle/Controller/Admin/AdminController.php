<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
	/**
     * @Route("/admin", name="_admin")
     */
    public function indexAction()
    {    	
    	return $this->render('Lotofootv2Bundle:Admin:admin.html.twig');
    }
    
}