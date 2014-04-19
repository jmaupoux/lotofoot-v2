<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cup
 *
 * @ORM\Table(name="lfv2_cup")
 * @ORM\Entity
 */
class Cup
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    
    /**
     * @var string
     *
     * @ORM\Column(name="opened", type="boolean")
     */
    private $opened;

    public function __construct()
    {
    	$this->opened = true;
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
     * Set name
     *
     * @param string $name
     * @return Season
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
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
    	return "Cup : {$this->name}\n";
    }
}
