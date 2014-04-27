<?php

namespace Lotofootv2\Bundle\Controller\User\Cup;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PrizesController extends Controller
{
	
	/**
     * @Route("/cup/prizes", name="_cup_prizes")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle:User\Cup:prizes.html.twig');
    }

}
