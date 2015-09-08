<?php

namespace Lotofootv2\Bundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccountHonnorsRankController extends Controller
{
	/**
	 * @Route("/stats/account_honnors_rank", name="_account_honnors_rank")
	 */

	public function indexAction()
	{
		return $this->render('Lotofootv2Bundle:User:account_honnors_rank.html.twig');
	}
	
}
