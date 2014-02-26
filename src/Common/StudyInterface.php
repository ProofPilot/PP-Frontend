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


interface StudyInterface
{
    public function getArmCodes();
    public function getInterventionCodes();
    public function studyRegistration($participant, $surveyId, $saveId, $campaignLink);
    public function interventionLogic($participant);
    public function checkSurveyEligibility( $surveyResult);
    public function checkEligibility($studyCode, $participant);
    public static function getStudyCode();
    public function commandInterventionLogic();

}
