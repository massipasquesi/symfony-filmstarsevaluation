<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class AgeRange
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
    private $age;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="ageRange")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /*********************\
    |* GETTERS & SETTERS *|
    \*********************/


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
     * Set age
     *
     * @param string $age
     *
     * @return AgeRange
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return AgeRange
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        // On lie la 'Tranche d'Age' à l'Utilisateur
        $user->setAgeRange($this);

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
        //$this->users->removeElement($user);

        /**
         * Commenter si la relation est obligatoire
         * Decommenter si la relation est facultative
         */
        $user->setAgeRange(null);
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
