<?php
namespace Cyclogram\FrontendBundle\Service;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Study;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\CyclogramCommon;

class StudyLogic
{
    private $container;
    
    public function __construct (Container $container)
    {
        $this->container = $container;
    }
    
    private function knowAtHomeRegistration ($participant, $surveyId, $saveId) {
        
        
        //insert participant_campaign_link
        $em = $this->container->get('doctrine')->getEntityManager();
        $campaignRepo = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Campaign');
        $campaign = $campaignRepo->find(1);
        
        $participantLevelRepo = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:ParticipantLevel');
        $participantLevel = $participantLevelRepo->find( 2 );
        
        //Campaign
        $ParticipantCampaignLinkCountData =  $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:ParticipantCampaignLink')
        ->findBy( array("participantCampaignLinkParticipantEmail"=>$participant->getParticipantEmail()) );
        
        $ParticipantCampaignLinkCount = ( is_array($ParticipantCampaignLinkCountData) ) ? count($ParticipantCampaignLinkCountData) : 0;
        
        $participantCampaignLinkId = CyclogramCommon::generateParticipantCampaignLinkID(
                $participantLevel->getParticipantLevelId(),
                $participant->getParticipantId(),
                $campaign->getCampaignId(),
                $ParticipantCampaignLinkCount
        );
        
        $uniqId = uniqid();
        
        //ParticipantCampaignLink
        $campaignLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantCampaignLink();
        $campaignLink->setParticipant( $participant );
        $campaignLink->setCampaign( $campaign );
        $campaignLink->setParticipantLevel( $participantLevel );
        $campaignLink->setParticipantSurveyLinkUniqid( $uniqId );
        $campaignLink->setParticipantCampaignLinkId( $participantCampaignLinkId );
        $campaignLink->setParticipantCampaignLinkParticipantEmail( $participant->getParticipantEmail() );
        $campaignLink->setParticipantCampaignLinkIpAddress( $_SERVER['REMOTE_ADDR'] );
        $campaignLink->setParticipantCampaignLinkDatetime( new \DateTime("now") );
        
        $em->persist( $campaignLink );
        $em->flush();
        
        $this->participantSurveyLinkRegistration($surveyId, $saveId, $participant, $uniqId);
        
        //Add participants to Default Arm at the moment.
        $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->find( 5 );
        $armData = ( ! is_null( $armData )  ) ? $armData : false;
        
        $armStatus = $em->getRepository('CyclogramProofPilotBundle:Status')->find( 1 );
        $armStatus = ( ! is_null( $armStatus ) ) ? $armStatus : false;
        
        $ArmParticipantLink = null;
        if( $armData ){
            $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
            $ArmParticipantLink->setArm($armData);
            $ArmParticipantLink->setParticipant($participant);
            $ArmParticipantLink->setStatus($armStatus);
            $ArmParticipantLink->setParticipantArmLinkDatetime( new \DateTime("now") );
        }
        $em->persist($ArmParticipantLink);
        
        $em->flush();
    }
    
