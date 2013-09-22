<?php

namespace Lotofootv2\Bundle\Controller\User\League;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PrizesController extends Controller
{
	
	/**
     * @Route("/league/prizes", name="_league_prizes")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle:User\League:prizes.html.twig');
    }

}
