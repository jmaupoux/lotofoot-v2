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


    	/* array_push($days, new CalendarDay(3, 'cl', new DateTime('2014-04-22 18:00')));
    	array_push($days, new CalendarDay(29, 'l', new DateTime('2014-04-26 13:00')));
    	array_push($days, new CalendarDay(30, 'l', new DateTime('2014-05-03 13:00')));
    	array_push($days, new CalendarDay(31, 'l', new DateTime('2014-05-10 13:00')));
    	array_push($days, new CalendarDay(32, 'l', new DateTime('2014-05-17 13:00')));
    	array_push($days, new CalendarDay(4, 'cl', new DateTime('2014-05-24 20:00'))); */
    	
    	array_push($days, new CalendarDay(1, 'vote-cup', new DateTime('2014-06-12 22:00')));
    	array_push($days, new CalendarDay(2, 'vote-cup', new DateTime('2014-06-13 18:00')));
    	array_push($days, new CalendarDay(3, 'vote-cup', new DateTime('2014-06-13 21:00')));
    	array_push($days, new CalendarDay(4, 'vote-cup', new DateTime('2014-06-13 23:59')));
    	array_push($days, new CalendarDay(5, 'vote-cup', new DateTime('2014-06-14 03:00')));
    	array_push($days, new CalendarDay(6, 'vote-cup', new DateTime('2014-06-14 18:00')));
    	array_push($days, new CalendarDay(7, 'vote-cup', new DateTime('2014-06-14 21:00')));
    	array_push($days, new CalendarDay(8, 'vote-cup', new DateTime('2014-06-14 23:59')));
    	array_push($days, new CalendarDay(9, 'vote-cup', new DateTime('2014-06-15 18:00')));
    	array_push($days, new CalendarDay(10, 'vote-cup', new DateTime('2014-06-15 21:00')));
    	array_push($days, new CalendarDay(11, 'vote-cup', new DateTime('2014-06-15 23:59')));
    	array_push($days, new CalendarDay(12, 'vote-cup', new DateTime('2014-06-16 18:00')));
    	array_push($days, new CalendarDay(13, 'vote-cup', new DateTime('2014-06-16 21:00')));
    	array_push($days, new CalendarDay(14, 'vote-cup', new DateTime('2014-06-16 23:59')));
    	array_push($days, new CalendarDay(15, 'vote-cup', new DateTime('2014-06-17 18:00')));
    	array_push($days, new CalendarDay(16, 'vote-cup', new DateTime('2014-06-17 21:00')));
    	array_push($days, new CalendarDay(17, 'vote-cup', new DateTime('2014-06-17 23:59')));
    	array_push($days, new CalendarDay(18, 'vote-cup', new DateTime('2014-06-18 18:00')));
    	array_push($days, new CalendarDay(19, 'vote-cup', new DateTime('2014-06-18 21:00')));
    	array_push($days, new CalendarDay(20, 'vote-cup', new DateTime('2014-06-18 23:59')));
    	array_push($days, new CalendarDay(21, 'vote-cup', new DateTime('2014-06-19 18:00')));
    	array_push($days, new CalendarDay(22, 'vote-cup', new DateTime('2014-06-19 21:00')));
    	array_push($days, new CalendarDay(23, 'vote-cup', new DateTime('2014-06-19 23:59')));
    	array_push($days, new CalendarDay(24, 'vote-cup', new DateTime('2014-06-20 18:00')));
    	array_push($days, new CalendarDay(25, 'vote-cup', new DateTime('2014-06-20 21:00')));
    	array_push($days, new CalendarDay(26, 'vote-cup', new DateTime('2014-06-20 23:59')));
    	array_push($days, new CalendarDay(27, 'vote-cup', new DateTime('2014-06-21 18:00')));
    	array_push($days, new CalendarDay(28, 'vote-cup', new DateTime('2014-06-21 21:00')));
    	array_push($days, new CalendarDay(29, 'vote-cup', new DateTime('2014-06-21 23:59')));
    	array_push($days, new CalendarDay(30, 'vote-cup', new DateTime('2014-06-22 18:00')));
    	array_push($days, new CalendarDay(31, 'vote-cup', new DateTime('2014-06-22 21:00')));
    	array_push($days, new CalendarDay(32, 'vote-cup', new DateTime('2014-06-22 23:59')));
    	
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
