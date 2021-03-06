<?php

namespace Study\AspirinaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Site
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Study\AspirinaBundle\Entity\SiteRepository")
 */
class Site
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
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="investigator", type="string", length=255, nullable=true)
     */
    private $investigator;
    
    /**
     * @ORM\OneToMany(targetEntity="Subject", mappedBy="site")
     */
    protected $subjects;
    
    public function __construct()
    {
        $this->subjects = new ArrayCollection();
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
     * Set number
     *
     * @param integer $number
     * @return Site
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
     * Set name
     *
     * @param string $name
     * @return Site
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
     * Set investigator
     *
     * @param string $investigator
     * @return Site
     */
    public function setInvestigator($investigator)
    {
        $this->investigator = $investigator;
    
        return $this;
    }

    /**
     * Get investigator
     *
     * @return string 
     */
    public function getInvestigator()
    {
        return $this->investigator;
    }

    /**
     * Add subjects
     *
     * @param \Study\AspirinaBundle\Entity\Subject $subjects
     * @return Site
     */
    public function addSubject(\Study\AspirinaBundle\Entity\Subject $subjects)
    {
        $this->subjects[] = $subjects;
    
        return $this;
    }

    /**
     * Remove subjects
     *
     * @param \Study\AspirinaBundle\Entity\Subject $subjects
     */
    public function removeSubject(\Study\AspirinaBundle\Entity\Subject $subjects)
    {
        $this->subjects->removeElement($subjects);
    }

    /**
     * Get subjects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubjects()
    {
        return $this->subjects;
    }
}