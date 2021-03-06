<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LeagueDay
 *
 * @ORM\Table(name="lfv2_league_day")
 * @ORM\Entity
 */
class LeagueDay
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
     * @ORM\Column(name="league_id", type="integer")
     */
    private $league_id;

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
     * @var boolean
     *
     * @ORM\Column(name="word", type="string", length=1024, nullable=true)
     */
    private $word;
    /**
     * @var boolean
     *
     * @ORM\Column(name="king_tag", type="string", length=255, nullable=true)
     */
    private $king_tag;

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
     * Set league_id
     *
     * @param integer $leagueId
     */
    public function setLeagueId($leagueId)
    {
        $this->league_id = $leagueId;
    
        return $this;
    }

    /**
     * Get league_id
     *
     * @return integer 
     */
    public function getLeagueId()
    {
        return $this->league_id;
    }

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
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
    
	/**     
     */
    public function setWord($word)
    {
    	$this->word = $word;
    
    	return $this;
    }
    
    /**
     * Get deadline
     *
     * @return String
     */
    public function getWord()
    {
    	return $this->word;
    }
    /**
     */
    public function setKingTag($king_tag)
    {
    $this->king_tag = $king_tag;
    
    return $this;
    }
    
    /**
    * Get deadline
    *
    * @return String
     */
    public function getKingTag()
    {
    return $this->king_tag;
    }
}
