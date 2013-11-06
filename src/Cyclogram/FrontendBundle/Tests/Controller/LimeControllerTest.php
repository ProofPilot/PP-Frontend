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

class LimeControllerTest extends \PHPUnit_Extensions_SeleniumTestCase
{
	protected function setUp()
	{
		$this->setBrowser("*chrome");
		$this->setBrowserUrl("https://beta.proofpilot.com/lime/index.php/survey/index/sid/356367/newtest/Y/lang/en");
	}
	
	public function testProdSurvey()
	{
		for ($i=0; $i < 200; $i++) {
			$this->open("/lime/index.php/survey/index/sid/356367/newtest/Y/lang/en");
			$this->click("id=answer356367X752X7873A1");
			$this->click("id=answer356367X752X7874A1");
			$this->click("id=answer356367X752X7875A1");
			$this->click("css=#middle > #movenextbtn");
			$this->waitForPageToLoad("30000");
			$this->type("id=answer356367X753X7876", "test");
			$this->type("id=answer356367X753X7877", "test");
			$this->type("id=answer356367X753X7878", "test");
			$this->type("id=answer356367X753X7879", "test");
			$this->click("id=answer356367X753X7880SQ001-1");
			$this->click("id=answer356367X753X7880SQ002-2");
			$this->click("id=answer356367X753X7880SQ003-3");
			$this->click("id=answer356367X753X7881SQ001-1");
			$this->click("//tr[@id='javatbd356367X753X7881SQ002']/td[2]");
			$this->click("id=answer356367X753X7881SQ003-3");
			$this->click("//tr[@id='javatbd356367X753X7881SQ004']/td[4]");
			$this->click("id=answer356367X753X7881SQ005-5");
			$this->click("css=#middle > #movesubmitbtn");
			$this->waitForPageToLoad("30000");
		}
		// $this->();
	}
}
