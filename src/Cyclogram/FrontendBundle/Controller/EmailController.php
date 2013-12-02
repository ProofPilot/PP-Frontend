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

namespace Cyclogram\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class EmailController extends Controller
{
    /**
     * @Route("/send_test_email/{email}" , name="_send_test_email")
     * @Template()
     */
    function sendTestEmailAction($email)
    {
        $branding = $this->get('branding');
        
        $embedded = array();
        $embedded = $cc->getEmbeddedImages();
        
        $cc = $this->get('cyclogram.common');
        
        $parameters = array();
        $parameters['code'] = 155;
        $parameters['email'] = "ok@ok.com";
        $parameters['confirmed'] = 1;
        $parameters['host'] = $this->container->getParameter('site_url');

        try{
            $cc->sendMail(
                    $email,
                    'Test Email from Cyclogram',
                    'CyclogramFrontendBundle:Email:email_test.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
        }
        catch (\Exception $exc){
            echo("Error. Email not send" . $exc->getMessage());
        
        }
        
        return new Response("Completed");
    }
    
    /**
     * @Route("/test_mail_view/{id}" , name="_test_mail_view")
     * @Template()
     */
    function testMailViewAction($id) {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
        $locale = $participant->getLocale();
        $cc = $this->get('cyclogram.common');

        
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getActiveParticipantInterventionLinks($participant);
        
        $embedded = array();
        $embedded = $cc->getEmbeddedImages();
        
        
        $parameters["interventions"] = array();
        if (!empty($interventionLinks)){
            foreach($interventionLinks as $interventionLink) {
        
                $interventionId = $interventionLink->getIntervention()->getInterventionId();
                $interventionContent = $this->container->get('doctrine')->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
        
                $study = $interventionLink->getIntervention()->getStudy();
                $studyId = $study->getStudyId();
                $studyContent = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudyId($studyId);
        
                $intervention = array();
                $intervention["title"] = $interventionContent->getInterventionTitle();
                $intervention["content"] = $interventionContent->getInterventionDescripton();
        
                $intervention["url"] = $this->getInterventionUrl($interventionLink, $locale);
                $intervention["logo"] = $this->container->getParameter('study_image_url') . "/" . $studyId . "/" . $studyContent->getStudyLogo();
                $parameters["interventions"][] = $intervention;
            }
        
            $parameters['email'] = $participant->getParticipantEmail();
            $parameters['locale'] = $participant->getLocale();
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters['siteurl'] = $this->container->getParameter('site_url').$this->getInterventionUrl($interventionLink, $locale);
            
                              $send = $cc->sendMail(
                          $participant->getParticipantEmail(),
                          $this->container->get('translator')->trans("do_it_task_email_title", array(), "email", $parameters['locale']),
                          'CyclogramFrontendBundle:Email:doitemail.html.twig',
                          null,
                          $embedded,
                          true,
                          $parameters);
                  if ($send) 
                      return new Response("Completed");
                  else 
                      return new Response("Email not send");
        } else {
            return new Response("Cant send email. No active tasks");
        }
    }
    
    private function getInterventionUrl($interventionLink, $locale) {
        $intervention = $interventionLink->getIntervention();
    
        $studyCode = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Intervention')
        ->getInterventionStudyCode($intervention->getInterventionId());
    
        $typeName = $interventionLink->getIntervention()->getInterventionType()->getInterventionTypeName();
        switch($typeName) {
            case 'Activity':
                return $intervention->getInterventionUrl();
            case 'Survey & Observation':
                $surveyId = $intervention->getSidId();
                $redirectPath = $this->container->get('router')->generate('_main', array('_locale' => $locale));
                $path = $this->container->get('router')->generate('_survey_protected', array(
                        '_locale' => $locale,
                        'studyCode' => $studyCode,
                        'surveyId' => $surveyId,
                        'redirectUrl' => urlencode($redirectPath)
    
                ));
                return $path;
    
        }
    }
    
    /**
     * @Route("/send_verification_email/{email}/{code}/{id}/{studyCode}" , name="_send_verification_email", defaults={"studyCode"=null})
     * @Template()
     */
    function sendVerificationEmailAction($email, $code ,$studyCode, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($id);
            $cc = $this->get('cyclogram.common');
            
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
        
            $parameters['email'] = $participant->getParticipantEmail();
            $parameters['locale'] = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters['code'] = $participant->getParticipantEmailCode();
            try{
            $cc->sendMail($participant->getParticipantEmail(),
                    $this->get('translator')->trans("email_title_verify", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
            } catch (\Exception $exc){
                echo("Error. Email not send" . $exc->getMessage());
            
            }
            
           return $this->render('CyclogramFrontendBundle:Email:mail_confirm.html.twig');
    }
    
    /**
     * @Route("/email_to_friend/{studyCode}" , name="_email_to_friend" , defaults={"studyCode"="null"})
     * @Template()
     */
    function emailToFriendAction(Request $request, $studyCode)
    {
        $em = $this->getDoctrine()->getManager();
        $cc = $this->get('cyclogram.common');
        
        $locale = $request->getLocale();
        
        if ($request->isXmlHttpRequest()) {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            $from = $request->get('send_from');
            $to = $request->get('send_to');
            $to = array_filter($to);
            $description = $request->get('description');
            $subject = $request->get('subject');
            if (empty($subject)) 
                $this->get('translator')->trans("email_friend_subject", array(), "email", $parameters['locale']);
            if (!isset($from) || empty($from)){
                return new Response(json_encode(array('error' => true, 'message' => 'Insert the sender e-mail')));
            } else {
                if (!preg_match($regex, $from)) 
                    return new Response(json_encode(array('error' => true, 'message' => 'You insert invalid sender e-mail')));
            }
            
            if (!isset($to[0]) || empty($to[0])){
                return new Response(json_encode(array('error' => true, 'message' => 'Insert at least one reciver e-mail')));
            } else {
                $to = array_filter($to);
                foreach ($to as $t)
                if ( !empty($t) && !preg_match($regex, $t)) 
                    return new Response(json_encode(array('error' => true, 'message' => 'You insert invalid reciver e-mail')));
                if ( empty($t))
                        return new Response(json_encode(array('error' => true, 'message' => 'Insert the reciver e-mail')));
            }
            
            if (!isset($description) || empty($description)){
                return new Response(json_encode(array('error' => true, 'message' => 'Please fill e-mail body')));
            }
            
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
            
            $parameters['email'] = $to[0];
            $parameters['studycontent'] = $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($studyCode, $locale);
            $parameters['locale'] = $locale;
            $parameters['url'] = $this->container->getParameter('site_url').DIRECTORY_SEPARATOR.$locale.DIRECTORY_SEPARATOR.$studyCode;
            $parameters['desription'] = $description;
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters["graphic"] = $this->container->getParameter('study_image_url') . '/' . $studyContent->getStudyId(). '/' .$studyContent->getStudyLogo();
            try{
                $send = $cc->sendMail($from,$to,
                        $subject,
                        'CyclogramFrontendBundle:Email:email_friends.html.twig',
                        null,
                        $embedded,
                        true,
                        $parameters);
            } catch (\Exception $exc){
                 return new Response(json_encode(array('error' => true, 'message' => "Error. Email not send" . $exc->getMessage())));
            }
            if ($send) {
                return new Response(json_encode(array('error' => false, 'message' => "Send")));
            }
        }
    }
    
    /**
     * @Route("/testdb" , name="_testdb")
     */
    function testDbAction()
    {
        $em = $this->getDoctrine()->getManager();
        $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantsWithNotConfirmedEmails();
        echo count($participants);
        return new Response("");
    }
    
    /**
     * @Route("/testError" , name="_test_error")
     */
    function showErrorAction()
    {
        return $this->render('::error.html.twig', array("error"=>"Error"));
    }
    
    

}
