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
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\CyclogramCommon;

class PledgeToTestStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes()
    {
        return array('Apledge');
    }
    public function getInterventionCodes()
    {
        return array('Pledge', 'MISurvey', 'Site');
    }
    public function studyRegistration($participant, $surveyId, $saveId,
            $campaignLink)
    {
        $session = $this->container->get('session');
        $em = $this->container->get('doctrine')->getManager();
        $participantLanguage = $participant->getParticipantLanguage();
        
            $participantInterventionLink = new ParticipantInterventionLink();
            
            $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneBy(array('interventionCode' => 'Pledge', 'language' => $participantLanguage));
            $participantInterventionLink->setIntervention($intervention);
            $participantInterventionLink->setParticipant($participant);
            $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
            $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
            $em->persist($participantInterventionLink);
            
            $participantInterventionLink = new ParticipantInterventionLink();
            
            $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneBy(array('interventionCode' => 'Site', 'language' => $participantLanguage));
            $participantInterventionLink->setIntervention($intervention);
            $participantInterventionLink->setParticipant($participant);
            $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
            $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
            $em->persist($participantInterventionLink);

            $this->createIncentive($participant, $intervention);

            $em->flush();
//             $this->sendNotification($participantInterventionLink, $referralParticipant);
        
            $ArmParticipantLink = null;
            $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('Apledge');
            if ($armData) {
                $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
                $ArmParticipantLink->setArm($armData);
                $ArmParticipantLink->setParticipant($participant);
                $ArmParticipantLink->setStatus(ParticipantArmLink::STATUS_ACTIVE);
                $ArmParticipantLink->setParticipantArmLinkDatetime(new \DateTime("now"));
            }
            $em->persist($ArmParticipantLink);
            $em->flush();
            
            $this->createIncentive($referralParticipant, $this->getStudyCode());
    }
    public function interventionLogic($participant)
    {
//         $em = $this->container->get('doctrine')->getManager();
        
//         $participantArm = $em->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')->getStudyArm($participant, $this->getStudyCode());
//         if (isset($participantArm))
//             $participantArmName = $participantArm->getArm()->getArmCode();
//             //get all participant intervention links
//             $interventionLinks = $em
//             ->getRepository(
//                     'CyclogramProofPilotBundle:ParticipantInterventionLink')
//                     ->getStudyInterventionLinks($participant, $this->getStudyCode());
//             foreach ($interventionLinks as $interventionLink) {
//                 $interventionCode = $interventionLink->getIntervention()->getInterventionCode();
//                 $intervention = $interventionLink->getIntervention();
//                 $status = $interventionLink->getStatus();
//                 switch ($interventionCode) {
//                     case 'Pledge' :
//                         if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
//                             $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
//                             ->checkIfSurveyPassed($participant, $surveyId);
//                             if ($passed) {
//                                 $this->createIncentive($participant, $intervention);
//                                 $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
//                                 $em->persist($interventionLink);
//                                 $em->flush();
//                                 $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
//                                     ->findOneByInterventionCode("MPFOCUS");
//                                 $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
//                                     ->addParticipantInterventionLink($participant,$intervention, false);
//                             }
//                         }
//                         break;
//                 }
//         }    
        return true;
    }
    
    public function checkEligibility($surveyResult)
    {
        $isEligible = true;

        return $isEligible;
    }
    public static function getStudyCode()
    {
        return 'pledgetotest';
    }
    public function commandInterventionLogic()
    {
    	$period = 14;
    	$em = $this->container->get('doctrine')->getManager();
    	$intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneBy(array('interventionCode' => 'Site', 'language' => '1'));
    	$newIntervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
    	->findOneBy(array('interventionCode' => 'Pledge', 'language' => '1'));
    	$interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
    	->getParticipantByInterventionCodeAndPeriod($intervention->getInterventionCode(), $period);
    	foreach ($interventionLinks as $interventionLink) {
    		$isIntervention = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
    		->checkIfExistParticipantInterventionLink($newIntervention->getInterventionCode(), $interventionLink['participantId']);
    		if (!$isIntervention) {
    			$participantInterventionLink = new ParticipantInterventionLink();
    			$participantInterventionLink->setIntervention($newIntervention);
    			$participantInterventionLink->setParticipant($em->getReference('Cyclogram\Bundle\ProofPilotBundle\Entity\Participant', $interventionLink['participantId']));
    			$participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
    			$participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
    			$em->persist($participantInterventionLink);
    			$em->flush();
    		}
    	}

    }

}
