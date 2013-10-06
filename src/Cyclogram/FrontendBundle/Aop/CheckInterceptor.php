<?php
namespace Cyclogram\FrontendBundle\Aop;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class CheckInterceptor implements MethodInterceptorInterface
{
     private $annotationReader;
        
     public function __construct(\Doctrine\Common\Annotations\Reader $annotationReader)
     {
            $this->annotationReader=$annotationReader;
     }
 
    /**
     * Called when intercepting a method call.
     *
     * @param MethodInvocation $invocation
     * @return mixed the return value for the method invocation
     * @throws \Exception may throw any exception
     */
     function intercept(MethodInvocation $invocation)
     {
         $method=$invocation->reflection;
         
        //Annotation Object can be retrieved for additional processing /logic
         $annotationObj=$this->annotationReader->getMethodAnnotation($method,'Cyclogram\FrontendBundle\Aop\Check');
         
         $callbacks = explode(",", $annotationObj->name);
         foreach ($callbacks as $callback){
             $checkResult = call_user_func_array(array($invocation->object, $callback), $invocation->arguments);
             if($checkResult)
                 return $checkResult;
         }


         return $invocation->proceed();
     }
}
