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

class KOCStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes()
    {
        return array('KOCCondomTrainingArm','KOCNoTrainingArm','KOCOnlineOnlyArm');
    }
    public function getInterventionCodes()
    {
        return array('KOCBaseline', 'KOCTraining',
                'KOCTechnologyUseSurvey', 'KOCCondomPick-UpSurvey','KOCFollow-UpSurvey');
    }

    public function studyRegistration($participant, $surveyId, $saveId)
    {
        $em = $this->container->get('doctrine')->getManager();
        $participantSurveyLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                    ->findOneBy(array('saveId'=>$saveId, 'sidId'=>$surveyId));
        if (isset($participantSurveyLink)) {
            $participantSurveyLink->setStatus(ParticipantSurveyLink::STATUS_CLOSED);
            $em->persist($participantSurveyLink);
            $em->flush();
            $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')
                          ->findOneByArmCode('KOCOnlineOnlyArm');
            $ArmParticipantLink = null;
            if ($armData) {
                $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
                $ArmParticipantLink->setArm($armData);
                $ArmParticipantLink->setParticipant($participant);
                $ArmParticipantLink->setStatus(ParticipantArmLink::STATUS_ACTIVE);
                $ArmParticipantLink
                ->setParticipantArmLinkDatetime(new \DateTime("now"));
            }
            $em->persist($ArmParticipantLink);

            $em->flush();
            
            $participantInterventionLink = new ParticipantInterventionLink();
            $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')
                               ->findOneByInterventionCode('KOCBaseline');
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
        
        $participantArm = $em
        ->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')
        ->getStudyArm($participant, $this->getStudyCode());
        $participantArmName = $participantArm->getArm()->getArmName();
        //get all participant intervention links
        $interventionLinks = $em
        ->getRepository(
                'CyclogramProofPilotBundle:ParticipantInterventionLink')
                ->getStudyInterventionLinks($participant, $this->getStudyCode());
        
        foreach ($interventionLinks as $interventionLink) {
            $interventionCode = $interventionLink->getIntervention()
                                                 ->getInterventionCode();
            $intervention = $interventionLink->getIntervention();
            $status = $interventionLink->getStatus();
            switch ($interventionCode) {
                case 'KOCBaseline' :
                    $surveyId = $intervention->getSidId();
                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                        $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                        ->checkIfSurveyPassed($participant, $surveyId);
                        if ($passed) {
                            $this->createIncentive($participant, $intervention);
                            $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                            $em->persist($interventionLink);
                            $em->flush();
                        }
                    }
                    break;
                case 'KOCTechnologyUseSurvey' :
                    $surveyId = $intervention->getSidId();
                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                        $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                     ->checkIfSurveyPassed($participant, $surveyId);
                        if ($passed) {
                            $this->createIncentive($participant, $intervention);
                            $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                            $em->persist($interventionLink);
                            $em->flush();
                        }
                    }
                    break;
                case 'KOCCondomPick-UpSurvey' :
                    $surveyId = $intervention->getSidId();
                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                        $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                     ->checkIfSurveyPassed($participant, $surveyId);
                        if ($passed) {
                            $this->createIncentive($participant, $intervention);
                            $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                            $em->persist($interventionLink);
                            $em->flush();
                        }
                    }
                    break;
                case 'KOCFollow-UpSurvey' :
                    $surveyId = $intervention->getSidId();
                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                        $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                     ->checkIfSurveyPassed($participant, $surveyId);
                        if ($passed) {
                            $this->createIncentive($participant, $intervention);
                            $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                            $em->persist($interventionLink);
                            $em->flush();
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

        if (isset($surveyResult['362142X497X4260'])
                && !in_array($surveyResult['362142X497X4260'],
                        array("A1", "A2", "A3", "A4", "A5", "A6", "A7"))) {
            $isEligible = false;
            $reason[] = "Parish";
        }

        if (isset($surveyResult['362142X497X4265'])
                && $surveyResult['362142X497X4265'] != "A1") {
            $isEligible = false;
            $reason[] = "Gender";
        }

        if (isset($surveyResult['362142X497X4269SQ005'])
                && $surveyResult['362142X497X4269SQ005'] == "Y") {
            $isEligible = false;
            $reason[] = "Sex in last 12 months with a male";
        }

        if (isset($surveyResult['362142X497X4263SQ003'])
                && $surveyResult['362142X497X4263SQ003'] != "Y") {
            $isEligible = false;
            $reason[] = "Race not African American/Black";
        }

        return $isEligible;
    }
    public static function getStudyCode()
    {
        return 'koc';
    }
    public function commandInterventionLogic()
    {
        $em = $this->container->get('doctrine')->getManager();
        
        $period = 1;
        $baseLineIntervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('KOCBaseline');
        $technologyUseIntervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('KOCTechnologyUseSurvey');
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
                                ->getParticipantByInterventionCodeAndPeriod($baseLineIntervention->getInterventionCode(), $period);
        foreach ($interventionLinks as $interventionLink) {
            if (!$em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
                    ->checkIfExistParticipantInterventionLink('KOCTechnologyUseSurvey', $interventionLink['participantId'])) {
                $participantInterventionLink = new ParticipantInterventionLink();
                $participantInterventionLink->setIntervention($technologyUseIntervention);
                $participantInterventionLink->setParticipant($em->getReference('Cyclogram\Bundle\ProofPilotBundle\Entity\Participant', $interventionLink['participantId']));
                $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
                $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
                $em->persist($participantInterventionLink);
                $em->flush();
            }
        }
        
        $period = 3;
        $condomPickUpIntervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('KOCCondomPick-UpSurvey');
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
                                ->getParticipantByInterventionCodeAndPeriod($technologyUseIntervention->getInterventionCode(), $period);
        foreach ($interventionLinks as $interventionLink) {
            if (!$em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
                    ->checkIfExistParticipantInterventionLink('KOCCondomPick-UpSurvey', $interventionLink['participantId'])) {
                $participantInterventionLink = new ParticipantInterventionLink();
                $participantInterventionLink->setIntervention($condomPickUpIntervention);
                $participantInterventionLink->setParticipant($em->getReference('Cyclogram\Bundle\ProofPilotBundle\Entity\Participant', $interventionLink['participantId']));
                $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
                $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
                $em->persist($participantInterventionLink);
                $em->flush();
            }
        }
        
        $period = 30;
        $condomFollowUpPickUpIntervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('KOCFollow-UpSurvey');
        $interventionLinks = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
                                ->getParticipantByInterventionCodeAndPeriod($condomPickUpIntervention->getInterventionCode(), $period);
        foreach ($interventionLinks as $interventionLink) {
            if (!$em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
                    ->checkIfExistParticipantInterventionLink('KOCFollow-UpSurvey', $interventionLink['participantId'])) {
                $participantInterventionLink = new ParticipantInterventionLink();
                $participantInterventionLink->setIntervention($condomFollowUpPickUpIntervention);
                $participantInterventionLink->setParticipant($em->getReference('Cyclogram\Bundle\ProofPilotBundle\Entity\Participant', $interventionLink['participantId']));
                $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
                $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
                $em->persist($participantInterventionLink);
                $em->flush();
            }
        }
    }

}
