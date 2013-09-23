<?php

namespace Lotofootv2\Bundle\Service;

use Lotofootv2\Bundle\Entity\Reward;

use Lotofootv2\Bundle\Entity\News;

use Monolog\Logger;

use Doctrine\ORM\EntityManager;

class RewardService
{
	private $em;
	private $logger;
	
	public function __construct(EntityManager $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }
	
    public function cleanUpDailies(){
    	$queryRemoveDailies = $this->em->createQuery(
		    'DELETE FROM Lotofootv2Bundle:Reward r 
		    WHERE r.type = :type')
    	->setParameter('type', 'd');

    	$queryRemoveDailies->getResult();
    }
    
	public function getAccountRewards($accountId){
    	$query = $this->em->createQuery(
		    'SELECT r FROM Lotofootv2Bundle:Reward r 
		    WHERE r.account_id = :accountId')
    	->setParameter('accountId', $accountId);

    	return $query->getResult();
    }
    
	public function rewardAllDailies($accounts){
    	$this->rewardKing($accounts);
    	$this->rewardChoune($accounts);
    	$this->rewardBouse($accounts);
    	$this->rewardEclair($accounts);
    	$this->rewardBourseMolle($accounts);
    	$this->rewardSmoking($accounts);
    }
    
	public function rewardKing($accounts){
    	$rewarded = array();
    	
    	$max = 0;
    	
    	foreach ($accounts as $acc) {
    		if($acc->getPoints() == $max){
    			array_push($rewarded, $acc->getId());
    		}elseif($acc->getPoints() > $max){
    			$rewarded = array();
    			array_push($rewarded, $acc->getId());
    			$max = $acc->getPoints();
    		}
    	}
    	
    	foreach ($rewarded as $toreward){
    		$reward = new Reward();
    		$reward->setAccountId($toreward);
    		$reward->setRewardId(1);
    		$reward->setType('d');
    		
    		$this->em->persist($reward);
    	}
    }
    
	public function rewardChoune($accounts){
		$rewarded = array();
    	
    	$max = 1;
    	
    	foreach ($accounts as $acc) {
    		if($acc->getStatScores() == $max){
    			array_push($rewarded, $acc->getId());
    		}elseif($acc->getStatScores() > $max){
    			$rewarded = array();
    			array_push($rewarded, $acc->getId());
    			$max = $acc->getStatScores();
    		}
    	}
    	
    	foreach ($rewarded as $toreward){
    		$reward = new Reward();
    		$reward->setAccountId($toreward);
    		$reward->setRewardId(2);
    		$reward->setType('d');
    		
    		$this->em->persist($reward);
    	}
    }
    
	public function rewardBouse($accounts){
		$rewarded = array();
    	
    	$min = 99999;
    	
    	foreach ($accounts as $acc) {
    		if($acc->getPoints() == $min){
    			array_push($rewarded, $acc->getId());
    		}elseif($acc->getPoints() < $min){
    			$rewarded = array();
    			array_push($rewarded, $acc->getId());
    			$min = $acc->getPoints();
    		}
    	}
    	
    	foreach ($rewarded as $toreward){
    		$reward = new Reward();
    		$reward->setAccountId($toreward);
    		$reward->setRewardId(3);
    		$reward->setType('d');
    		
    		$this->em->persist($reward);
    	}
    }
    
	public function rewardEclair($accounts){
		$queryMaxPoints = $this->em->createQuery(
		    'SELECT DISTINCT (h.account_id) 
		     FROM Lotofootv2Bundle:LeagueHistory h 
		     WHERE h.points = (SELECT max(h2.points) FROM Lotofootv2Bundle:LeagueHistory h2)');

    	$rewarded = $queryMaxPoints->getResult();
    	
    	foreach ($rewarded as $toreward){
    		$reward = new Reward();
    		$reward->setAccountId($toreward['account_id']);
    		$reward->setRewardId(4);
    		$reward->setType('d');
    		
    		$this->em->persist($reward);
    	}
    }
    
	public function rewardBourseMolle($accounts){
		$queryMinPoints = $this->em->createQuery(
		    'SELECT DISTINCT (h.account_id) 
		     FROM Lotofootv2Bundle:LeagueHistory h 
		     WHERE h.points = (SELECT min(h2.points) FROM Lotofootv2Bundle:LeagueHistory h2)');

    	$rewarded = $queryMinPoints->getResult();
    	
    	foreach ($rewarded as $toreward){
    		$reward = new Reward();
    		$reward->setAccountId($toreward['account_id']);
    		$reward->setRewardId(5);
    		$reward->setType('d');
    		
    		$this->em->persist($reward);
    	}
    }
    
	public function rewardSmoking($accounts){
		$rewarded = array();
    	
    	$max = 1;
    	
    	foreach ($accounts as $acc) {
    		if($acc->getStatBonuses() == $max){
    			array_push($rewarded, $acc->getId());
    		}elseif ($acc->getStatBonuses() > $max){
    			$rewarded = array();
    			array_push($rewarded, $acc->getId());
    			$max = $acc->getStatBonuses();
    		}
    		
    	}
    	
    	foreach ($rewarded as $toreward){
    		$reward = new Reward();
    		$reward->setAccountId($toreward);
    		$reward->setRewardId(6);
    		$reward->setType('d');
    		
    		$this->em->persist($reward);
    	}
    }
    
    public function reward50($accountId){
 	   	$reward = new Reward();
    	$reward->setAccountId($accountId);
    	$reward->setRewardId(7);
    	$reward->setType('s');
    	
    	$this->em->persist($reward);
    }
    
	public function reward100($accountId){
 	   	$reward = new Reward();
    	$reward->setAccountId($accountId);
    	$reward->setRewardId(8);
    	$reward->setType('s');
    	
    	$this->em->persist($reward);
    }
    
	public function reward500($accountId){
 	   	$reward = new Reward();
    	$reward->setAccountId($accountId);
    	$reward->setRewardId(9);
    	$reward->setType('s');
    	
    	$this->em->persist($reward);
    }
}
