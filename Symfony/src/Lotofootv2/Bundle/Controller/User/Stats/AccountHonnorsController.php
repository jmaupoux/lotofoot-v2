<?php

namespace Lotofootv2\Bundle\Controller\User\Stats;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccountHonnorsController extends Controller
{
	/**
	 * @Route("/stats/account_honnors", name="_account_honnors")
	 */

	public function indexAction()
	{
		return $this->render('Lotofootv2Bundle:User:account_honnors.html.twig');
	}
	
}
