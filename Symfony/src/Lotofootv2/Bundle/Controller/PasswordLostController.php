<?php

namespace Lotofootv2\Bundle\Controller;

use Lotofootv2\Bundle\Service\AccountService;

use Lotofootv2\Bundle\Entity\Account;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class PasswordLostController extends Controller
{
	
	/**
     * @Route("/passwordlost", name="_password_lost")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle::password_lost.html.twig');
    }
    
	/**
     * @Route("/passwordlost/recover", name="_recover_password")
     * @Method("POST")
     */
    public function recoverAction(Request $request)
    {
    	$username = $request->request->get('username');
    	
    	$error = null;
    	
   		if($username == null || trim($username) == ''){
    		$error = "Tous les champs sont obligatoires";
    		return $this->render('Lotofootv2Bundle::password_lost.html.twig', array('error' => $error));   
    	}
    	
    	$account = $this->get('account_service')->findByUsername($username);
    	
    	if($account == null){
    		$error = "Nom d'utilisateur inconnu !";
    		return $this->render('Lotofootv2Bundle::password_lost.html.twig', array('error' => $error));   
    	}
    	
    	$this->mailRecover($account);
    	
        return $this->redirect($this->generateUrl('_login', array('pl' => 1)));
    }
    
    private function mailRecover($account)
    {
    	$from = $this->container->getParameter('mailer_from');
    	
    	$message = \Swift_Message::newInstance()
	        ->setSubject('[Lotofoot] Rappel de mot de passe')
	        ->setFrom($from)
	        ->setTo($account->getEmail())
	        ->setBody($this->renderView('Lotofootv2Bundle:mails:recover.txt.twig', array('account' => $account)));
    	
	    $this->get('mailer')->send($message);
    }
}
