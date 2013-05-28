<?php

namespace Study\AspirinaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trail
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Study\AspirinaBundle\Entity\TrailRepository")
 */
class Trail
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
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="fields", type="text")
     */
    private $fields;


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
     * Set user
     *
     * @param integer $user
     * @return Trail
     */
    public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Trail
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
     * Set fields
     *
     * @param \stdClass $fields
     * @return Trail
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    
        return $this;
    }

    /**
     * Get fields
     *
     * @return \stdClass 
     */
    public function getFields()
    {
        return $this->fields;
    }
}
