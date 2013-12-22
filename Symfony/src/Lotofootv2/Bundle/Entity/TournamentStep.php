<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament step :
 *
 * @ORM\Table(name="lfv2_tournament_step")
 * @ORM\Entity
 */
class TournamentStep
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
     * @ORM\Column(name="tour_id", type="integer")
     */
    private $tour_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=1)
     */
    private $state;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="datetime", nullable=true)
     */
    private $deadline;
    
    /**
     * @var string
     *
     * @ORM\Column(name="opened", type="boolean")
     */
    private $opened;

    public function __construct()
    {
    	$this->opened = true;
    	$this->state = "W";//A or R or W aller / retour / waiting
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
     * Set number
     *
     * @param integer $number
     * @return Season
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
     * Set number
     *
     * @param integer $number
     * @return Season
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set number
     *
     * @param integer $number
     * @return Season
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Season
     */
    public function setTourId($tour_id)
    {
        $this->tour_id = $tour_id;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getTourId()
    {
        return $this->tour_id;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Season
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }    
    
    /**
     * Set name
     *
     * @param string $name
     * @return Season
     */
    public function setOpened($state)
    {
    	$this->opened = $state;
    
    	return $this;
    }
    
    /**
     * Get name
     *
     * @return string
     */
    public function getOpened()
    {
    	return $this->opened;
    }
    
    public function __toString() {
    	return "TourStep : {$this->name}\n";
    }
}
