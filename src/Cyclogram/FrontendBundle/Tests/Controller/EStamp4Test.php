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

namespace Cyclogram\FrontendBundle\Tests\Controller;
class EStamp4Test  extends  \PHPUnit_Extensions_SeleniumTestCase
{
    protected $dbhandle;
    protected $selected;
    
    protected function setUp(){
        $this->setBrowser("*chrome");
        $this->setBrowserUrl(SITEHOST . "/en/eStamp4/");
        $this->dbhandle = mysql_connect(DBHOSTNAME, DBUSERNAME, DBPASSWORD)
        or die("Unable to connect to MySQL");
        //select a database to work with
        $this->selected = mysql_select_db('proofpilot', $this->dbhandle)
        or die("Could not select database");
        $this->setSpeed(200);
    }
    
    // set the participant quantity in $n
    public function testEStmap4Registration(){
        $n=1;
        $HIV = true;
        if (!$HIV) {
            for ($i = 1; $i <= $n; $i++){
                if ($i%2 == 0){
                    $this->registerEStmap4Participant($i);
                    $this->activateEmail($i);
                    $this->eStampBaselineSurvey($i);
                    $this->runFirstEStamp4ComandInterventionSurvey($i);
                    $this->eStampControlSurvey($i);
                    $this->runEStamp4ComandInterventionSurvey($i);
                    $this->eStampControlSurvey($i);
                    $this->runEStamp4ComandInterventionSurvey($i);
                    $this->eStampControlSurvey($i);
                    $this->runEStamp4ComandInterventionSurvey($i);
                    $this->eStampControlSurvey($i);
                } else {
                    $this->registerEStmap4Participant($i);
                    $this->activateEmail($i);
                    $this->eStampBaselineSurvey($i);
                    $this->runEStamp4TestResultsSurvey($i);
                    $this->eStampTestResultsSurvey($i);
                    $this->runEStamp4FollowUpSurvey($i);
                    $this->eStampeRCTFollowUp4Survey($i);
                    $this->runEStamp4TestResultsSurvey($i);
                    $this->eStampTestResultsSurvey($i);
                    $this->runEStamp4FollowUpSurvey($i);
                    $this->eStampeRCTFollowUp4Survey($i);
                    $this->runEStamp4TestResultsSurvey($i);
                    $this->eStampTestResultsSurvey($i);
                    $this->runEStamp4FollowUpSurvey($i);
                    $this->eStampeRCTFollowUp4Survey($i);
                    $this->runEStamp4TestResultsSurvey($i);
                    $this->eStampFinalTestResultsSurvey($i);
                    $this->runEStamp4FollowUpSurvey($i);
                    $this->eStampeRCTFollowUp4Survey($i);
                }
            }
        } else {
            for ($i = 1; $i <= $n; $i++){
                $this->registerEStmap4HIVParticipant($i);
                $this->activateEmail($i);
                $this->eStampHIVBaselineSurvey($i);
                $this->runFirstEStamp4HIVFollowUpSurvey($i);
                $this->eStamp4HIVFollowUpSurvey($i);
                $this->runEStamp4HIVFollowUpSurvey($i);
                $this->eStamp4HIVFollowUpSurvey($i);
                $this->runEStamp4HIVFollowUpSurvey($i);
                $this->eStamp4HIVFollowUpSurvey($i);
                $this->runEStamp4HIVFollowUpSurvey($i);
                $this->eStamp4HIVFollowUpSurvey($i);
            }
        }
        return $n;
    }
    
