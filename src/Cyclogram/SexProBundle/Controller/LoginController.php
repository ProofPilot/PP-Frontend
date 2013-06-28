<?php

namespace Cyclogram\SexProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LoginController extends Controller
{
    /**
     * @Route("/login/")
     * @Template()
     */
    public function loginAction()
    {
        return $this->render('CyclogramSexProBundle:Login:login.html.twig');
    }
    
    /**
     * @Route("/login_new/")
     * @Template()
     */
    public function loginNewAction()
    {
        return $this->render('CyclogramSexProBundle:Login:login_new.html.twig');
    }
    
    /**
     * @Route("/phone_login/")
     * @Template()
     */
    public function phoneLoginAction()
    {
        return $this->render('CyclogramSexProBundle:Login:mobile_phone_login.html.twig');
    }
}
