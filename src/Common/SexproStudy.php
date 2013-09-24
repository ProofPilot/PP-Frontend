<?php
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
        $em = $this->container->get('doctrine')->getEntityManager();
        $participantSurveyLink = $em
                ->getRepository(
                        'CyclogramProofPilotBundle:ParticipantSurveyLink')
                ->findOneBySaveId($saveId);
        if (isset($participantSurveyLink)) {
            $saveId = $participantSurveyLink->getSaveId();

            $lem = $this->container->get('doctrine')
                    ->getEntityManager('limesurvey');
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
            $firstArmParticipants = $em->getRepository('CyclogramProofPilotBundle:Participant')->countAllArms('SexProBaseLine');
            $secondArmParticipants = $em->getRepository('CyclogramProofPilotBundle:Participant')->countAllArms('SexPro3Month');
            $firstArmParticipantsByCriteria = $em
                    ->getRepository('CyclogramProofPilotBundle:Participant')
                    ->countArmByCityAge('SexProBaseLine', $cityName, $minAge,
                            $maxAge);
            $secondArmParticipantsByCriteria = $em
                    ->getRepository('CyclogramProofPilotBundle:Participant')
                    ->countArmByCityAge('SexPro3Month', $cityName, $minAge,
                            $maxAge);
            $firstArm = $em->getRepository('CyclogramProofPilotBundle:Arm')
                    ->findOneByArmCode('SexProBaseLine');
            $secondArm = $em->getRepository('CyclogramProofPilotBundle:Arm')
                    ->findOneByArmCode('SexPro3Month');

            $participantArmLink = new ParticipantArmLink();
            if ($firstArmParticipantsByCriteria == 0 && $secondArmParticipantsByCriteria == 0 ) {
                if ($firstArmParticipants <= $secondArmParticipants)
                    $participantArmLink->setArm($firstArm);
                else 
                    $participantArmLink->setArm($secondArm);
            } elseif ($firstArmParticipantsByCriteria <= $secondArmParticipantsByCriteria) {
                $participantArmLink->setArm($firstArm);
            } else {
                $participantArmLink->setArm($secondArm);
            }
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
        $em = $this->container->get('doctrine')->getEntityManager();
        $participantArm = $em
                ->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')
                ->findOneByParticipant($participant);
        $participantArmName = $participantArm->getArm()->getArmName();
        //get all participant intervention links
        $interventionLinks = $em
                ->getRepository('CyclogramProofPilotBundle:Participant')
                ->getParticipantInterventionLinks($participant);
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
                if ($participantArmName == 'SexPro3Month'){
                    if (($status == "Closed")
                            && ($intervention->getInterventionName()
                                    == "SexPro Baseline Survey")) {
                        $intervention = $em
                                ->getRepository(
                                        'CyclogramProofPilotBundle:Intervention')
                                ->findOneByInterventionCode("SexProActivity");
                        $em->getRepository('CyclogramProofPilotBundle:Participant')
                                ->addParticipantInterventionLink($participant,
                                        $intervention);
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
        return true;
    }
    public static function getStudyCode()
    {
        return 'sexpro';
    }

}
