<?php

namespace Dnsee\TutorialBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;


class CustomMessageConsumer implements ConsumerInterface
{
    protected $i;

    public function execute(AMQPMessage $msg)
    {
        $this->i++;
        echo '['.$this->i.']Incoming new message'.PHP_EOL;

        $message = unserialize($msg->body);

        echo '['.$this->i.'][Subject]'.$message->getSubject();
        echo PHP_EOL;
        echo '['.$this->i.'][Body]'.$message->getBody();
        echo PHP_EOL;

        // If your process failed due to a temporary error you can return false
        // from your callback so the message will be rejected by the consumer and
        // requeued by RabbitMQ.
        // Any other value not equal to false will acknowledge the message and remove it
        // from the queue
        return true;



        }
    }

