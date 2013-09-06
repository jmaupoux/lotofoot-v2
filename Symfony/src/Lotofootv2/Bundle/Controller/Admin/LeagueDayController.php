<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class LeagueDayController extends Controller
{
    public function indexAction()
    {
    	return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig');
    }
}
