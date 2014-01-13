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

    	array_push($days, new CalendarDay(1, 'l', new DateTime('2013-10-05 13:00')));
    	array_push($days, new CalendarDay(2, 'l', new DateTime('2013-10-19 13:00')));
    	array_push($days, new CalendarDay(3, 'l', new DateTime('2013-10-26 13:00')));
    	array_push($days, new CalendarDay(4, 'l', new DateTime('2013-11-02 13:00')));
    	array_push($days, new CalendarDay(5, 'l', new DateTime('2013-11-09 13:00')));
    	array_push($days, new CalendarDay(6, 'l', new DateTime('2013-11-24 13:00')));
    	array_push($days, new CalendarDay(7, 'l', new DateTime('2013-11-30 13:00')));
    	array_push($days, new CalendarDay(8, 'l', new DateTime('2013-12-04 13:00')));
    	array_push($days, new CalendarDay(9, 'l', new DateTime('2013-12-07 13:00')));
    	array_push($days, new CalendarDay(10, 'l', new DateTime('2013-12-14 13:00')));
    	array_push($days, new CalendarDay(11, 'l', new DateTime('2013-12-21 13:00')));
    	array_push($days, new CalendarDay(12, 'l', new DateTime('2013-12-25 13:00')));
    	array_push($days, new CalendarDay(13, 'l', new DateTime('2014-01-04 13:00')));
    	array_push($days, new CalendarDay(14, 'l', new DateTime('2014-01-11 13:00')));
    	array_push($days, new CalendarDay(15, 'l', new DateTime('2014-01-18 13:00')));
    	array_push($days, new CalendarDay(16, 'l', new DateTime('2014-01-25 13:00')));
    	array_push($days, new CalendarDay(17, 'l', new DateTime('2014-02-01 13:00')));
    	array_push($days, new CalendarDay(18, 'l', new DateTime('2014-02-08 13:00')));
    	array_push($days, new CalendarDay(19, 'l', new DateTime('2014-02-15 13:00')));
    	array_push($days, new CalendarDay(1, 'cl', new DateTime('2014-02-18 18:00')));
    	array_push($days, new CalendarDay(20, 'l', new DateTime('2014-02-22 13:00')));
    	array_push($days, new CalendarDay(21, 'l', new DateTime('2014-03-01 13:00')));
    	array_push($days, new CalendarDay(22, 'l', new DateTime('2014-03-08 13:00')));
    	array_push($days, new CalendarDay(2, 'cl', new DateTime('2014-03-11 18:00')));
    	array_push($days, new CalendarDay(23, 'l', new DateTime('2014-03-15 13:00')));
    	array_push($days, new CalendarDay(24, 'l', new DateTime('2014-03-22 13:00')));
    	array_push($days, new CalendarDay(25, 'l', new DateTime('2014-03-29 13:00')));
    	array_push($days, new CalendarDay(3, 'cl', new DateTime('2014-04-01 18:00')));
    	array_push($days, new CalendarDay(26, 'l', new DateTime('2014-04-05 13:00')));
    	array_push($days, new CalendarDay(4, 'cl', new DateTime('2014-04-08 18:00')));
    	array_push($days, new CalendarDay(27, 'l', new DateTime('2014-04-12 13:00')));
    	array_push($days, new CalendarDay(28, 'l', new DateTime('2014-04-19 13:00')));
    	array_push($days, new CalendarDay(5, 'cl', new DateTime('2014-04-22 18:00')));
    	array_push($days, new CalendarDay(29, 'l', new DateTime('2014-04-26 13:00')));
    	array_push($days, new CalendarDay(6, 'cl', new DateTime('2014-04-29 18:00')));
    	array_push($days, new CalendarDay(30, 'l', new DateTime('2014-05-03 13:00')));
    	array_push($days, new CalendarDay(31, 'l', new DateTime('2014-05-10 13:00')));
    	array_push($days, new CalendarDay(32, 'l', new DateTime('2014-05-17 13:00')));
    	array_push($days, new CalendarDay(7, 'cl', new DateTime('2014-05-24 20:00')));
    	
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
