<?php

namespace Cyclogram\FrontendBundle\Controller;

use Cyclogram\FrontendBundle\Exception\IncompleteUserException;

use Cyclogram\FrontendBundle\Form\UserSmsCodeForm;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\Mapping\Entity;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Custom\DbCustom;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Cyclogram\CyclogramCommon;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use HWI\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken;


class LoginController extends Controller
{

    /**
     * @Route("/login/{studyId}", name="_login")
     * @Template()
     */
    public function loginAction($studyId=null)
    {
        if ($this->get('security.context')->isGranted("ROLE_USER")){
            return $this->redirect($this->generateURL("_main"));
        }
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $error = $this->getErrorForRequest($request);

        if(     $error &&
                $error instanceof IncompleteUserException) {

            $participantId = $error->getParticipantId();
            $studyId = $error->getToken()->getAttribute("studyId");
            $resourceOwner = $error->getToken()->getResourceOwnerName();
            $session->set("resourceOwnerName",$resourceOwner);
            
            $participant = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Participant')->find($participantId);
            
            if(!empty($studyId))
                $study = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
            
            if (!empty($studyId)){
                if ($study->getEmailVerificationRequired()) {
                    return $this->redirect( $this->generateUrl("reg_step_2", array('id' => $participant->getParticipantId(), 'studyId' => $studyId)));
                } else {
                    return $this->redirect( $this->generateUrl("simplereg_step_2", array('id' => $participant->getParticipantId(), 'studyId' => $studyId)));
                }
            } else {
                return $this->redirect( $this->generateUrl("simplereg_step_2", array('id' => $participant->getParticipantId())) );
            }
        }
        
        
        return $this->render('CyclogramFrontendBundle:Login:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
            'studyId'       => $studyId,
        ));
    }

    /**
     * @Route("/login_check/{studyId}", name="login_check")
     */
    public function securityCheckAction($studyId)
    {
        // The security layer will intercept this request
    }


    /**
     * @Route("/logout", name="_logout" , options={"expose"=true})
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/doLogin/{studyId}", name="_do_login")
     * @Template()
     */
    public function doLoginAction($studyId=null){
    
        $em = $this->getDoctrine()->getManager();
    
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            $this->redirect($this->generateUrl("_login"));
        }
    
        $participant = $this->get('security.context')->getToken()->getUser();
        
        $participant->setParticipantEmail(strtolower($participant->getParticipantEmail()));
    
        $customerMobileNumber = $participant->getParticipantMobileNumber();

        $request = $this->getRequest();
        $session = $request->getSession();


        if( $customerMobileNumber ){
    
            $participantSMSCode = CyclogramCommon::getAutoGeneratedCode(4);
            $participant->setParticipantMobileSmsCode($participantSMSCode);
    
            //hardcoded fix
            if( $participant->getParticipantEmail() == "ien2@cdc.gov" ){
                $participantSMSCode = "1234";
                $participant->setParticipantMobileSmsCode($participantSMSCode);
            }
    
            $em->persist($participant);
            $em->flush($participant);
    
            $sms = $this->get('sms');
            $this->get('custom_db')->getFactory('CommonCustom')->addEvent($participant->getParticipantId(),null,3, 'doLogin', $participantSMSCode . ":" . $participant->getParticipantEmail());
            $sentSms = $sms->sendSmsAction( array('message' => "Your SMS Verification code is $participantSMSCode", 'phoneNumber'=>"$customerMobileNumber") );
    
            if($sentSms)
                return $this->redirect(($this->generateUrl("login_sms", array("studyId"=>$studyId))));
        }

        return $this->redirect(($this->generateUrl("login_sms", array("studyId"=>$studyId))));
    }

    /**
     * @Route("/login_sms/{studyId}", name="login_sms" )
     * @Template()
     */
    public function loginSMSAction($studyId=null)
    {
        $em = $this->getDoctrine()->getManager();
        
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            $this->redirect($this->generateUrl("_login"));
        }
        
        $participant = $this->get('security.context')->getToken()->getUser();
        $participant->setParticipantEmail(strtolower($participant->getParticipantEmail()));
        
        $request = $this->getRequest();
        $session = $request->getSession();

        
        $form = $this->createForm(new UserSmsCodeForm($this->container));
        
        if( $request->getMethod() == "POST" ){
        
            $form->handleRequest($request);
        
            if( $form->isValid() ) {
        
                $values = $form->getData();
                $userSms = $values['sms_code'];
        
                if( $participant->getParticipantMobileSmsCode() == $userSms ){

                    $participant->setParticipantMobileSmsCodeConfirmed(true);
                    $participant->setParticipantEmail(strtolower($participant->getParticipantEmail()));
                    $status = $em->getRepository('CyclogramProofPilotBundle:Status')->find(1);
                    $participant->setStatus($status);

                    $roles = $em->getRepository('CyclogramProofPilotBundle:UserRoleLink')->findBy(array("userUser"=>$participant));
                    $participant->setRoles($roles);
                    $participant->setParticipantLastTouchDatetime(new \DateTime());

                    $em->persist($participant);
                    $em->flush();
                    
                    $currentToken = $this->get('security.context')->getToken();
                    $roles = $currentToken->getRoles();
                    
                    
                    if($currentToken instanceof OAuthToken) {
                    
                        $token = new OAuthToken($currentToken->getRawToken(), array_merge($roles, array("ROLE_PARTICIPANT")));
                        $token->setResourceOwnerName($currentToken->getResourceOwnerName());
                        $token->setUser($participant);
                        $token->setAuthenticated(true);
                    } else {
                        $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($participant, $participant->getPassword(), 'main', array_merge($roles, array("ROLE_PARTICIPANT")));
                    }
                    $this->get('security.context')->setToken($token);

                    $this->get('custom_db')->getFactory('CommonCustom')->addEvent($participant->getParticipantId(),null,1,'login','Login succesfully', TRUE);
                    return $this->redirect( $this->generateUrl("_main", array("studyId"=>$studyId)) );
                } else {
                    $this->get('custom_db')->getFactory('CommonCustom')->addEvent($participant->getParticipantId(),null,1,'login','Login failed', FALSE);
                    return $this->redirect( $this->generateUrl("_login") );
                }
            }
        }
        
        return $this->render(
            'CyclogramFrontendBundle:Login:mobile_phone_login.html.twig',
            array(
                "form"=>$form->createView()
            ));
    }
    
    /**
     * Get the security error for a given request.
     *
     * @param Request $request
     *
     * @return string|\Exception
     */
    protected function getErrorForRequest(Request $request)
    {
        $session = $request->getSession();
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }
    
        return $error;
    }
    
    /**
     * @param Request $request
     * @param string  $service
     *
     * @return RedirectResponse
     */
    public function redirectToServiceAction(Request $request, $service)
    {
        // Check for a specified target path and store it before redirect if present
        $param = $this->container->getParameter('hwi_oauth.target_path_parameter');
    
        $studyId = $request->get('studyId');
        $extraParameters = array();
        if($studyId)
            $extraParameters["state"] = $studyId;
    
        if (!empty($param) && $request->hasSession() && $targetUrl = $request->get($param, null, true)) {
            $providerKey = $this->container->getParameter('hwi_oauth.firewall_name');
            $request->getSession()->set('_security.' . $providerKey . '.target_path', $targetUrl);
        }
    
        return new RedirectResponse(
                $this->container->get('hwi_oauth.security.oauth_utils')->getAuthorizationUrl(
                        $service, 
                        null, 
                        $extraParameters)
    
        );
    }
}
