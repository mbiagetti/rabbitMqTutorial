<?php

namespace Dnsee\TutorialBundle\ServerRpc;


use PhpAmqpLib\Message\AMQPMessage;

class DummyServer
{

    public function execute(AMQPMessage $msg)
    {
        $message = unserialize($msg->body);
        $delay = $message['delay'];

        sleep($delay);

        $return = array('value'=>$delay);

        return $return;
    }
}
