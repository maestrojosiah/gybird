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
}