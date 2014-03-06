<?php
/*
* This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/
namespace Cyclogram\FrontendBundle\Listener;

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