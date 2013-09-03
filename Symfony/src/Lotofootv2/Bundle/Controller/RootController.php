<?php

namespace Lotofootv2\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RootController extends Controller
{
    public function indexAction()
    {
    	if( $this->getUser() ){
    		return $this->redirect($this->generateUrl('_home'));
    	}else{
    		return $this->redirect($this->generateUrl('_login'));
    	}
    }
}
