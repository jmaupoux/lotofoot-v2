<?php

namespace Lotofootv2\Bundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Entity
 * @ORM\Table(name="lfv2_account")
 */
class Account implements AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="team", type="string", length=16, nullable=true)
     */
    private $team;       
    
    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;
    
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\Column(name="is_admin", type="boolean")
     */
    private $isAdmin;
    
    /**
     * @ORM\Column(name="points", type="integer")
     */
    private $points;
    
    /**
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;
    
    /**
     * @ORM\Column(name="progression", type="integer")
     */
    private $progression;
    
    /**
     * @ORM\Column(name="stat_days", type="integer")
     */
    private $statDays;
    
    /**
     * @ORM\Column(name="stat_bonuses", type="integer")
     */
    private $statBonuses;

    /**
     * @ORM\Column(name="stat_results", type="integer")
     */
    private $statResults;
    
    /**
     * @ORM\Column(name="stat_scores", type="integer")
     */
    private $statScores;
    
     /**
     * @ORM\Column(name="cagnoute", type="boolean")
     */
    private $cagnoute;
    
        /**
     * @ORM\Column(name="cup_points", type="integer")
     */
    private $cupPoints;
    
    /**
     * @ORM\Column(name="cup_rank", type="integer")
     */
    private $cupRank;
    
    /**
     * @ORM\Column(name="stat_cup_matchs", type="integer")
     */
    private $statCupMatchs;
    
    /**
     * @ORM\Column(name="stat_cup_results", type="integer")
     */
    private $statCupResults;
    
    /**
     * @ORM\Column(name="stat_cup_scores", type="integer")
     */
    private $statCupScores;
    
     /**
     * @ORM\Column(name="cup_cagnoute", type="boolean")
     */
    private $cupCagnoute;
    
    /**
     * @ORM\Column(name="wins_league", type="integer")
     */
    private $winsLeague = 0;
    
    /**
     * @ORM\Column(name="wins_cup", type="integer")
     */
    private $winsCup = 0;
    
    /**
     * @ORM\Column(name="wins_cl", type="integer")
     */
    private $winsCL = 0;

    /**
     * @ORM\Column(name="groups", type="string", length=64, nullable=true)
     */
    private $groups;

    
    public function __construct()
    {
    	$this->isActive = false;
    	$this->isAdmin = false;
    	$this->points = 0;
    	$this->progression = 0;
    	$this->rank = 99;
    	$this->statBonuses = 0;
    	$this->statDays = 0;
    	$this->statResults = 0;
    	$this->statScores = 0;
    	$this->cagnoute = false;
    	$this->salt = '';
    	//cup
    	$this->cupCagnoute = false;
    	$this->cupPoints = 0;
    	$this->cupRank = 99;
    	$this->statCupMatchs = 0;
    	$this->statCupResults = 0;
    	$this->statCupScores = 0;
    	
    	$this->winsCL = 0;
    	$this->winsLeague = 0;
    	$this->winsCup = 0;
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Account
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPoints($points)
    {
    	$this->points = $points;
    
    	return $this;
    }

    public function getPoints()
    {
    	return $this->points;
    }
    
	public function setRank($rank)
    {
    	$this->rank = $rank;
    
    	return $this;
    }

    public function getRank()
    {
    	return $this->rank;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Account
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

        /**
     * Set email
     *
     * @param string $email
     * @return Account
     */
    public function setTeam($team)
    {
        $this->team = $team;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getTeam()
    {
        return $this->team;
    }
    
    
    /**
     * Set progression
     *
     * @param string $progression
     * @return Account
     */
    public function setProgression($progression)
    {
        $this->progression = $progression;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getProgression()
    {
        return $this->progression;
    }
    
    public function getStatDays()
    {
    	return $this->statDays;
    }
    
    public function setStatDays($stat)
    {
    	$this->statDays = $stat;
    	
    	return $this;
    }
    
	public function getStatBonuses()
    {
    	return $this->statBonuses;
    }
    
	public function setStatBonuses($stat)
    {
    	$this->statBonuses = $stat;
    	
    	return $this;
    }
    
	public function getStatScores()
    {
    	return $this->statScores;
    }
    
	public function setStatScores($stat)
    {
    	$this->statScores = $stat;
    	
    	return $this;
    }
    
	public function getStatResults()
    {
    	return $this->statResults;
    }

	public function setStatResults($stat)
    {
    	$this->statResults = $stat;
    	
    	return $this;
    }
    
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
    	return serialize(array(
    			$this->id,
    	));
    }
    
    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
    	list (
    			$this->id,
    	) = unserialize($serialized);
    }
    
    /**
     * @inheritDoc
     */
    public function getSalt()
    {
    	return $this->salt;
    }
    
    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
    
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
    	if($this->isAdmin){
    		return array('ROLE_ADMIN');
    	}else{
    		return array('ROLE_USER');
    	}
    }
    
	public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }
    
    public function isAdmin()
    {
        return $this->isAdmin;
    }
    
    public function setActive($active)
    {
    	$this->isActive = $active;
    }

	public function setCagnoute($cagnoute)
    {
    	$this->cagnoute = $cagnoute;
    
    	return $this;
    }

    public function getCagnoute()
    {
    	return $this->cagnoute;
    }
    
    public function setCupCagnoute($cupCagnoute)
    {
        $this->cupCagnoute = $cupCagnoute;
    
        return $this;
    }

    public function getCupCagnoute()
    {
        return $this->cupCagnoute;
    }
    
    public function setCupPoints($cupPoints)
    {
        $this->cupPoints = $cupPoints;
    
        return $this;
    }

    public function getCupPoints()
    {
        return $this->cupPoints;
    }
    
    public function setCupRank($rank)
    {
        $this->cupRank = $rank;
    
        return $this;
    }

    public function getCupRank()
    {
        return $this->cupRank;
    }
    
    public function getStatCupMatchs()
    {
        return $this->statCupMatchs;
    }
    
    public function setStatCupMatchs($statCup)
    {
        $this->statCupMatchs = $statCup;
        
        return $this;
    }
    
    public function getStatCupScores()
    {
        return $this->statCupScores;
    }
    
    public function setStatCupScores($statCup)
    {
        $this->statCupScores = $statCup;
        
        return $this;
    }
    
    public function getStatCupResults()
    {
        return $this->statCupResults;
    }

    public function setStatCupResults($statCup)
    {
        $this->statCupResults = $statCup;
        
        return $this;
    }
    
    public function getWinsCL()
    {
        return $this->winsCL;
    }
    public function getWinsLeague()
    {
        return $this->winsLeague;
    }
    public function getWinsCup()
    {
        return $this->winsCup;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function setGroups($group)
    {
        $this->groups = $group;

        return $this;
    }
}