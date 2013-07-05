<?php

namespace Cyclogram\SexProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RegistrationController extends Controller
{

    /**
     * @Route("/register", name="_registration")
     * @Template()
     */
    public function registerAction()
    {
        return $this->render('CyclogramSexProBundle:Registration:register.html.twig');
    }
    
    /**
     * @Route("/register_step2/", name="reg_step_2")
     * @Template()
     */
    public function phoneAction()
    {
        return $this->render('CyclogramSexProBundle:Registration:mobile_phone_1.html.twig');
    }
    
    /**
     * @Route("/register_step3/")
     * @Template()
     */
    public function checkPhoneAction()
    {
        return $this->render('CyclogramSexProBundle:Registration:mobile_phone_2.html.twig');
    }
    
    /**
     * @Route("/register_step4/")
     * @Template()
     */
    public function enterSMSAction()
    {
        return $this->render('CyclogramSexProBundle:Registration:mobile_phone_3.html.twig');
    }
    
    
    /**
     * @Route("/register_popup/")
     * @Template()
     */
    public function registerPopupAction()
    {
        return $this->render('CyclogramSexProBundle:Registration:register_with_popup.html.twig');
    }

    /**
     * @Route("/username_sent/")
     * @Template()
     */
    public function userNameSentAction()
    {
        return $this->render('CyclogramSexProBundle:Registration:username_sent.html.twig');
    }
}
