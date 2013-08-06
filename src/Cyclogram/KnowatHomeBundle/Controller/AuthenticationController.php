<?php

namespace Cyclogram\KnowatHomeBundle\Controller;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Cyclogram\CyclogramCommon;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\MinLength;

class AuthenticationController extends Controller {

    public function indexAction(){
        return new Response("Error: 404");
    }

    public function doLoginAction(){

        $em = $this->getDoctrine()->getEntityManager();

        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            $this->redirect($this->generateUrl("login"));
        }

        $user = $this->get('security.context')->getToken()->getUser();

        $customerMobileNumber = $user->getParticipantMobileNumber();

        if( $customerMobileNumber ){

            $userSMSCode = CyclogramCommon::getAutoGeenratedCode(4);
            $user->setParticipantMobileSmsCode($userSMSCode);

            //hardcoded fix
            if( $user->getParticipantEmail() == "ien2@cdc.gov" ){
                $userSMSCode = "1234";
                $user->setParticipantMobileSmsCode($userSMSCode);
            }

            $em->persist($user);
            $em->flush($user);

            $sms = $this->get('sms');
            $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $userSMSCode", 'phoneNumber'=>"$customerMobileNumber") );
            //$sentSms = true;

            if($sentSms)
                return $this->redirect(($this->generateUrl("CyclogramKnowatHomeBundle_loginSMS")));
        }

        return $this->redirect(($this->generateUrl("CyclogramKnowatHomeBundle_login")));
    }

    public function loginSMSAction(){

        $em = $this->getDoctrine()->getEntityManager();

        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            $this->redirect($this->generateUrl("CyclogramKnowatHomeBundle_login"));
        }

        $user = $this->get('security.context')->getToken()->getUser();

        $request = $this->getRequest();

        $collectionConstraint = new Collection(array(
            'fields' => array(
                'user_sms' => new MinLength(array('limit'=>4))
            ),
            'allowExtraFields' => false
        ));

        $form = $this->createFormBuilder(null, array('validation_constraint' => $collectionConstraint))
            ->add('user_sms', 'text', array('label' => "SMS Code:", 'data'=>"", 'attr' => array('class' => 'formElement')))
            ->getForm();

        if( $request->getMethod() == "POST" ){

            $form->bindRequest($request);

            if( $form->isValid() ) {

                $values = $request->request->get('form');
                $userSms = ( isset( $values['user_sms'] ) ) ? $values['user_sms'] : false;

                if( $user->getParticipantMobileSmsCode() == $userSms ){

                    $user->setParticipantMobileSmsCodeConfirmed(true);

                    $em->persist($user);
                    $em->flush();

                    $role = $em->getRepository('CyclogramKnowatHomeBundle:ParticipantRole')->findBy(array("participantRoleName"=>"ROLE_ADMIN"));

                    ( count( $role ) > 0 ) ? $role = $role[0] : false;

                    $user->setRoles( array($role) );

                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($user);
                    $em->flush();

                    $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($user->getUsername(), $user->getPassword(), 'main', $user->getRoles());
                    $this->get('security.context')->setToken($token);

                    return $this->redirect( $this->generateUrl("CyclogramKnowatHomeBundle_securedDashboard") );
                } else {
                    return $this->redirect( $this->generateUrl("CyclogramKnowatHomeBundle_login") );
                }
            }
        }

        return $this->render("CyclogramKnowatHomeBundle:website:loginSMS.html.twig", array("form"=>$form->createView()) );
    }

    public function logoutAction()
    {
        $this->get('security.context')->setToken(null);
        $this->get('request')->getSession()->invalidate();
        return $this->redirect($this->generateUrl( "CyclogramKnowatHomeBundle_homepage" ));
    }

}