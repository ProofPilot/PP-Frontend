<?php

namespace Cyclogram\SmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    
    /**
     * @Route("/testsms/")
     * @Template()
     */
    public function indexAction()
    {
        $sms = $this->get('sms');
        $response = $sms->sendSmsAction( array('message' => 'test sms', 'phoneNumber'=>'+380938804015') );
        $response = ( $response )? "Sent" : "Not sent";

        return new Response("sms: " . $response);
    }
}
