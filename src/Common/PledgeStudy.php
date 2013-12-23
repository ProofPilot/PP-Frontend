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
        return array('MPFOCUS', 'MPFORM');
    }
    public function studyRegistration($participant, $surveyId, $saveId,
            $campaignLink)
    {
        $em = $this->container->get('doctrine')->getManager();
        $participantSurveyLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
        ->findOneBy(array('saveId'=>$saveId, 'sidId'=>$surveyId));
        if (isset($participantSurveyLink)) {
            $participantSurveyLink->setStatus(ParticipantSurveyLink::STATUS_CLOSED);
            $em->persist($participantSurveyLink);
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
        
            $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('MPFORM');
            $participantInterventionLink->setIntervention($intervention);
            $participantInterventionLink->setParticipant($participant);
            $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
            $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
            $em->persist($participantInterventionLink);
            $em->flush($participantInterventionLink);
        }
    }
    public function interventionLogic($participant)
    {
        $em = $this->container->get('doctrine')->getManager();
        
        $participantArm = $em->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')->getStudyArm($participant, $this->getStudyCode());
        if (isset($participantArm))
            $participantArmName = $participantArm->getArm()->getArmCode();
            //get all participant intervention links
            $interventionLinks = $em
            ->getRepository(
                    'CyclogramProofPilotBundle:ParticipantInterventionLink')
                    ->getStudyInterventionLinks($participant, $this->getStudyCode());
            foreach ($interventionLinks as $interventionLink) {
                $interventionCode = $interventionLink->getIntervention()->getInterventionCode();
                $intervention = $interventionLink->getIntervention();
                $status = $interventionLink->getStatus();
                switch ($interventionCode) {
                    case 'MPFORM' :
                        $surveyId = $intervention->getSidId();
                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                            $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                            ->checkIfSurveyPassed($participant, $surveyId);
                            if ($passed) {
                                $this->createIncentive($participant, $intervention);
                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                                $em->persist($interventionLink);
                                $em->flush();
                                $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
                                    ->findOneByInterventionCode("MPFOCUS");
                                $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
                                    ->addParticipantInterventionLink($participant,$intervention, false);
                            }
                        }
                        break;
                }
        }
    }
    
    public function checkEligibility($surveyResult)
    {
        $isEligible = true;
        $reason = array();

        if (isset($surveyResult['481663X739X7418'])
                && intval($surveyResult['481663X739X7418'] < 18)) {
            $isElegible = false;
            $reason[] = "Less than 18 years";
        }

        if (isset($surveyResult['481663X739X7425'])
                &&  !in_array($surveyResult['481663X739X7425'], array('A2','A4'))) {
            $isEligible = false;
            $reason[] = "Gender";
        }

        if (isset($surveyResult['481663X739X7424SQ002']) && $surveyResult['481663X739X7424SQ002'] != 'Y') {
            $isEligible = false;
            $reason[] = "Sex in last 12 months with a male";
        }

        return $isEligible;
    }
    public static function getStudyCode()
    {
        return 'S4581';
    }
    public function commandInterventionLogic()
    {
        return;

    }

}
