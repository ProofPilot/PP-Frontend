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
class KOCTest  extends  \PHPUnit_Extensions_SeleniumTestCase
{
    protected $dbhandle;
    protected $selected;
    
    protected function setUp(){
        $this->setBrowser("*chrome");
        $this->setBrowserUrl(SITEHOST . "/en/koc/");
        $this->dbhandle = mysql_connect(DBHOSTNAME, DBUSERNAME, DBPASSWORD)
        or die("Unable to connect to MySQL");
        //select a database to work with
        $this->selected = mysql_select_db('proofpilot', $this->dbhandle)
        or die("Could not select database");
        $this->setSpeed(200);
    }
    
    // set the participant quantity in $n
    public function testKOCRegistration(){
        $n=1;
        for ($i = 1; $i <= $n; $i++){
            $this->KOCParticipantRegistration($i);
            $this->KOCbaselineSurvey($i);
            $this->runKOCTechnologyUseSurvey($i);
            $this->KOCTechnologySurvey($i);
            $this->runKOCCondomPickUpInterventionSurvey($i);
            $this->KOCPickUpSurvey($i);
            $this->runKOCFollowUpSurvey($i);
            $this->KOCFollowUpSurvey($i);
        }
    }
    
    protected function KOCParticipantRegistration($n)
    {
        $this->open("/en/koc/");
        $this->click("css=a.sign_up > span");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer362142X497X4261", "23");
        $this->click("id=answer362142X497X4265A1");
        $this->click("id=answer362142X497X4260A1");
        $this->click("id=answer362142X497X4263SQ001");
        $this->click("id=answer362142X497X4263SQ003");
        $this->click("id=answer362142X497X4263SQ001");
        $this->click("id=answer362142X497X6203A1");
        $this->click("id=answer362142X497X6204A1");
        $this->click("id=answer362142X497X4269SQ001");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer362142X531X4734SQ001");
        $this->click("id=answer362142X531X4730SQ001");
        $this->click("id=answer362142X531X4714SQ001");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        for ($second = 0; ; $second++) {
            if ($second >= 60) $this->fail("timeout");
            try {
                if ($this->isElementPresent("css=a.green > span")) break;
            } catch (Exception $e) {
            }
            sleep(1);
        }
        
        $this->click("css=a.green > span");
        $this->waitForPageToLoad("30000");
        $this->type("id=registration_participantEmail", "koc".$n."@mail.com");
        $this->type("id=registration_participantUsername", "koc".$n);
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
    }
    
    protected function KOCbaselineSurvey($n)
    {
        $this->open("/en/login");
        $this->type("id=reg_field_1", "koc".$n);
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer432264X499X6973", "23");
        $this->click("id=answer432264X499X4323Y");
        $this->click("id=answer432264X499X69745");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("css=a.icon_logout.normal > span");
        $this->waitForPageToLoad("30000");
    }
    
    protected function runKOCTechnologyUseSurvey($n) {
        // 1. update participant intervention date
        $query = "UPDATE participant_arm_link SET participant_arm_link_datetime = DATE_SUB(participant_arm_link_datetime,INTERVAL 1 DAY)
        WHERE arm_id = (SELECT arm_id FROM arm WHERE arm.arm_code = 'KOCOnlineOnlyArm')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'KOC".$n."')";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
    
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
    
        // 3. update back to prevent cloning links
        $query = "UPDATE participant_arm_link SET participant_arm_link_datetime = DATE_ADD(participant_arm_link_datetime,INTERVAL 1 DAY)
        WHERE arm_id = (SELECT arm_id FROM arm WHERE arm.arm_code = 'KOCOnlineOnlyArm')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'KOC".$n."')";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        return $n;
    }
    
    protected function KOCTechnologySurvey($n)
    {
        $this->open("/en/login");
        $this->type("id=reg_field_1", "koc".$n);
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->open("/en/main/dashboard");
        $this->click("link=DO IT");
        $this->waitForPageToLoad("30000");
        $this->click("id=navigator");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("css=a.icon_logout.normal > span");
        $this->waitForPageToLoad("30000");
    }

    protected function runKOCCondomPickUpInterventionSurvey($n) {
        // 1. update participant intervention date
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_SUB(participant_intervention_link_datetime_start,INTERVAL 3 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'KOCTechnologyUseSurvey')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'KOC".$n."')
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
    
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
    
        // 3. update back to prevent cloning links
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_ADD(participant_intervention_link_datetime_start,INTERVAL 3 DAY)
        WHERE intervention_id = (SELECT intervention_id FROM intervention WHERE intervention.intervention_code = 'KOCTechnologyUseSurvey')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'KOC".$n."')
        AND participant_intervention_link_datetime_start < CURDATE()
        ORDER BY participant_intervention_link_id DESC LIMIT 1";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        return $n;
    }
    
    protected function KOCPickUpSurvey($n)
    {
        $this->open("/en/login");
        $this->type("id=reg_field_1", "koc".$n);
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->open("/en/main/dashboard");
        $this->click("link=DO IT");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer949233X694X6871N");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("css=a.icon_logout.normal > span");
        $this->waitForPageToLoad("30000");
    }
    
    protected function runKOCFollowUpSurvey($n) {
        // 1. update participant intervention date
        $query = "UPDATE participant_arm_link SET participant_arm_link_datetime = DATE_SUB(participant_arm_link_datetime,INTERVAL 30 DAY)
        WHERE arm_id = (SELECT arm_id FROM arm WHERE arm.arm_code = 'KOCOnlineOnlyArm')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'KOC".$n."')";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
    
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
    
        // 3. update back to prevent cloning links
        $query = "UPDATE participant_arm_link SET participant_arm_link_datetime = DATE_ADD(participant_arm_link_datetime,INTERVAL 30 DAY)
        WHERE arm_id = (SELECT arm_id FROM arm WHERE arm.arm_code = 'KOCOnlineOnlyArm')
        AND participant_id = (SELECT participant_id FROM participant WHERE participant.participant_username = 'KOC".$n."')";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        return $n;
    }
    
    protected function KOCFollowUpSurvey($n)
    {
        $this->open("/en/login");
        $this->type("id=reg_field_1", "koc".$n);
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->open("/en/main/dashboard");
        $this->click("link=DO IT");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("css=a.icon_logout.normal > span");
        $this->waitForPageToLoad("30000");
    }
}
