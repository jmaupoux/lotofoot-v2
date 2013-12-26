<?php

namespace Lotofootv2\Bundle\Controller\User\CL;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BoardController extends Controller
{
	/**
     * @Route("/cl/board", name="_cl_board")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle:User/CL:board.html.twig');
    }
}
