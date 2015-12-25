<?php

namespace AppBundle\EventListener;

// for Doctrine < 2.4 :
// use Doctrine\ORM\Event\LifecycleEventArgs;
// for Doctrine >= 2.4 :
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use AppBundle\Exception\EventListenerException as Exception;

abstract class AbstractSubscriberManager implements EventSubscriber
{
    abstract public function getSubscribedEvents();
    abstract public function getEntitiesToListen();
    abstract protected function callHandlerMethod($event);

    public function checkEntity()
    {
        $entity_class = get_class($this->entity);

        if (in_array($entity_class, $this->getEntitiesToListen())) {
            return true;
        }

        return false;
    }

    protected function handleEvent(LifecycleEventArgs $args, $event)
    {
        $this->entity = $args->getEntity();

        if ($this->checkEntity() !== true) {
            return;
        }

        $this->em = $args->getEntityManager();

        $this->callHandlerMethod($event);
    }

    public function __call($name, array $arguments)
    {
        if (in_array($name, $this->getSubscribedEvents())) {
            if (! $arguments[0] instanceof LifecycleEventArgs) {
                $e_msg = Exception::badClassEventParameterMsg(array($name, $arguments[0]));
                throw new Exception($e_msg);
            }

            $this->handleEvent($arguments[0], $name);
        }
    }

    // public function preUpdate(LifecycleEventArgs $args)
    // {
    //     $this->handleEvent($args, __METHOD__);
    // }

    // public function prePersist(LifecycleEventArgs $args)
    // {
    //     $this->handleEvent($args, __METHOD__);
    // }

    // public function postUpdate(LifecycleEventArgs $args)
    // {
    //     $this->handleEvent($args, __METHOD__);
    // }

    // public function postPersist(LifecycleEventArgs $args)
    // {
    //     $this->handleEvent($args, __METHOD__);
    // }

    // public function postRemove(LifecycleEventArgs $args)
    // {
    //     $this->handleEvent($args, __METHOD__);
    // }
}
