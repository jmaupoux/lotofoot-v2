<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use \DateTime;

use Lotofootv2\Bundle\Entity\LeagueMatch;

class LeagueDayController extends Controller
{
	/**
     * @Route("/admin/league/day", name="_admin_league_day")
     */
    public function indexAction()
    {		
		$leagueDay = $this->get('league_service')->getNotCorrectedLeagueDay();
		
		$closed = true;
		$matches = null;
		
		if($leagueDay != null){
			$closed = ($leagueDay->getDeadline() < new DateTime());
			$matches = $this->get('league_service')->getLeagueDayMatches($leagueDay->getId());
		}
		
    	return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', 
    		array('leagueDay' => $leagueDay, 'closed' => $closed, 'matches' => $matches)
    	);
    }
    
	/**
     * @Route("/admin/league/day/new", name="_admin_league_day_new")
     */
    public function newAction(Request $request)
    {	
    	$deadline = DateTime::createFromFormat("d/m/Y H:i", $request->request->get('deadline').' '.$request->request->get('deadlineh'));
	    $dl_errors = DateTime::getLastErrors();
		if (!empty($dl_errors['warning_count'])) {
		    return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('error' => 'Date incorrecte'));
		}
    	
    	if($deadline == null){
    		return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('error' => 'Date incorrecte'));
    	}
    	
    	if($deadline < new DateTime()){
    		return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('error' => 'Date dans le passé !!'));
    	}
    	
    	$matches = array();
    	
    	$isbonus = false;
    	
		for($i=1;$i<=13;$i++){
			$error = null;
			
			$home = $request->request->get('home_'.$i);
			$visitor = $request->request->get('visitor_'.$i);
			$bonus = $request->request->get('bonus_'.$i);
			
			if($home == null || $home == ''){
				$error = 'L\'équipe Domicile '.$i.' n\'est pas remplie';
			}
			if($visitor == null || $visitor == ''){
				$error = 'L\'équipe Extérieur '.$i.' n\'est pas remplie';
			}
			
			if($bonus != null && $bonus == 'on'){
				if($isbonus == true){
					$error = '2 bonus détectés';
				}else{
					$isbonus = true;
				}
			}
			
			$this->get('logger')->info($bonus);
			
			if($error != null){
				return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('error' => $error));
			}
			
			$match = new LeagueMatch();
			$match->setTeamHome($home);
			$match->setTeamVisitor($visitor);
			$match->setBonus($bonus == 'on');
			$match->setNumber($i);
			
			array_push($matches, $match);
		}
    	
		$this->get('league_service')->newLeagueDay($matches, $deadline);
		
    	return $this->redirect($this->generateUrl('_admin_league_day'));
    }
    
	/**
     * @Route("/admin/league/day/mark", name="_admin_league_day_mark")
     */
    public function markAction(Request $request)
    {	
    	$deadline = DateTime::createFromFormat("d/m/Y H:i", $request->request->get('deadline').' '.$request->request->get('deadlineh'));
	    $dl_errors = DateTime::getLastErrors();
		if (!empty($dl_errors['warning_count'])) {
		    return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('error' => 'Date incorrecte'));
		}
    	
    	if($deadline == null){
    		return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('error' => 'Date incorrecte'));
    	}
    	
    	if($deadline < new DateTime()){
    		return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('error' => 'Date dans le passé !!'));
    	}
    	
    	$matches = array();
    	
    	$isbonus = false;
    	
		for($i=1;$i<=13;$i++){
			$error = null;
			
			$home = $request->request->get('home_'.$i);
			$visitor = $request->request->get('visitor_'.$i);
			$bonus = $request->request->get('bonus_'.$i);
			
			if($home == null || $home == ''){
				$error = 'L\'équipe Domicile '.$i.' n\'est pas remplie';
			}
			if($visitor == null || $visitor == ''){
				$error = 'L\'équipe Extérieur '.$i.' n\'est pas remplie';
			}
			
			if($bonus != null && $bonus == 'on'){
				if($isbonus == true){
					$error = '2 bonus détectés';
				}else{
					$isbonus = true;
				}
			}
			
			$this->get('logger')->info($bonus);
			
			if($error != null){
				return $this->render('Lotofootv2Bundle:Admin:league_day.html.twig', array('error' => $error));
			}
			
			$match = new LeagueMatch();
			$match->setTeamHome($home);
			$match->setTeamVisitor($visitor);
			$match->setBonus($bonus == 'on');
			$match->setNumber($i);
			
			array_push($matches, $match);
		}
    	
		$this->get('league_service')->newLeagueDay($matches, $deadline);
		
    	return $this->redirect($this->generateUrl('_admin_league_day'));
    }
}
