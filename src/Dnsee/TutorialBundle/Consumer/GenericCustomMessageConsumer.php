<?php
/**
 * Created by JetBrains PhpStorm.
 * User: matteo
 * Date: 18/03/13
 * Time: 19.24
 * To change this template use File | Settings | File Templates.
 */

namespace Dnsee\TutorialBundle\Consumer;


class GenericCustomMessageConsumer extends CustomMessageConsumer {

    protected function getName()
    {
        return 'Generic Message Consumer';
    }
}