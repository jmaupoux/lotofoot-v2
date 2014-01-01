<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Lotofootv2\Bundle\Entity\TournamentMatch;

use Lotofootv2\Bundle\Entity\Tournament;

use Lotofootv2\Bundle\Service\LeagueService;
use Lotofootv2\Bundle\LotofootUtil;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Lotofootv2\Bundle\Entity\League;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \DateTime;

class CLController extends Controller
{
	/**
     * @Route("/admin/cl", name="_admin_cl")
     */
    public function indexAction(Request $request)
    {
    	$tour_s = $this->get('tournament_service');
    	$cl = $tour_s->getRunningTour();
    	

    	if($cl == null || $cl->getType() != "CL"){
    		return $this->render('Lotofootv2Bundle:Admin:cl.html.twig', 
				array('step' => null)
			);
    	}
    	
    	$step = $tour_s->getTourStep($cl->getId());
        $closed = ($step->getDeadline() < new DateTime());
    	
        $matches = $tour_s->getTourStepMatches($step->getId());
    	
    	return $this->render('Lotofootv2Bundle:Admin:cl.html.twig', 
			array('step' => $step, 'err' => $request->query->get('err'), 'closed' => $closed, 'matches' => $matches)
		);
//		
//		$this->get('logger')->info('This will be written in logs'.$tour);
//		
//		$toCorrect = $this->get('league_service')->getNotCorrectedLeagueDay() != null;
//		
		
    }
    
    /**
     * @Route("/admin/cl/create", name="_admin_cl_create")
     */
    public function createAction(Request $request)
    {    	
    	$this->get('tournament_service')->createCL($request->request->get('name'), $request->request->get('step_name'));

    	return $this->redirect($this->generateUrl('_admin_cl'));
    }
    
    /**
     * @Route("/admin/cl/step/matchs", name="_admin_cl_matchs_create")
     */
    public function createMatchsAction(Request $request)
    {    	
    	$deadline = DateTime::createFromFormat("d/m/Y H:i", $request->request->get('deadline').' '.$request->request->get('deadlineh'));
	    $dl_errors = DateTime::getLastErrors();
		if (!empty($dl_errors['warning_count'])) {
			return $this->redirect($this->generateUrl('_admin_cl', array('err' => 'Date incorrecte')));
		}
    	
    	if($deadline == null){
    		return $this->redirect($this->generateUrl('_admin_cl', array('err' => 'Date incorrecte')));
    	}
    	
    	if($deadline < new DateTime()){
    		return $this->redirect($this->generateUrl('_admin_cl', array('err' => 'Date passée')));
    	}
    	
    	$matches = array();
    	
    	$i = 1;
    	
    	while($request->request->get('home_'.$i) != null && $request->request->get('home_'.$i) != ''){
    		$home = $request->request->get('home_'.$i);
			$visitor = $request->request->get('visitor_'.$i);
			
			$error = null;
			
			if($home == null || $home == ''){
				$error = 'L\'équipe Domicile '.$i.' n\'est pas remplie';
			}
			if($visitor == null || $visitor == ''){
				$error = 'L\'équipe Extérieur '.$i.' n\'est pas remplie';
			}
			
			if($error != null){
				return $this->redirect($this->generateUrl('_admin_cl', array('err' => $error)));
			}
			
			$match = new TournamentMatch();
			$match->setTeamHome($home);
			$match->setTeamVisitor($visitor);
			$match->setNumber($i);
			
			if($request->request->has('is_first_goal') && $request->request->get('is_first_goal') == $i){
				$match->setIsFirstGoal(true);
			}else{
				$match->setIsFirstGoal(false);
			}
			
			array_push($matches, $match);
			
			$i++;
    	}
    	
		$this->get('tournament_service')->createMatches($matches, $deadline);
		
//		$this->mailNewDay($deadline);
		
    	return $this->redirect($this->generateUrl('_admin_cl'));
    }
    
    /**
     * @Route("/admin/cl/mark", name="_admin_cl_mark")
     */
    public function markAction(Request $request)
    {
    	$step = $this->get('tournament_service')->getOpenCLTourStep();
        
    	$deadline = DateTime::createFromFormat("d/m/Y H:i", $request->request->get('deadline').' '.$request->request->get('deadlineh'));    	
    	
        if($step == null){
            return $this->redirect($this->generateUrl('_admin_cl'));
        }
        
        $matches = $this->get('tournament_service')->getTourStepMatches($step->getId());
        
        for($i=1;$i<=count($matches);$i++){
            $error = null;
            if(! LotofootUtil::validScore($request->request->get('score_'.$matches[$i-1]->getId()))){
                return $this->render('Lotofootv2Bundle:Admin:cl.html.twig', 
                array('step' => $step, 'closed' => true, 'matches' => $matches, 'err' => 'Score incorrect pour le match : '.$i));
            }
        }
        
        for($i=1;$i<=count($matches);$i++){  
            $score = LotofootUtil::clearSpaces($request->request->get('score_'.$matches[$i-1]->getId()));
            $matches[$i-1]->setScore($score);
            
            $score = preg_split("/-/", $score);
            
            $result = (intval($score[0]) > intval($score[1]))? '1' :
                    (intval($score[0]) < intval($score[1]) ? '2' : 'N');    
            
            $matches[$i-1]->setResult($result);
            
            if($matches[$i-1]->getIsFirstGoal()){
            	$matches[$i-1]->setFirstGoalMin($request->request->get('first_goal_min'));
            }
        }

        $this->get('tournament_service')->processCLStep($matches, $deadline);
        
        return $this->redirect($this->generateUrl('_admin_cl'));
    }
}
