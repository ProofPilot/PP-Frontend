<?php
namespace Cyclogram\FrontendBundle\Service;


interface StudyInterface
{
    public function getArmCodes();
    public function getInterventionCodes();
    public function studyRegistration($participant, $surveyId, $saveId);
    public function interventionLogic($participant);
    public function checkEligibility( $surveyResult);

}
