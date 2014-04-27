<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="lfv2_cup_vote")
 * @ORM\Entity
 */
class CupVote
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
     * @ORM\Column(name="account_id", type="integer")
     */
    private $account_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="league_match_id", type="integer")
     */
    private $cup_match_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

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
     * @var string
     *
     * @ORM\Column(name="points", type="integer", nullable=true)
     */
    private $points;
    
    /**
     * @var string
     *
     * @ORM\Column(name="resultOk", type="boolean", nullable=true)
     */
    private $resultOk;
    
    /**
     * @var string
     *
     * @ORM\Column(name="scoreOk", type="boolean", nullable=true)
     */
    private $scoreOk;


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
     * Set league_match_id
     *
     * @param integer $matchId
     * @return Vote
     */
    public function setCupMatchId($matchId)
    {
        $this->cup_match_id = $matchId;
    
        return $this;
    }

    /**
     * Get league_match_id
     *
     * @return integer 
     */
    public function getCupMatchId()
    {
        return $this->cup_match_id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Vote
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set score
     *
     * @param string $score
     * @return Vote
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
     * @return Vote
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
     * @return Vote
     */
    public function setPoints($points)
    {
        $this->points = $points;
    
        return $this;
    }

    /**
     * Get result
     *
     * @return string 
     */
    public function getPoints()
    {
        return $this->points;
    }
    
    /**
     * @return Vote
     */
    public function setResultOk($b)
    {
        $this->resultOk = $b;
    
        return $this;
    }

    /**
     * Get result
     *
     * @return string 
     */
    public function getResultOk()
    {
        return $this->resultOk;
    }
    
/**
     * @return Vote
     */
    public function setScoreOk($b)
    {
        $this->scoreOk = $b;
    
        return $this;
    }

    /**
     * Get result
     *
     * @return string 
     */
    public function getScoreOk()
    {
        return $this->scoreOk;
    }
}
