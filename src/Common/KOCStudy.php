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

class KOCStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes()
    {
        return array('KocOnline');
    }

    public function getInterventionCodes()
    {
        return array('KocBaseline', 'LocalTechUseSurvey',
                'KOCCondomPickupSurvey', 'KOCFollowUpSurvey');
    }

    public function studyRegistration($participant, $surveyId, $saveId)
    {
        $em = $this->container->get('doctrine')->getManager();

        $participantArmLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
        $participantArmLink->setParticipant($participant);
        $participantArmLink
                ->setStatus(ParticipantArmLink::ACTIVE);
        $participantArmLink
                ->setParticipantArmLinkDatetime(new \DateTime("now"));
        $participantArmLink
                ->setArm(
                        $this->container->get('doctrine')
                                ->getRepository('CyclogramProofPilotBundle:Arm')
                                ->findOneByArmCode('KOCOnline'));

        $em->persist($participantArmLink);
        $em->flush();

        $timeNow = new \DateTime("now");

        //create interventions
        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink
                ->setStatus(ParticipantInterventionLink::ACTIVE);
        $participantInterventionLink
                ->setIntervention(
                        $em
                                ->getRepository(
                                        'CyclogramProofPilotBundle:Intervention')
                                ->findOneByInterventionCode('KOCBaseline'));
        $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeStart($timeNow);
        $participantInterventionLink->setParticipantInterventionLinkName("");
        $em->persist($participantInterventionLink);
        $em->flush();

        //One day after
        $timeNowPlusOneDay = new \DateTime(
                date("Y-m-d", strtotime("+1 day", $timeNow->format("U")))
                        . " 00:00:00");
        //3 days from registration
        $timeNowPlusThreeDay = new \DateTime(
                date("Y-m-d", strtotime("+3 day", $timeNow->format("U")))
                        . " 00:00:00");
        //30 days from registration
        $timeNowPlusThirtyDay = new \DateTime(
                date("Y-m-d", strtotime("+30 day", $timeNow->format("U")))
                        . " 00:00:00");

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setStatus(ParticipantInterventionLink::ACTIVE);
        $participantInterventionLink
                ->setIntervention(
                        $em
                                ->getRepository(
                                        'CyclogramProofPilotBundle:Intervention')
                                ->findOneByInterventionCode(
                                        'LocalTechUseSurvey'));
        $participantInterventionLink->setParticipantInterventionLinkName("");
        //One day after
        $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeStart(
                        $timeNowPlusOneDay);
        $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeEnd(
                        $timeNowPlusThreeDay);
        $em->persist($participantInterventionLink);
        $em->flush();

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink
                ->setStatus(ParticipantInterventionLink::ACTIVE);
        $participantInterventionLink
                ->setIntervention(
                        $em
                                ->getRepository(
                                        'CyclogramProofPilotBundle:Intervention')
                                ->findOneByInterventionCode(
                                        'KOCCondomPickupSurvey'));
        $participantInterventionLink->setParticipantInterventionLinkName("");
        //3 days from registration
        $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeStart(
                        $timeNowPlusThreeDay);
        $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeEnd(
                        $timeNowPlusThirtyDay);
        $em->persist($participantInterventionLink);
        $em->flush();

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink
                ->setStatus(ParticipantInterventionLink::ACTIVE);
        $participantInterventionLink
                ->setIntervention(
                        $em
                                ->getRepository(
                                        'CyclogramProofPilotBundle:Intervention')
                                ->findOneByInterventionCode('KOCFollowUpSurvey'));
        $participantInterventionLink->setParticipantInterventionLinkName("");
        //30 days from registration
        $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeStart(
                        $timeNowPlusThirtyDay);
        //$participantInterventionLink->setParticipantInterventionLinkDatetimeEnd();
        $em->persist($participantInterventionLink);
        $em->flush();
    }

    public function interventionLogic($participant)
    {
        return false;
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
        return true;
    }

}
