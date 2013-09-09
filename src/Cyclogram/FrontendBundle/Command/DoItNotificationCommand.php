<?php
namespace Cyclogram\FrontendBundle\Command;

use Cyclogram\CyclogramCommon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DoItNotificationCommand extends ContainerAwareCommand
{
    protected function configure(){
        
        $this->setName('send:doitnotification')
        ->setDescription('Send email with doit tasks');
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
            $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')
                ->getParticipantsForEmailNotifications(
                        1, //reminder type
                        $timezone->getParticipantTimezoneId(),  //timezone   
                        $periodId, //id of period in timezone
                        $weekDayInTz //weekday in timezone
                    );
            foreach($participants as $participant) {
                $output->writeln($participant->getParticipantEmail()); 
                $result = $this->sendDoItNowEmail($participant);
                if($result)
                    $output->writeln("sent email");
                else
                    $output->writeln("email not sent");
            }
            
            $output->writeln("Looking for participants with SMS notification... ");
            $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')
            ->getParticipantsForSmsNotifications(
                    1, //reminder type
                    $timezone->getParticipantTimezoneId(),  //timezone
                    $periodId, //id of period in timezone
                    $weekDayInTz //weekday in timezone
            );
            foreach($participants as $participant) {
                $output->writeln($participant->getParticipantUsername()." phone number: ".$participant->getParticipantMobileNumber());
                $result = $this->sendDoItNowSMS($participant);
                if($result)
                    $output->writeln("sent sms");
                else
                    $output->writeln("sms not sent");
            }
            
            $output->writeln("\n");
        }
    }
    
    private function sendDoItNowEmail($participant) 
    {
        $cc = $this->getContainer()->get('cyclogram.common');
        $em = $this->getContainer()->get('doctrine')->getManager();
        
        $locale = $participant->getLanguage();
        
        $embedded['logo_top'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
        $embedded['logo_footer'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
        $embedded['login_button'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
        $embedded['white_top'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_white_top.png");
        $embedded['white_bottom'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_white_bottom.png");
        
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventionLinks($participant);
        
        $parameters["interventions"] = array();
        if (!empty($interventionLinks)){
            foreach($interventionLinks as $interventionLink) {
        
                $interventionId = $interventionLink->getIntervention()->getInterventionId();
                $interventionContent = $this->getContainer()->get('doctrine')->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
        
                $study = $interventionLink->getIntervention()->getStudy();
                $studyId = $study->getStudyId();
                $studyContent = $this->getContainer()->get('doctrine')->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudyId($studyId);
        
                $intervention = array();
                $intervention["title"] = $interventionContent->getInterventionTitle();
                $intervention["content"] = $interventionContent->getInterventionDescripton();
        
                $intervention["url"] = $this->getInterventionUrl($interventionLink, $locale);
                $intervention["logo"] = $this->getContainer()->getParameter('study_image_url') . "/" . $studyId . "/" . $studyContent->getStudyLogo();
        
                if($interventionLink->getStatus()->getStatusName() != "Active" ) {
                    $intervention["status"] = "Completed";
                } else {
                    $intervention["status"] = "Enabled";
                }
                $parameters["interventions"][] = $intervention;
                $user = $this->getContainer()->get('security.context')->getToken();
            }
        
            $parameters['email'] = $participant->getParticipantEmail();
            $parameters['locale'] = $participant->getLanguage();
            $parameters['host'] = $this->getContainer()->getParameter('site_url');
            $parameters['siteurl'] = $this->getContainer()->getParameter('site_url').$this->getContainer()->get('router')->generate('_login', array('_locale' => $locale,
                    'surveyUrl' => urlencode($this->getInterventionUrl($interventionLink, $locale))));
        
            $send = $cc->sendMail(
                    $participant->getParticipantEmail(),
                    $this->getContainer()->get('translator')->trans("do_it_task_email_title", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:doitemail.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
            if ($send) 
                return true;
        } else {
            return false;
        }

    }
    
    private function sendDoItNowSMS($participant) {
        $locale = $participant->getLanguage();
        
        $cc = $this->getContainer()->get('cyclogram.common');
        $em = $this->getContainer()->get('doctrine')->getManager();
        
        $locale = $participant->getLanguage();
        
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventionLinks($participant);
        
        $interventions = array();
        if (!empty($interventionLinks)){
            foreach($interventionLinks as $interventionLink) {
                $interventionId = $interventionLink->getIntervention()->getInterventionId();
                $interventionContent = $this->getContainer()->get('doctrine')->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
        
                $study = $interventionLink->getIntervention()->getStudy();
                $studyId = $study->getStudyId();
                $studyContent = $this->getContainer()->get('doctrine')->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudyId($studyId);
        
                $intervention = array();
                $interventionTitle = strip_tags($interventionContent->getInterventionName());
        
                $interventionUrl = $cc::generateGoogleShorURL($this->getContainer()->getParameter('site_url').$this->getContainer()->get('router')->generate('_login', array('_locale' => $locale,
                        'surveyUrl' => urlencode($this->getInterventionUrl($interventionLink, $locale)))));
                $sms = $this->getContainer()->get('sms');
                $message = $this->getContainer()->get('translator')->trans('You have active doit task: ', array(), 'security', $locale);
                $sentSms = $sms->sendSmsAction( array('message' => $message .' '. $interventionTitle.' '.$interventionUrl, 'phoneNumber'=> $participant->getParticipantMobileNumber()) );
                return $sentSms;
            }
        }
        return false;
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
                $path = $this->getContainer()->get('router')->generate('_survey', array(
                        '_locale' => $locale,
                        'studyCode' => $studyCode,
                        'surveyId' => $surveyId,
                        'redirectUrl' => urlencode($redirectPath)
    
                ));
                return $path;
    
        }
    }
    

}
