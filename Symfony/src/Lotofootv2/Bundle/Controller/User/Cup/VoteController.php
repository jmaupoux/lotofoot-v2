<?php

namespace Lotofootv2\Bundle\Controller\User\Cup;

use Lotofootv2\Bundle\Entity\CupVote;

use Lotofootv2\Bundle\Entity\LeagueVote;
use Lotofootv2\Bundle\LotofootUtil;

use Lotofootv2\Bundle\Entity\LeagueMatch;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use \DateTime;

class VoteController extends Controller
{
	/**
     * @Route("/cup/vote", name="_cup_vote")
     */ 
    public function indexAction(Request $request, $err = null)
    {
    	$cs = $this->get('cup_service');
    	
    	$open = $cs->getOpenMatchs();
    	$closed = $cs->getClosedMatchs();
    	
    	$votes = $cs->getAccountVotes($this->getUser()->getId());
    	
    	$points = 0;
        for($i=0;$i<count($votes);$i++){
            $request->request->set('score_'.$votes[$i]->getCupMatchId(), $votes[$i]->getScore());
            $request->request->set('result_'.$votes[$i]->getCupMatchId(), $votes[$i]->getResult());
            $request->request->set('points_'.$votes[$i]->getCupMatchId(), $votes[$i]->getPoints());
            $points+=$votes[$i]->getPoints();
        }
    	
    	return $this->render('Lotofootv2Bundle:User/Cup:vote.html.twig', array('opens' => $open, 'closed' => $closed, 'err'=>$err));
    }

    /**
     * @Route("/cup/post", name="_cup_post")
     */ 
    public function postAction(Request $request)
    {
        $cs = $this->get('cup_service');
        
        //base to add votes
        $matches = $cs->getOpenMatchs();
        
        $votes = array();
        
        $err = "";
        $full = 1;
        
        for($i=0;$i<count($matches);$i++){
            
            if(LotofootUtil::clearSpaces($request->request->get('score_'.$matches[$i]->getId())) != '' 
                && ! LotofootUtil::validScore($request->request->get('score_'.$matches[$i]->getId()))){
                $err .='<br/>Score incorrect pour le match : '.($i+1);
                continue;
            }
            if(LotofootUtil::clearSpaces($request->request->get('result_'.$matches[$i]->getId())) != '' 
                && ! LotofootUtil::validResult($request->request->get('result_'.$matches[$i]->getId()))){
                $err .='<br/>Résultat incorrect pour le match : '.($i+1);
                continue;
            }
            
            $vote = new CupVote();   
            $vote->setDate(new DateTime());
            $vote->setAccountId($this->getUser()->getId());
            $vote->setCupMatchId($matches[$i]->getId());
            $vote->setResult(
                LotofootUtil::clearSpaces($request->request->get('result_'.$matches[$i]->getId()))
            );
            $vote->setScore(
                LotofootUtil::clearSpaces($request->request->get('score_'.$matches[$i]->getId()))
            );
            
            if(($vote->getResult() == '' || $vote->getResult() == null) &&
                ($vote->getScore() == '' || $vote->getScore() == null) ){
                $err .= "<br/>Match ".($i+1)." non rempli";
            }else{
                array_push($votes, $vote);
            }
        }
        
        $cs->vote($votes);
        
        return $this->forward('Lotofootv2Bundle:User\Cup\Vote:index',array('request' => $request, 'err' => $err));
    }
}
