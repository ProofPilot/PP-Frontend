<?php
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
        $em = $this->container->get('doctrine')->getEntityManager();

        //participant intervention link
        $activeStatus = $this->container->get('doctrine')
                ->getRepository('CyclogramProofPilotBundle:Status')->find(1);
        $intervention = $em
                ->getRepository('CyclogramProofPilotBundle:Intervention')
                ->findOneByInterventionCode('KOCSocialMediaSurvey');

        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setStatus($activeStatus);
        $participantInterventionLink->setIntervention($intervention);
        $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeStart(
                        new \DateTime("now"));
        $participantInterventionLink->setParticipantInterventionLinkName("");

        $em->persist($participantInterventionLink);
        $em->flush();

        $participantArmLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
        $participantArmLink->setParticipant($participant);
        $participantArmLink->setStatus($activeStatus);
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
        $em = $this->container->get('doctrine')->getEntityManager();
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
                                ->findOneByStatusName("Completed");
                        $interventionLink->setStatus($completedStatus);
                        $em->persist($interventionLink);
                        $em->flush();
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

        if (isset($surveyResponse['382539X701X6985'])
                && intval($surveyResponse['382539X701X6985']) < 18) {
            $isEligible = false;
            $reason[] = "Less than 18 years";
        }

        if (isset($surveyResponse['382539X701X6987'])
                && $surveyResponse['382539X701X6987'] != "A1") {
            $isEligible = false;
            $reason[] = "Sex not male";
        }

        if (isset($surveyResponse['382539X701X6984'])
                && !in_array($surveyResponse['382539X701X6984'],
                        array("A1", "A2", "A3", "A4", "A5", "A6", "A7"))) {
            $isEligible = false;
            $reason[] = "Parish is other";
        }

        if (isset($surveyResponse['382539X701X6986SQ003'])
                && $surveyResponse['382539X701X6986SQ003'] != "Y") {
            $isEligible = false;
            $reason[] = "Race Not Black/African American";
        }

        if (isset($surveyResponse['382539X701X6988SQ005'])
                && $surveyResponse['382539X701X6988SQ005'] == "Y") {
            $isEligible = false;
            $reason[] = "No sex in the last 12 months";
        }

        return $isEligible;
    }
    public static function getStudyCode()
    {
        return 'kocsocialmedia';
    }

}
