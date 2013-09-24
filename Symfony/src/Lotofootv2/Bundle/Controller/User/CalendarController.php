<?php

namespace Lotofootv2\Bundle\Controller\User;

use Lotofootv2\Bundle\Bean\CalendarDay;
use \DateTime;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CalendarController extends Controller
{
	
	/**
     * @Route("/calendar", name="_calendar")
     */
    public function indexAction()
    {
    	$days = array();

    	array_push($days, new CalendarDay(1, 'l', new DateTime('2012-10-13 13:00')));
    	array_push($days, new CalendarDay(2, 'l', new DateTime('2013-10-18 13:00')));
    	array_push($days, new CalendarDay(3, 'l', new DateTime('2013-10-20 13:00')));
    	array_push($days, new CalendarDay(4, 'cl', new DateTime('2013-11-13 13:00')));
    	array_push($days, new CalendarDay(5, 'l', new DateTime('2018-11-20 13:00')));
    	array_push($days, new CalendarDay(6, 'cl', new DateTime('2019-11-27 13:00')));
    	
    	for($i=0;$i<count($days);$i++){
    		if($days[$i]->getBefore() < new DateTime()){
    			continue;
    		}elseif ($days[$i]->getBefore()> new DateTime()){
    			$days[$i]->setOpened();
    			break;
    		}
    	}
    	
    	return $this->render('Lotofootv2Bundle:User:calendar.html.twig', array('days'=>$days));
    }

}
