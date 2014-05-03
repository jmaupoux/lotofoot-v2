<?php

namespace Lotofootv2\Bundle\Controller\User\Cup;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RankingController extends Controller
{
	/**
     * @Route("/cup/ranking", name="_cup_ranking")
     */
    public function indexAction()
    {
    	$accounts = $this->get('cup_service')->getRankingAccounts();
    	
    	return $this->render('Lotofootv2Bundle:User\Cup:ranking.html.twig', array('accounts' => $accounts));
    }
}
