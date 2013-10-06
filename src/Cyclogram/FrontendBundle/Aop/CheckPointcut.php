<?php 
namespace Cyclogram\FrontendBundle\Aop;

use JMS\AopBundle\Aop\PointcutInterface;

class CheckPointcut implements PointcutInterface
{

     private $annotationReader;
     public function __construct(\Doctrine\Common\Annotations\Reader $annotationReader)
     {
         $this->annotationReader=$annotationReader;
     }
 
    /**
     * Determines whether the advice applies to instances of the given class.
     *
     * There are some limits as to what you can do in this method. Namely, you may
     * only base your decision on resources that are part of the ContainerBuilder.
     * Specifically, you may not use any data in the class itself, such as
     * annotations.
     *
     * @param \ReflectionClass $class
     * @return boolean
     */
     function matchesClass(\ReflectionClass $class)
     {
         // TODO: Implement matchesClass() method.
         //return $class->getName() === 'Acme\DemoBundle\Controller\DemoController';
         return true;
     }
 
    /**
     * Determines whether the advice applies to the given method.
     *
     * This method is not limited in the way the matchesClass method is. It may
     * use information in the associated class to make its decision.
     *
     * @param \ReflectionMethod $method
     * @return boolean
     */
     function matchesMethod(\ReflectionMethod $method)
     {
         // TODO: Implement matchesMethod() method.
         $annotationObj=$this->annotationReader->getMethodAnnotation($method,'Cyclogram\FrontendBundle\Aop\Check');
         //echo "<pre>";
         //echo "\n**".print_r($annotationObj,true)."\n";
         return isset($annotationObj);
     }
}
