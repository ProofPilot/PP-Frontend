<?php
namespace Cyclogram\FrontendBundle\Command;

use Cyclogram\CyclogramCommon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DoItSmsCommand extends ContainerAwareCommand
{
    protected function configure(){
    
        $this->setName('send:doitsms')
        ->addArgument('sendTime', InputArgument::REQUIRED, 'send time')
        ->setDescription('Send sms with doit tasks');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $time = $input->getArgument('sendTime');
         
        $cc = $this->getContainer()->get('cyclogram.common');
        $em = $this->getContainer()->get('doctrine')->getManager();
    
        $smsReminders = $em->getRepository('CyclogramProofPilotBundle:ParticipantStudyReminderLink')->findBy(array('participantStudyReminder' => 2,'bySMS' =>1));
        $participants = array();
        foreach ($smsReminders as $reminder) {
            $participants[] = $reminder->getParticipant();
        }
        
        foreach ($participants as $participant){
            $locale = $participant->getLanguage();
            $participantContactWeekDayLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactWeekdayLink')->findBy(array('weekdayId' => date( "w"), 'participant' => $participant));
            foreach ($participantContactWeekDayLinks as $participantDay){
                $participantContactTimeLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTimeLink')->findOneByParticipant($participantDay->getParticipant());
                $contactTime = $participantContactTimeLink->getParticipantContactTime()->getParticipantContactTimesName();

                if ($time == $contactTime) {
                    $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventionLinks($participant);

                    $interventions = array();
                    if (!empty($interventionLinks)){
                        foreach($interventionLinks as $interventionLink) {
                            if($interventionLink->getStatus()->getStatusName() == "Active" ){
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
                            }
                        }
                        
                    }
                }
               
            }
        }
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
