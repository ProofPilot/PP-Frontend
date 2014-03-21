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

    public function studyRegistration($participant, $surveyId, $saveId, $campaignLink)
    {
        return false;
    }

    public function interventionLogic($participant)
    {
        return false;
    }

    public function checkSurveyEligibility($surveyResult)
    {
        return true;
    }
    public function checkEligibility($studyCode, $participant) {
        return false;
    }

    public static function getStudyCode()
    {
        return 'estamp3';
    }
    public function commandInterventionLogic()
    {
        $this->addInterventionsbByPeriod($this->getStudyCode());
    }

}
