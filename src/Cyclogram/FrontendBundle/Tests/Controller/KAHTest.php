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

class KAHTest extends \PHPUnit_Extensions_SeleniumTestCase
{

    protected $username = "root";
    protected $password = "q1w2e3";
    protected $hostname = "localhost"; 
    protected $dbhandle;
    protected $selected;
    
    protected function setUp(){
        $this->setBrowser("*chrome");
        $this->setBrowserUrl("http://frontend-dm.proofpilot.dyndns.org/en/sexpro");
        $this->dbhandle = mysql_connect($this->hostname, $this->username, $this->password)
                                or die("Unable to connect to MySQL");
        //select a database to work with
        $this->selected = mysql_select_db("proofpilot",$this->dbhandle)
                                or die("Could not select database");
        $this->setSpeed(200);
    }

    // set the participant quantity in $n 
    public function testKAHRegistration(){
        
    }
    
    public function testKAHBaseline() {
        
    }
    
    public function testKAHFollowUp() {
    // 1. update participant intervention date
    // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" )
    
    
    }
    
    public function testKAHReportResults() {
    
    }
    
    //-------------- Single User Registration -------------------
    protected function registerKAHParticipant($number)
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
        $this->type("id=registration_participantEmail", "test". $number ."@test.com");
        $this->type("id=registration_participantUsername", "dime". $number);
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
    
    
    //-------------- Checkinfo -------------------
//     public function testDatabase()
//     {
//       $result = mysql_query("SELECT *  FROM participant", $this->dbhandle);
      
//       //fetch tha data from the database
//       while ($row = mysql_fetch_array($result)) {
//           echo "ID:".$row['participant_id']."\n";
//       }
//       mysql_close($this->dbhandle);
//     }
}

