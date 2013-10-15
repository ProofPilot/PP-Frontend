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

class KAHTest extends  \PHPUnit_Extensions_SeleniumTestCase //\PHPUnit_Extensions_Selenium2TestCase
{

    protected $dbhandle;
    protected $selected;
    
    protected function setUp(){
        $this->setBrowser("*chrome");
        $this->setBrowserUrl(SITEHOST . "/en/knowathome/");
        $this->dbhandle = mysql_connect(DBHOSTNAME, DBUSERNAME, DBPASSWORD)
                                or die("Unable to connect to MySQL");
        //select a database to work with
        $this->selected = mysql_select_db('proofpilot', $this->dbhandle)
                                or die("Could not select database");
        $this->setSpeed(200);
    }

    // set the participant quantity in $n 
    public function testKAHRegistration(){
        $n=1;
        for ($i = 1; $i <= $n; $i++){
            $this->registerKAHParticipant($i);
        }
        return $n;
    }
    
    /**
     * @depends testKAHRegistration
     */
    public function testKAHBaseline($n) {
        // verify email to get baseline survey
        for ($i = 1; $i <= $n; $i++){
            $this->activateEmail($i);
            $this->kahBaselineSurvey($i);
        }
        return $n;
    }
    
    /**
     * @depends testKAHBaseline
     */
    public function testKAHReportResults($n) {
        // 0. first need to login to create new intervention link
        for ($i = 1; $i <= $n; $i++){
            $this->login($i);
        }
        // 1. update participant intervention date
        $query = "UPDATE participant_intervention_link SET participant_intervention_link_datetime_start = DATE_SUB(participant_intervention_link_datetime_start,INTERVAL 3 DAY), status_id = '11' WHERE intervention_id = 22";
        mysql_query($query, $this->dbhandle) or die('updating error'. mysql_error());
        printf ("Records updated: %d\n", mysql_affected_rows());
        
        // 2. shell_exec ( "cd ./../../../.. & php app/console run:generalcommand 17" );
        system('php app/console run:generalcommand ' . date('H'));
        for ($i = 1; $i <= $n; $i++){
            $this->kahReportResultsSurvey($i);
        }
        return $n;
    }
    
    /**
     * @depends testKAHReportResults
     */
    public function testKAHFollowUp($n) {
        for ($i = 1; $i <= $n; $i++){
            $this->kahFollowUPSurvey($i);
        }
        return $n;
    
    }
    
