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
namespace Cyclogram\FrontendBundle\Command;

use Cyclogram\CyclogramCommon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Common\Collections\Criteria;


class DoItNotificationCommand extends ContainerAwareCommand
{
    protected function configure(){
        
        $this->setName('send:doitnotification')
        ->setDescription('Send email with doit tasks')
        ->addArgument('study', InputArgument::OPTIONAL,'Input study code')
        ->addArgument('intervention', InputArgument::OPTIONAL,'Input intervention code');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em = $this->getContainer()->get('doctrine')->getManager();
        
        $contactPeriod = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTime')->getCurrentContactPeriod();
        $periodId = $contactPeriod->getParticipantContactTimesId();
        $periodStart = $contactPeriod->getParticipantContactTimesRangeStart();
        $periodEnd = $contactPeriod->getParticipantContactTimesRangeEnd();
        
        $output->writeln("Server is in contact period #".$periodId."[".$periodStart->format("H:i:s")."-".$periodEnd->format("H:i:s")."]");
        $output->writeln("Server weekday is ".date("l")." #".date("w")."\n");
        
        //get all participant timezones and process them one by one
        $timezones = $em->getRepository('CyclogramProofPilotBundle:ParticipantTimezone')->findAll();
        foreach($timezones as $timezone)
        {
            $output->writeln("Processing timezone " . $timezone->getParticipantTimezoneName() . "");
            $currentInTz = new \DateTime(null, new \DateTimeZone($timezone->getParticipantTimezoneName()));
            $weekDayInTz = (int)$currentInTz->format("w");
            $periodInTz = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTime')->getCurrentContactPeriod($currentInTz);
            $periodId = $periodInTz->getParticipantContactTimesId();
            $periodStart = $periodInTz->getParticipantContactTimesRangeStart();
            $periodEnd = $periodInTz->getParticipantContactTimesRangeEnd();
            $output->writeln("Timezone in contact period #".$periodId."[".$periodStart->format("H:i:s")."-".$periodEnd->format("H:i:s")."]");
            $output->writeln("Timezone weekday is ".$weekDayInTz);
            
            $output->writeln("Looking for participants with email notification... ");
            $studyCode = $input->getArgument('study');
            $interventionCode = $input->getArgument('intervention');
            if (isset($studyCode) && isset($interventionCode))
            $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')
                ->getParticipantsForEmailNotifications(
                        1, //reminder type
                        $timezone->getParticipantTimezoneId(),  //timezone   
                        $periodId, //id of period in timezone
                        $weekDayInTz, //weekday in timezone
                        $studyCode,
                        $interventionCode
                    );
            else
                $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')
                ->getParticipantsForEmailNotifications(
                        1, //reminder type
                        $timezone->getParticipantTimezoneId(),  //timezone   
                        $periodId, //id of period in timezone
                        $weekDayInTz //weekday in timezone
                    );
            foreach($participants as $participant) {
            	if (isset($studyCode) && isset($interventionCode))
            	{
            		$result = $this->sendDoItNowEmail($participant, $interventionCode);
            	} else {
            		$result = $this->sendDoItNowEmail($participant);
            	}
                
                if($result['send'] == true){
                    $output->writeln($participant->getParticipantEmail());
                    $output->writeln("sent email");
                } else {
                    if (!empty($result['message']))
                    {
                        $output->writeln($participant->getParticipantEmail());
                        $output->writeln($result['message']);
                    }
                }
            }
            
            $output->writeln("Looking for participants with SMS notification... ");
            if (isset($studyCode) && isset($interventionCode))
                $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')
                ->getParticipantsForSmsNotifications(
                        1, //reminder type
                        $timezone->getParticipantTimezoneId(),  //timezone
                        $periodId, //id of period in timezone
                        $weekDayInTz, //weekday in timezone
                        $studyCode,
                        $interventionCode
                );
            else 
                $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')
                ->getParticipantsForSmsNotifications(
                        1, //reminder type
                        $timezone->getParticipantTimezoneId(),  //timezone
                        $periodId, //id of period in timezone
                        $weekDayInTz //weekday in timezone
                );
            foreach($participants as $participant) {
                if (isset($studyCode) && isset($interventionCode))
                {
                    $result = $this->sendDoItNowSMS($participant, $interventionCode);
                } else {
                    $result = $this->sendDoItNowSMS($participant);
                }
                if($result['send'] == true){
                    $output->writeln($participant->getParticipantUsername()." phone number: ".$participant->getParticipantMobileNumber());
                    $output->writeln("sent sms");
                } else {
                    if (!empty($result['message']))
                    {
                        $output->writeln($participant->getParticipantUsername()." phone number: ".$participant->getParticipantMobileNumber());
                        $output->writeln($result['message']);
                    }
                }
            }
        }
    }
    
