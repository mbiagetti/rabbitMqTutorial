<?php

namespace Dnsee\TutorialBundle\Controller;

use Dnsee\TutorialBundle\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class QueueController extends Controller
{
    /**
     * @Route("/simpleRpc")
     * @Template()
     */
    public function simpleRpcAction()
    {
        $client = $this->get('old_sound_rabbit_mq.integer_store_rpc');
        $client->addRequest(serialize(array('min' => 0, 'max' => 10)), 'random_int', 'request_id');
        $replies = $client->getReplies();

        return array('replies' => $replies);
    }

    /**
     * @Route("/parallelRpc")
     * @Template()
     */
    public function parallelRpcAction()
    {
        $start = microtime(true);
        $client = $this->get('old_sound_rabbit_mq.parallel_rpc');
        $client->addRequest(serialize(array('delay' => 3)), 'service_a', 'service_a_response');
        $client->addRequest(serialize(array('delay' => 4)), 'service_b', 'service_b_response');
        $replies = $client->getReplies();
        $end= microtime(true);

        return array('replies' => $replies, 'elapsed'=> $end-$start);
    }

}
