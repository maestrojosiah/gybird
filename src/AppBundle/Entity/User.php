<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="GB_car", mappedBy="user")
     */
    private $cars;

    /**
     * @ORM\OneToMany(targetEntity="GB_presentation", mappedBy="user")
     */
    private $presentations;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add car
     *
     * @param \AppBundle\Entity\GB_car $car
     *
     * @return User
     */
    public function addCar(\AppBundle\Entity\GB_car $car)
    {
        $this->cars[] = $car;

        return $this;
    }

    /**
     * Remove car
     *
     * @param \AppBundle\Entity\GB_car $car
     */
    public function removeCar(\AppBundle\Entity\GB_car $car)
    {
        $this->cars->removeElement($car);
    }

    /**
     * Get cars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCars()
    {
        return $this->cars;
    }

    /**
     * Add presentation
     *
     * @param \AppBundle\Entity\GB_presentation $presentation
     *
     * @return User
     */
    public function addPresentation(\AppBundle\Entity\GB_presentation $presentation)
    {
        $this->presentations[] = $presentation;

        return $this;
    }

    /**
     * Remove presentation
     *
     * @param \AppBundle\Entity\GB_presentation $presentation
     */
    public function removePresentation(\AppBundle\Entity\GB_presentation $presentation)
    {
        $this->presentations->removeElement($presentation);
    }

    /**
     * Get presentations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPresentations()
    {
        return $this->presentations;
    }
}
