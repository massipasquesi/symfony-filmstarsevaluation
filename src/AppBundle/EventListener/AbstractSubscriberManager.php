<?php

namespace AppBundle\EventListener;

// for Doctrine < 2.4 :
// use Doctrine\ORM\Event\LifecycleEventArgs;
// for Doctrine >= 2.4 :
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use AppBundle\Exception\EventListenerException as Exception;

/**
 * @author PASQUESI Massimiliano <massipasquesi@gmail.com>
 */
abstract class AbstractSubscriberManager implements EventSubscriber
{
    /**
     * [getSubscribedEvents description]
     * @return [type] [description]
     */
    abstract public function getSubscribedEvents();
    /**
     * Return list of entities that have to listen to event
     * @return array : list of entities that have to listen to event
     */
    abstract public function getEntitiesToListen();
    /**
     * [callHandlerMethod description]
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    abstract protected function callHandlerMethod($event);

    /**
     * [checkEntity description]
     * @return [type] [description]
     */
    public function checkEntity()
    {
        $entity_class = get_class($this->entity);

        if (in_array($entity_class, $this->getEntitiesToListen())) {
            return true;
        }

        return false;
    }

    /**
     * [handleEvent description]
     * @param  LifecycleEventArgs $args
     * @param  string   $event : event name
     * @return void : $this->callHandlerMethod($event)
     */
    protected function handleEvent(LifecycleEventArgs $args, $event)
    {
        $this->entity = $args->getEntity();

        if ($this->checkEntity() !== true) {
            return;
        }

        $this->entityMnager = $args->getEntityManager();

        $this->callHandlerMethod($event);
    }

    /**
     * Here magic method __call is used in place of every event method
     * like : preUpdate, prePersist, etc...
     * @example : public function preUpdate(LifecycleEventArgs $args)
     *            {
     *                 $this->handleEvent($args, __METHOD__);
     *            }
     * @param  string $name : name of the called event function
     * @param  array  $arguments : function arguments
     * @throws EventListenerException if $arguments[0] is not instanceof LifecycleEventArgs
     * @return void : $this->handleEvent($args, __METHOD__)
     */
    public function __call($name, Array $arguments)
    {
        if (in_array($name, $this->getSubscribedEvents())) {
            if (! $arguments[0] instanceof LifecycleEventArgs) {
                $e_msg = Exception::badClassEventParameterMsg(array($name, $arguments[0]));
                throw new Exception($e_msg);
            }

            $this->handleEvent($arguments[0], $name);
        }
    }
}
