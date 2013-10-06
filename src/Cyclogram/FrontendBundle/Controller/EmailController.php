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

        
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:Participant')->getActiveParticipantInterventionLinks($participant);
        
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
