<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class User
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
    private $avatar;

    /**
     * @ORM\Column(type="string")
     */
    private $first_name;

    /**
     * @ORM\Column(type="string")
     */
    private $family_name;

    /**
     * @ORM\Column(type="string")
     */
    private $nick_name;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

     /**
     * @ORM\Column(type="datetime")
     */
    private $date_inscription;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Movie",
     *      mappedBy="post",
     *      orphanRemoval=true
     * )
     * @ORM\OrderBy({"publishedAt" = "ASC"})
     */
    private $movies;

    public function __construct()
    {
        $this->publishedAt = new \DateTime();
        $this->movies = new ArrayCollection();
    }

    // getters and setters ...
}