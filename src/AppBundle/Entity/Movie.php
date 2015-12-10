<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $directeur;

    /**
     * @ORM\Column(type="string")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $evaluations;


    public function __construct()
    {
        $this->publishedAt = new \DateTime();
        $this->stars = new ArrayCollection();
    }

    // getters and setters ...

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
     * Set title
     *
     * @param string $title
     *
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set directeur
     *
     * @param string $directeur
     *
     * @return Movie
     */
    public function setDirecteur($directeur)
    {
        $this->directeur = $directeur;

        return $this;
    }

    /**
     * Get directeur
     *
     * @return string
     */
    public function getDirecteur()
    {
        return $this->directeur;
    }

    /**
     * Set year
     *
     * @param string $year
     *
     * @return Movie
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set evaluations
     *
     * @param integer $evaluations
     *
     * @return Movie
     */
    public function setEvaluations($evaluations)
    {
        $this->evaluations = $evaluations;

        return $this;
    }

    /**
     * Get evaluations
     *
     * @return integer
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }
}
