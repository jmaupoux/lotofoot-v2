<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matchh
 *
 * @ORM\Table(name="lfv2_league_match")
 * @ORM\Entity
 */
class LeagueMatch
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
     * @ORM\Column(name="league_day_id", type="integer")
     */
    private $league_day_id;

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
     * @var boolean
     *
     * @ORM\Column(name="bonus", type="boolean")
     */
    private $bonus;
    
        /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=3)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="result", type="string", length=1)
     */
    private $result;


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
     * Set league_day_id
     *
     * @param integer $dayId
     * @return Matchh
     */
    public function setLeagueDayId($dayId)
    {
        $this->league_day_id = $dayId;
    
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
    
/**
     * Set team_visitor
     *
     * @param string $teamVisitor
     * @return Matchh
     */
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;
    
        return $this;
    }

    /**
     * Get team_visitor
     *
     * @return string 
     */
    public function getBonus()
    {
        return $this->bonus;
    }
    
    /**
     * Set score
     *
     * @param string $score
     * @return Results
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score
     *
     * @return string 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set result
     *
     * @param string $result
     * @return Results
     */
    public function setResult($result)
    {
        $this->result = $result;
    
        return $this;
    }

    /**
     * Get result
     *
     * @return string 
     */
    public function getResult()
    {
        return $this->result;
    }
}
