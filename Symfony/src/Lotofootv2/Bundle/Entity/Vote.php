<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="lfv2_vote")
 * @ORM\Entity
 */
class Vote
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
     * @ORM\Column(name="day_id", type="integer")
     */
    private $day_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer")
     */
    private $account_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="match_id", type="integer")
     */
    private $match_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

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
     * Set day_id
     *
     * @param integer $dayId
     * @return Vote
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
     * Set match_id
     *
     * @param integer $matchId
     * @return Vote
     */
    public function setMatchId($matchId)
    {
        $this->match_id = $matchId;
    
        return $this;
    }

    /**
     * Get match_id
     *
     * @return integer 
     */
    public function getMatchId()
    {
        return $this->match_id;
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
}
