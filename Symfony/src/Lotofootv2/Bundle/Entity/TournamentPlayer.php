<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament step :
 *
 * @ORM\Table(name="lfv2_tournament_player")
 * @ORM\Entity
 */
class TournamentPlayer
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
     * @var string
     *
     * @ORM\Column(name="account_id", type="integer")
     */
    private $account_id;

    /**
     * @var string
     *
     * @ORM\Column(name="group_number", type="integer")
     */
    private $group_number;

    public function __construct()
    {

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


    public function setTourStepId($tour_step_id)
    {
        $this->tour_step_id = $tour_step_id;
    
        return $this;
    }
    
    public function getTourStepId()
    {
        return $this->tour_step_id;
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
     * Set group_number
     *
     * @param integer groupNumber
     * @return Vote
     */
    public function setGroupNumber($groupNumber)
    {
        $this->group_number = $groupNumber;
    
        return $this;
    }

    /**
     * Get group_number
     *
     * @return integer 
     */
    public function getGroupNumber()
    {
        return $this->group_number;
    }
}
