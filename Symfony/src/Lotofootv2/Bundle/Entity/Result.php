<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Results
 *
 * @ORM\Table(name="lfv2_result")
 * @ORM\Entity
 */
class Result
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
     * @ORM\Column(name="matchh_id", type="integer")
     */
    private $matchh_id;

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
     * Set matchh_id
     *
     * @param integer $matchhId
     * @return Results
     */
    public function setMatchhId($matchhId)
    {
        $this->matchh_id = $matchhId;
    
        return $this;
    }

    /**
     * Get matchh_id
     *
     * @return integer 
     */
    public function getMatchhId()
    {
        return $this->matchh_id;
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
