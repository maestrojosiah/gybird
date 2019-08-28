<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GB_testimonial
 *
 * @ORM\Table(name="g_b_testimonial")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GB_testimonialRepository")
 */
class GB_testimonial
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
     * @ORM\Column(name="t_rating", type="string", length=255)
     */
    private $tRating;

    /**
     * @var string
     *
     * @ORM\Column(name="t_comment", type="string", length=255)
     */
    private $tComment;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="submitted", type="datetime")
     */
    private $submitted;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="testimonials")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="GB_car", inversedBy="testimonials")
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $car;

    


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
     * Set tRating
     *
     * @param string $tRating
     *
     * @return GB_testimonial
     */
    public function setTRating($tRating)
    {
        $this->tRating = $tRating;

        return $this;
    }

    /**
     * Get tRating
     *
     * @return string
     */
    public function getTRating()
    {
        return $this->tRating;
    }

    /**
     * Set tComment
     *
     * @param string $tComment
     *
     * @return GB_testimonial
     */
    public function setTComment($tComment)
    {
        $this->tComment = $tComment;

        return $this;
    }

    /**
     * Get tComment
     *
     * @return string
     */
    public function getTComment()
    {
        return $this->tComment;
    }

    /**
     * Set submitted
     *
     * @param \DateTime $submitted
     *
     * @return GB_testimonial
     */
    public function setSubmitted($submitted)
    {
        $this->submitted = $submitted;

        return $this;
    }

    /**
     * Get submitted
     *
     * @return \DateTime
     */
    public function getSubmitted()
    {
        return $this->submitted;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return GB_testimonial
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
     * Set car
     *
     * @param \AppBundle\Entity\GB_car $car
     *
     * @return GB_testimonial
     */
    public function setCar(\AppBundle\Entity\GB_car $car = null)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return \AppBundle\Entity\GB_car
     */
    public function getCar()
    {
        return $this->car;
    }
}
