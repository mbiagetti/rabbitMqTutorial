<?php

namespace Dnsee\TutorialBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;


class LoggerWatcher implements ConsumerInterface
{
    protected $i = 0;

    public function execute(AMQPMessage $msg)
    {
        $message = unserialize($msg->body);

        echo '['.++$this->i.']'.$message['message'];
        echo PHP_EOL;

        return true;
    }
}
