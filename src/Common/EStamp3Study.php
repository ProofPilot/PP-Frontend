<?php
namespace Common;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Study;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\CyclogramCommon;

class EStamp3Study extends AbstractStudy implements StudyInterface
{

    public function getArmCodes()
    {
        return array();
    }

    public function getInterventionCodes()
    {
        return array();
    }

    public function studyRegistration($participant, $surveyId, $saveId)
    {
        return false;
    }

    public function interventionLogic($participant)
    {
        return false;
    }

    public function checkEligibility($surveyResult)
    {
        return true;
    }

    public static function  getStudyCode()
    {
        return 'estamp3';
    }

}
