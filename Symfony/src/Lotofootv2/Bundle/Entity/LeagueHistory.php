<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table(name="lfv2_league_history")
 * @ORM\Entity
 */
class LeagueHistory
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
     * @var integer
     *
     * @ORM\Column(name="league_day_id", type="integer")
     */
    private $league_day_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer")
     */
    private $account_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="has_bonus", type="boolean")
     */
    private $has_bonus;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="scores", type="integer")
     */
    private $scores;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="results", type="integer")
     */
    private $results;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="total_points", type="integer")
     */
    private $totalPoints;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="voted", type="boolean")
     */
    private $voted;

    /**
     * @var integer
     *
     * @ORM\Column(name="season", type="integer")
     */
    private $season;
    

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
     * Set league_day_id
     *
     * @param integer $league_day_id
     * @return History
     */
    public function setLeagueDayId($league_day_id)
    {
        $this->league_day_id = $league_day_id;
    
        return $this;
    }

    /**
     * Get league_day_id
     *
     * @return integer 
     */
    public function getLeagueDayId()
    {
        return $this->league_day_id;
    }

    /**
     * Set account_id
     *
     * @param integer $accountId
     * @return History
     */
    public function setAccountId($accountId)
    {
        $this->account_id = $accountId;
    
        return $this;
    }

    /**
     * Get account_id
     *
     * @return integer 
     */
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return History
     */
    public function setPoints($points)
    {
        $this->points = $points;
    
        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }
    
	/**
     * Set totalPoints
     *
     * @param integer $totalPoints
     */
    public function setTotalPoints($totalPoints)
    {
        $this->totalPoints = $totalPoints;
    
        return $this;
    }

    /**
     * Get totalPoints
     *
     * @return totalPoints 
     */
    public function getTotalPoints()
    {
        return $this->totalPoints;
    }
    
	/**
     * Set totalPoints
     *
     * @param integer $totalPoints
     */
    public function setHasBonus($hasBonus)
    {
        $this->has_bonus = $hasBonus;
    
        return $this;
    }

    /**
     * Get totalPoints
     *
     * @return totalPoints 
     */
    public function getHasBonus()
    {
        return $this->has_bonus;
    }
    
	/**
     * Set totalPoints
     *
     * @param integer $totalPoints
     */
    public function setScores($scores)
    {
        $this->scores = $scores;
    
        return $this;
    }

    /**
     * Get totalPoints
     *
     * @return totalPoints 
     */
    public function getScores()
    {
        return $this->scores;
    }
    
	/**
     * Set totalPoints
     *
     * @param integer $totalPoints
     */
    public function setResults($results)
    {
        $this->results = $results;
    
        return $this;
    }

    /**
     * Get totalPoints
     *
     * @return totalPoints 
     */
    public function getResults()
    {
        return $this->results;
    }
    
    /**
     * Set rank
     *
     * @param integer $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    
        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }
    
	/**
     * Set voted
     *
     * @param boolean $voted
     */
    public function setVoted($voted)
    {
        $this->voted = $voted;
    
        return $this;
    }

    /**
     * Get voted
     *
     * @return voted 
     */
    public function getVoted()
    {
        return $this->voted;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     */
    public function setSeason($season)
    {
        $this->season = $season;
    
        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getSeason()
    {
        return $this->season;
    }
    

}
