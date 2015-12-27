<?php

namespace AppBundle\EventListener;

/**
 * @author MaSsI00 <massipasquesi@gmail.com>
 *
 * @method void preUpdate(LifecycleEventArgs $args)
 * @method void prePersist(LifecycleEventArgs $args)
 * @method void postUpdate(LifecycleEventArgs $args)
 * @method void postPersist(LifecycleEventArgs $args)
 * @method void postRemove(LifecycleEventArgs $args)
 */
abstract class AbstractFileUploadSubscriber extends AbstractSubscriberManager
{
    public function __construct($root_dir)
    {
        $this->rootDir = $root_dir . '/../web';
    }

    /**
     * [getSubscribedEvents description]
     * @return [type] [description]
     */
    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate',
            'postPersist',
            'postUpdate',
        );
    }

    /**
     * [callHandlerMethod description]
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
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
            $this->setEntityPath();
            $this->setEntityName();
        }
    }

    /**
     * You can override this method to do
     * whatever you want to generate a unique file name
     * for PATH entity's property
     */
    protected function setEntityPath()
    {
        $entity = $this->entity;
        $filename = sha1(uniqid(mt_rand(), true));
        $entity->setPath($filename . '.' . $entity->getFile()->guessExtension());
    }

    /**
     * You can override this method to set whatever you want
     * for NAME entity's property
     */
    protected function setEntityName()
    {
        $entity = $this->entity;
        // set the name property to the filename where you've saved the file
        $entity->setName($entity->getFile()->getClientOriginalName());
    }

    /**
     * [upload description]
     * @return [type] [description]
     */
    public function upload()
    {
        $entity = $this->entity;

        // the file property can be empty if the field is not required
        if (null === $entity->getFile()) {
            return;
        }

        $this->processBeforeMove();

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $entity->getFile()->move($this->getUploadRootDir(), $entity->getPath());

        // check if we have an old image
        if (isset($entity->tempPath)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$entity->tempPath);
            // clear the temp image path
            $this->tempPath = null;
        }

        $entity->emptyFile();
    }

    /**
     * Override this method
     * to do some stuff before moving the file
     * @return [type] [description]
     */
    protected function processBeforeMove()
    {
        return;
    }

    /**
     * [removeUpload description]
     * @return [type] [description]
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    /**
     * [getAbsolutePath description]
     * @return [type] [description]
     */
    public function getAbsolutePath()
    {
        return null === $this->entity->path
            ? null
            : $this->getUploadRootDir() . '/' . $this->entity->path;
    }

    /**
     * [getWebPath description]
     * @return [type] [description]
     */
    public function getWebPath()
    {
        return null === $this->entity->path
            ? null
            : $this->getUploadDir() . '/' . $this->entity->path;
    }

    /**
     * [getUploadRootDir description]
     * @return [type] [description]
     */
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // avatars should be saved
        return $this->rootDir . '/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        if (!isset($this->uploadDir)) {
            $this->uploadDir = $this->entity->getUploadDir();
        }

        return $this->uploadDir;
    }
}