    private function sexproRegistration($participant, $surveyId, $saveId) {
        
        $em = $this->container->get('doctrine')->getEntityManager();
        //insert participant_campaign_link
        $campaignRepo = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Campaign');
        $campaign = $campaignRepo->find(4);
        
        $participantLevelRepo = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:ParticipantLevel');
        $participantLevel = $participantLevelRepo->find( 2 );
        
        //Campaign
        $ParticipantCampaignLinkCountData =  $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:ParticipantCampaignLink')
        ->findBy( array("participantCampaignLinkParticipantEmail"=>$participant->getParticipantEmail()) );
        
        $ParticipantCampaignLinkCount = ( is_array($ParticipantCampaignLinkCountData) ) ? count($ParticipantCampaignLinkCountData) : 0;
        
        $participantCampaignLinkId = CyclogramCommon::generateParticipantCampaignLinkID(
                $participantLevel->getParticipantLevelId(),
                $participant->getParticipantId(),
                $campaign->getCampaignId(),
                $ParticipantCampaignLinkCount
        );
        
        $uniqId = uniqid();
        
        //ParticipantCampaignLink
        $campaignLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantCampaignLink();
        $campaignLink->setParticipant( $participant );
        $campaignLink->setCampaign( $campaign );
        $campaignLink->setParticipantLevel( $participantLevel );
        $campaignLink->setParticipantSurveyLinkUniqid( $uniqId );
        $campaignLink->setParticipantCampaignLinkId( $participantCampaignLinkId );
        $campaignLink->setParticipantCampaignLinkParticipantEmail( $participant->getParticipantEmail() );
        $campaignLink->setParticipantCampaignLinkIpAddress( $_SERVER['REMOTE_ADDR'] );
        $campaignLink->setParticipantCampaignLinkDatetime( new \DateTime("now") );
        
        $em->persist( $campaignLink );
        $em->flush();
        
        $this->participantSurveyLinkRegistration($surveyId, $saveId, $participant, $uniqId);
        
        $surveyId = 468727;
        $sexProBaselineArm = 'SexProBaseLine';
        $sexPro3MonthArm = 'SexPro3Month';
        
        $em = $this->container->get('doctrine')->getEntityManager();
        $participantSurveyLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->findOneBySaveId($saveId);
        if (isset($participantSurveyLink)) {
            $saveId = $participantSurveyLink->getSaveId();
            
            $lem = $this->container->get('doctrine')->getEntityManager('limesurvey');
            $participantSurvey = $lem->getRepository('CyclogramProofPilotBundleLime:LimeSurvey468727')->find($saveId);
            
            $surveyAge = $participantSurvey->getAge();
            $surveyCity = $participantSurvey->getLocation();
            
            switch ($surveyCity){
                case 'A1':
                    $cityName = 'San Francisco';
                    break;
                case 'A2':
                    $cityName = 'New York';
                    break;
                case 'A3': 
                    $cityName = 'Lima';
                    break;
                case 'A4':
                    $cityName = 'Rio de Janiero';
                    break;
            }
            
            $participant->setLocation($cityName);
            $participant->setAge($surveyAge);
            $em->persist($participant);
            $em->flush($participant);
            
            if ($surveyAge < 30){
                $minAge = 18;
                $maxAge = 30;
            } else {
                $minAge = 31;
                $maxAge = 90;
            }
            $firstArmParticipants = $em->getRepository('CyclogramProofPilotBundle:Participant')->countArmByCityAge($sexProBaselineArm, $cityName, $minAge, $maxAge);
            $secondArmParticipants = $em->getRepository('CyclogramProofPilotBundle:Participant')->countArmByCityAge($sexPro3MonthArm, $cityName, $minAge, $maxAge);
            $firstArm = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmName($sexProBaselineArm);
            $secondArm = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmName($sexPro3MonthArm);
            
            $participantArmLink = new ParticipantArmLink();
            if ($firstArmParticipants <= $secondArmParticipants){
                $participantArmLink->setArm($firstArm);
            } else {
                $participantArmLink->setArm($secondArm);
            }
            $participantArmLink->setParticipant($participant);
            $status = $em->getRepository('CyclogramProofPilotBundle:Status')->find(1);
            $participantArmLink->setStatus($status);
            $participantArmLink->setParticipantArmLinkDatetime(new \DateTime());
            $em->persist($participantArmLink);
            $em->flush($participantArmLink);
            
            $participantInterventionLink = new ParticipantInterventionLink();
            $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionName('SexPro Baseline Survey');
            $participantInterventionLink->setIntervention($intervention);
            $participantInterventionLink->setParticipant($participant);
            $participantInterventionLink->setParticipantInterventionLinkDatetimeStart( new \DateTime("now") );
            $participantInterventionLink->setStatus($status);
            $em->persist($participantInterventionLink);
            $em->flush($participantInterventionLink);
        }
    }

