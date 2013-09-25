<?php

namespace Lotofootv2\Bundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RootController extends Controller
{
	/**
     * @Route("/", name="_root")
     */
    public function indexAction()
    {
    	if( $this->getUser() != null ){
    		return $this->redirect($this->generateUrl('_home'));
    	}else{
    		return $this->redirect($this->generateUrl('_login'));
    	}
    }
}
