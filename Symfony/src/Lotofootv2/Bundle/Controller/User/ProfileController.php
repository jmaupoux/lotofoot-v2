<?php

namespace Lotofootv2\Bundle\Controller\User;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProfileController extends Controller
{
	/**
     * @Route("/profile", name="_profile")
     */
    
    public function indexAction(Request $request)
    {
    	$registry = array();
    	 
    	//[0] = ['A', [ ['Ajaccio', 70], ['Arsenal', 71]...
    	foreach( range('A', 'Z') as $letter){
    		array_push($registry, array($letter, array()));
    	}
    	 
		$registry = $this->register($registry,'Allemagne','159');
		$registry = $this->register($registry,'Angleterre','170');
		$registry = $this->register($registry,'Arabie Saoudite','631');
		$registry = $this->register($registry,'Argentine','642');
		$registry = $this->register($registry,'Australie','1889');
		$registry = $this->register($registry,'Belgique','644');
		$registry = $this->register($registry,'Brésil','626');
		$registry = $this->register($registry,'Colombie','640');
		$registry = $this->register($registry,'Corée du Sud','636');
		$registry = $this->register($registry,'Costa Rica','5000000000000000000001351');
		$registry = $this->register($registry,'Croatie','187');
		$registry = $this->register($registry,'Danemark','151');
		$registry = $this->register($registry,'Egypte','654');
		$registry = $this->register($registry,'Espagne','175');
		$registry = $this->register($registry,'France','165');
		$registry = $this->register($registry,'Iran','637');
		$registry = $this->register($registry,'Islande','167');
		$registry = $this->register($registry,'Japon','643');
		$registry = $this->register($registry,'Maroc','627');
		$registry = $this->register($registry,'Mexique','635');
		$registry = $this->register($registry,'Nigeria','634');
		$registry = $this->register($registry,'Panama','1207');
		$registry = $this->register($registry,'Pérou','650');
		$registry = $this->register($registry,'Pologne','173');
		$registry = $this->register($registry,'Portugal','181');
		$registry = $this->register($registry,'Russie','164');
		$registry = $this->register($registry,'Sénégal','651');
		$registry = $this->register($registry,'Serbie','4256');
		$registry = $this->register($registry,'Suède','172');
		$registry = $this->register($registry,'Suisse','152');
		$registry = $this->register($registry,'Tunisie','639');
		$registry = $this->register($registry,'Uruguay','885');
    	
    	

    	$groups = $this->get('account_service')->listGroups();

    	return $this->render('Lotofootv2Bundle:User:profile.html.twig', array('u' => $request->query->has('u'),'registry' => $registry, 'myteam' => $this->getUser()->getTeam(), 'groups' => $groups));
    }
    
    private function register($registry, $name, $code){
    	array_push($registry[ord($name[0])-65][1], array($name, $code));
    	return $registry;
    }

	/**
     * @Route("/profile/group", name="_profile_group")
     */
    public function changeGroup(Request $request)
    {
    	$group = $request->request->get('group');

   		if($group == null || trim($group) == ''){
    		$group = null;
    	}

    	$this->get('account_service')->updateGroup($this->getUser(), $group);
    	$this->getUser()->setGroups($group);

    	return $this->redirect($this->generateUrl('_profile', array('u' => 1)));
    }

	/**
     * @Route("/profile/mail", name="_profile_mail")
     */
    public function changeMail(Request $request)
    {
    	$mail = $request->request->get('mail');
    	
   		if($mail == null || trim($mail) == ''){
    		$error = "Email obligatoire";
    		return $this->render('Lotofootv2Bundle:User:profile.html.twig', array('error' => $error));
    	}
    	
    	$this->get('account_service')->updateMail($this->getUser(), $mail);
    	$this->getUser()->setEmail($mail);
    	
    	return $this->redirect($this->generateUrl('_profile', array('u' => 1)));
    }
    
    /**
     * @Route("/profile/my", name="_profile_my")
     */
    public function changeTeam(Request $request)
    {
        $team = $request->query->get('t');
        
        if($team == null || trim($team) == ''){
            return $this->redirect($this->generateUrl('_profile'));
        }
        
        $this->get('account_service')->updateTeam($this->getUser(), $team);
        $this->getUser()->setTeam($team);
        
        return $this->redirect($this->generateUrl('_profile'));
    }
}
