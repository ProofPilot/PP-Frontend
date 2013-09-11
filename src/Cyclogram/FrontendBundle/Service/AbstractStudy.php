<?php
namespace Cyclogram\FrontendBundle\Service;

class AbstractStudy
{
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }

}
