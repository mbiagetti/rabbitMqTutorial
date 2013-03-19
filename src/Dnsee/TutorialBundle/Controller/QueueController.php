<?php

namespace Dnsee\TutorialBundle\Controller;

use Dnsee\TutorialBundle\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class QueueController extends Controller
{
    /**
     * @Route("/log/{severity}/{message}/{tot}", defaults={"tot" = 1})
     * @Template()
     */
    public function logAction($severity,$message,$tot)
    {
        $msg = array( 'message' => $message);
        for($i=0;$i<$tot;$i++)
            $this->get('old_sound_rabbit_mq.app_logs_producer')->publish(serialize($msg),$severity);

        return array('severity' => $severity, 'message' => $message,'tot'=>$tot);
    }

}
