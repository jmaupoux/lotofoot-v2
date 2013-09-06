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
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;


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
}
