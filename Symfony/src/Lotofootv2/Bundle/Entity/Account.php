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
    	$this->salt = '';
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
}
