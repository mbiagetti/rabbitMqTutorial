<?php

namespace Dnsee\TutorialBundle\Controller;

use Dnsee\TutorialBundle\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class QueueController extends Controller
{

    /**
     * @Route("/rouningKey/{subject}/{message}/{key}/{tot}", name ="_key", defaults={"tot" = 1})
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
