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
        for ($i = 1; $i <= $n; $i++){
            $this->registerEStmap4Participant($i);
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
    }
    
    /**
     * @depends testKAHRegistration
     */
    public function testKAHBaseline($n) {
        // verify email to get baseline survey
        for ($i = 1; $i <= $n; $i++){
            $this->activateEmail($i);
            $this->eStampBaselineSurvey($i);
        }
        return $n;
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
    }
    
    
    
    protected function eStampBaselineSurvey($n) {
        $this->open("/en/main/dashboard");
        $this->click("css=div.button_box > a > span");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X156X2004A1");
        $this->click("id=answer819549X156X2005A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X157X2006A1");
        $this->click("id=answer819549X157X2007A4");
        $this->click("id=answer819549X157X2009");
        $this->type("id=answer819549X157X2009", "1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X158X2010A1");
        $this->click("id=answer819549X158X2011A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X159X2013SQ001");
        $this->click("id=answer819549X159X2026A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X160X2042SQ001");
        $this->click("id=answer819549X160X2046A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer819549X161X2056", "0");
        $this->click("id=answer819549X161X205710");
        $this->click("css=#javatbd819549X161X205710 > label.answertext");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X162X2059A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X165X2089A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer819549X167X2100", "1");
        $this->type("id=answer819549X167X2101SQ001", "a");
        $this->type("id=answer819549X167X2101SQ002", "s");
        $this->type("id=answer819549X167X2101SQ003", "w");
        $this->type("id=answer819549X167X2101SQ004", "d");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X168X2107A1");
        $this->click("id=answer819549X168X2108A6");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X169X2109SQ006");
        $this->click("id=answer819549X169X2117A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer819549X170X2118", "0");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->type("id=answer819549X181X2182SQ001", "1");
        $this->type("id=answer819549X181X2182SQ002", "0");
        $this->type("id=answer819549X181X2182SQ003", "0");
        $this->click("id=answer819549X181X2186SQ005");
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
        $this->click("//tr[@id='javatbd819549X184X2210SQ006']/td");
        $this->click("//tr[@id='javatbd819549X184X2210SQ007']/td");
        $this->click("id=answer819549X184X2210SQ008-A1");
        $this->click("//tr[@id='javatbd819549X184X2210SQ009']/td");
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
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X190X2266A1");
        $this->click("id=answer819549X190X2267A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X729X7376A1");
        $this->click("id=answer819549X729X7377A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X730X7379A1");
        $this->click("css=label.answertext");
        $this->click("css=#javatbd819549X730X7380A1 > label.answertext");
        $this->click("id=answer819549X730X7380A1");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X732X7384A2");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("xpath=(//button[@id='movenextbtn'])[2]");
        $this->waitForPageToLoad("30000");
        $this->click("id=answer819549X735X7392A2");
        $this->click("css=#javatbd819549X735X7392A2 > label.answertext");
        $this->click("id=answer819549X735X7397A1");
        $this->click("xpath=(//button[@id='movesubmitbtn'])[2]");
        $this->waitForPageToLoad("30000");
    }
    
}
