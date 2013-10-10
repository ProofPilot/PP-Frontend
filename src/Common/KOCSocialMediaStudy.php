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

class KOCSocialMediaStudy extends AbstractStudy implements StudyInterface
{

    public function getArmCodes()
    {
        return array('KOCSMDefault');
    }

    public function getInterventionCodes()
    {
        return array('KOCSocialMediaSurvey');
    }

    public function studyRegistration($participant, $surveyId, $saveId)
    {
        $em = $this->container->get('doctrine')->getManager();

        //participant intervention link
        $intervention = $em
                ->getRepository('CyclogramProofPilotBundle:Intervention')
                ->findOneByInterventionCode('KOCSocialMediaSurvey');

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
        $participantInterventionLink->setIntervention($intervention);
        $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeStart(
                        new \DateTime("now"));
        $participantInterventionLink->setParticipantInterventionLinkName("");

        $em->persist($participantInterventionLink);
        $em->flush();

        $participantArmLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
        $participantArmLink->setParticipant($participant);
        $participantArmLink->setStatus(ParticipantArmLink::STATUS_ACTIVE);
        $participantArmLink
                ->setParticipantArmLinkDatetime(new \DateTime("now"));
        $participantArmLink
                ->setArm(
                        $this->container->get('doctrine')
                                ->getRepository('CyclogramProofPilotBundle:Arm')
                                ->findOneByArmCode('KOCSMDefault'));

        $em->persist($participantArmLink);
        $em->flush();
    }

    public function interventionLogic($participant)
    {
        $em = $this->container->get('doctrine')->getManager();
        $study = $em->getRepository('CyclogramProofPilotBundle:Study')
                ->findOneByStudyCode($this->getStudyCode());
        //get all participant intervention links
        $interventionLinks = $em
                ->getRepository(
                        'CyclogramProofPilotBundle:ParticipantInterventionLink')
                ->getStudyInterventionLinks($participant, $this->getStudyCode());
        foreach ($interventionLinks as $interventionLink) {
            $interventionTypeName = $interventionLink->getIntervention()
                    ->getInterventionType()->getInterventionTypeName();
            $intervention = $interventionLink->getIntervention();
            $status = $interventionLink->getStatus();
            switch ($interventionTypeName) {
            case "Survey & Observation":
                $surveyId = $intervention->getSidId();
                if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                    $passed = $em
                            ->getRepository(
                                    'CyclogramProofPilotBundle:ParticipantSurveyLink')
                            ->checkIfSurveyPassed($participant, $surveyId);

                    if ($passed) {
                        $completedStatus = $em
                                ->getRepository(
                                        'CyclogramProofPilotBundle:Status')
                                ->findOneByStatusName("Completed");
                        $interventionLink->setStatus($completedStatus);
                        $em->persist($interventionLink);
                        $em->flush();
                        $this->createIncentive($participant, $intervention);
                        $status = ParticipantInterventionLink::STATUS_CLOSED;
                    }
                }

                break;
            case "Activity":
                break;
            }
        }
    }

    public function checkEligibility($surveyResult)
    {
        $isEligible = true;
        $reason = array();

        if (isset($surveyResult['382539X701X6985'])
                && intval($surveyResult['382539X701X6985']) < 18) {
            $isEligible = false;
            $reason[] = "Less than 18 years";
        }

        if (isset($surveyResult['382539X701X6987'])
                && $surveyResult['382539X701X6987'] != "A1") {
            $isEligible = false;
            $reason[] = "Sex not male";
        }

        if (isset($surveyResult['382539X701X6984'])
                && !in_array($surveyResult['382539X701X6984'],
                        array("A1", "A2", "A3", "A4", "A5", "A6", "A7"))) {
            $isEligible = false;
            $reason[] = "Parish is other";
        }

        if (isset($surveyResult['382539X701X6986SQ003'])
                && $surveyResult['382539X701X6986SQ003'] != "Y") {
            $isEligible = false;
            $reason[] = "Race Not Black/African American";
        }

        if (isset($surveyResult['382539X701X6988SQ005'])
                && $surveyResult['382539X701X6988SQ005'] == "Y") {
            $isEligible = false;
            $reason[] = "No sex in the last 12 months";
        }

        return $isEligible;
    }
    public static function getStudyCode()
    {
        return 'kocsocialmedia';
    }
    public function commandInterventionLogic()
    {
        return true;
    }

}
