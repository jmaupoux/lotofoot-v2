<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Lotofootv2\Bundle\Service\LeagueService;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Lotofootv2\Bundle\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \DateTime;

class NewsController extends Controller
{
	/**
     * @Route("/admin/news", name="_admin_news")
     */
    public function indexAction()
    {
		return $this->render('Lotofootv2Bundle:Admin:news.html.twig');    	
    }
    
	/**
     * @Route("/admin/news/edit", name="_admin_news_edit")
     */
    public function editAction(Request $request)
    {
    	$news = $this->get('news_service')->getLastNews();
    	
    	$request->request->set('edit', 1);
    	$request->request->set('title', $news->getTitle());
    	$request->request->set('text', $news->getText());
    	
		return $this->render('Lotofootv2Bundle:Admin:news.html.twig');    	
    }
    
    /**
     * @Route("/admin/news/create", name="_admin_news_create")
     */
    public function createAction(Request $request)
    {
    	if($request->request->get('edit') == '1'){
    		$news = $this->get('news_service')->getLastNews();
    	}else{
    		$news = new News();
    		$news->setDate(new DateTime());
    	}
    	
    	$news->setTitle(stripslashes($request->request->get('title')));
    	$news->setText(stripslashes($request->request->get('text')));
    	
    	$this->get('news_service')->createUpdateNews($news);

    	return $this->redirect($this->generateUrl('_home'));
    }
}
