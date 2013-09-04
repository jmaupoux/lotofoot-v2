<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table(name="lfv2_history")
 * @ORM\Entity
 */
class History
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
     * @ORM\Column(name="seasonNumber", type="integer")
     */
    private $seasonNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="dayNumber", type="integer")
     */
    private $dayNumber;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set seasonNumber
     *
     * @param integer $seasonNumber
     * @return History
     */
    public function setSeasonNumber($seasonNumber)
    {
        $this->seasonNumber = $seasonNumber;
    
        return $this;
    }

    /**
     * Get seasonNumber
     *
     * @return integer 
     */
    public function getSeasonNumber()
    {
        return $this->seasonNumber;
    }

    /**
     * Set dayNumber
     *
     * @param integer $dayNumber
     * @return History
     */
    public function setDayNumber($dayNumber)
    {
        $this->dayNumber = $dayNumber;
    
        return $this;
    }

    /**
     * Get dayNumber
     *
     * @return integer 
     */
    public function getDayNumber()
    {
        return $this->dayNumber;
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
}
