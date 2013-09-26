<?php

namespace Lotofootv2\Bundle\Controller;

use Lotofootv2\Bundle\Service\AccountService;

use Lotofootv2\Bundle\Entity\Account;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
	
	/**
     * @Route("/register", name="_register")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('Lotofootv2Bundle::register.html.twig');
    }
    
	/**
     * @Route("/register", name="_register_post")
     * @Method("POST")
     */
    public function registerAction(Request $request)
    {
    	$username = $request->request->get('username');
    	$mail = $request->request->get('mail');
    	$pass1 = $request->request->get('pass1');
    	$pass2 = $request->request->get('pass2');
    	$whoru = $request->request->get('whoru');
    	
    	$error = null;
    	
    	if($username == null || $mail == null || $pass1 == null || $pass2 == null || 
    		trim($username) == '' || trim($mail) == '' || trim($pass1) == '' || trim($pass2) == '' 
    		|| trim($whoru) == '' ){
    		$error = "Tous les champs sont obligatoires";
    	}
    	else if(trim($pass1) != trim($pass2)){
    		$error = "Les mots de passe ne sont pas identiques";
    	}
    	else if(!preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$mail)){
    		$error = 'L\'email est incorrect';
    	}else if($this->get('account_service')->usernameExists($username)){
    		$error = 'Ce nom d\'utilisateur est déjà pris';
    	}  
    	
    	if($error){
    		 return $this->render('Lotofootv2Bundle::register.html.twig', array('error' => $error));
    	}
    	
    	$account = new Account();
    	$account->setUsername($username);
    	$account->setPassword($pass1);
    	$account->setEmail($mail);
    	
    	$this->get('account_service')->create($account);
    	
    	$this->mailRegistration($account, $whoru);
    	
        return $this->redirect($this->generateUrl('_login', array('r' => 1)));
    }
    
    private function mailRegistration($account, $whoru)
    {
    	$from = $this->container->getParameter('mailer_from');
    	
    	$message = \Swift_Message::newInstance()
	        ->setSubject('Inscription Lotofoot')
	        ->setFrom($from)
	        ->setTo($account->getEmail())
	        ->setBody($this->renderView('Lotofootv2Bundle:mails:registration.txt.twig', array('account' => $account)));
    	
	    $this->get('mailer')->send($message);
	    
	    $message2 = \Swift_Message::newInstance()
	        ->setSubject('Inscription Lotofoot')
	        ->setFrom($from)
	        ->setTo($from)
	        ->setBody('Compte à valider ! Account='.$account->getUsername().' (Identification fournie :'.$whoru.')');
	    
	   	$this->get('mailer')->send($message2);
    }
}
