<?php

namespace Dnsee\TutorialBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;


class WordsConsumer implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {

        $message = unserialize($msg->body);

        echo $message;

        return true;
    }
}
