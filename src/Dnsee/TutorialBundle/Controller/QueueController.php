<?php

namespace Dnsee\TutorialBundle\Controller;

use Dnsee\TutorialBundle\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class QueueController extends Controller
{
    /**
     * @Route("/produce/{subject}/{message}/{tot}", defaults={"tot" = 1})
     * @Template()
     */
    public function produceAction($subject,$message,$tot)
    {
        $msg=new Message();
        $msg->setBody($message);
        $msg->setSubject($subject);

        /**
         *  Puoi inviare messaggi di tipo XML, Json o text plain semplicemente modificando il content type
         * della coda, insomma qualsiasi formato che sia serializzabile, ovviamente anche oggetti.
         *
            $this->get('old_sound_rabbit_mq.custom_message_producer')->setContentType('application/json');

         * il default è text/plain
         */

        for($i=0;$i<$tot;$i++)
            $this->get('old_sound_rabbit_mq.custom_message_producer')->publish(serialize($msg));

        return array('msg' => $msg, 'tot'=>$tot);
    }

    /**
     * @Route("/rouningKey/{subject}/{message}/{key}/{tot}", defaults={"tot" = 1})
     * @Template()
     */
    public function keyAction($subject,$message,$key,$tot)
    {
        $msg=new Message();
        $msg->setBody($message);
        $msg->setSubject($subject);

        for($i=0;$i<$tot;$i++)
            $this->get('old_sound_rabbit_mq.rk_custom_message_producer')->publish(serialize($msg),$key);

        return array('key' => $key, 'msg' => $msg,'tot'=>$tot);
    }
}
