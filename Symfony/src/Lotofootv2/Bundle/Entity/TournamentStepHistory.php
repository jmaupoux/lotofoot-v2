<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table(name="lfv2_tournament_history")
 * @ORM\Entity
 */
class TournamentStepHistory
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
     * @ORM\Column(name="account_id", type="integer")
     */
    private $account_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="pointsA", type="integer")
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
     * Set tour_step_id
     *
     * @param integer $tour_step_id
     * @return History
     */
    public function setTourStepId($tour_step_id)
    {
        $this->tour_step_id = $tour_step_id;
    
        return $this;
    }

    /**
     * Get tour_step_id
     *
     * @return integer 
     */
    public function getTourStepId()
    {
        return $this->tour_step_id;
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
