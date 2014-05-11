<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Lotofootv2\Bundle\Entity\CupMatch;

use Lotofootv2\Bundle\Entity\Cup;

use Lotofootv2\Bundle\Service\LeagueService;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Lotofootv2\Bundle\Entity\League;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Lotofootv2\Bundle\LotofootUtil;

use \DateTime;

class CupController extends Controller
{
	/**
     * @Route("/admin/cup", name="_admin_cup")
     */
    public function indexAction()
    {
    	$cs = $this->get('cup_service');
    	$cup = $cs->getRunningCup();
    	
    	if($cup == null){
    		return $this->render('Lotofootv2Bundle:Admin:new_cup.html.twig' );      
    	}
    	
    	$nc_matchs = $cs->getNotCorrectedMatchs();
    	
		return $this->render('Lotofootv2Bundle:Admin:cup.html.twig', 
			array('nc_matchs' => $nc_matchs)
		);    	
    }
    
    /**
     * @Route("/admin/cup/stats", name="_admin_cup_stats")
     */
    public function statsAction()
    {
        $cs = $this->get('cup_service');
        $cup = $cs->getRunningCup();
        
        if($cup == null){
            return $this->render('Lotofootv2Bundle:Admin:new_cup.html.twig' );      
        }

        $stats = $cs->getStatsCorrectedMatchs();
        
        $next = $cs->getNextMatchToVote();
        $voted = $cs->getHasVoted();
        $not_voted = $cs->getHasNotVoted();
        
        return $this->render('Lotofootv2Bundle:Admin:cup_stats.html.twig', 
            array('stats' => $stats,
            'voted' => $voted, 'not_voted' => $not_voted, 'next' => $next)
        );      
    }
    
    /**
     * @Route("/admin/cup/create", name="_admin_cup_create")
     */
    public function createAction(Request $request)
    {
    	$cup = new Cup();
    	$cup->setName($request->request->get('name'));
    	$cup->setOpened(true);
    	
    	$this->get('cup_service')->createCup($cup);

    	return $this->redirect($this->generateUrl('_admin_cup'));
    }
    
    /**
     * @Route("/admin/cup/matchs/create", name="_admin_cup_matchs_create")
     */
    public function createMatchsAction(Request $request)
    {        
        $matches = array();
        
        $i = 1;
        
        while($request->request->get('home_'.$i) != null && $request->request->get('home_'.$i) != ''){
            $home = $request->request->get('home_'.$i);
            $visitor = $request->request->get('visitor_'.$i);
            $factor = $request->request->get('factor_'.$i);
            
            $error = null;
            
            if($home == null || $home == ''){
                $error = 'L\'équipe Domicile '.$i.' n\'est pas remplie';
            }
            if($visitor == null || $visitor == ''){
                $error = 'L\'équipe Extérieur '.$i.' n\'est pas remplie';
            }
            if($factor == null || $factor == ''){
                $error = 'Le facteur '.$i.' n\'est pas rempli';
            }
            
	        $deadline = DateTime::createFromFormat("d/m/Y H:i", $request->request->get('deadline_'.$i).' '.$request->request->get('deadlineh_'.$i));
	        
	        $dl_errors = DateTime::getLastErrors();
	        if (!empty($dl_errors['warning_count'])) {
	        	$error = 'Date incorrecte';
	        }
	        
	        if($deadline == null){
	            $error = 'Date incorrecte';
	        }
	        
	        if($deadline < new DateTime()){
	            $error = 'Date passée';
	        }
            
            if($error != null){
                return $this->redirect($this->generateUrl('_admin_cup', array('err' => $error)));
            }
            
            $match = new CupMatch();
            $match->setTeamHome($home);
            $match->setTeamVisitor($visitor);
            $match->setDeadline($deadline);
            $match->setFactor($factor);
            $match->setCorrected(false);
            
            array_push($matches, $match);
            
            $i++;
        }
        
        $this->get('cup_service')->createMatches($matches);
    	
        return $this->redirect($this->generateUrl('_admin_cup'));
    }
    
    /**
     * @Route("/admin/cup/correct", name="_admin_cup_correct")
     */
    public function correctMatchsAction(Request $request)
    {
    	$cs = $this->get('cup_service');
        $matches = $cs->getClosedMatchs();
        
        $corrected = array();
        
        $err = "";
        
        for($i=0;$i<count($matches);$i++){
            
            if(LotofootUtil::clearSpaces($request->request->get('score_'.$matches[$i]->getId())) != '' 
                && ! LotofootUtil::validScore($request->request->get('score_'.$matches[$i]->getId()))){
                $err .='<br/>Score incorrect pour le match : '.($i+1);
                continue;
            }
            
            $m = $matches[$i];
            $score = LotofootUtil::clearSpaces($request->request->get('score_'.$matches[$i]->getId()));
            
            if($score != '' && $score != null){
                $m->setCorrected(true);
                $m->setScore($score);
                  
                $res = preg_split("/-/", $score);
            
	            $result = (intval($res[0]) > intval($res[1]))? '1' :
	                    (intval($res[0]) < intval($res[1]) ? '2' : 'N');    
	            
	            $m->setResult($result);    
	            
	            array_push($corrected, $m);
            }
        }
        
        //TODO afficher l'erreur quelque part s'il y en a
        $cs->processCorrection($corrected);        
        
        return $this->redirect($this->generateUrl('_admin_cup'));
    }
}
