<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class DayController extends Controller
{
    public function indexAction()
    {
    	return $this->render('Lotofootv2Bundle:Admin:day.html.twig');
    }
}
