<?php

namespace VOOTS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VOOTSUserBundle extends Bundle
{
    public function getParent()
    {
      return 'FOSUserBundle';
    }
}
