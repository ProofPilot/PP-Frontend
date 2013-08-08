<?php
namespace Cyclogram\FrontendBundle\Service;

use Symfony\Component\DependencyInjection\Container;

class LimeSurvey
{
    private $container;
    
    public function __construct (Container $container)
    {
        $this->container = $container;
    }

}
