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
     * @Route("/admin/news/create", name="_admin_news_create")
     */
    public function createAction(Request $request)
    {
    	$news = new News();
    	$news->setTitle(stripslashes($request->request->get('title')));
    	$news->setText($request->request->get('text'));
    	$news->setDate(new DateTime());
    	
    	$this->get('news_service')->createNews($news);

    	return $this->redirect($this->generateUrl('_home'));
    }
}
