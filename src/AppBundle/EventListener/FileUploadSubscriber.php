<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Avatar;

/**
 * @author MaSsI00 <massipasquesi@gmail.com>
 */
class FileUploadSubscriber extends AbstractFileUploadSubscriber
{
    /**
     * @see \AppBundle\EventListener\AbstractSubscriberManager::getEntitiesToListen()
     */
    public function getEntitiesToListen()
    {
        return array(
            'AppBundle\Entity\Avatar'
        );
    }

    /**
     * [processBeforeMove description]
     * @return [type] [description]
     */
    protected function processBeforeMove()
    {
        if (!($this->entity instanceof Avatar)) {
            return;
        }
    }
}
