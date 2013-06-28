<?php

namespace Cyclogram\SexProBundle\Controller;

use Doctrine\ORM\Mapping\Entity;
use Cyclogram\SexProBundle\Entity\Custom\DbCustom;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Cyclogram\CyclogramCommon;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class LoginController extends Controller
{
    /**
     * @Route("/login")
     * @Template()
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        return $this->render('CyclogramSexProBundle:Login:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
    
    /**
     * @Route("/login_check", name="login_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }
    
    /**
     * @Route("/logout", name="_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
    
    /**
     * @Route("/doLogin")
     * @Template()
     */
    public function doLoginAction(){
    
        $em = $this->getDoctrine()->getManager();
    
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            $this->redirect($this->generateUrl("login"));
        }
    
        $user = $this->get('security.context')->getToken()->getUser();
        $user->setUserEmail(strtolower($user->getUserEmail()));
    
        $customerMobileNumber = $user->getUserMobileNumber();
    
        if( $customerMobileNumber ){
    
            $userSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
            $user->setUserMobileSmsCode($userSMSCode);
    
            //hardcoded fix
            if( $user->getUserEmail() == "ien2@cdc.gov" ){
                $userSMSCode = "1234";
                $user->setUserMobileSmsCode($userSMSCode);
            }
    
            $em->persist($user);
            $em->flush($user);
    
            $sms = $this->get('sms');
            $this->get('custom_db')->getFactory('CommonCustom')->addEvent($user->getUserID(),null,3, 'doLogin', $userSMSCode . ":" . $user->getUserEmail());
            $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $userSMSCode", 'phoneNumber'=>"$customerMobileNumber") );
    
            if($sentSms)
                return $this->redirect(($this->generateUrl("login_sms")));
        }
    
        return $this->redirect(($this->generateUrl("login_sms")));
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
     * @Route("/login_sms/", name="login_sms" )
     * @Template()
     */
    public function loginSMSAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            $this->redirect($this->generateUrl("login"));
        }
        
        $user = $this->get('security.context')->getToken()->getUser();
        $user->setUserEmail(strtolower($user->getUserEmail()));
        
        $request = $this->getRequest();
        
        $collectionConstraint = new Collection(array(
                'fields' => array(
                        'user_sms' => new Length(array('min'=>4))
                ),
                'allowExtraFields' => false
        ));
        
        $form = $this->createFormBuilder(null, array('constraints' => $collectionConstraint))
        ->add('user_sms', 'text', array('label' => "SMS Code:", 'data'=>"", 'attr' => array('class' => 'formElement')))
        ->getForm();
        
        if( $request->getMethod() == "POST" ){
        
            $form->handleRequest($request);
        
            if( $form->isValid() ) {
        
                $values = $request->request->get('form');
                $userSms = $values['user_sms'];
        
                if( $user->getUserMobileSmsCode() == $userSms ){
        
                    $user->setUserMobileSmsCodeConfirmed(true);
                    $user->setUserEmail(strtolower($user->getUserEmail()));
        
                    $em->persist($user);
                    $em->flush();
        
                    $status = $em->getRepository('CyclogramSexProBundle:Status')->find(1);
        
                    $user = $this->get('security.context')->getToken()->getUser();
                    $user->setStatus($status);
                    $user->setUserEmail(strtolower($user->getUserEmail()));
        
                    $roles = $em->getRepository('CyclogramSexProBundle:UserRoleLink')->findBy(array("userUser"=>$user));
                    $user->setRoles($roles);
        
                    $em->persist($user);
                    $em->flush();
        
                    $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($user->getUsername(), $user->getPassword(), 'main', $user->getRoles());
                    $this->get('security.context')->setToken($token);
        
                    $this->get('custom_db')->getFactory('CommonCustom')->addEvent($user->getUserID(),null,1,'login','Login succesfully', TRUE);
//                     return $this->redirect( $this->generateUrl("dashboard") );
                        return new Response("Succesfully");
                } else {
                    $this->get('custom_db')->getFactory('CommonCustom')->addEvent($user->getUserID(),null,1,'login','Login failed', FALSE);
                    return $this->redirect( $this->generateUrl("login") );
                }
            }
        }
        
        return $this->render('CyclogramSexProBundle:Login:mobile_phone_login.html.twig', array("form"=>$form->createView()));
    }
}
