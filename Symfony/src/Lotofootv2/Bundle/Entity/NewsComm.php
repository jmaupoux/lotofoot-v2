<?php

namespace Lotofootv2\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="lfv2_news_comm")
 * @ORM\Entity
 */
class NewsComm
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
     * @ORM\Column(name="news_id", type="integer")
     */
    private $news_id;
    
    /**
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;
    
    /**
     *
     * @ORM\Column(name="author", type="string", length=128)
     */
    private $author;
  
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
     * Get id
     *
     * @return integer 
     */
    public function getNewsId()
    {
        return $this->news_id;
    }

    /**
     * Set text
     *
     * @param integer $text
     * @return Day
     */
    public function setNewsId($nid)
    {
        $this->news_id = $nid;
    
        return $this;
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
    public function setAuthor($author)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return integer 
     */
    public function getAuthor()
    {
        return $this->author;
    }
   
}
