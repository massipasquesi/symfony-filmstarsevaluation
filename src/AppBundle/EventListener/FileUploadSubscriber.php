<?php

namespace AppBundle\EventListener;

// for Doctrine < 2.4 :
// use Doctrine\ORM\Event\LifecycleEventArgs;
// for Doctrine >= 2.4 :
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use AppBundle\Entity\Avatar;

class FileUploadSubscriber extends AbstractSubscriberManager
{
    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate',
            'postPersist',
            'postUpdate',
        );
    }

    public function getEntitiesToListen()
    {
        return array(
            'AppBundle\Entity\Avatar'
        );
    }

    protected function callHandlerMethod($event)
    {
        switch ($event) {
            case 'prePersist':
            case 'preUpdate':
                $this->preUpload();
                break;
            case 'postPersist':
            case 'postUpdate':
                $this->upload();
                break;
            case 'postRemove':
                $this->removeUpload();
                break;
            default:
                return;
        }
    }

    /**
     * [preUpload description]
     * @return [type] [description]
     */
    public function preUpload()
    {
        $entity = $this->entity;

        if (null !== $entity->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $entity->setPath($filename . '.' . $entity->getFile()->guessExtension());
        }
    }

    /**
     * [upload description]
     * @return [type] [description]
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->entity->getFile()) {
            return;
        }

        $entity = $this->entity;

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $entity->getFile()->move(
            $entity->getUploadRootDir(),
            $entity->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $entity->path = $entity->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $entity->setFile(null);
    }

    public function removeUpload()
    {
        $file = $this->entity->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }
}
