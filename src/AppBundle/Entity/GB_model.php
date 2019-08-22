<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GB_model
 *
 * @ORM\Table(name="g_b_model")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GB_modelRepository")
 */
class GB_model
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="md_name", type="string", length=255)
     */
    private $mdName;

    /**
     * @ORM\ManyToOne(targetEntity="GB_make", inversedBy="models")
     * @ORM\JoinColumn(name="make_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $make;

    public function __toString()
    {
        return $this->mdName;
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mdName
     *
     * @param string $mdName
     *
     * @return GB_model
     */
    public function setMdName($mdName)
    {
        $this->mdName = $mdName;

        return $this;
    }

    /**
     * Get mdName
     *
     * @return string
     */
    public function getMdName()
    {
        return $this->mdName;
    }

    /**
     * Set make
     *
     * @param \AppBundle\Entity\GB_make $make
     *
     * @return GB_model
     */
    public function setMake(\AppBundle\Entity\GB_make $make = null)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make
     *
     * @return \AppBundle\Entity\GB_make
     */
    public function getMake()
    {
        return $this->make;
    }
}
