<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Avatar
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    /**
     * [getAbsolutePath description]
     * @return [type] [description]
     */
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    /**
     * [getWebPath description]
     * @return [type] [description]
     */
    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    /**
     * [getUploadRootDir description]
     * @return [type] [description]
     */
    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
exit(var_dump( $this->get('kernel')->getRootDir() ));
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    /**
     * [getUploadDir description]
     * @return [type] [description]
     */
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/avatars';
    }
}
