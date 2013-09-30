<?php

namespace Lotofootv2\Bundle\Controller\User\CL;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ComingController extends Controller
{
	/**
     * @Route("/cl/coming", name="_cl_coming")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle:User/CL:coming.html.twig');
    }
}
