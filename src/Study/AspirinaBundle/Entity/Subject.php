<?php

namespace Study\AspirinaBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 *
 * @Gedmo\Loggable
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Study\AspirinaBundle\Entity\SubjectRepository")
 */
class Subject
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
     * @Gedmo\Versioned
     * @ORM\Column(name="initial", type="string", length=3)
     */
    private $initial;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="sites")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     */
    private $site;


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
     * Set initial
     *
     * @param string $initial
     * @return Subject
     */
    public function setInitial($initial)
    {
        $this->initial = $initial;
    
        return $this;
    }

    /**
     * Get initial
     *
     * @return string 
     */
    public function getInitial()
    {
        return $this->initial;
    }

    /**
     * Set site
     *
     * @param integer $site
     * @return Subject
     */
    public function setSite($site)
    {
        $this->site = $site;
    
        return $this;
    }

    /**
     * Get site
     *
     * @return integer 
     */
    public function getSite()
    {
        return $this->site;
    }
}
