<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matchh
 *
 * @ORM\Table(name="lfv2_cup_match")
 * @ORM\Entity
 */
class CupMatch
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
     * @ORM\Column(name="cup_id", type="integer")
     */
    private $cup_id;

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
     * @var integer
     *
     * @ORM\Column(name="factor", type="integer")
     */
    private $factor;
    
    /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=3, nullable=true)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="result", type="string", length=1, nullable=true)
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
     * Set league_day_id
     *
     * @param integer $dayId
     * @return Matchh
     */
    public function setCupId($dayId)
    {
        $this->cup_id = $dayId;
    
        return $this;
    }

    /**
     * Get league_day_id
     *
     * @return integer 
     */
    public function getCupId()
    {
        return $this->cup_id;
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
    public function setFactor($factor)
    {
        $this->factor = $factor;
    
        return $this;
    }

    /**
     * Get team_visitor
     *
     * @return string 
     */
    public function getFactor()
    {
        return $this->factor;
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
    
    /**
     * Set $deadline
     *
     * @param string $deadline
     * @return $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    
        return $this;
    }

    /**
     * Get deadline
     *
     * @return string 
     */
    public function getDeadline()
    {
        return $this->deadline;
    }
    
    /**
     * Set $corrected
     *
     * @param string $corrected
     * @return $corrected
     */
    public function setCorrected($corrected)
    {
        $this->corrected = $corrected;
    
        return $this;
    }

    /**
     * Get corrected
     *
     * @return string 
     */
    public function getCorrected()
    {
        return $this->corrected;
    }
}
