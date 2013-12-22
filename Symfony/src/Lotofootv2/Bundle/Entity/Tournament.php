<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament : 1v1
 *
 * @ORM\Table(name="lfv2_tournament")
 * @ORM\Entity
 */
class Tournament
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
     * @ORM\Column(name="type", type="string", length=8)
     */
    private $type;
    
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
     * Set type
     *
     * @param string $name
     * @return Season
     */
    public function setType($type)
    {
    	//CL or...
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
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
    	return "Tournoi : {$this->name}\n";
    }
}
