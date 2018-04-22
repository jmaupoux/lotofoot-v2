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

		array_push($days, new CalendarDay(1, 'wc', new DateTime('2018-06-14 17:00')));
		array_push($days, new CalendarDay(2, 'wc', new DateTime('2018-06-15 14:00')));
		array_push($days, new CalendarDay(3, 'wc', new DateTime('2018-06-15 17:00')));
		array_push($days, new CalendarDay(4, 'wc', new DateTime('2018-06-15 20:00')));
		array_push($days, new CalendarDay(5, 'wc', new DateTime('2018-06-16 12:00')));
		array_push($days, new CalendarDay(6, 'wc', new DateTime('2018-06-16 15:00')));
		array_push($days, new CalendarDay(7, 'wc', new DateTime('2018-06-16 18:00')));
		array_push($days, new CalendarDay(8, 'wc', new DateTime('2018-06-16 21:00')));
		array_push($days, new CalendarDay(9, 'wc', new DateTime('2018-06-17 14:00')));
		array_push($days, new CalendarDay(10, 'wc', new DateTime('2018-06-17 17:00')));
		array_push($days, new CalendarDay(11, 'wc', new DateTime('2018-06-17 20:00')));
		array_push($days, new CalendarDay(12, 'wc', new DateTime('2018-06-18 14:00')));
		array_push($days, new CalendarDay(13, 'wc', new DateTime('2018-06-18 17:00')));
		array_push($days, new CalendarDay(14, 'wc', new DateTime('2018-06-18 20:00')));
		array_push($days, new CalendarDay(15, 'wc', new DateTime('2018-06-19 14:00')));
		array_push($days, new CalendarDay(16, 'wc', new DateTime('2018-06-19 17:00')));
		array_push($days, new CalendarDay(17, 'wc', new DateTime('2018-06-19 20:00')));
		array_push($days, new CalendarDay(18, 'wc', new DateTime('2018-06-20 14:00')));
		array_push($days, new CalendarDay(19, 'wc', new DateTime('2018-06-20 17:00')));
		array_push($days, new CalendarDay(20, 'wc', new DateTime('2018-06-20 20:00')));
		array_push($days, new CalendarDay(21, 'wc', new DateTime('2018-06-21 14:00')));
		array_push($days, new CalendarDay(22, 'wc', new DateTime('2018-06-21 17:00')));
		array_push($days, new CalendarDay(23, 'wc', new DateTime('2018-06-21 20:00')));
		array_push($days, new CalendarDay(24, 'wc', new DateTime('2018-06-22 14:00')));
		array_push($days, new CalendarDay(25, 'wc', new DateTime('2018-06-22 17:00')));
		array_push($days, new CalendarDay(26, 'wc', new DateTime('2018-06-22 20:00')));
		array_push($days, new CalendarDay(27, 'wc', new DateTime('2018-06-23 14:00')));
		array_push($days, new CalendarDay(28, 'wc', new DateTime('2018-06-23 17:00')));
		array_push($days, new CalendarDay(29, 'wc', new DateTime('2018-06-23 20:00')));
		array_push($days, new CalendarDay(30, 'wc', new DateTime('2018-06-24 14:00')));
		array_push($days, new CalendarDay(31, 'wc', new DateTime('2018-06-24 17:00')));
		array_push($days, new CalendarDay(32, 'wc', new DateTime('2018-06-24 20:00')));
		array_push($days, new CalendarDay(33, 'wc', new DateTime('2018-06-25 16:00')));
		array_push($days, new CalendarDay(34, 'wc', new DateTime('2018-06-25 16:00')));
		array_push($days, new CalendarDay(35, 'wc', new DateTime('2018-06-25 20:00')));
		array_push($days, new CalendarDay(36, 'wc', new DateTime('2018-06-25 20:00')));
		array_push($days, new CalendarDay(37, 'wc', new DateTime('2018-06-26 16:00')));
		array_push($days, new CalendarDay(38, 'wc', new DateTime('2018-06-26 16:00')));
		array_push($days, new CalendarDay(39, 'wc', new DateTime('2018-06-26 20:00')));
		array_push($days, new CalendarDay(40, 'wc', new DateTime('2018-06-26 20:00')));
		array_push($days, new CalendarDay(41, 'wc', new DateTime('2018-06-27 16:00')));
		array_push($days, new CalendarDay(42, 'wc', new DateTime('2018-06-27 16:00')));
		array_push($days, new CalendarDay(43, 'wc', new DateTime('2018-06-27 20:00')));
		array_push($days, new CalendarDay(44, 'wc', new DateTime('2018-06-27 20:00')));
		array_push($days, new CalendarDay(45, 'wc', new DateTime('2018-06-28 16:00')));
		array_push($days, new CalendarDay(46, 'wc', new DateTime('2018-06-28 16:00')));
		array_push($days, new CalendarDay(47, 'wc', new DateTime('2018-06-28 20:00')));
		array_push($days, new CalendarDay(48, 'wc', new DateTime('2018-06-28 20:00')));
		array_push($days, new CalendarDay(49, 'wc', new DateTime('2018-06-30 16:00')));
		array_push($days, new CalendarDay(50, 'wc', new DateTime('2018-06-30 20:00')));
		array_push($days, new CalendarDay(51, 'wc', new DateTime('2018-07-01 16:00')));
		array_push($days, new CalendarDay(52, 'wc', new DateTime('2018-07-01 20:00')));
		array_push($days, new CalendarDay(53, 'wc', new DateTime('2018-07-02 16:00')));
		array_push($days, new CalendarDay(54, 'wc', new DateTime('2018-07-02 20:00')));
		array_push($days, new CalendarDay(55, 'wc', new DateTime('2018-07-03 16:00')));
		array_push($days, new CalendarDay(56, 'wc', new DateTime('2018-07-03 20:00')));
		array_push($days, new CalendarDay(57, 'wc', new DateTime('2018-07-06 16:00')));
		array_push($days, new CalendarDay(58, 'wc', new DateTime('2018-07-06 20:00')));
		array_push($days, new CalendarDay(59, 'wc', new DateTime('2018-07-07 16:00')));
		array_push($days, new CalendarDay(60, 'wc', new DateTime('2018-07-07 20:00')));
		array_push($days, new CalendarDay(61, 'wc', new DateTime('2018-07-10 20:00')));
		array_push($days, new CalendarDay(62, 'wc', new DateTime('2018-07-11 20:00')));
		array_push($days, new CalendarDay(63, 'wc', new DateTime('2018-07-14 16:00')));
		array_push($days, new CalendarDay(64, 'wc', new DateTime('2018-07-15 17:00')));
    	
    	
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
