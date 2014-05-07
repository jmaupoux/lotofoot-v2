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


    	array_push($days, new CalendarDay(3, 'cl', new DateTime('2014-04-22 18:00')));
    	array_push($days, new CalendarDay(29, 'l', new DateTime('2014-04-26 13:00')));
    	array_push($days, new CalendarDay(30, 'l', new DateTime('2014-05-03 13:00')));
    	array_push($days, new CalendarDay(31, 'l', new DateTime('2014-05-10 13:00')));
    	array_push($days, new CalendarDay(32, 'l', new DateTime('2014-05-17 13:00')));
    	array_push($days, new CalendarDay(4, 'cl', new DateTime('2014-05-24 20:00')));
    	
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
