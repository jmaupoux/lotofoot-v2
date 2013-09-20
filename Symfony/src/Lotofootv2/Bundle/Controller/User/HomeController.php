<?php

namespace Lotofootv2\Bundle\Controller\User;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
	/**
     * @Route("/home", name="_home")
     */
    public function indexAction()
    {
    	$news = $this->get('news_service')->getLastNews();
    	
    	return $this->render('Lotofootv2Bundle:User:home.html.twig', array('news' => $news));
    }
    
	/**
     * @Route("/home/news/next", name="_home_next_news")
     */
    public function nextNewsAction(Request $request)
    {
    	$news = $this->get('news_service')->getNextNews($request->query->get('number'));
    	
    	if($news == null){
    		$news = $this->get('news_service')->getLastNews();
    	}
    	
    	return $this->render('Lotofootv2Bundle:User:home.html.twig', array('news' => $news));
    }
    
	/**
     * @Route("/home/news/prev", name="_home_prev_news")
     */
    public function prevNewsAction(Request $request)
    {
    	$news = $this->get('news_service')->getPreviousNews($request->query->get('number'));
    	
        if($news == null){
    		$news = $this->get('news_service')->getLastNews();
    	}
    	
    	return $this->render('Lotofootv2Bundle:User:home.html.twig', array('news' => $news));
    }
}
