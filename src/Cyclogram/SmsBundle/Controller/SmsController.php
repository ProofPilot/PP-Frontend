<?php

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