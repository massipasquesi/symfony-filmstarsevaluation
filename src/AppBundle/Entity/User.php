<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class User extends BaseUSer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @Vich\UploadableField(mapping="avatar", fileNameProperty="avatarName")
     * @var File
     */
    private $avatarFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $avatarName;

    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateCreation;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Evaluation", mappedBy="user", cascade={"persist"})
     */
    private $evaluations;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserChoiceCategory", mappedBy="user", cascade={"persist"})
     */
    private $categoriesChoices;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgeRange")
    */
    private $ageRange;


    public function __construct()
    {
        if(empty($this->dateCreation)) {
            $this->dateCreation = new \DateTime();
        }
            
        $this->updatedAt = new \DateTime();
        $this->isActive = true;
        $this->evaluations = new ArrayCollection();
        $this->categories = new ArrayCollection();

        parent::__construct();
    }

     /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setAvatarFile(File $avatar = null)
    {
        $this->avatarFile = $avatar;

        if ($avatar) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }



    /**
     * Set avatarName
     *
     * @param string $avatarName
     *
     * @return User
     */
    public function setAvatarName($avatarName)
    {
        $this->avatarName = $avatarName;

        return $this;
    }

    /**
     * Get avatarName
     *
     * @return string
     */
    public function getAvatarName()
    {
        return $this->avatarName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return User
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add evaluation
     *
     * @param \AppBundle\Entity\Evaluation $evaluation
     *
     * @return User
     */
    public function addEvaluation(\AppBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations[] = $evaluation;

        return $this;
    }

    /**
     * Remove evaluation
     *
     * @param \AppBundle\Entity\Evaluation $evaluation
     */
    public function removeEvaluation(\AppBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations->removeElement($evaluation);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }

    /**
     * Add categoriesChoice
     *
     * @param \AppBundle\Entity\UserChoiceCategory $categoriesChoice
     *
     * @return User
     */
    public function addCategoriesChoice(\AppBundle\Entity\UserChoiceCategory $categoriesChoice)
    {
        $this->categoriesChoices[] = $categoriesChoice;

        return $this;
    }

    /**
     * Remove categoriesChoice
     *
     * @param \AppBundle\Entity\UserChoiceCategory $categoriesChoice
     */
    public function removeCategoriesChoice(\AppBundle\Entity\UserChoiceCategory $categoriesChoice)
    {
        $this->categoriesChoices->removeElement($categoriesChoice);
    }

    /**
     * Get categoriesChoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoriesChoices()
    {
        return $this->categoriesChoices;
    }

    /**
     * Set ageRange
     *
     * @param \AppBundle\Entity\AgeRange $ageRange
     *
     * @return User
     */
    public function setAgeRange(\AppBundle\Entity\AgeRange $ageRange = null)
    {
        $this->ageRange = $ageRange;

        return $this;
    }

    /**
     * Get ageRange
     *
     * @return \AppBundle\Entity\AgeRange
     */
    public function getAgeRange()
    {
        return $this->ageRange;
    }
}
