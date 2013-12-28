<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament step :
 *
 * @ORM\Table(name="lfv2_tournament_player")
 * @ORM\Entity
 */
class TournamentPlayer
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
     * @ORM\Column(name="tour_step_id", type="integer")
     */
    private $tour_step_id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="tour_step_number", type="integer")
     */
    private $tour_step_number;
    
    /**
     * @var string
     *
     * @ORM\Column(name="account_id", type="integer")
     */
    private $account_id;

    /**
     * @var string
     *
     * @ORM\Column(name="group_number", type="integer")
     */
    private $group_number;
    
    /**
     * @var string
     *
     * @ORM\Column(name="group_position", type="integer")
     */
    private $group_position;

        /**
     * @var integer
     *
     * @ORM\Column(name="pointsA", type="integer", nullable = true)
     */
    private $pointsA;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="pointsR", type="integer", nullable = true)
     */
    private $pointsR;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="total_points", type="integer", nullable = true)
     */
    private $totalPoints;
    
    public function __construct()
    {

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


    public function setTourStepId($tour_step_id)
    {
        $this->tour_step_id = $tour_step_id;
    
        return $this;
    }
    
    public function getTourStepId()
    {
        return $this->tour_step_id;
    }
    
    /**
     * Set tour_step_id
     *
     * @param integer $tour_step_id
     * @return History
     */
    public function setTourStepNumber($tour_step_number)
    {
        $this->tour_step_number = $tour_step_number;
    
        return $this;
    }

    /**
     * Get tour_step_id
     *
     * @return integer 
     */
    public function getTourStepNumber()
    {
        return $this->tour_step_number;
    }

    /**
     * Set account_id
     *
     * @param integer $accountId
     * @return Vote
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
     * Set group_number
     *
     * @param integer groupNumber
     * @return Vote
     */
    public function setGroupNumber($groupNumber)
    {
        $this->group_number = $groupNumber;
    
        return $this;
    }

    /**
     * Get group_number
     *
     * @return integer 
     */
    public function getGroupNumber()
    {
        return $this->group_number;
    }
    
    /**
     * Set group_number
     *
     * @param integer groupNumber
     * @return Vote
     */
    public function setGroupPosition($groupNumber)
    {
        $this->group_position = $groupNumber;
    
        return $this;
    }

    /**
     * Get group_number
     *
     * @return integer 
     */
    public function getGroupPosition()
    {
        return $this->group_position;
    }
    
    /**
     * Set points
     *
     * @param integer $points
     * @return History
     */
    public function setPointsA($points)
    {
        $this->pointsA = $points;
    
        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPointsA()
    {
        return $this->pointsA;
    }
    
    /**
     * Set points
     *
     * @param integer $points
     * @return History
     */
    public function setPointsR($points)
    {
        $this->pointsR = $points;
    
        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPointsR()
    {
        return $this->pointsR;
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
}
