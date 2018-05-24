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

        $matchCorrected = count($this->get('cup_service')->getClosedMatchs());

        $groups = $this->get('account_service')->listGroups();
        
    	return $this->render('Lotofootv2Bundle:User\Cup:ranking.html.twig', array('accounts' => $accounts, 'matchCorrected' => $matchCorrected, 'groups' => $groups));
    }
}
