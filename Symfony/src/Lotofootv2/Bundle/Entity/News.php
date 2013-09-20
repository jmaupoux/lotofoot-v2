<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="lfv2_news")
 * @ORM\Entity
 */
class News
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
     *
     * @ORM\Column(name="text", type="string", length=4096)
     */
    private $text;
    
    /**
     *
     * @ORM\Column(name="title", type="string", length=128)
     */
    private $title;
    
        
    /**
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;
    
    /**
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

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
     * Set text
     *
     * @param integer $text
     * @return Day
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return integer 
     */
    public function getText()
    {
        return $this->text;
    }
    
	/**
     * Set date
     *
     * @param integer $date
     * @return Day
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return integer 
     */
    public function getDate()
    {
        return $this->date;
    }
    
	/**
     * Set title
     *
     * @param integer $title
     * @return Day
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return integer 
     */
    public function getTitle()
    {
        return $this->title;
    }
    
	/**
     * Set title
     *
     * @param integer $title
     * @return Day
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }
}
