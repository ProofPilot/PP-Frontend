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

class SexProTest extends \PHPUnit_Extensions_SeleniumTestCase
{
    protected $dbhandle;
    protected $selected;
    
    protected function setUp(){
        $this->setBrowser("*chrome");
        $this->setBrowserUrl( SITEHOST . "/en/sexpro");
        $this->dbhandle = mysql_connect(DBHOSTNAME, DBUSERNAME, DBPASSWORD)
                                or die("Unable to connect to MySQL");
        //select a database to work with
        $this->selected = mysql_select_db("proofpilot",$this->dbhandle)
                                or die("Could not select database");
        $this->setSpeed(200);
    }

    //-------------  SexPro Registration; set the participant quantity in $n ---------------- 
    public function testSexProRegistration(){
        $n=8;
        for ($i = 1; $i <= $n; $i++){
            $this->registerSexProParticipant($i);
        }
        return $n;
    }
    
    //-------------- SexpPro Single User Registration -------------------
    protected function registerSexProParticipant($number)
    {
        $this->open("/en/sexpro/");
        $this->click("css=a.sign_up > span");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer468727X596X5526", "25");
        $this->click("id=answer468727X596X5527A2");
        $this->click("id=answer468727X596X5528A2");
        $this->click("css=#middle > #movesubmitbtn");
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
        $this->type("id=registration_participantEmail", "sexpro". $number ."@test.com");
        $this->type("id=registration_participantUsername", "sexpro". $number);
        $this->type("id=registration_participantPassword_first", "q1w2e3r4");
        $this->type("id=registration_participantPassword_second", "q1w2e3r4");
        $this->click("id=registration_next");
        $this->waitForPageToLoad("30000");
        $this->type("id=phone_phone_wide", "345". $number);
        $this->click("id=phone_sendCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=button.submit.m2");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    //-------------- SexProRandomization between arms -------------------
    /**
     * @depends testSexProRegistration
     */
    public function testSexProRandomization($n)
    {
      // SexPro Baseline (activity) : SexPro 3 Month = 2 : 1
//       $participants = array();
//       for ($i = 0; $i < $n; $i++) {
//           array_push($participants, "test". $i ."@test.com");
//       }
      
      // Expected participant quantity in each arm
      $baseLineExpected = floor($n * 2 / 3);
      $threeMonthExpected = $n - $baseLineExpected;

      // selecting SexProBaseline participants 
      $query = "SELECT
                *
                FROM
                participant
                INNER JOIN participant_arm_link ON participant.participant_id = participant_arm_link.participant_id
                INNER JOIN arm ON arm.arm_id = participant_arm_link.arm_id
                where arm.arm_code = 'SexProBaseLine'";
      $baseLineParticipants = mysql_query($query, $this->dbhandle);
      $baseLineParticipantsCount = mysql_num_rows($baseLineParticipants);
      mysql_free_result($baseLineParticipants);
      // END: selecting SexProBaseline participants
      
      // selecting SexPro3Month participants 
      $query = "SELECT
                *
                FROM
                participant
                INNER JOIN participant_arm_link ON participant.participant_id = participant_arm_link.participant_id
                INNER JOIN arm ON arm.arm_id = participant_arm_link.arm_id
                where arm.arm_code = 'SexPro3Month'";
      $threeMonthParticipants = mysql_query($query, $this->dbhandle);
      $threeMonthParticipantsCount = mysql_num_rows($threeMonthParticipants);
      mysql_free_result($threeMonthParticipants);
      // END: selecting SexPro3Month participants
     
      $this->assertEquals($baseLineExpected, $baseLineParticipantsCount);
      $this->assertEquals($threeMonthExpected, $threeMonthParticipantsCount);
    }
    
    
    
    protected function tearDown()
    {
        mysql_close($this->dbhandle);
    }
}

