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
namespace Cyclogram\FrontendBundle\Service;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Study;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\CyclogramCommon;
use Common\DefaultParticipantStudy;

class StudyLogic
{
    private $container;
    private $studies;
    

    public function __construct (Container $container)
    {
        $this->container = $container;
        
        $classes = get_declared_classes();
        $studyClasses = array();
        foreach($classes as $class) {
            $reflect = new \ReflectionClass($class);
            if($reflect->implementsInterface('Common\StudyInterface'))
                $studyClasses[] = $class;
        }
        foreach ($studyClasses as $class) {
            $code = $class::getStudyCode();
            $this->studies[$code] = new $class($this->container);
        }
    }
    
    public function getArmCodes($studyCode) {
        return $this->studies[$studyCode]->getArmCodes();
    }
    
    public function getInterventionCodes($studyCode) {
       return $this->studies[$studyCode]->getInterventionCodes();
    }
    
    /**
     * 
     * @param unknown_type $participant
     * @param unknown_type $studyCode
     * @param unknown_type $surveyId
     * @param unknown_type $saveId
     */
    public function studyRegistration($participant, $studyCode, $surveyId, $saveId) 
    {
        $session=$this->container->get('session');
        $em = $this->container->get('doctrine')->getManager();
        $isEnrolled = $em->getRepository("CyclogramProofPilotBundle:Participant")->isEnrolledInStudy($participant, $studyCode);
        if(!$isEnrolled) {
            $uniqId = uniqid();
            $campaignLink = $this->campaignRegistration($participant, $uniqId);
            $this->participantSurveyLinkRegistration($surveyId, $saveId, $participant, $uniqId);
            $this->studies[$studyCode]->studyRegistration($participant,$surveyId, $saveId, $campaignLink);
            $this->studyWelcomeEmail($participant, $studyCode);
            $study = $em->getRepository("CyclogramProofPilotBundle:Study")->findOneByStudyCode($studyCode);
            $studyParticipants = $study->getStudyNumberOfCurrentParticipants();
            $study->setStudyNumberOfCurrentParticipants(++$studyParticipants);
            $em->persist($study);
            $em->flush();
        }
        $session->remove('participantId');
        
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
        
        $session->remove('referralSite');
        $session->remove('referralCampaign');
    
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
        
        return $campaignLink;
    }
    
    public function participantSurveyLinkRegistration($surveyId, $saveId, $participant, $uniqId) {
        
        $em = $this->container->get('doctrine')->getEntityManager();
    
        $participantLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->getParticipantSurveyLink($participant, $surveyId, $saveId);
        $participantLink->setParticipantSurveyLinkElegibility(1);
        $participantLink->setParticipantSurveyLinkUniqid($uniqId);
        $participantLink->setParticipant($participant);
        $participantLink->setSidId($surveyId);
        $participantLink->setSaveId($saveId);
        $participantLink->setStatus(ParticipantSurveyLink::STATUS_CLOSED);

        $em->persist($participantLink);
        $em->flush();
    }

    public function interventionLogic($participant) {
        
        $studies = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')
        ->getEnrolledStudies($participant);
        
        foreach ($studies as $study) {   
                if (in_array($study->getStudyCode(), $this->getSupportedStudies())) {
                    $this->studies[$study->getStudyCode()]->interventionLogic($participant);
                }
        }
    }
    
    public function commandInterventionLogic() {
    
        foreach ($this->studies as $study) {
                $study->commandInterventionLogic();
        }
    }
    
    public function checkEligibility($studyCode, $surveyResult)
    {
        if (in_array($studyCode, $this->getSupportedStudies())) {
            return $this->studies[$studyCode]->checkEligibility($surveyResult);
        } else {
            throw new \Exception("Study code" . $studyCode . "does not implement eligibility logic");
        }
        
    }

    public function getSupportedStudies()
    {
        return array_keys($this->studies);
    }
    public function participantDefaultInterventionLogic($participant, $update = null) {
        $defaultParticipantStudy = new DefaultParticipantStudy($this->container);
        if (!is_null($update))
           $defaultParticipantStudy->participantDefaultInterventionLogic($participant, $update);
        else 
            $defaultParticipantStudy->participantDefaultInterventionLogic($participant);
    }
    
    private function studyWelcomeEmail($participant, $studyCode) {
        $cc = $this->container->get('cyclogram.common');
        $interventionLinks =  $this->container->get('doctrine')->getRepository("CyclogramProofPilotBundle:Study")->getStudyParticipantInterventions($studyCode, $participant);
        $embedded = array();
        $locale = $participant->getLocale();
        $study = $this->container->get('doctrine')->getRepository("CyclogramProofPilotBundle:Study")->findOneByStudyCode($studyCode);
        $studyContent = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContentById($study->getStudyId(), $locale);
        $parameters['study_logo'] = $this->container->getParameter('study_image_url') . '/' .$study->getStudyId(). '/' .$studyContent->getStudyGraphic();
        $parameters['studyName'] = $studyContent->getStudyName(); 
        $parameters['studyInvolved'] = $studyContent->getStudyWhatsInvolved();
        if (!empty($interventionLinks)){
            foreach($interventionLinks as $interventionLink) {
                $interventionId = $interventionLink->getIntervention()->getInterventionId();
                $interventionContent = $this->container->get('doctrine')->getRepository("CyclogramProofPilotBundle:Intervention")->getInterventionContent($interventionId, $locale);
                $intervention = array();
                $intervention["title"] = $interventionContent->getInterventionTitle();
                $intervention["content"] = $interventionContent->getInterventionDescripton();
    
                $intervention["url"] =  $this->container->getParameter('site_url').$this->getInterventionUrl($interventionLink, $locale);
                $intervention["logo"] = $this->container->getParameter('study_image_url') . "/" . $study->getStudyId() . "/" . $studyContent->getStudyLogo();
                $parameters["interventions"][] = $intervention;
            }
        }
        $embedded = $cc->getEmbeddedImages();
        $parameters['email'] = $participant->getParticipantEmail();
        $parameters['locale'] = $locale;
        $parameters['host'] = $this->container->getParameter('site_url');
        $parameters["studies"] = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);

    
        $cc->sendMail(null,
                $participant->getParticipantEmail(),
                $this->container->get('translator')->trans("welcome_to_study", array(), "email", $parameters['locale'])." ". $parameters['studyName'],
                'CyclogramFrontendBundle:Email:study_welcome.html.twig',
                null,
                $embedded,
                true,
                $parameters);
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
    
}
