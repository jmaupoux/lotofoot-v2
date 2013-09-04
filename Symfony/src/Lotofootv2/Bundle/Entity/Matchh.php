<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matchh
 *
 * @ORM\Table(name="lfv2_matchh")
 * @ORM\Entity
 */
class Matchh
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
     * @ORM\Column(name="day_id", type="integer")
     */
    private $day_id;

    /**
     * @var string
     *
     * @ORM\Column(name="team_home", type="string", length=255)
     */
    private $team_home;

    /**
     * @var string
     *
     * @ORM\Column(name="team_visitor", type="string", length=255)
     */
    private $team_visitor;


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
     * @return Matchh
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
     * Set day_id
     *
     * @param integer $dayId
     * @return Matchh
     */
    public function setDayId($dayId)
    {
        $this->day_id = $dayId;
    
        return $this;
    }

    /**
     * Get day_id
     *
     * @return integer 
     */
    public function getDayId()
    {
        return $this->day_id;
    }

    /**
     * Set team_home
     *
     * @param string $teamHome
     * @return Matchh
     */
    public function setTeamHome($teamHome)
    {
        $this->team_home = $teamHome;
    
        return $this;
    }

    /**
     * Get team_home
     *
     * @return string 
     */
    public function getTeamHome()
    {
        return $this->team_home;
    }

    /**
     * Set team_visitor
     *
     * @param string $teamVisitor
     * @return Matchh
     */
    public function setTeamVisitor($teamVisitor)
    {
        $this->team_visitor = $teamVisitor;
    
        return $this;
    }

    /**
     * Get team_visitor
     *
     * @return string 
     */
    public function getTeamVisitor()
    {
        return $this->team_visitor;
    }
}
