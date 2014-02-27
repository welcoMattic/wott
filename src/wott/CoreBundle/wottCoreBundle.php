<?php

namespace wott\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class wottCoreBundle extends Bundle
{

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}
