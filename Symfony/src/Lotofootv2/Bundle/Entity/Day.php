<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Day
 *
 * @ORM\Table(name="lfv2_day")
 * @ORM\Entity
 */
class Day
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
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var integer
     *
     * @ORM\Column(name="season_id", type="integer")
     */
    private $season_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="datetime")
     */
    private $deadline;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="corrected", type="boolean")
     */
    private $corrected;


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
     * Set number
     *
     * @param integer $number
     * @return Day
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set season_id
     *
     * @param integer $seasonId
     * @return Day
     */
    public function setSeasonId($seasonId)
    {
        $this->season_id = $seasonId;
    
        return $this;
    }

    /**
     * Get season_id
     *
     * @return integer 
     */
    public function getSeasonId()
    {
        return $this->season_id;
    }

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
     * @return Day
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    
        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime 
     */
    public function getDeadline()
    {
        return $this->deadline;
    }
    
    /**     
     */
    public function setCorrected($corrected)
    {
    	$this->corrected = $corrected;
    
    	return $this;
    }
    
    /**
     * Get deadline
     *
     * @return \DateTime
     */
    public function getCorrected()
    {
    	return $this->corrected;
    }
}
