<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Avatar;

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
}
