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

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class EmailController extends Controller
{
    /**
     * @Route("/verify_email/{email}" , name="_verify_email")
     * @Template()
     */
    function verifyEmailAction(Request $request, $email)
    {

        $cc = $this->get('cyclogram.common');
        $verify = $cc->verifyEmail($email);
        if ($verify)
            return new Response("Email verified");
        else 
            return new Response("Email not verified");
    }
    
    /**
     * @Route("/send_test_email/{email}" , name="_send_test_email")
     * @Template()
     */
    function sendTestEmailAction(Request $request, $email)
    {
//         $branding = $this->get('branding');
        $locale = $this->getRequest()->getLocale();
        $cc = $this->get('cyclogram.common');
        $embedded = array();
        $embedded = $cc->getEmbeddedImages();
        
        $parameters = array();
        $parameters['code'] = 155;
        $parameters['email'] = "ok@ok.com";
        $parameters['confirmed'] = 1;
        $parameters['host'] = $this->container->getParameter('site_url');
        $parameters['locale'] = $request->getLocale();
        $parameters["studies"] = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);

        try{
            $cc->sendMail(null,
                    $email,
                    'Test Email from Cyclogram',
                    'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
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
            
                              $send = $cc->sendMail(null,
                          $participant->getParticipantEmail(),
                          $this->container->get('translator')->trans("do_it_task_email_title", array(), "email", $parameters['locale']),
                          'CyclogramFrontendBundle:Email:doitemail.html.twig',
                          null,
                          $embedded,
                          true,
                          $parameters);
                  if ($send['status'] == true) 
                      return new Response("Completed");
                  else 
                      return new Response($send['message']);
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
            $locale = $this->getRequest()->getLocale();
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
        
            $parameters['email'] = $participant->getParticipantEmail();
            $parameters['locale'] = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters['code'] = $participant->getParticipantEmailCode();
            $parameters["studies"] = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
            try{
            $send = $cc->sendMail(null,
                    $participant->getParticipantEmail(),
                    $this->get('translator')->trans("email_title_verify", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
            } catch (\Exception $exc){
                echo($this->container->get('translator')->trans('email_not_send_try_later', array(), 'validators'));
            
            }
            
           return $this->render('CyclogramFrontendBundle:Email:mail_confirm.html.twig');
    }
    
    /**
     * @Route("/email_to_friend" , name="_email_to_friend" )
     * @Template()
     */
    function emailToFriendAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cc = $this->get('cyclogram.common');
      
        $locale = $request->getLocale();
        
        if ($request->isXmlHttpRequest()) {
            $participantEmail = $request->get('participant');
            $studyCode = $request->get('studyCode');
            
            $parameters['locale'] = $locale;
            $from = $request->get('send_from');
            $to = $request->get('send_to');
            $to = array_filter($to);
            $description = $request->get('description');
            $subject = $request->get('subject');
//             if (empty($subject)) 
//                 $this->get('translator')->trans("email_friend_subject", array(), "email", $parameters['locale']);
            if (!isset($from) || empty($from)){
                return new Response(json_encode(array('error' => true, 'message' => $this->get('translator')->trans("insert_sender_email", array(), "email", $parameters['locale']))));
            }
            
            if (!isset($to[0]) || empty($to[0])){
                return new Response(json_encode(array('error' => true, 'message' => $this->get('translator')->trans("insert_receiver_email", array(), "email", $parameters['locale']))));
            } 
            
//             if (!isset($description) || empty($description)){
//                 return new Response(json_encode(array('error' => true, 'message' => 'Please fill e-mail body')));
//             }
            
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
            
            $parameters['email'] = $to[0];
            $parameters['studycontent'] = $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($studyCode, $locale);
            

            $parameters['desription'] = $description;
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters["graphic"] = $this->container->getParameter('study_image_url') . '/' . $studyContent->getStudyId(). '/' .$studyContent->getStudyLogo();
            $parameters['from'] = $from;
            $parameters['hideFooter'] = true;
            if (!is_null($participantEmail)) {
                $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                $site = $em->getRepository('CyclogramProofPilotBundle:Study')->getDefaultSites($study->getStudyId());
                $siteId = $em->getRepository('CyclogramProofPilotBundle:Site')->findOneBySiteName($site[0]['siteName']);
                $siteCampaignLink = $em->getRepository('CyclogramProofPilotBundle:CampaignSiteLink')->findOneBySite($siteId);
                $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneByParticipantEmail($participantEmail);
                $parameters["studies"] = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
                $parameters['url'] = $this->container->getParameter('site_url')."/".$locale."/".$study->getStudyCode()."/?utm_campaign=".$siteCampaignLink->getCampaign()->getCampaignName()."&utm_medium-Clinic&utm_source=".$site[0]['siteName']."&pid=".$participant->getParticipantId();
            } else {
                $parameters["studies"] = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, null);
                if (isset($studyCode))
                    $parameters['url'] = $this->container->getParameter('site_url').DIRECTORY_SEPARATOR.$locale.DIRECTORY_SEPARATOR.$studyCode;
            }
            try{
                $send = $cc->sendMail($from,$to,
                        $subject,
                        'CyclogramFrontendBundle:Email:email_friends.html.twig',
                        null,
                        $embedded,
                        true,
                        $parameters);
            } catch (\Exception $exc){
                 return new Response(json_encode(array('error' => true, 'message' => $this->container->get('translator')->trans('email_not_send_try_later', array(), "email", $parameters['locale']))));
            }
            if ($send['status'] == false) {
                return new Response(json_encode(array('error' => true, 'message' => $send['message'])));
            } 
            return new Response(json_encode(array('error' => false, 'message' => $this->get('translator')->trans("sent_email_to_friends", array(), "email", $parameters['locale']))));
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
        $em = $this->container->get('doctrine')->getManager();
        $timezone = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimezone')->find(1);
        $currentInTz = new \DateTime(null, new \DateTimeZone($timezone->getParticipantTimezoneName()));
        $weekDayInTz = (int)$currentInTz->format("w");
        $weekNo = date('W');
        
        
        return new Response('Current week: '.$weekNo.' prev: '.$weekDayInTz);
    }
    
    
    /**
     * @Route("/testGoogleSearch" , name="_test_google_search")
     */
    function testGoogleEarthAction()
    {
        $yaml = new Parser();

        try {
            $value = $yaml->parse(file_get_contents($path = $this->get('kernel')->getRootDir() . '/../web/DSL/SexproLogic.yml'));
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
        return new Response(var_dump($value));
    }
    
    

}
