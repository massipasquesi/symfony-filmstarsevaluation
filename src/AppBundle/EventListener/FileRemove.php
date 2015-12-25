<?php

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Product;

class FileRemove
{
    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // only act on some "Product" entity
        if (!$entity instanceof Avatar) {
            return;
        }

        // Uncomment if you need entityManager
        // $entityManager = $args->getEntityManager();
        
        $this->removeUpload($entity);
    }

    protected function removeUpload($entity)
    {
        $file = $entity->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }
}