    //-------------- Single User Registration -------------------
    protected function registerKAHParticipant($n)
    {
        $this->open("/en/knowathome/");
        $this->click("link=exact:ARE YOU ELIGIBLE?");
        $this->waitForPageToLoad("30000");
        $this->click("id=consentYes");
        $this->click("id=specimenYes");
        $this->click("id=continueBtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=surveyLink");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer349799X690X6787Y");
        $this->click("id=movenextbtn");
        $this->waitForPageToLoad("30000");
        //$this->click("name=r1answer349799X591X5493");
        //$this->sendKeys("id=answer349799X591X5493", "25");
        $this->type("id=answer349799X591X5493", "25");
        $this->keyUp("id=answer349799X591X5493", "2");
        $this->select("id=answer349799X591X5505", "label=Texas");
        //$this->click("name=r1answer349799X591X5496");
        $this->type("id=answer349799X591X5496", "75001");
        $this->click("id=answer349799X591X5494A2");
        $this->click("id=answer349799X591X5495SQ001");
        $this->click("id=movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer349799X592X5497A1");
        $this->click("id=answer349799X592X5498A1");
        $this->click("id=movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer349799X737X5499A2");
        $this->click("id=movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer349799X593X5502A1");
        $this->click("id=answer349799X593X5500A2");
        $this->click("id=movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer349799X594X5503A1");
        $this->click("id=answer349799X594X5504A1");
        $this->click("id=movesubmitbtn");
        $this->waitForPageToLoad("30000");
        $this->click("link=Continue to registration");
        $this->waitForPageToLoad("30000");
        $this->type("id=registration_participantEmail", "kah". $n ."@test.com");
        $this->type("id=registration_participantUsername", "kah" . $n);
        $this->type("id=registration_participantPassword_first", "q1w2e3r4");
        $this->type("id=registration_participantPassword_second", "q1w2e3r4");
        $this->click("id=registration_next");
        $this->waitForPageToLoad("30000");
        $this->type("id=phone_phone_wide", "23345" . $n);
        $this->click("id=phone_sendCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=button.submit.m2");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function activateEmail($n) {
        $query = "SELECT
        *
        FROM
        participant
        WHERE participant_email = 'kah" .$n . "@test.com'";
        $participantRes = mysql_query($query, $this->dbhandle);
        $participant = mysql_fetch_array($participantRes);
        mysql_free_result($participantRes);
        $this->open(SITEHOST . "/en/register/email_verify/" .$participant['participant_email']. "/" . $participant['participant_email_code']);
        $this->open("/en/logout");
    }
    
    protected function kahBaselineSurvey($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "kah" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer169385X607X5883A1");
        $this->click("id=answer169385X607X5884A1");
        $this->click("id=answer169385X607X5885A1");
        $this->click("id=answer169385X607X5886A1");
        $this->click("id=answer169385X607X5888");
        $this->type("id=answer169385X607X5888", "2");
        $this->click("id=answer169385X607X5889A1");
        $this->click("id=answer169385X607X5890A1");
        $this->click("id=answer169385X607X5891A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer169385X608X5892SQ007");
        $this->click("id=answer169385X608X6250A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->select("id=month169385X609X5893", "label=Apr");
        $this->select("id=year169385X609X5893", "label=2008");
        $this->type("id=answer169385X609X5894", "21");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer169385X615X5895A1");
        $this->click("id=answer169385X615X5896A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer169385X610X5897A1");
        $this->click("id=answer169385X610X5898A1");
        $this->click("id=answer169385X610X5899A1");
        $this->click("id=answer169385X610X5902SQ001");
        $this->type("id=answer169385X610X5903", "2");
        $this->click("id=panel_right");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer169385X616X5904SQ001");
        $this->click("id=answer169385X616X5905SQ001");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer169385X611X5906A1");
        $this->click("id=answer169385X611X5907A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer169385X612X5910A1");
        $this->click("id=answer169385X612X5911A5");
        $this->click("id=answer169385X612X5915A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer169385X613X5920A1");
        $this->click("id=answer169385X613X5921A1");
        $this->click("id=answer169385X613X5922A1");
        $this->click("id=answer169385X613X5923A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer169385X614X5924");
        $this->type("id=answer169385X614X5924", "3");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer169385X617X5925", "3");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer169385X618X5929", "3");
        $this->type("id=answer169385X618X5930", "3");
        $this->type("id=answer169385X618X5931", "3");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=question5932");
        $this->click("id=answer169385X619X5932A2");
        $this->click("id=answer169385X619X6044Y");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("css=#middle > #movesubmitbtn");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function kahFollowUPSurvey($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "kah" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer543977X629X6134A1");
        $this->click("id=answer543977X629X6135SQ001");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer543977X630X6140A1");
        $this->click("id=answer543977X630X6141SQ001");
        $this->click("id=answer543977X630X6150A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer543977X631X6151A1");
        $this->click("id=answer543977X631X6163A1");
        $this->click("id=answer543977X631X6164A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer543977X632X6165A1");
        $this->click("id=answer543977X632X6166A1");
        $this->click("id=answer543977X632X6167A1");
        $this->click("id=answer543977X632X6168A1");
        $this->click("id=answer543977X632X6169A1");
        $this->click("id=answer543977X632X6170A1");
        $this->click("id=answer543977X632X6172A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer543977X633X6173A1");
        $this->click("id=answer543977X633X6174A1");
        $this->click("id=answer543977X633X6175A1");
        $this->click("id=answer543977X633X6176A1");
        $this->click("id=answer543977X633X6198A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer543977X634X6177A1");
        $this->click("id=answer543977X634X6178A1");
        $this->click("id=answer543977X634X6179A1");
        $this->click("id=answer543977X634X6180A1");
        $this->click("id=answer543977X634X6181A1");
        $this->click("id=answer543977X634X6182A1");
        $this->click("id=answer543977X634X6184A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer543977X637X6185A1");
        $this->click("id=answer543977X637X6186A1");
        $this->click("id=answer543977X637X6187A1");
        $this->click("id=answer543977X637X6188A1");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer543977X635X6190A1");
        $this->click("id=answer543977X635X6192Y");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("css=#middle > #movesubmitbtn");
        $this->waitForPageToLoad("30000");
        $this->open("/en/main/dashboard");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function kahReportResultsSurvey($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_1", "kah" . $n);
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer295666X78X1035SQ001");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer295666X79X1036", "456645");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer295666X621X6046A2");
        $this->click("id=answer295666X621X6047A6");
        $this->click("css=#middle > #movenextbtn");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer295666X628X6127A1");
        $this->click("id=answer295666X628X6129N");
        $this->click("id=answer295666X628X6129Y");
        $this->click("css=#middle > #movesubmitbtn");
        $this->waitForPageToLoad("30000");
        $this->open("/en/main/dashboard");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function login($n) {
        $this->open("/en/login");
        $this->type("id=reg_field_2", "q1w2e3r4");
        $this->type("id=reg_field_1", "kah" . $n);
        $this->click("css=button.submit.btn_login");
        $this->waitForPageToLoad("30000");
        $this->type("id=sms_confirm_sms_code", "1111");
        $this->click("id=sms_confirm_confirmCode");
        $this->waitForPageToLoad("30000");
        $this->open("/en/logout");
    }
    
    protected function tearDown()
    {
        mysql_close($this->dbhandle);
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

