<?php

namespace Cyclogram\SexProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SecurityController extends Controller
{
    /**
     * @Route("/create_pass/")
     * @Template()
     */
    public function createPassAction()
    {
        return $this->render('CyclogramSexProBundle:Security:create_new_password.html.twig');
    }
    
    /**
     * @Route("/forgot_username/")
     * @Template()
     */
    public function forgotUserAction()
    {
        return $this->render('CyclogramSexProBundle:Security:forgot_username.html.twig');
    }
    
    /**
     * @Route("/forgot_pass_no_error/")
     * @Template()
     */
    public function forgotPassNoErrorAction()
    {
        return $this->render('CyclogramSexProBundle:Security:forgot_your_password_no_error.html.twig');
    }
    
    /**
     * @Route("/forgot_pass/")
     * @Template()
     */
    public function forgotPassAction()
    {
        return $this->render('CyclogramSexProBundle:Security:forgot_your_password.html.twig');
    }
    
    /**
     * @Route("/reset_pass/")
     * @Template()
     */
    public function resetPassAction()
    {
        return $this->render('CyclogramSexProBundle:Security:reset_password_confirmation.html.twig');
    }
    
    /**
     * @Route("/confirm_reset/")
     * @Template()
     */
    public function confirmResetAction()
    {
        return $this->render('CyclogramSexProBundle:Security:confirm_reset.html.twig');
    }
    
    /**
     * @Route("/pass_changed/")
     * @Template()
     */
    public function passChangedAction()
    {
        return $this->render('CyclogramSexProBundle:Security:password_changed.html.twig');
    }
}
