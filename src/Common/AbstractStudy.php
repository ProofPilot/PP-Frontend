<?php
namespace Common;

class AbstractStudy
{
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }

}
