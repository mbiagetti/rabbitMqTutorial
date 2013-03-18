<?php

namespace Dnsee\TutorialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('DnseeTutorialBundle:Welcome:index.html.twig');
    }
}
