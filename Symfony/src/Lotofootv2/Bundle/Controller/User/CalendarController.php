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

    	array_push($days, new CalendarDay(1, 'l', new DateTime('2014-09-13 13:00')));
    	array_push($days, new CalendarDay(2, 'l', new DateTime('2014-09-20 13:00')));
    	array_push($days, new CalendarDay(3, 'l', new DateTime('2014-09-27 13:00')));
    	array_push($days, new CalendarDay(4, 'l', new DateTime('2014-10-04 13:00')));
    	array_push($days, new CalendarDay(5, 'l', new DateTime('2014-10-11 13:00')));
    	array_push($days, new CalendarDay(6, 'l', new DateTime('2014-10-18 13:00')));
    	array_push($days, new CalendarDay(7, 'l', new DateTime('2014-10-25 13:00')));
    	array_push($days, new CalendarDay(8, 'l', new DateTime('2014-11-01 13:00')));
    	array_push($days, new CalendarDay(9, 'l', new DateTime('2014-11-08 13:00')));
    	array_push($days, new CalendarDay(10, 'l', new DateTime('2014-11-15 13:00')));
    	array_push($days, new CalendarDay(11, 'l', new DateTime('2014-11-22 13:00')));
    	array_push($days, new CalendarDay(12, 'l', new DateTime('2014-11-29 13:00')));
    	
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
