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

class SexproStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes()
    {
        return array('SexProBaseLine', 'SexPro3Month');
    }

    public function getInterventionCodes()
    {
        return array('SexProBaselineSurvey', 'SexProActivity',
                'SexPro3MonthFollowUpSurvey');
    }

    public function studyRegistration($participant, $surveyId, $saveId)
    {
        $em = $this->container->get('doctrine')->getManager();
        $participantSurveyLink = $em
                ->getRepository(
                        'CyclogramProofPilotBundle:ParticipantSurveyLink')
                ->findOneBySaveId($saveId);
        if (isset($participantSurveyLink)) {
            $saveId = $participantSurveyLink->getSaveId();

            $lem = $this->container->get('doctrine')->getManager('limesurvey');
            $participantSurvey = $lem
                    ->getRepository(
                            'CyclogramProofPilotBundleLime:LimeSurvey468727')
                    ->find($saveId);

            $surveyAge = $participantSurvey->getAge();
            $surveyCity = $participantSurvey->getLocation();

            switch ($surveyCity) {
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

            if ($surveyAge < 30) {
                $minAge = 18;
                $maxAge = 30;
            } else {
                $minAge = 31;
                $maxAge = 90;
            }
            $baseLineArmParticipants = $em
                    ->getRepository('CyclogramProofPilotBundle:Participant')
                    ->countAllArms('SexProBaseLine');
            $threeMonthArmParticipants = $em
                    ->getRepository('CyclogramProofPilotBundle:Participant')
                    ->countAllArms('SexPro3Month');
            //             $baseLineArmParticipantsByCriteria = $em
            //                     ->getRepository('CyclogramProofPilotBundle:Participant')
            //                     ->countArmByCityAge('SexProBaseLine', $cityName, $minAge,
            //                             $maxAge);
            //             $threeMonthArmParticipantsByCriteria = $em
            //                     ->getRepository('CyclogramProofPilotBundle:Participant')
            //                     ->countArmByCityAge('SexPro3Month', $cityName, $minAge,
            //                             $maxAge);
            $baseLineArm = $em->getRepository('CyclogramProofPilotBundle:Arm')
                    ->findOneByArmCode('SexProBaseLine');
            $threeMonthArm = $em
                    ->getRepository('CyclogramProofPilotBundle:Arm')
                    ->findOneByArmCode('SexPro3Month');
            $participantArmLink = new ParticipantArmLink();
            if ($baseLineArmParticipants == 0
                    && $threeMonthArmParticipants == 0) {
                $armArray = array($baseLineArm, $threeMonthArm);
                shuffle($armArray);
                $participantArmLink->setArm($armArray[0]);
            } elseif ($baseLineArmParticipants == 0) {
                $participantArmLink->setArm($baseLineArm);
            } elseif ($threeMonthArmParticipants == 0) {
                $participantArmLink->setArm($threeMonthArm);
            } else {
                if ($baseLineArmParticipants / $threeMonthArmParticipants > 2) {
                    $participantArmLink->setArm($threeMonthArm);
                } elseif ($baseLineArmParticipants / $threeMonthArmParticipants
                        < 2) {
                    $participantArmLink->setArm($baseLineArm);
                } else {
                    $armArray = array($baseLineArm, $threeMonthArm);
                    shuffle($armArray);
                    $participantArmLink->setArm($armArray[0]);
                }
            }
            //             if ($baseLineArmParticipantsByCriteria == 0 && $threeMonthArmParticipantsByCriteria == 0 ) {
            //                 if ($baseLineArmParticipants <= $threeMonthArmParticipants)
            //                     $participantArmLink->setArm($baseLineArm);
            //                 else 
            //                     $participantArmLink->setArm($threeMonthArm);
            //             } elseif ($baseLineArmParticipantsByCriteria <= $threeMonthArmParticipantsByCriteria) {
            //                 $participantArmLink->setArm($baseLineArm);
            //             } else {
            //                 $participantArmLink->setArm($threeMonthArm);
            //             }
            $participantArmLink->setParticipant($participant);
            $status = $em->getRepository('CyclogramProofPilotBundle:Status')
                    ->find(1);
            $participantArmLink->setStatus($status);
            $participantArmLink->setParticipantArmLinkDatetime(new \DateTime());
            $em->persist($participantArmLink);
            $em->flush($participantArmLink);

            $participantInterventionLink = new ParticipantInterventionLink();
            $intervention = $em
                    ->getRepository('CyclogramProofPilotBundle:Intervention')
                    ->findOneByInterventionCode('SexProBaselineSurvey');
            $participantInterventionLink->setIntervention($intervention);
            $participantInterventionLink->setParticipant($participant);
            $participantInterventionLink
                    ->setParticipantInterventionLinkDatetimeStart(
                            new \DateTime("now"));
            $participantInterventionLink->setStatus($status);
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
            $interventionTypeName = $interventionLink->getIntervention()
                    ->getInterventionType()->getInterventionTypeName();
            $intervention = $interventionLink->getIntervention();
            $status = $interventionLink->getStatus()->getStatusName();

            switch ($interventionTypeName) {
            case "Survey & Observation":
                $surveyId = $intervention->getSidId();
                if ($status == "Active") {
                    $passed = $em
                            ->getRepository(
                                    'CyclogramProofPilotBundle:ParticipantSurveyLink')
                            ->checkIfSurveyPassed($participant, $surveyId);

                    if ($passed) {
                        $this->createIncentive($participant, $intervention);
                        $completedStatus = $em
                                ->getRepository(
                                        'CyclogramProofPilotBundle:Status')
                                ->findOneByStatusName("Closed");
                        $interventionLink->setStatus($completedStatus);
                        $em->persist($interventionLink);
                        $em->flush();
                        $status = "Closed";

                    }
                }
                if ($participantArmName == 'SexProBaseLine') {
                    if (($status == "Closed")
                            && ($intervention->getInterventionCode()
                                    == "SexProBaselineSurvey")) {
                        $iSexProActivity = $em
                                ->getRepository(
                                        'CyclogramProofPilotBundle:Intervention')
                                ->findOneByInterventionCode("SexProActivity");
                        $em
                                ->getRepository(
                                        'CyclogramProofPilotBundle:ParticipantInterventionLink')
                                ->addParticipantInterventionLink($participant,
                                        $iSexProActivity);
                    }
                }
                break;
            case "Activity":
                if ($participantArmName == 'SexPro3Month') {
                    if ($intervention->getInterventionCode()
                            == "SexProActivity") {
                        $em->remove($interventionLink);
                        $em->flush();
                    }
                }
                break;
            }
        }
    }

    public function checkEligibility($surveyResult)
    {
        return true;
    }
    public static function getStudyCode()
    {
        return 'sexpro';
    }
    public function commandInterventionLogic()
    {
        return true;
    }

}
