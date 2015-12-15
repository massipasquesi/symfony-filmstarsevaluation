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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserChoiceCategory", mappedBy="category", cascade={"persist"})
     */
    private $usersChoices;



    /*********************\
    |* GETTERS & SETTERS *|
    \*********************/

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usersChoices = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add usersChoice
     *
     * @param \AppBundle\Entity\UserChoiceCategory $usersChoice
     *
     * @return Category
     */
    public function addUsersChoice(\AppBundle\Entity\UserChoiceCategory $usersChoice)
    {
        $this->usersChoices[] = $usersChoice;

        return $this;
    }

    /**
     * Remove usersChoice
     *
     * @param \AppBundle\Entity\UserChoiceCategory $usersChoice
     */
    public function removeUsersChoice(\AppBundle\Entity\UserChoiceCategory $usersChoice)
    {
        $this->usersChoices->removeElement($usersChoice);
    }

    /**
     * Get usersChoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersChoices()
    {
        return $this->usersChoices;
    }
}
