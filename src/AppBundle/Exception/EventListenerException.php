<?php

namespace AppBundle\Exception;

class EventListenerException extends AppBundleException
{
    protected static $predifinedMessages = array(
        1 => 'badClassEventParameterMsg'
    );

    public static function getPredifinedMessages($key, $args = array())
    {
        $message_call = $this->predifinedMessages[$key];
        return $this->$message_call($args);
    }

    public static function badClassEventParameterMsg($args)
    {
        $event = $args[0];
        $parameter = $args[1];

        $msg = 'Event: ' . $event . ' called with bad arguments ! ';
        $msg .= 'Expect object of class LifecycleEventArgs . ';
        $msg .= (is_object($parameter))
            ? 'Object of class ' . get_class($args[1])
            : gettype($parameter);
        $msg .= ' given.';

        return $msg;
    }
}
