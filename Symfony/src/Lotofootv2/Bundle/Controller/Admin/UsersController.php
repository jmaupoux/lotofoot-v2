<?php

namespace Lotofootv2\Bundle\Controller\Admin;

use Lotofootv2\Bundle\Service\LeagueService;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Lotofootv2\Bundle\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \DateTime;

class UsersController extends Controller
{
	/**
     * @Route("/admin/users", name="_admin_users")
     */
    public function indexAction()
    {
    	$accounts = $this->get('account_service')->all();
    	
		return $this->render('Lotofootv2Bundle:Admin:users.html.twig', array('users'=>$accounts));    	
    }
    
	/**
     * @Route("/admin/users/activation", name="_admin_users_activation")
     */
    public function activationAction(Request $request)
    {
    	$id = $request->query->get('id');
    	
    	$acc = $this->get('account_service')->switchActivation($id);
    	
    	if($acc->isEnabled()){
    		$this->mailActivation($acc);
    	}else{
    		$this->mailDesactivation($acc);
    	}
		return $this->redirect($this->generateUrl('_admin_users'));
    }
    
	private function mailActivation($account)
    {
    	$from = $this->container->getParameter('mailer_from');
    
    	$message = \Swift_Message::newInstance()
	        ->setSubject('[Lotofoot] Activation du compte')
	        ->setFrom($from)
	        ->setTo($account->getEmail())
	        ->setBody($this->renderView('Lotofootv2Bundle:mails:activation.txt.twig', 
	        	array('account' => $account)));
    	
	    $this->get('mailer')->send($message);
    }
    
	private function mailDesactivation($account)
    {
    	$from = $this->container->getParameter('mailer_from');
    
    	$message = \Swift_Message::newInstance()
	        ->setSubject('[Lotofoot] Désactivation du compte')
	        ->setFrom($from)
	        ->setTo($account->getEmail())
	        ->setBody($this->renderView('Lotofootv2Bundle:mails:deactivation.txt.twig', 
	        	array('account' => $account)));
    	
	    $this->get('mailer')->send($message);
    }

}
