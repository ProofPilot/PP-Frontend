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
    
    private $supportedStudies = array(
            'sexpro',
            'koc',
            'kocsocialmedia'
            );

    public function __construct (Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * Check if system supports the study
     * @param unknown_type $studyCode
     */
    public function supports($studyCode) {
        return in_array(strtolower($studyCode), $this->supportedStudies) ? true : false;
    }
    
    public function getArmCodes($studyCode) {
        
        
        switch($studyCode) {
            case 'sexpro':
                return array('SexProBaseLine','SexPro3Month');
                break;
            case 'kah':
                return array('eStamp3');
                break;
            case 'koc':
                return array('KocOnline');
                break;
            case 'kocsocialmedia':
                return array('KOCSMDefault');
                break;
        }
    }
    
    public function getInterventionCodes($studyCode) {
    
    
        switch($studyCode) {
            case 'sexpro':
                return array('SexProBaselineSurvey', 'SexProActivity', 'SexPro3MonthFollowUpSurvey');
                break;
            case 'kah':
                return array();
                break;
            case 'koc':
                return array('KocBaseline', 'LocalTechUseSurvey', 'KOCCondomPickupSurvey', 'KOCFollowUpSurvey' );
                break;
            case 'kocsocialmedia':
                return array('KOCSocialMediaSurvey');
                break;
        }
    }
    
    /**
     * 
     * @param unknown_type $participant
     * @param unknown_type $studyCode
     * @param unknown_type $surveyId
     * @param unknown_type $saveId
     */
    public function studyRegistration($participant, $studyCode, $surveyId, $saveId) {
    
        $uniqId = uniqid();
        $this->campaignRegistration($participant, $uniqId);
        $this->participantSurveyLinkRegistration($surveyId, $saveId, $participant, $uniqId);
    
        switch($studyCode) {
            case 'sexpro':
                $this->sexproRegistration($participant, $surveyId, $saveId);
                break;
            case 'kah':
                $this->knowAtHomeRegistration($participant, $surveyId, $saveId);
                break;
            case 'koc':
                $this->kOcRegistration($participant, $surveyId, $saveId);
                break;
            case 'kocsocialmedia':
                $this->kOcSocialMediaRegistration($participant, $surveyId, $saveId);
                break;
        }
    
    }
    
    /**
     * Link participant with campaign
     * @param unknown_type $participant
     * @param unknown_type $uniqId
     */
    private function campaignRegistration($participant, $uniqId)
    {
        $session = $this->container->get('session');
    
        $siteId = $session->get('referralSite');
        $campaignId = $session->get('referralCampaign');
    
        if(!$siteId || !$campaignId )
            throw new \Exception("Could not reliably determine campaign and site from session. Cancelling registration");
    
    
        $em = $this->container->get('doctrine')->getEntityManager();
    
    
        $campaign = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Campaign')->find($campaignId);
        $site = $em->getRepository('CyclogramProofPilotBundle:Site')->find($siteId);
    
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
        if($site)
            $campaignLink->setSite( $site );

        $em->persist( $campaignLink );
        $em->flush();
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
    
    private function sexproRegistration($participant, $surveyId, $saveId) 
    {

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
            $firstArmParticipants = $em->getRepository('CyclogramProofPilotBundle:Participant')->countArmByCityAge('SexProBaseLine', $cityName, $minAge, $maxAge);
            $secondArmParticipants = $em->getRepository('CyclogramProofPilotBundle:Participant')->countArmByCityAge('SexPro3Month', $cityName, $minAge, $maxAge);
            $firstArm = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('SexProBaseLine');
            $secondArm = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('SexPro3Month');
    
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
    
    
    
    private function knowAtHomeRegistration ($participant, $surveyId, $saveId) 
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        
        //Add participants to Default Arm at the moment.
        $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('eStamp3');
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
    


    private function kOcRegistration($participant, $surveyId=null, $saveId=null){
       
        $em = $this->container->get('doctrine')->getEntityManager();
        
        $participantArmLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
        $participantArmLink->setParticipant($participant);
        $participantArmLink->setStatus( $em->getRepository('CyclogramProofPilotBundle:Status')->find(1) );
        $participantArmLink->setParticipantArmLinkDatetime( new \DateTime("now") );
        $participantArmLink->setArm( $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('KOCOnline'));

        $em->persist($participantArmLink);
        $em->flush();

        $timeNow = new \DateTime("now");

        //create interventions
        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setStatus( $em->getRepository('CyclogramProofPilotBundle:Status')->find(1) );
        $participantInterventionLink->setIntervention( $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('KOCBaseline') );
        $participantInterventionLink->setParticipantInterventionLinkDatetimeStart( $timeNow );
        $participantInterventionLink->setParticipantInterventionLinkName("");
        $em->persist($participantInterventionLink);
        $em->flush();

        //One day after
        $timeNowPlusOneDay = new \DateTime( date("Y-m-d", strtotime("+1 day", $timeNow->format("U")))." 00:00:00" );
        //3 days from registration
        $timeNowPlusThreeDay = new \DateTime( date("Y-m-d", strtotime("+3 day", $timeNow->format("U")))." 00:00:00" );
        //30 days from registration
        $timeNowPlusThirtyDay = new \DateTime( date("Y-m-d", strtotime("+30 day", $timeNow->format("U")))." 00:00:00" );

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setStatus( $em->getRepository('CyclogramProofPilotBundle:Status')->find(1) );
        $participantInterventionLink->setIntervention( $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('LocalTechUseSurvey') );
        $participantInterventionLink->setParticipantInterventionLinkName("");
        //One day after
        $participantInterventionLink->setParticipantInterventionLinkDatetimeStart( $timeNowPlusOneDay );
        $participantInterventionLink->setParticipantInterventionLinkDatetimeEnd( $timeNowPlusThreeDay );
        $em->persist($participantInterventionLink);
        $em->flush();

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setStatus( $em->getRepository('CyclogramProofPilotBundle:Status')->find(1) );
        $participantInterventionLink->setIntervention( $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('KOCCondomPickupSurvey') );
        $participantInterventionLink->setParticipantInterventionLinkName("");
        //3 days from registration
        $participantInterventionLink->setParticipantInterventionLinkDatetimeStart( $timeNowPlusThreeDay );
        $participantInterventionLink->setParticipantInterventionLinkDatetimeEnd( $timeNowPlusThirtyDay );
        $em->persist($participantInterventionLink);
        $em->flush();

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setStatus( $em->getRepository('CyclogramProofPilotBundle:Status')->find(1) );
        $participantInterventionLink->setIntervention( $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('KOCFollowUpSurvey') );
        $participantInterventionLink->setParticipantInterventionLinkName("");
        //30 days from registration
        $participantInterventionLink->setParticipantInterventionLinkDatetimeStart( $timeNowPlusThirtyDay );
        //$participantInterventionLink->setParticipantInterventionLinkDatetimeEnd();
        $em->persist($participantInterventionLink);
        $em->flush();
    }

    private function kOcSocialMediaRegistration($participant, $surveyId=null, $saveId=null)
    {

        $em = $this->container->get('doctrine')->getEntityManager();

        //participant intervention link
        $activeStatus = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Status')->find(1);
        $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('KOCSocialMediaSurvey');

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setStatus($activeStatus);
        $participantInterventionLink->setIntervention($intervention);
        $participantInterventionLink->setParticipantInterventionLinkDatetimeStart( new \DateTime("now") );
        $participantInterventionLink->setParticipantInterventionLinkName("");

        $em->persist($participantInterventionLink);
        $em->flush();

        $participantArmLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
        $participantArmLink->setParticipant($participant);
        $participantArmLink->setStatus($activeStatus);
        $participantArmLink->setParticipantArmLinkDatetime( new \DateTime("now") );
        $participantArmLink->setArm( $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('KOCSMDefault'));

        $em->persist($participantArmLink);
        $em->flush();

        $this->participantSurveyLinkRegistration($surveyId, $saveId, $participant, $uniqId);
    }
    

    public function interventionLogic($participant) {
        
        $studies = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')
        ->getEnrolledStudies($participant);
        
        foreach ($studies as $study) {
            switch($study->getStudyCode()) {
                case 'sexpro':
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
    
    public function checkEligibility($studyCode, $surveyResult)
    {
        switch($studyCode){
            case 'koc':
                $KoCEligible = $this->getKoCEligibilityriteria($surveyResult);
                if( $KoCEligible ){
                    return true;
                }else{
                    return false;
                }
                break;
            case 'kocsocialmedia':
                $KoCSMEligible = $this->getKoCSocialMediaEligibilityriteria($surveyResult);
                if( $KoCSMEligible ){
                    return true;
                }else{
                    return false;
                }
                break;
            default:
               return true; //For all other studies at the moment we always assume user is eligible 
        }
    }
    
    
    
    /**
     * Determine KoC Social Media Eligibility
     * @param unknown_type $surveyResponse
     */
    private function getKoCSocialMediaEligibilityriteria($surveyResponse){
        $isEligible = true;
        $reason = array();
    
        if( isset($surveyResponse['382539X701X6985']) && intval($surveyResponse['382539X701X6985']) < 18 ){
            $isEligible = false;
            $reason[] = "Less than 18 years";
        }
    
        if( isset($surveyResponse['382539X701X6987']) && $surveyResponse['382539X701X6987'] != "A1" ){
            $isEligible = false;
            $reason[] = "Sex not male";
        }
    
        if( isset($surveyResponse['382539X701X6984']) &&  ! in_array($surveyResponse['382539X701X6984'], array("A1","A2","A3","A4","A5","A6","A7"))){
            $isEligible = false;
            $reason[] = "Parish is other";
        }
    
        if( isset($surveyResponse['382539X701X6986SQ003']) && $surveyResponse['382539X701X6986SQ003'] != "Y" ){
            $isEligible = false;
            $reason[] = "Race Not Black/African American";
        }
    
        if( isset($surveyResponse['382539X701X6988SQ005']) && $surveyResponse['382539X701X6988SQ005'] == "Y" ){
            $isEligible = false;
            $reason[] = "No sex in the last 12 months";
        }
    
        return $isEligible;
    }
    
    /**
     * Determine KoC Eligibility
     * @param unknown_type $surveyResponse
     * @return boolean
     */
    private function getKoCEligibilityriteria($surveyResponse){
        $isEligible = true;
        $reason = array();
    
        if( isset($surveyResponse['362142X497X4260']) && ! in_array($surveyResponse['362142X497X4260'], array("A1","A2","A3","A4","A5","A6","A7")) ){
            $isEligible = false;
            $reason[] = "Parish";
        }
    
        if( isset($surveyResponse['362142X497X4265']) && $surveyResponse['362142X497X4265'] != "A1" ){
            $isEligible = false;
            $reason[] = "Gender";
        }
    
        if( isset($surveyResponse['362142X497X4269SQ005']) && $surveyResponse['362142X497X4269SQ005'] == "Y" ){
            $isEligible = false;
            $reason[] = "Sex in last 12 months with a male";
        }
    
        if( isset($surveyResponse['362142X497X4263SQ003']) && $surveyResponse['362142X497X4263SQ003'] != "Y" ){
            $isEligible = false;
            $reason[] = "Race not African American/Black";
        }
    
        return $isEligible;
    }
    

    public function getSupportedStudies()
    {
        return $this->supportedStudies;
    }

    public function setSupportedStudies($supportedStudies)
    {
        $this->supportedStudies = $supportedStudies;
    }
}
