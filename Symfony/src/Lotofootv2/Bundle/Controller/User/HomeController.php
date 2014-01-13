<?php

namespace Lotofootv2\Bundle\Controller\User;

use Lotofootv2\Bundle\Entity\NewsComm;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use \DateTime;

class HomeController extends Controller
{
	/**
     * @Route("/home", name="_home")
     */
    public function indexAction()
    {
    	$news = $this->get('news_service')->getLastNews();
    	$comms = null;
    	
    	if($news != null){
    	   $comms = $this->get('news_service')->getNewsComms($news);
    	}
    	
    	return $this->render('Lotofootv2Bundle:User:home.html.twig', array('news' => $news, 'last' => true, 'comms'=>$comms));
    }
    
	/**
     * @Route("/home/news/next", name="_home_next_news")
     */
    public function nextNewsAction(Request $request)
    {
    	$news = $this->get('news_service')->getNextNews($request->query->get('number'));
    	$last = $this->get('news_service')->getLastNews();
    	
        if($news == null){
            $news = $last;
        }
        
        $comms = null;
        
        if($news != null){
           $comms = $this->get('news_service')->getNewsComms($news);
        }
    	
    	return $this->render('Lotofootv2Bundle:User:home.html.twig', array('news' => $news, 'last' => ($news->getId() == $last->getId()), 'comms'=>$comms));
    }
    
	/**
     * @Route("/home/news/prev", name="_home_prev_news")
     */
    public function prevNewsAction(Request $request)
    {
    	$news = $this->get('news_service')->getPreviousNews($request->query->get('number'));
    	$last = $this->get('news_service')->getLastNews();
    	
        if($news == null){
    		$news = $last;
    	}
    	
        $comms = null;
        
        if($news != null){
           $comms = $this->get('news_service')->getNewsComms($news);
        }
    	
    	return $this->render('Lotofootv2Bundle:User:home.html.twig', array('news' => $news, 'last' => ($news->getId() == $last->getId()), 'comms'=>$comms));
    }
    
    /**
     * @Route("/home/news/postcomm", name="_home_news_postcomm")
     */
    public function postCommAction(Request $request)
    {
    	$comm = new NewsComm();
    	$comm->setDate(new DateTime());
    	$comm->setAuthor($this->getUser()->getUsername());
    	$comm->setText($request->request->get('text'));
    	
    	if(stripslashes($request->request->get('text')) != null && stripslashes($request->request->get('text')) != ''){
    		$this->get('news_service')->postNewsComm($comm);
    	}
    	
    	return $this->redirect($this->generateUrl('_home'));
    }
}
