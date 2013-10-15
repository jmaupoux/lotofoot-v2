<?php

namespace Lotofootv2\Bundle\Controller\User\CL;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PrizesController extends Controller
{
	
	/**
     * @Route("/cl/prizes", name="_cl_prizes")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle:User\CL:prizes.html.twig');
    }

}
