<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * GB_car
 *
 * @ORM\Table(name="g_b_car")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GB_carRepository")
 */
class GB_car
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
     * @ORM\Column(name="c_make", type="string", length=255)
     */
    private $cMake;

    /**
     * @var string
     *
     * @ORM\Column(name="c_model", type="string", length=255)
     */
    private $cModel;

    /**
     * @var string
     *
     * @ORM\Column(name="c_steering", type="string", length=255)
     */
    private $cSteering;

    /**
     * @var string
     *
     * @ORM\Column(name="c_eng_cap", type="string", length=255)
     */
    private $cEngCap;

    /**
     * @var string
     *
     * @ORM\Column(name="c_reg_year", type="string", length=255)
     */
    private $cRegYear;

    /**
     * @var string
     *
     * @ORM\Column(name="c_price", type="string", length=255)
     */
    private $cPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="c_fuel", type="string", length=255)
     */
    private $cFuel;

    /**
     * @var string
     *
     * @ORM\Column(name="c_body_style", type="string", length=255)
     */
    private $cBodyStyle;

    /**
     * @var string
     *
     * @ORM\Column(name="c_ext_color", type="string", length=255)
     */
    private $cExtColor;

    /**
     * @var string
     *
     * @ORM\Column(name="c_int_color", type="string", length=255)
     */
    private $cIntColor;

    /**
     * @var string
     *
     * @ORM\Column(name="c_drive_type", type="string", length=255)
     */
    private $cDriveType;

    /**
     * @var string
     *
     * @ORM\Column(name="c_doors", type="string", length=255)
     */
    private $cDoors;

    /**
     * @var string
     *
     * @ORM\Column(name="c_vin", type="string", length=255)
     */
    private $cVin;

    /**
     * @var string
     *
     * @ORM\Column(name="c_model_code", type="string", length=255)
     */
    private $cModelCode;

    /**
     * @var string
     *
     * @ORM\Column(name="c_mileage", type="string", length=255)
     */
    private $cMileage;

    /**
     * @var string
     *
     * @ORM\Column(name="c_trans", type="string", length=255)
     */
    private $cTrans;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product image as a png or jpg image.")
     * @Assert\File(mimeTypes={ "image/png", "image/jpg", "image/jpeg" })
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="availability", type="string", length=255)
     */
    private $availability;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uploaded", type="datetime")
     */
    private $uploaded;

    /**
     * @var string
     *
     * @ORM\Column(name="deleted", type="string", length=255)
     */
    private $deleted;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="cars")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;


    /**
     * @ORM\OneToMany(targetEntity="GB_presentation", mappedBy="car")
     */
    private $presentations;

    /**
     * @ORM\OneToMany(targetEntity="GB_testimonial", mappedBy="car")
     */
    private $testimonials;


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
     * Set cMake
     *
     * @param string $cMake
     *
     * @return GB_car
     */
    public function setCMake($cMake)
    {
        $this->cMake = $cMake;

        return $this;
    }

    /**
     * Get cMake
     *
     * @return string
     */
    public function getCMake()
    {
        return $this->cMake;
    }

    /**
     * Set cModel
     *
     * @param string $cModel
     *
     * @return GB_car
     */
    public function setCModel($cModel)
    {
        $this->cModel = $cModel;

        return $this;
    }

    /**
     * Get cModel
     *
     * @return string
     */
    public function getCModel()
    {
        return $this->cModel;
    }

    /**
     * Set cSteering
     *
     * @param string $cSteering
     *
     * @return GB_car
     */
    public function setCSteering($cSteering)
    {
        $this->cSteering = $cSteering;

        return $this;
    }

    /**
     * Get cSteering
     *
     * @return string
     */
    public function getCSteering()
    {
        return $this->cSteering;
    }

    /**
     * Set cEngCap
     *
     * @param string $cEngCap
     *
     * @return GB_car
     */
    public function setCEngCap($cEngCap)
    {
        $this->cEngCap = $cEngCap;

        return $this;
    }

    /**
     * Get cEngCap
     *
     * @return string
     */
    public function getCEngCap()
    {
        return $this->cEngCap;
    }

    /**
     * Set cRegYear
     *
     * @param string $cRegYear
     *
     * @return GB_car
     */
    public function setCRegYear($cRegYear)
    {
        $this->cRegYear = $cRegYear;

        return $this;
    }

    /**
     * Get cRegYear
     *
     * @return string
     */
    public function getCRegYear()
    {
        return $this->cRegYear;
    }

    /**
     * Set cPrice
     *
     * @param string $cPrice
     *
     * @return GB_car
     */
    public function setCPrice($cPrice)
    {
        $this->cPrice = $cPrice;

        return $this;
    }

    /**
     * Get cPrice
     *
     * @return string
     */
    public function getCPrice()
    {
        return $this->cPrice;
    }

    /**
     * Set cFuel
     *
     * @param string $cFuel
     *
     * @return GB_car
     */
    public function setCFuel($cFuel)
    {
        $this->cFuel = $cFuel;

        return $this;
    }

    /**
     * Get cFuel
     *
     * @return string
     */
    public function getCFuel()
    {
        return $this->cFuel;
    }

    /**
     * Set cBodyStyle
     *
     * @param string $cBodyStyle
     *
     * @return GB_car
     */
    public function setCBodyStyle($cBodyStyle)
    {
        $this->cBodyStyle = $cBodyStyle;

        return $this;
    }

    /**
     * Get cBodyStyle
     *
     * @return string
     */
    public function getCBodyStyle()
    {
        return $this->cBodyStyle;
    }

    /**
     * Set cExtColor
     *
     * @param string $cExtColor
     *
     * @return GB_car
     */
    public function setCExtColor($cExtColor)
    {
        $this->cExtColor = $cExtColor;

        return $this;
    }

    /**
     * Get cExtColor
     *
     * @return string
     */
    public function getCExtColor()
    {
        return $this->cExtColor;
    }

    /**
     * Set cIntColor
     *
     * @param string $cIntColor
     *
     * @return GB_car
     */
    public function setCIntColor($cIntColor)
    {
        $this->cIntColor = $cIntColor;

        return $this;
    }

    /**
     * Get cIntColor
     *
     * @return string
     */
    public function getCIntColor()
    {
        return $this->cIntColor;
    }

    /**
     * Set cDriveType
     *
     * @param string $cDriveType
     *
     * @return GB_car
     */
    public function setCDriveType($cDriveType)
    {
        $this->cDriveType = $cDriveType;

        return $this;
    }

    /**
     * Get cDriveType
     *
     * @return string
     */
    public function getCDriveType()
    {
        return $this->cDriveType;
    }

    /**
     * Set cDoors
     *
     * @param string $cDoors
     *
     * @return GB_car
     */
    public function setCDoors($cDoors)
    {
        $this->cDoors = $cDoors;

        return $this;
    }

    /**
     * Get cDoors
     *
     * @return string
     */
    public function getCDoors()
    {
        return $this->cDoors;
    }

    /**
     * Set cVin
     *
     * @param string $cVin
     *
     * @return GB_car
     */
    public function setCVin($cVin)
    {
        $this->cVin = $cVin;

        return $this;
    }

    /**
     * Get cVin
     *
     * @return string
     */
    public function getCVin()
    {
        return $this->cVin;
    }

    /**
     * Set cModelCode
     *
     * @param string $cModelCode
     *
     * @return GB_car
     */
    public function setCModelCode($cModelCode)
    {
        $this->cModelCode = $cModelCode;

        return $this;
    }

    /**
     * Get cModelCode
     *
     * @return string
     */
    public function getCModelCode()
    {
        return $this->cModelCode;
    }

    /**
     * Set cMileage
     *
     * @param string $cMileage
     *
     * @return GB_car
     */
    public function setCMileage($cMileage)
    {
        $this->cMileage = $cMileage;

        return $this;
    }

    /**
     * Get cMileage
     *
     * @return string
     */
    public function getCMileage()
    {
        return $this->cMileage;
    }

    /**
     * Set cTrans
     *
     * @param string $cTrans
     *
     * @return GB_car
     */
    public function setCTrans($cTrans)
    {
        $this->cTrans = $cTrans;

        return $this;
    }

    /**
     * Get cTrans
     *
     * @return string
     */
    public function getCTrans()
    {
        return $this->cTrans;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return GB_car
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set availability
     *
     * @param string $availability
     *
     * @return GB_car
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return string
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set uploaded
     *
     * @param \DateTime $uploaded
     *
     * @return GB_car
     */
    public function setUploaded($uploaded)
    {
        $this->uploaded = $uploaded;

        return $this;
    }

    /**
     * Get uploaded
     *
     * @return \DateTime
     */
    public function getUploaded()
    {
        return $this->uploaded;
    }

    /**
     * Set deleted
     *
     * @param string $deleted
     *
     * @return GB_car
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return string
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return GB_car
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->presentations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add presentation
     *
     * @param \AppBundle\Entity\GB_presentation $presentation
     *
     * @return GB_car
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

    /**
     * Add testimonial
     *
     * @param \AppBundle\Entity\GB_testimonial $testimonial
     *
     * @return GB_car
     */
    public function addTestimonial(\AppBundle\Entity\GB_testimonial $testimonial)
    {
        $this->testimonials[] = $testimonial;

        return $this;
    }

    /**
     * Remove testimonial
     *
     * @param \AppBundle\Entity\GB_testimonial $testimonial
     */
    public function removeTestimonial(\AppBundle\Entity\GB_testimonial $testimonial)
    {
        $this->testimonials->removeElement($testimonial);
    }

    /**
     * Get testimonials
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTestimonials()
    {
        return $this->testimonials;
    }
}