    private function sendDoItNowEmail($participant, $interventionCode = null) 
    {
        $cc = $this->getContainer()->get('cyclogram.common');
        $em = $this->getContainer()->get('doctrine')->getManager();
        
        $locale = $participant->getLocale();
        
        $embedded = array();
        $embedded = $cc->getEmbeddedImages();
        
        
	    if(isset($interventionCode))
	        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getNotSendParticipantInterventionLinks($participant, $interventionCode);
	    else
	        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getNotSendParticipantInterventionLinks($participant);
        
        $parameters["interventions"] = array();
        if (!empty($interventionLinks)){
            foreach($interventionLinks as $interventionLink) {
                $sendTime = $interventionLink->getParticipantInterventionLinkSendEmailTime();
                if (!is_null($sendTime))
                    $sendTime = date('W') - $interventionLink->getParticipantInterventionLinkSendEmailTime()->format('W');
                if (is_null($sendTime) || $sendTime == 1 || $sendTime == -51){ 
                
                    $interventionId = $interventionLink->getIntervention()->getInterventionId();
                    $interventionContent = $this->getContainer()->get('doctrine')->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
            
                    $study = $interventionLink->getIntervention()->getStudy();
                    $studyId = $study->getStudyId();
                    $studyContent = $this->getContainer()->get('doctrine')->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContentById($studyId, $locale);
            
                    $intervention = array();
                    $intervention["title"] = $interventionContent->getInterventionTitle();
                    $intervention["content"] = $interventionContent->getInterventionDescripton();
            
                    $intervention["url"] = $this->getInterventionUrl($interventionLink, $locale);
                    $intervention["logo"] = $this->getContainer()->getParameter('study_image_url') . "/" . $studyId . "/" . $studyContent->getStudyLogo();
                    
                    $parameters["interventions"][] = $intervention;
                    if (!isset($interventionCode))
                        $interventionLink->setParticipantInterventionLinkSendEmailTime(new \DateTime());
                    $em->persist($interventionLink);
                    $em->flush();
                }
            }
        
            $parameters['email'] = $participant->getParticipantEmail();
            $parameters['locale'] = $participant->getLocale();
            $parameters['host'] = $this->getContainer()->getParameter('site_url');
            $parameters['siteurl'] = $this->getContainer()->getParameter('site_url').$this->getInterventionUrl($interventionLink, $locale);
            $parameters["studies"] = $this->getContainer()->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
            
            if (!empty($parameters["interventions"])){
                $send = $cc->sendMail(null,
                        $participant->getParticipantEmail(),
                        $this->getContainer()->get('translator')->trans("do_it_task_email_title", array(), "email", $parameters['locale']),
                        'CyclogramFrontendBundle:Email:doitemail.html.twig',
                        null,
                        $embedded,
                        true,
                        $parameters);
                if ($send['status'] == true){
                    
                    return array('send' => true, 'message' => 'sent email');
                } else {
                    return array('send' => false, 'message' => 'email not send');
                }
            } else {
                return array('send' => false, 'message' => 'No intervenion');
            }
        }
    }
    
    private function sendDoItNowSMS($participant, $interventionCode = null) {
        $locale = $participant->getLocale();
        
        $cc = $this->getContainer()->get('cyclogram.common');
        $em = $this->getContainer()->get('doctrine')->getManager();
        
        if(isset($interventionCode))
	        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getNotSendParticipantInterventionLinks($participant, $interventionCode);
	    else
	        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getNotSendParticipantInterventionLinks($participant);
        
        $interventions = array();
        if (!empty($interventionLinks)){
            foreach($interventionLinks as $interventionLink) {
                $sendTime = $interventionLink->getParticipantInterventionLinkSendSmsTime();
                if (!is_null($sendTime))
                    $sendTime = date('W') - $interventionLink->getParticipantInterventionLinkSendSmsTime()->format('W');
                if (is_null($sendTime) || $sendTime == 1 || $sendTime == -51){
                    $interventionId = $interventionLink->getIntervention()->getInterventionId();
                    $interventionContent = $this->getContainer()->get('doctrine')->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
            
                    $study = $interventionLink->getIntervention()->getStudy();
                    $studyId = $study->getStudyId();
                    $studyContent = $this->getContainer()->get('doctrine')->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContentById($studyId, $locale);
            
                    $intervention = array();
                    $interventionTitle = strip_tags($interventionContent->getInterventionName());
                        $interventionUrl = $cc::generateGoogleShorURL($this->getContainer()->getParameter('site_url').$this->getInterventionUrl($interventionLink, $locale));
                        $sms = $this->getContainer()->get('sms');
                        $message = $this->getContainer()->get('translator')->trans('sms_title', array(), 'security', $locale);
                        $sentSms = $sms->sendSmsAction( array('message' => $message .': '. $interventionTitle.' '.$interventionUrl, 'phoneNumber'=> $participant->getParticipantMobileNumber()) );
                        if ($sentSms){
                            if (!isset($interventionCode))
                                $interventionLink->setParticipantInterventionLinkSendSmsTime(new \DateTime());
                            $em->persist($interventionLink);
                            $em->flush();
                            return array('send' => true, 'message' => 'sent sms');
                        } else {
                            return array('send' => false, 'message' => 'sms not send');
                        }
                }
            }
        }
        return array('send' => false, 'message' => '');
    }
    
    
    private function getInterventionUrl($interventionLink, $locale) {
        $intervention = $interventionLink->getIntervention();
    
        $studyCode = $this->getContainer()->get('doctrine')->getRepository('CyclogramProofPilotBundle:Intervention')
        ->getInterventionStudyCode($intervention->getInterventionId());
    
        $typeName = $interventionLink->getIntervention()->getInterventionType()->getInterventionTypeName();
        switch($typeName) {
            case 'Activity':
                return $intervention->getInterventionUrl();
            case 'Survey & Observation':
                $surveyId = $intervention->getSidId();
                $redirectPath = $this->getContainer()->get('router')->generate('_main', array('_locale' => $locale));
                $path = $this->getContainer()->get('router')->generate('_survey_protected', array(
                        '_locale' => $locale,
                        'studyCode' => $studyCode,
                        'surveyId' => $surveyId,
                        'redirectUrl' => urlencode($redirectPath)
    
                ));
                return $path;
    
        }
    }
    

}