    //-------------- Single User Registration -------------------
    protected function registerEStmap4Participant($n)
    {
        $this->open("/en/eStamp4/");
        $this->click("link=exact:ARE YOU ELIGIBLE?");
        $this->waitForPageToLoad("30000");
        $this->click("id=consentYes");
        $this->click("id=specimenYes");
        $this->click("id=continueBtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=surveyLink");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer232486X145X1975", "23");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer232486X146X1976", "label=Georgia");
        $this->type("id=answer232486X146X1977", "30308");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer232486X147X1978A1");
        $this->click("id=answer232486X147X1979SQ005");
        $this->click("id=answer232486X147X1986A1");
        $this->click("id=answer232486X147X1987A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer232486X148X1988A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer232486X149X1989A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer232486X150X1990A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("link=Continue to registration");
        $this->waitForPageToLoad("30000");
        $this->type("id=registration_participantEmail", "estamp4". $n ."@test.com");
        $this->type("id=registration_participantUsername", "estamp4". $n);
        $this->type("id=registration_participantPassword_first", "q1w2e3r4");
        $this->type("id=registration_participantPassword_second", "q1w2e3r4");
        $this->click("id=registration_next");
        $this->waitForPageToLoad("30000");
        $this->type("id=phone_phone_wide", "123".$n);
        $this->click("id=phone_sendCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=button.submit.m2");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
//     /**
//      * @depends testEStmap4Registration
//      */
//     public function testKAHBaseline($n=1) {
//         // verify email to get baseline survey
//         for ($i = 1; $i <= $n; $i++){
//             $this->activateEmail($i);
//             $this->eStampBaselineSurvey($i);
//         }
//         return $n;
//     }
    
    protected function activateEmail($n) {
        $query = "SELECT
        *
        FROM
        participant
        WHERE participant_email = 'estamp4" .$n . "@test.com'";
        $participantRes = mysql_query($query, $this->dbhandle);
        $participant = mysql_fetch_array($participantRes);
        mysql_free_result($participantRes);
        $this->open(SITEHOST . "/en/register/email_verify/" .$participant['participant_email']. "/" . $participant['participant_email_code']);
    }
    
    
    
    protected function eStampBaselineSurvey($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "estamp4" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X156X2004A1");
        $this->click("id=answer819549X156X2005A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X157X2006A1");
        $this->click("id=answer819549X157X2007A4");
        $this->type("id=answer819549X157X2009", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X158X2010A1");
        $this->click("id=answer819549X158X2011A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X159X2013SQ001");
        $this->click("css=#javatbd819549X159X2026A1 > label.answertext");
        $this->click("id=answer819549X159X2026A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X160X2042SQ001");
        $this->click("css=#javatbd819549X160X2046A1 > label.answertext");
        $this->click("id=answer819549X160X2046A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer819549X161X2056", "0");
        $this->click("css=label.answertext");
        $this->click("id=answer819549X161X2057A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X162X2059A2");
        $this->click("id=answer819549X162X2060A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X165X2089A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer819549X167X2100", "1");
        $this->keyUp("id=answer819549X167X2100", "1");
        $this->type("id=answer819549X167X2101SQ001", "a");
        $this->type("id=answer819549X167X2101SQ002", "s");
        $this->type("id=answer819549X167X2101SQ003", "w");
        $this->type("id=answer819549X167X2101SQ004", "d");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X168X2107A1");
        $this->click("id=answer819549X168X2108A4");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X169X2109SQ001");
        $this->click("id=answer819549X169X2117A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer819549X170X2118", "1");
        $this->keyUp("id=answer819549X170X2118", "1");
        $this->click("id=answer819549X170X2119A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer819549X181X2182SQ001", "1");
        $this->type("id=answer819549X181X2182SQ002", "0");
        $this->type("id=answer819549X181X2182SQ003", "0");
        $this->click("css=#javatbd819549X181X2186SQ004 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X182X2200A1");
        $this->click("id=answer819549X182X2201A1");
        $this->click("id=answer819549X182X2202A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X183X2203A1");
        $this->click("id=answer819549X183X2204A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X184X2210SQ001-A1");
        $this->click("id=answer819549X184X2210SQ002-A1");
        $this->click("id=answer819549X184X2210SQ003-A1");
        $this->click("id=answer819549X184X2210SQ004-A1");
        $this->click("id=answer819549X184X2210SQ005-A1");
        $this->click("id=answer819549X184X2210SQ006-A1");
        $this->click("id=answer819549X184X2210SQ007-A1");
        $this->click("id=answer819549X184X2210SQ008-A1");
        $this->click("id=answer819549X184X2210SQ009-A1");
        $this->click("id=answer819549X184X2210SQ010-A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X185X2222A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X186X2226A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X187X2238A1");
        $this->click("id=answer819549X187X2257A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X188X2259A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X189X2262A1");
        $this->click("id=answer819549X189X2263A1");
        $this->click("id=navigator");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X190X2266A1");
        $this->click("id=javatbd819549X190X2267A1");
        $this->click("id=answer819549X190X2267A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer819549X191X22691", "label=Call my phone number at [insert telephone number from QS2]");
        $this->select("id=answer819549X191X22692", "label=Call my phone number at [insert telephone number from QS2]");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer819549X192X22711", "label=Email me at [insert email address from QS1]");
        $this->select("id=answer819549X192X22712", "label=Email me at [insert email address from QS1]");
        $this->select("id=answer819549X192X22713", "label=Email me at [insert email address from QS1]");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer819549X193X22731", "label=Email me at [insert email address from QS1]");
        $this->select("id=answer819549X193X22732", "label=Email me at [insert email address from QS1]");
        $this->select("id=answer819549X193X22733", "label=Email me at [insert email address from QS1]");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X729X7376A1");
        $this->click("css=#javatbd819549X729X7377A1 > label.answertext");
        $this->click("id=answer819549X729X7377A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X730X7379A1");
        $this->click("css=label.answertext");
        $this->click("css=#javatbd819549X730X7380A1 > label.answertext");
        $this->click("id=answer819549X730X7380A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer819549X731X73821", "label=Call my phone number at [insert telephone number from QS2]");
        $this->select("id=answer819549X731X73822", "label=Call my phone number at [insert telephone number from QS2]");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X732X7384A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer819549X733X73871", "label=Email me at [insert email address from QS1]");
        $this->select("id=answer819549X733X73872", "label=Email me at [insert email address from QS1]");
        $this->select("id=answer819549X733X73873", "label=Email me at [insert email address from QS1]");
        $this->click("id=answer819549X733X73891");
        $this->select("id=answer819549X733X73891", "label=Email me at [insert email address from QS1]");
        $this->select("id=answer819549X733X73892", "label=Email me at [insert email address from QS1]");
        $this->select("id=answer819549X733X73893", "label=Email me at [insert email address from QS1]");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X735X7392A2");
        $this->click("css=#javatbd819549X735X7392A2 > label.answertext");
        $this->click("id=answer819549X735X7397A1");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function runFirstEStamp4ComandInterventionSurvey($n) {
        // 1. update participant intervention date
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_SUB(participant_intervention_link_datetime_start,INTERVAL 90 DAY) 
                  WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4Baseline')
                  AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
                ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
    
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
        
        // 3. update back to prevent cloning links 
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_ADD(participant_intervention_link_datetime_start,INTERVAL 90 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4Baseline')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        return $n;
    }
    
    protected function runEStamp4ComandInterventionSurvey($n) {
        // 1. update participant intervention date
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_SUB(participant_intervention_link_datetime_start,INTERVAL 90 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4ControlArmIntervention')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
    
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
    
        // 3. update back to prevent cloning links
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_ADD(participant_intervention_link_datetime_start,INTERVAL 90 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4ControlArmIntervention')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        AND participant_intervention_link_datetime_start < CURDATE()
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        return $n;
    }
    
    protected function eStampControlSurvey($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "estamp4" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("link=DO IT");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function runEStamp4FollowUpSurvey($n) {
        // 1. update participant intervention date
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_SUB(participant_intervention_link_datetime_start,INTERVAL 90 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4Self-TestResults')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
    
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
    
//         3. update back to prevent cloning links
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_ADD(participant_intervention_link_datetime_start,INTERVAL 90 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4Self-TestResults')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        return $n;
    }
    
    protected function runEStamp4TestResultsSurvey($n) {
        // 1. update participant intervention date
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_SUB(participant_intervention_link_datetime_start,INTERVAL 2 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4WelcomeKit')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
    
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
    
        // 3. update back to prevent cloning links
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_ADD(participant_intervention_link_datetime_start,INTERVAL 2 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4WelcomeKit')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        return $n;
    }
    
    protected function eStampTestResultsSurvey($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "estamp4" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->open("/en/main/dashboard");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer479586X473X4032A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer479586X474X7399", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=month479586X475X4036", "label=May");
        $this->select("id=day479586X475X4036", "label=06");
        $this->select("id=year479586X475X4036", "label=2009");
        $this->click("id=answer479586X475X4080A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer479586X477X4081A5");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer479586X478X4094A1");
        $this->click("id=answer479586X478X4095A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=month479586X479X4097", "label=Jun");
        $this->select("id=day479586X479X4097", "label=09");
        $this->select("id=year479586X479X4097", "label=2010");
        $this->click("id=answer479586X479X4098A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer479586X480X4099A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer479586X481X4113A1");
        $this->click("id=answer479586X481X4114A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer479586X482X4116", "23");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer479586X483X4117A1");
        $this->click("id=answer479586X483X4118SQ005");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer479586X484X4126A1");
        $this->click("id=answer479586X484X4127A2");
        $this->click("id=answer479586X484X4128A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer479586X485X4130A2");
        $this->click("id=answer479586X485X4131A5");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer479586X487X4145A2");
        $this->click("id=answer479586X487X4146A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    

    
    protected function eStampeRCTFollowUp4Survey($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "estamp4" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X490X4161A1");
        $this->click("id=answer932957X490X4163SQ001");
        $this->click("id=question4168");
        $this->click("id=answer932957X490X4168SQ001");
        $this->click("id=answer932957X490X4182A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X491X4184SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X492X4229SQ001");
        $this->click("id=month932957X492X4240");
        $this->select("id=month932957X492X4240", "label=Jul");
        $this->click("css=option[value=\"07\"]");
        $this->select("id=day932957X492X4240", "label=09");
        $this->select("id=year932957X492X4240", "label=2009");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X494X4241A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X495X4245A1");
        $this->click("id=answer932957X495X4246A1");
        $this->click("id=answer932957X495X4247SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X498X4303SQ001");
        $this->click("id=answer932957X498X4308SQ001");
        $this->click("id=answer932957X498X4313SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X501X4334SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X504X4385SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X507X4434A1");
        $this->type("id=answer932957X507X4469SQ001", "1");
        $this->type("id=answer932957X507X4469SQ002", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X510X4528A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X511X4529SQ001");
        $this->click("id=answer932957X511X4539SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X542X4839A1");
        $this->click("id=answer932957X542X4840SQ001");
        $this->click("id=answer932957X542X4851A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer932957X543X4852othertext", "1");
        $this->type("id=answer932957X543X4853othertext", "1");
        $this->type("id=answer932957X543X4854othertext", "1");
        $this->click("id=answer932957X543X4855othertext");
        $this->type("id=answer932957X543X4855othertext", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer932957X544X4856", "23");
        $this->click("id=answer932957X544X4857A1");
        $this->click("id=answer932957X544X4858SQ001");
        $this->click("id=answer932957X544X4866A5");
        $this->click("id=answer932957X544X4867A1");
        $this->click("id=answer932957X544X4868SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer932957X545X4877", "label=Date");
        $this->click("id=answer932957X545X4878A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer932957X546X4879", "label=Date");
        $this->click("id=answer932957X546X4880A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer932957X547X4881", "label=Date");
        $this->click("id=answer932957X547X4882A1");
        $this->click("id=answer932957X547X4883A1");
        $this->click("id=answer932957X547X4884A1");
        $this->click("id=answer932957X547X4885A1");
        $this->click("id=answer932957X547X4886A1");
        $this->click("id=answer932957X547X4887A1");
        $this->click("id=answer932957X547X4888A1");
        $this->click("id=answer932957X547X4889A1");
        $this->click("id=answer932957X547X4890A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer932957X548X4891", "label=Date");
        $this->click("id=answer932957X548X4892A1");
        $this->click("css=label.answertext");
        $this->click("id=answer932957X548X4893A1");
        $this->click("id=answer932957X548X4894A1");
        $this->click("id=answer932957X548X4895A1");
        $this->click("id=answer932957X548X4896A1");
        $this->click("id=answer932957X548X4897A1");
        $this->click("id=answer932957X548X4898A1");
        $this->click("id=answer932957X548X4899A1");
        $this->click("id=javatbd932957X548X4900A2");
        $this->click("id=answer932957X548X4900A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X549X4901A1");
        $this->click("css=label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer932957X550X4902", "0");
        $this->type("id=answer932957X550X4903", "0");
        $this->type("id=answer932957X550X4904SQ001", "1");
        $this->type("id=answer932957X550X4904SQ002", "1");
        $this->type("id=answer932957X550X4904SQ003", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer932957X551X4908", "1");
        $this->type("id=answer932957X551X4909SQ001", "a");
        $this->type("id=answer932957X551X4909SQ002", "s");
        $this->type("id=answer932957X551X4909SQ003", "w");
        $this->type("id=answer932957X551X4909SQ004", "d");
        $this->click("id=answer932957X551X4914A1");
        $this->click("id=answer932957X551X4915A1");
        $this->click("id=answer932957X551X4916SQ006");
        $this->click("id=answer932957X551X4924A1");
        $this->type("id=answer932957X551X4925", "1");
        $this->click("id=answer932957X551X4926A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer932957X569X5038SQ001comment", "1");
        $this->type("id=answer932957X569X5044SQ001", "1");
        $this->type("id=answer932957X569X5044SQ002", "1");
        $this->type("id=answer932957X569X5044SQ003", "1");
        $this->type("id=answer932957X569X5044SQ004", "1");
        $this->click("id=answer932957X569X5049SQ001");
        $this->type("id=answer932957X569X5049SQ001", "1");
        $this->type("id=answer932957X569X5049SQ002", "1");
        $this->type("id=answer932957X569X5049SQ003", "1");
        $this->type("id=answer932957X569X5049SQ004", "1");
        $this->type("id=answer932957X569X5054SQ001", "1");
        $this->type("id=answer932957X569X5054SQ002", "1");
        $this->type("id=answer932957X569X5054SQ003", "1");
        $this->type("id=answer932957X569X5054SQ004", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer932957X570X5059SQ001", "1");
        $this->type("id=answer932957X570X5059SQ002", "1");
        $this->type("id=answer932957X570X5059SQ003", "1");
        $this->type("id=answer932957X570X5059SQ004", "1");
        $this->click("id=answer932957X570X5064SQ001");
        $this->click("id=answer932957X570X5078A1");
        $this->click("id=answer932957X570X5082A1");
        $this->click("id=answer932957X570X5083A1");
        $this->click("id=answer932957X570X5084A1");
        $this->click("id=answer932957X570X5085A1");
        $this->click("id=answer932957X570X5086SQ001");
        $this->click("id=answer932957X570X5091SQ001");
        $this->type("id=answer932957X570X5091SQ001", "1");
        $this->type("id=answer932957X570X5091SQ002", "1");
        $this->type("id=answer932957X570X5091SQ003", "1");
        $this->type("id=answer932957X570X5091SQ005", "1");
        $this->type("id=answer932957X570X5091SQ004", "1");
        $this->type("id=answer932957X570X5097SQ001", "1");
        $this->type("id=answer932957X570X5097SQ002", "1");
        $this->type("id=answer932957X570X5097SQ003", "1");
        $this->type("id=answer932957X570X5097SQ005", "1");
        $this->type("id=answer932957X570X5097SQ004", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X571X5103A1");
        $this->click("id=answer932957X571X5104A1");
        $this->click("id=answer932957X571X5105A1");
        $this->click("id=answer932957X571X5106SQ001");
        $this->click("id=answer932957X571X5124A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X572X5125A1");
        $this->click("id=answer932957X572X5126A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X573X5127A1");
        $this->type("id=answer932957X573X5128SQ001", "1");
        $this->type("id=answer932957X573X5128SQ002", "1");
        $this->type("id=answer932957X573X5128SQ004", "1");
        $this->type("id=answer932957X573X5128SQ003", "1");
        $this->click("id=answer932957X573X5133SQ001");
        $this->type("id=answer932957X573X5133SQ001", "1");
        $this->type("id=answer932957X573X5133SQ003", "1");
        $this->type("id=answer932957X573X5133SQ002", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer932957X574X5137A1");
        $this->click("id=answer932957X574X5138A1");
        $this->click("id=answer932957X574X5139SQ001");
        $this->click("id=answer932957X574X5148SQ001");
        $this->click("id=answer932957X574X5155A1");
        $this->click("id=answer932957X574X5156A1");
        $this->click("id=answer932957X574X5157SQ001");
        $this->click("id=answer932957X574X5166SQ001");
        $this->click("id=answer932957X574X5173A1");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function eStampFinalTestResultsSurvey($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "estamp4" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer699237X514X4652SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer699237X515X4661", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer699237X516X4572A2");
        $this->click("id=answer699237X516X4573A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer699237X526X4596A2");
        $this->click("id=answer699237X526X4659A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function registerEStmap4HIVParticipant($n) {
        $this->open("/en/eStamp4/");
        $this->click("link=exact:ARE YOU ELIGIBLE?");
        $this->waitForPageToLoad("30000");
        $this->click("id=consentYes");
        $this->click("id=specimenYes");
        $this->click("id=continueBtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=surveyLink");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer232486X145X1975", "23");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer232486X146X1976", "label=Georgia");
        $this->type("id=answer232486X146X1977", "30308");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer232486X147X1978A1");
        $this->click("id=answer232486X147X1979SQ001");
        $this->click("id=answer232486X147X1986A1");
        $this->click("id=answer232486X147X1987A1");
        $this->click("css=#javatbd232486X147X1987A1 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer232486X148X1988A2");
        $this->click("css=#javatbd232486X148X1988A2 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer232486X149X1989A1");
        $this->click("css=label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer232486X150X1990A2");
        $this->click("css=#javatbd232486X150X1990A2 > label.answertext");
        $this->click("id=answer232486X150X1991A2");
        $this->click("css=#javatbd232486X150X1991A2 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("link=Continue to registration");
        $this->waitForPageToLoad("30000");
        $this->type("id=registration_participantEmail", "estamp4". $n ."@test.com");
        $this->type("id=registration_participantUsername", "estamp4". $n);
        $this->type("id=registration_participantPassword_first", "q1w2e3r4");
        $this->type("id=registration_participantPassword_second", "q1w2e3r4");
        $this->click("id=registration_next");
        $this->waitForPageToLoad("30000");
        $this->type("id=phone_phone_wide", "123".$n);
        $this->click("id=phone_sendCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=button.submit.m2");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=a.icon_logout.normal > span");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function eStampHIVBaselineSurvey($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "estamp4" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("link=DO IT");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X312X3016A1");
        $this->click("id=answer393626X312X3017A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X313X3018A1");
        $this->click("id=answer393626X313X3019A1");
        $this->type("id=answer393626X313X3021", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X314X3022A1");
        $this->click("id=answer393626X314X3023A1");
        $this->click("id=answer393626X314X3506A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X318X3033A1");
        $this->click("id=answer393626X318X3724SQ001");
//         $this->click("css=#javatbd393626X318X3724SQ001 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X319X3035A1");
        $this->click("id=answer393626X319X3036");
        $this->type("id=answer393626X319X3036", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer393626X320X3037", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X316X3754A1");
        $this->click("css=#javatbd393626X316X3754A1 > label.answertext");
        $this->click("id=navigator");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X317X3755A1");
        $this->click("id=answer393626X317X3756A1");
        $this->click("id=javatbd393626X317X3757A1");
        $this->click("id=answer393626X317X3757A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X348X3992A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X467X3995A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X468X3998A1");
        $this->click("id=answer393626X468X4001A1");
        $this->click("css=#javatbd393626X468X4001A1 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X469X4003A1");
        $this->click("css=#javatbd393626X469X4004A1 > label.answertext");
        $this->click("id=answer393626X469X4004A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X470X4006A1");
        $this->click("css=label.answertext");
        $this->click("css=#javatbd393626X470X4007A5 > label.answertext");
        $this->click("id=answer393626X470X4007A5");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X471X4019SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X472X4030A1");
        $this->click("css=label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X321X3040A1");
        $this->click("css=label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer393626X323X3046", "1");
        $this->keyUp("id=answer393626X323X3046", "1");
        $this->type("id=answer393626X323X3047SQ001", "a");
        $this->type("id=answer393626X323X3047SQ002", "s");
        $this->type("id=answer393626X323X3047SQ003", "w");
        $this->type("id=answer393626X323X3047SQ004", "d");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X324X3049A1");
        $this->click("id=answer393626X324X3050A1");
        $this->click("css=#javatbd393626X324X3050A1 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X325X3051SQ001");
        $this->click("id=answer393626X325X3052A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer393626X326X3053", "1");
        $this->keyUp("id=answer393626X326X3053", "1");
        $this->click("id=answer393626X326X3054A2");
        $this->click("css=#javatbd393626X326X3054A2 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer393626X337X3080SQ001", "1");
        $this->type("id=answer393626X337X3080SQ002", "0");
        $this->type("id=answer393626X337X3080SQ003", "0");
//         $this->click("css=#javatbd393626X337X3081SQ001 > label.answertext");
        $this->click("id=answer393626X337X3081SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X338X3082A1");
        $this->click("id=answer393626X338X3083A1");
        $this->click("css=#javatbd393626X338X3084A1 > label.answertext");
        $this->click("id=answer393626X338X3084A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X339X3085A1");
        $this->click("css=label.answertext");
        $this->click("id=answer393626X339X3086A1");
        $this->click("css=#javatbd393626X339X3086A1 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X340X3088SQ001-A1");
        $this->click("//tr[@id='javatbd393626X340X3088SQ002']/td/label");
        $this->click("id=answer393626X340X3088SQ002-A1");
        $this->click("//tr[@id='javatbd393626X340X3088SQ003']/td");
        $this->click("id=answer393626X340X3088SQ004-A1");
        $this->click("id=answer393626X340X3088SQ005-A1");
        $this->click("id=answer393626X340X3088SQ006-A1");
        $this->click("id=answer393626X340X3088SQ007-A1");
        $this->click("id=answer393626X340X3088SQ008-A1");
        $this->click("id=answer393626X340X3088SQ009-A1");
        $this->click("id=answer393626X340X3088SQ010-A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X341X3090A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X342X3094A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X343X3099A1");
        $this->click("css=label.answertext");
        $this->click("css=#javatbd393626X343X3101A1 > label.answertext");
        $this->click("id=answer393626X343X3101A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X344X3103A2");
        $this->click("id=answer393626X344X3761A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X345X3106A1");
        $this->click("css=#javatbd393626X345X3107A1 > label.answertext");
        $this->click("id=answer393626X345X3107A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer393626X346X3109A1");
        $this->click("id=javatbd393626X346X3110A1");
        $this->click("id=answer393626X346X3110A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->select("id=answer393626X347X31121", "label=Call my phone number at [insert telephone number from QS2]");
        $this->select("id=answer393626X347X31122", "label=Call my phone number at [insert telephone number from QS2]");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function runFirstEStamp4HIVFollowUpSurvey($n) {
        // 1. update participant intervention date
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_SUB(participant_intervention_link_datetime_start,INTERVAL 90 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4HIVBaseline')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
    
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
    
        // 3. update back to prevent cloning links
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_ADD(participant_intervention_link_datetime_start,INTERVAL 90 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4HIVBaseline')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        return $n;
    }
    
    protected function eStamp4HIVFollowUpSurvey($n){
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "estamp4" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer254935X529X4702SQ001", "1");
        $this->type("id=answer254935X529X4702SQ002", "1");
        $this->keyUp("id=answer254935X529X4702SQ002", "1");
        $this->click("css=label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer254935X530X4712SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer254935X532X4742A1");
        $this->click("id=answer254935X532X4745SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer254935X534X4765", "23");
        $this->click("id=answer254935X534X4766A1");
        $this->click("id=answer254935X534X4767SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer254935X535X4775A1");
        $this->click("id=answer254935X535X4776A1");
        $this->click("css=#javatbd254935X535X4776A1 > label.answertext");
        $this->click("id=javatbd254935X535X4777A1");
        $this->click("id=answer254935X535X4777A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer254935X536X4778A1");
        $this->click("css=#question4782 > div.answer.clearfix > ul.answers-list.radio-list > li.answer-item.radio-item > label.answertext");
        $this->click("css=li.answer-item.radio-item > input[name=\"254935X536X4782\"]");
        $this->click("id=answer254935X536X4783A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("css=li.answer-item.radio-item > input[name=\"254935X537X4785\"]");
        $this->click("id=answer254935X537X4786A1");
        $this->click("id=answer254935X537X4787A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer254935X539X4791A1");
        $this->click("id=answer254935X539X4792A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer254935X540X4794A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function runEStamp4HIVFollowUpSurvey($n) {
        // 1. update participant intervention date
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_SUB(participant_intervention_link_datetime_start,INTERVAL 90 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4HIVWelcomeKit')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
    
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
    
        // 3. update back to prevent cloning links
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_ADD(participant_intervention_link_datetime_start,INTERVAL 90 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'eStamp4HIVWelcomeKit')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'eStamp4".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        return $n;
    }
}
