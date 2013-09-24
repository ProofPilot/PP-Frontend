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

namespace Cyclogram\SmsBundle\Controller;

use Cyclogram\SmsBundle\Entity\Sms;

class SmsController
{
    private $_kernel;

    public function __construct( \Symfony\Component\HttpKernel\Kernel $kernel )
    {
        $this->_kernel    = $kernel;
    }

    public function indexAction($name)
    {
        return $this->render('CyclogramSmsBundle:Default:index.html.twig', array('name' => $name));
    }

    public function sendSmsAction( array $config = array() )
    {
        $response = null;
        $phoneNumber = ( $config['phoneNumber'] )? $config['phoneNumber'] : NULL;
        $message = ( $config['message'] )? $config['message'] : NULL;

        if( (is_null($phoneNumber)) || (is_null($message)) )
            return false;

        $sms = new Sms($this->_kernel);
        $sms->setPhoneNumber($phoneNumber);
        $sms->setMessage($message);
        $response = $sms->sendSms();

        return $response;
    }
}