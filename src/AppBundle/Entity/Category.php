<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Category
{
    /**
     * Number of items to show in a page list
     */
    const NUM_ITEMS = 10;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Movie", mappedBy="category")
     */
    private $movies;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="categories")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movies = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * @return string [description]
     */
    public function __toString()
    {
        return $this->name;
    }

    /*********************\
    |* GETTERS & SETTERS *|
    \*********************/

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
     * Add movie
     *
     * @param \AppBundle\Entity\Movie $movie
     *
     * @return Category
     */
    public function addMovie(\AppBundle\Entity\Movie $movie)
    {
        $this->movies[] = $movie;

        // On lie la Category au Movie
        $movie->setCategory($this);

        return $this;
    }

    /**
     * Remove movie
     *
     * @param \AppBundle\Entity\Movie $movie
     */
    public function removeMovie(\AppBundle\Entity\Movie $movie)
    {
        /**
         * Commenter si la relation est facultative
         * Decommenter si la relation est obligatoire
         */
        // $this->movies->removeElement($movie);

        /**
         * Commenter si la relation est obligatoire
         * Decommenter si la relation est facultative
         */
        $movie->setCategory(null);
    }

    /**
     * Get movies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Category
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        // On lie la Category à User
        $user->setCategory($this);

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        /**
         * Commenter si la relation est facultative
         * Decommenter si la relation est obligatoire
         */
        //  $this->users->removeElement($user);

        /**
         * Commenter si la relation est obligatoire
         * Decommenter si la relation est facultative
         */
        $user->setCategory(null);

    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
