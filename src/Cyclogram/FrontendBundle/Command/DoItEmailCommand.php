<?php
namespace Cyclogram\FrontendBundle\Command;

use Cyclogram\CyclogramCommon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DoItEmailCommand extends ContainerAwareCommand
{
    protected function configure(){
        
        $this->setName('send:doitemail')
        ->setDescription('Send email with doit tasks');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
//         $participantId = $input->getArgument('participantId');
       
        $cc = $this->getContainer()->get('cyclogram.common');
        $em = $this->getContainer()->get('doctrine')->getManager();
        $time = date('H:i');
        
        $embedded['logo_top'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_logo.png");
        $embedded['logo_footer'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newletter_logo_footer.png");
        $embedded['login_button'] = realpath($this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/newsletter_small_login.jpg");
        
        $participantContactWeekDayLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactWeekdayLink')->findByWeekdayId(date( "w"));
        foreach ($participantContactWeekDayLinks as $participantDay){
            $participantContactTimeLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantContactTimeLink')->findOneByParticipant($participantDay->getParticipant());
            $conatctTime = null;
            switch ($participantContactTimeLink->getParticipantContactTime()->getParticipantContactTimesName()){
                case 'time_early_am':
                    $contactTime = '5:00';
                    break;
                case 'time_morning':
                    $contactTime = '09:00';
                    break;
                case 'time_afternoon':
                    $contactTime = $time;
                    break;
                case 'time_early_evening':
                    $contactTime = '17:00';
                    break;
                case 'time_night':
                     $contactTime = '21:00';
                     break;
                case 'time_late_night':
                     $contactTime = '01:00';
                     break;
            }
            
          if ($time == $contactTime) {
              $participant = $participantDay->getParticipant();
              $locale = $participant->getLanguage();
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
                  if ($send) $output->writeln("send");
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
