<?php
namespace Cyclogram\StudyBundle\Listener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;


class ControllerListener
{
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        if(!is_array($controller))
        {
            // not a controller do nothing
            return;
        }
        $controllerObject = $controller[0];
        if(is_object($controllerObject) && method_exists($controllerObject, "preExecute") )
        {
            $hasError = $controllerObject->preExecute();
            if($hasError) { 
                   $event->setController(array($controllerObject, "errorAction"));
            }
        }
    }
    
    public function onKernelRequest(GetResponseEvent $event) {
        $request =  $event->getRequest();
        echo $request->get('wow');
    }
}