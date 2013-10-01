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
namespace Common;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Study;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\CyclogramCommon;

class KAHStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes() {
        return array('Phase3Default');
    }
    
    public function getInterventionCodes() {
        return array('KAHPhase3Baseline','KAHPhase3TestPackage', 'KAHPhase3ReportResults',
                'KAHPhase3FollowUp');
    }
    
    public function studyRegistration($participant, $surveyId, $saveId) {
        $em = $this->container->get('doctrine')->getEntityManager();
        //Add participants to Default Arm at the moment.
        $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('Phase3Default');
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
        
        $status = $em->getRepository('CyclogramProofPilotBundle:Status')
        ->find(1);
        $participantInterventionLink = new ParticipantInterventionLink();
        $intervention = $em
        ->getRepository('CyclogramProofPilotBundle:Intervention')
        ->findOneByInterventionCode('KAHPhase3Baseline');
        $participantInterventionLink->setIntervention($intervention);
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink
        ->setParticipantInterventionLinkDatetimeStart(
                new \DateTime("now"));
        $participantInterventionLink->setStatus($status);
        $em->persist($participantInterventionLink);
        $em->flush($participantInterventionLink);
    }
    
    public function interventionLogic($participant) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($this->getStudyCode());
        $participantArm = $em->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')
                ->getParticipantStudyArm($participant, $study);
        $participantArmName = $participantArm->getArm()->getArmName();
        //get all participant intervention links
        $interventionLinks = $em
                ->getRepository('CyclogramProofPilotBundle:Participant')
                ->getParticipantInterventionLinks($participant, $study);
        foreach ($interventionLinks as $interventionLink) {
            $interventionCode = $interventionLink->getIntervention()
                    ->getInterventionCode();
            $intervention = $interventionLink->getIntervention();
            $status = $interventionLink->getStatus()->getStatusName();
            switch ($interventionCode) {
            case "KAHPhase3Baseline":
                $surveyId = $intervention->getSidId();
                if ($status == "Active") {
                    $passed = $em
                        ->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                        ->checkIfSurveyPassed($participant, $surveyId);
                    
                    if ($passed) {
                        $this->createIncentive($participant, $intervention);
                        $completedStatus = $em->getRepository('CyclogramProofPilotBundle:Status')
                                ->findOneByStatusName("Closed");
                        $interventionLink->setStatus($completedStatus);
                        $em->persist($interventionLink);
                        $em->flush();
                        $status = "Closed";
                    }
                }
                if (($status == "Closed") && ($intervention->getInterventionName() == "KAHPhase3Baseline")) {
                    $intervention = $em
                        ->getRepository('CyclogramProofPilotBundle:Intervention')
                        ->findOneByInterventionCode("KAHPhase3TestPackage");
                    $em->getRepository('CyclogramProofPilotBundle:Participant')
                        ->addParticipantInterventionLink($participant,$intervention);
                    }
            }
        }
    }
    
    public function checkEligibility($surveyResult) {
        return true;
    }

    public static function getStudyCode()
    {
        return 'knowathome';
    }
}
