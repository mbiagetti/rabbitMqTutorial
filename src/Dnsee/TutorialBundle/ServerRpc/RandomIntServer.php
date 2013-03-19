<?php

namespace Dnsee\TutorialBundle\ServerRpc;


use PhpAmqpLib\Message\AMQPMessage;

class RandomIntServer
{

    public function execute(AMQPMessage $msg)
    {
        $message = unserialize($msg->body);
        $min = $message['min'];
        $max = $message['max'];

        $value = rand($min,$max);

        $return = array('value'=>$value);

        return $return;
    }
}
