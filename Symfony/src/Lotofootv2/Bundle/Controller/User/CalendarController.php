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

    	array_push($days, new CalendarDay(1, 'l', new DateTime('2015-09-12 13:00')));
    	array_push($days, new CalendarDay(2, 'l', new DateTime('2015-09-19 13:00')));
    	array_push($days, new CalendarDay(3, 'l', new DateTime('2015-09-26 13:00')));
    	array_push($days, new CalendarDay(4, 'l', new DateTime('2015-10-03 13:00')));
    	array_push($days, new CalendarDay(5, 'l', new DateTime('2015-10-17 13:00')));
    	array_push($days, new CalendarDay(6, 'l', new DateTime('2015-10-24 13:00')));
    	array_push($days, new CalendarDay(7, 'l', new DateTime('2015-10-31 13:00')));
    	array_push($days, new CalendarDay(8, 'l', new DateTime('2015-11-07 13:00')));
    	array_push($days, new CalendarDay(9, 'l', new DateTime('2015-11-21 13:00')));
    	array_push($days, new CalendarDay(10, 'l', new DateTime('2015-11-28 13:00')));
    	array_push($days, new CalendarDay(11, 'l', new DateTime('2015-12-05 13:00')));
    	array_push($days, new CalendarDay(12, 'l', new DateTime('2015-12-12 13:00')));
    	array_push($days, new CalendarDay(13, 'l', new DateTime('2015-12-19 13:00')));
    	array_push($days, new CalendarDay(1, 'cl', new DateTime('2016-02-16 20:45')));
    	array_push($days, new CalendarDay(2, 'cl', new DateTime('2016-2-23 20:45')));
    	
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
