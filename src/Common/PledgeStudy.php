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

class PledgeStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes()
    {
        return array('AFormative');
    }
    public function getInterventionCodes()
    {
        return array('Pledgereferral');
    }
    public function studyRegistration($participant, $surveyId, $saveId,
            $campaignLink)
    {
        $session = $this->container->get('session');
        $em = $this->container->get('doctrine')->getManager();
        $participantSurveyLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
        ->findOneBy(array('saveId'=>$saveId, 'sidId'=>$surveyId));
        if (isset($participantSurveyLink)) {
            $participantSurveyLink->setStatus(ParticipantSurveyLink::STATUS_CLOSED);
            $em->persist($participantSurveyLink);
            
            $participantInterventionLink = new ParticipantInterventionLink();
            
            $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('MPFORM');
            $participantInterventionLink->setIntervention($intervention);
            $participantInterventionLink->setParticipant($participant);
            $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
            $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_REFERRAL);
            $em->persist($participantInterventionLink);

            $this->createIncentive($participant, $intervention);

            $em->flush();
        
            $ArmParticipantLink = null;
            $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('AFormative');
            if ($armData) {
                $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
                $ArmParticipantLink->setArm($armData);
                $ArmParticipantLink->setParticipant($participant);
                $ArmParticipantLink->setStatus(ParticipantArmLink::STATUS_ACTIVE);
                $ArmParticipantLink->setParticipantArmLinkDatetime(new \DateTime("now"));
            }
            $em->persist($ArmParticipantLink);
            $em->flush();
        
            $participantInterventionLink = new ParticipantInterventionLink();
        
            $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('Pledgereferral');
            $participantInterventionLink->setIntervention($intervention);
            $participantInterventionLink->setParticipant($participant);
            $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
            $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
            $em->persist($participantInterventionLink);
            $em->flush($participantInterventionLink);
            
            if ($session->has('refferal_participant')){
                $participant->setParticipantRefferalId($session->get('refferal_participant'));
                $em->flush();
                $referralParticipant = $em->getRepository('CyclogramProofPilotBundle:Participant')->find($session->get('refferal_participant'));
                $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('Pledgereferral');
                $countReferrals = $em->getRepository('CyclogramProofPilotBundle:Participant')->countParticipantRefferals($intervention->getInterventionCode(), $referralParticipant);
                if ($countReferrals <2) {
                    $participantInterventionLink = new ParticipantInterventionLink();
                    
                    $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('Pledgereferral');
                    $participantInterventionLink->setIntervention($intervention);
                    $participantInterventionLink->setParticipant($referralParticipant);
                    $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
                    $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_REFERRAL);
                    $em->persist($participantInterventionLink);
                    $em->flush($participantInterventionLink);
                    
                    $this->createIncentive($referralParticipant, $intervention);
                }
                $session->remove('refferal_participant');
            }
        }
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
//                     case 'MPFORM' :
//                         $surveyId = $intervention->getSidId();
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
        $reason = array();

        if (isset($surveyResult['399419X758X7914'])
                && intval($surveyResult['399419X758X7914'] < 16)) {
            $isElegible = false;
            $reason[] = "Less than 16 years";
        }

        if (isset($surveyResult['399419X758X7915'])
                &&  !in_array($surveyResult['399419X758X7915'], array('A2','A4'))) {
            $isEligible = false;
            $reason[] = "Invalid city";
        }

        if (isset($surveyResult['399419X758X7921SQ002']) && $surveyResult['399419X758X7921SQ002'] != 'Y') {
            $isEligible = false;
            $reason[] = "Sex in last 12 months with a male";
        }

        return $isEligible;
    }
    public static function getStudyCode()
    {
        return 'newhiv';
    }
    public function commandInterventionLogic()
    {
        return;

    }

}