    private function kOcSocialMediaRegistration($participant, $surveyId=null, $saveId=null){

        $em = $this->container->get('doctrine')->getEntityManager();
        $campaignRepo = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Campaign');
        $campaign = $campaignRepo->find(12);

        $participantLevelRepo = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:ParticipantLevel');
        $participantLevel = $participantLevelRepo->find( 2 );

        //Campaign
        $ParticipantCampaignLinkCountData =  $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:ParticipantCampaignLink')
            ->findBy( array("participantCampaignLinkParticipantEmail"=>$participant->getParticipantEmail()) );

        $ParticipantCampaignLinkCount = ( is_array($ParticipantCampaignLinkCountData) ) ? count($ParticipantCampaignLinkCountData) : 0;

        $participantCampaignLinkId = CyclogramCommon::generateParticipantCampaignLinkID(
            $participantLevel->getParticipantLevelId(),
            $participant->getParticipantId(),
            $campaign->getCampaignId(),
            $ParticipantCampaignLinkCount
        );

        $uniqId = uniqid();
        
        //ParticipantCampaignLink
        $campaignLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantCampaignLink();
        $campaignLink->setParticipant( $participant );
        $campaignLink->setCampaign( $campaign );
        $campaignLink->setParticipantLevel( $participantLevel );
        $campaignLink->setParticipantSurveyLinkUniqid( $uniqId );
        $campaignLink->setParticipantCampaignLinkId( $participantCampaignLinkId );
        $campaignLink->setParticipantCampaignLinkParticipantEmail( $participant->getParticipantEmail() );
        $campaignLink->setParticipantCampaignLinkIpAddress( $_SERVER['REMOTE_ADDR'] );
        $campaignLink->setParticipantCampaignLinkDatetime( new \DateTime("now") );

        $em->persist( $campaignLink );
        $em->flush();

        //participant intervention link
        $activeStatus = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Status')->find(12);
        $intervention = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Intervention')->find(9);

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setStatus($activeStatus);
        $participantInterventionLink->setIntervention($intervention);
        $participantInterventionLink->setParticipantInterventionLinkDatetimeStart( new \DateTime("now") );
        $participantInterventionLink->setParticipantInterventionLinkName("");

        $em->persist($participantInterventionLink);
        $em->flush();
    }
    
    public function studyRegistration($participant, $studyId, $surveyId, $saveId) {
        
        switch($studyId) {
            case 7:
                $this->sexproRegistration($participant, $surveyId, $saveId);
                break;
            case 1:
                $this->knowAtHomeRegistration($participant, $surveyId, $saveId);
                break;
            case 12:
                $this->kOcSocialMediaRegistration($participant, $surveyId, $saveId);
                break;
        }
        
    }
    
    public function participantSurveyLinkRegistration($surveyId, $saveId, $participant, $uniqId) {
        $em = $this->container->get('doctrine')->getEntityManager();
        
        $participantLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->getParticipantSurveyLink($participant, $surveyId, $saveId);
        $participantLink->setParticipantSurveyLinkElegibility(1);
        $participantLink->setParticipantSurveyLinkUniqid($uniqId);
        $participantLink->setParticipant($participant);
        $participantLink->setSidId($surveyId);
        $participantLink->setSaveId($saveId);
        
        
        
        $em->persist($participantLink);
        $em->flush($participantLink);
    }
    
    public function interventionLogic($participant) {
        
        $studies = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')
        ->getEnrolledStudies($participant);
        
        foreach ($studies as $study) {
            switch($study->getStudyId()) {
                case 7:
                    $this->sexProInterventionLogic($participant);
                    break;
                default:
                    break;
            }
        }
    }
    
    private function sexProInterventionLogic($participant) {
        $em = $this->container->get('doctrine')->getEntityManager();
        //get all participant intervention links
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:Participant')->getParticipantInterventionLinks($participant);
        foreach($interventionLinks as $interventionLink) {
            $interventionTypeName = $interventionLink->getIntervention()->getInterventionType()->getInterventionTypeName();
            $intervention = $interventionLink->getIntervention();
            $status = $interventionLink->getStatus()->getStatusName();
            switch($interventionTypeName) {
                case "Survey & Observation":
                    $surveyId = $intervention->getSidId();
                    if($status == "Active") {
                        $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->checkIfSurveyPassed($participant, $surveyId);
                        
                        if($passed) {
                            $completedStatus = $em->getRepository('CyclogramProofPilotBundle:Status')->findOneByStatusName("Closed");
                            $interventionLink->setStatus($completedStatus);
                            $em->persist($interventionLink);
                            $em->flush();
                            $status = "Closed";
                        }
                    }
                    
                    if(($status == "Closed") && ($intervention->getInterventionName() == "SexPro Baseline Survey")) {
                        $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionName("SexPro Activity");
                        $em->getRepository('CyclogramProofPilotBundle:Participant')->addParticipantInterventionLink($participant, $intervention);
                    }

                    break;
                case "Activity":
                    break;
            }


        }
        
        
    }
    
}
