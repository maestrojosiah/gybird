<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GB_make
 *
 * @ORM\Table(name="g_b_make")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GB_makeRepository")
 */
class GB_make
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
     * @ORM\Column(name="m_name", type="string", length=255)
     */
    private $mName;

    /**
     * @ORM\OneToMany(targetEntity="GB_model", mappedBy="make")
     */
    private $models;    

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
     * Set mName
     *
     * @param string $mName
     *
     * @return GB_make
     */
    public function setMName($mName)
    {
        $this->mName = $mName;

        return $this;
    }

    /**
     * Get mName
     *
     * @return string
     */
    public function getMName()
    {
        return $this->mName;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->models = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->mName;
    }

    /**
     * Add model
     *
     * @param \AppBundle\Entity\GB_model $model
     *
     * @return GB_make
     */
    public function addModel(\AppBundle\Entity\GB_model $model)
    {
        $this->models[] = $model;

        return $this;
    }

    /**
     * Remove model
     *
     * @param \AppBundle\Entity\GB_model $model
     */
    public function removeModel(\AppBundle\Entity\GB_model $model)
    {
        $this->models->removeElement($model);
    }

    /**
     * Get models
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModels()
    {
        return $this->models;
    }
}
