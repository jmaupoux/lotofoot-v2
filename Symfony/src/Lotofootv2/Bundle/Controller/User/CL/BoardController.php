<?php

namespace Lotofootv2\Bundle\Controller\User\CL;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BoardController extends Controller
{
	/**
     * @Route("/cl/board", name="_cl_board")
     */
    public function indexAction(Request $request)
    {
        $tour =  $this->get('tournament_service')->getRunningTour();
        
        $data = array();
        
        if($tour != null){
        	$players = $this->get('tournament_service')->getTourPlayers($tour->getId());
        	
        	$accs = $this->get('account_service')->all();
        	
        	foreach($accs as $a){
        		//acc_accountid
        		$request->request->set('acc_'.$a->getId(), $a->getUsername());
        	}
        	
        	foreach($players as $p){
        		//step display
        		//step_stepid_groupnumber_groupposition
        		$base_key = 'step_'.$p->getTourStepNumber().'_'.$p->getGroupNumber().'_'.$p->getGroupPosition();
        		
        		$request->request->set($base_key.'_a', $p->getAccountId());
        		$request->request->set($base_key.'_pa', $p->getPointsA());
        		$request->request->set($base_key.'_pr', $p->getPointsR());
        		$request->request->set($base_key.'_pt', $p->getTotalPoints());
        	}
        }
    	
        return $this->render('Lotofootv2Bundle:User/CL:board.html.twig');
    }
}
