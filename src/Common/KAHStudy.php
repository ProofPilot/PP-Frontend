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

use Cyclogram\Bundle\ProofPilotBundle\Entity\Orders;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Study;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Specimen;
use Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenHistory;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Test;
use Cyclogram\Bundle\ProofPilotBundle\Entity\OrderSpecimenLink;
use Cyclogram\Bundle\ProofPilotBundle\Entity\SpecimenTestLink;
use Cyclogram\Bundle\ProofPilotBundle\Entity\TestHistory;
use Cyclogram\Bundle\ProofPilotBundle\Entity\User;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\CyclogramCommon;

class KAHStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes() {
        return array('Phase3Default');
    }
    
    public function getInterventionCodes() {
        return array('KAHPhase3Baseline','KAHPhase3TestPackage', 'KAHPhase3ReportResults',
                'KAHPhase3FollowUp');
    }
    
    public function studyRegistration($participant, $surveyId, $saveId) {
        $em = $this->container->get('doctrine')->getEntityManager();
        //Add participants to Default Arm at the moment.
        $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('Phase3Default');
        $armData = ( ! is_null( $armData )  ) ? $armData : false;
        
        $armStatus = $em->getRepository('CyclogramProofPilotBundle:Status')->find( 1 );
        $armStatus = ( ! is_null( $armStatus ) ) ? $armStatus : false;
        
        $ArmParticipantLink = null;
        if( $armData ){
            $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
            $ArmParticipantLink->setArm($armData);
            $ArmParticipantLink->setParticipant($participant);
            $ArmParticipantLink->setStatus($armStatus);
            $ArmParticipantLink->setParticipantArmLinkDatetime( new \DateTime("now") );
        }
        $em->persist($ArmParticipantLink);
        
        $em->flush();
        
        $status = $em->getRepository('CyclogramProofPilotBundle:Status')
        ->find(1);
    }
    
    public function interventionLogic($participant) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($this->getStudyCode());
        //get all participant intervention links
        $interventionLinks = $em
        ->getRepository('CyclogramProofPilotBundle:Participant')
        ->getParticipantInterventionLinks($participant, $study);
        if (($participant->getParticipantEmailConfirmed() == true) && empty($interventionLinks)) {
            $status = $em->getRepository('CyclogramProofPilotBundle:Status')
            ->find(1);
            $participantInterventionLink = new ParticipantInterventionLink();
            $intervention = $em
            ->getRepository('CyclogramProofPilotBundle:Intervention')
            ->findOneByInterventionCode('KAHPhase3Baseline');
            $participantInterventionLink->setIntervention($intervention);
            $participantInterventionLink->setParticipant($participant);
            $participantInterventionLink
            ->setParticipantInterventionLinkDatetimeStart(
                    new \DateTime("now"));
            $participantInterventionLink->setStatus($status);
            $em->persist($participantInterventionLink);
            $em->flush($participantInterventionLink);
        }

        foreach ($interventionLinks as $interventionLink) {
            $interventionCode = $interventionLink->getIntervention()
                    ->getInterventionCode();
            $intervention = $interventionLink->getIntervention();
            $status = $interventionLink->getStatus()->getStatusName();
            switch ($interventionCode) {
            case "KAHPhase3Baseline":
                    $surveyId = $intervention->getSidId();
                    if ($status == "Active") {
                        $passed = $em
                            ->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                            ->checkIfSurveyPassed($participant, $surveyId);
                        
                        if ($passed) {
                            $surveyLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->findOneBy(array('participant'=>$participant,'sidId'=>$surveyId));
     
                            $surveyResult = $this->container->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData($surveyLink->getSaveId(), $surveyId);
                            if(isset($surveyResult['169385X619X5932'])) {
                                switch ($surveyResult['169385X619X5932']) {
                                    case "A1" :
                                        $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName('Paypal Gift Card');
                                        break;
                                    case "A2" :
                                        $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName('Amazon Gift Card');
                                        break;
                                    case "A3" :
                                        $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName('None');
                                        break;
                                }
                            }
                            
                            $this->createIncentive($participant, $intervention, $incentiveType->getIncentiveTypeName());
                            $completedStatus = $em->getRepository('CyclogramProofPilotBundle:Status')
                                    ->findOneByStatusName("Closed");
                            $interventionLink->setStatus($completedStatus);
                            $em->persist($interventionLink);
                            $em->flush();
                            $status = "Closed";
                           
                            $intervention = $em
                            ->getRepository('CyclogramProofPilotBundle:Intervention')
                            ->findOneByInterventionCode("KAHPhase3TestPackage");
                            $em->getRepository('CyclogramProofPilotBundle:Participant')
                            ->addParticipantInterventionLink($participant,$intervention);
                            $em->persist($interventionLink);
                            $em->flush();
                            //inserting order
                            $order = new Orders();
                            $order->setOrderDatetime(new \Datetime('now'));
                            $courier = $em->getRepository('CyclogramProofPilotBundle:Courier')->find(1);
                            $order->setCourier($courier);
                            $productCourier = $em->getRepository('CyclogramProofPilotBundle:CourierProduct')->find(1);
                            $order->setCourierProduct($productCourier);
                            $order->setParticipant($participant);
                            $order->setStudy($study);
                            $status = $em->getRepository('CyclogramProofPilotBundle:Status')
                            ->findOneByStatusName("Active");
                            $order->setStatus($status);
                            $em->persist($order);
                            $em->flush();
                            //inserting speciment
                            $specimen = new Specimen();
                            $specimen->setSpecimenName('STE123');
                            $kitNumber = "SPKN-" . $participant->getParticipantId() . "-TE";
                            $kitNumber = "";
                            $specimen->setSpecimenKitNumber($kitNumber);
                            $specimen->setSpecimenPhase($em->getRepository('CyclogramProofPilotBundle:SpecimenPhase')->find( 1 ));
                            $specimen->setSpecimenFdaApprovalStatus(1);
                            $specimen->setSpecimenCollectionTool($em->getRepository('CyclogramProofPilotBundle:SpecimenCollectionTool')->find( 1 ));
                            $specimen->setCollectorForum($em->getRepository('CyclogramProofPilotBundle:CollectorForum')->find( 3 ));
                            $specimen->setStatus($em->getRepository('CyclogramProofPilotBundle:Status')->find( 1 ));
                            $em->persist($specimen);
                            $em->flush();
                            //inserting specimen history
                            $specimen_history = new SpecimenHistory();
                            $specimen_history->setSpecimenHistoryDatetime(new \DateTime("now"));
                            $specimen_history->setSpecimenHistoryIpAddress($_SERVER['REMOTE_ADDR']);
                            $specimen_history->setSpecimen($em->getRepository('CyclogramProofPilotBundle:Specimen')->find( $specimen->getSpecimenId() ));
                            $specimen_history->setSpecimenPhase($em->getRepository('CyclogramProofPilotBundle:SpecimenPhase')->find( 1 ));
                            $representative = $em->getRepository('CyclogramProofPilotBundle:Representative')->find(1);
                            $specimen_history->setRepresentative($representative);
                            $em->persist($specimen_history);
                            $em->flush();
                            //inserting test
                            $test = new Test();
                            $test->setTestDateCreation(new \DateTime("now"));
                            $kitNumber = "TKN-" . $participant->getParticipantId() . "-TE";
                            $kitNumber = "";
                            $test->getTestKitNumber($kitNumber);
                            $testName = "TNM-" . $participant->getParticipantId() . "-TE";
                            $test->setTestName($testName);
                            $test->setTestKitRegistered(1);
                            $test->setTestType($em->getRepository('CyclogramProofPilotBundle:TestType')->find( 1 ));
                            $test->setTestPhase($em->getRepository('CyclogramProofPilotBundle:TestPhase')->find( 1 ));
                            $test->setTestPreliminarResult($em->getRepository('CyclogramProofPilotBundle:TestPreliminarResult')->find( 1 ));
                            $test->setCollectorForum($em->getRepository('CyclogramProofPilotBundle:CollectorForum')->find( 3 ));
                            $test->setTestOutcomeType($em->getRepository('CyclogramProofPilotBundle:TestOutcomeType')->find( 1 ));
                            $test->setTestProccesingType($em->getRepository('CyclogramProofPilotBundle:TestProccesingType')->find( 1 ));
                            $test->setStatus($em->getRepository('CyclogramProofPilotBundle:Status')->find( 1 ));
                            $em->persist($test);
                            $em->flush();
                            //inserting order-specimen-link
                            $order_specimen_link = new OrderSpecimenLink();
                            $order_specimen_link->setOrder($order);
                            $order_specimen_link->setSpecimen($em->getRepository('CyclogramProofPilotBundle:Specimen')->find( $specimen->getSpecimenId() ));
                            $em->persist($order_specimen_link);
                            $em->flush();
                            //inserting specimen-test-link
                            $specimen_test_link = new SpecimenTestLink();
                            $specimen_test_link->setTestId($test->getTestId());
                            $specimen_test_link->setSpecimen($em->getRepository('CyclogramProofPilotBundle:Specimen')->find( $specimen->getSpecimenId() ));
                            $em->persist($specimen_test_link);
                            $em->flush();
                            //inserting order-history
                            $test_history = new TestHistory();
                            $test_history->setTestHistoryDatetime(new \DateTime("now"));
                            $test_history->setTest($em->getRepository('CyclogramProofPilotBundle:Test')->find( $test->getTestId() ));
                            $test_history->setTestPhase($em->getRepository('CyclogramProofPilotBundle:TestPhase')->find( 1 ));
                            $test_history->setRepresentative($representative);
                            $em->persist($test_history);
                            $em->flush();
                        }
                    }
                    break;
            case "KAHPhase3TestPackage":
                $surveyId = $intervention->getSidId();
                if ($status == "Active") {
                        $this->createIncentive($participant, $intervention);
                        $completedStatus = $em->getRepository('CyclogramProofPilotBundle:Status')
                            ->findOneByStatusName("Closed");
                        $interventionLink->setStatus($completedStatus);
                        $em->persist($interventionLink);
                        $em->flush();
                        $status = "Closed";
                }
                break;
            case "KAHPhase3ReportResults":
                $surveyId = $intervention->getSidId();
                if ($status == "Active") {
                    $passed = $em
                    ->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                    ->checkIfSurveyPassed($participant, $surveyId);
                
                    if ($passed) {
                        $surveyLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->findOneBy(array('participant'=>$participant,'sidId'=>$surveyId));
                         
                        $surveyResult = $this->container->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData($surveyLink->getSaveId(), $surveyId);
                        if(isset($surveyResult['295666X628X6127'])) {
                            switch ($surveyResult['295666X628X6127']) {
                                case "A1" :
                                    $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName('Paypal Gift Card');
                                    break;
                                case "A2" :
                                    $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName('Amazon Gift Card');
                                    break;
                                case "A3" :
                                    $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName('None');
                                    break;
                            }
                        }
                        $this->createIncentive($participant, $intervention, $incentiveType->getIncentiveTypeName());
                        $completedStatus = $em->getRepository('CyclogramProofPilotBundle:Status')
                        ->findOneByStatusName("Closed");
                        $interventionLink->setStatus($completedStatus);
                        $status = "Closed";
                        $intervention = $em
                            ->getRepository('CyclogramProofPilotBundle:Intervention')
                            ->findOneByInterventionCode("KAHPhase3FollowUp");
                        $em->getRepository('CyclogramProofPilotBundle:Participant')
                            ->addParticipantInterventionLink($participant,$intervention);
                        $em->persist($interventionLink);
                        $em->flush();
                    }
                }
            break;
            case "KAHPhase3FollowUp":
                $surveyId = $intervention->getSidId();
                if ($status == "Active") {
                    $passed = $em
                    ->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                    ->checkIfSurveyPassed($participant, $surveyId);
                    if ($passed) {
                        $surveyLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->findOneBy(array('participant'=>$participant,'sidId'=>$surveyId));
                         
                        $surveyResult = $this->container->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData($surveyLink->getSaveId(), $surveyId);
                        if(isset($surveyResult['543977X635X6190'])) {
                            switch ($surveyResult['543977X635X6190']) {
                                case "A1" :
                                    $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName('Paypal Gift Card');
                                    break;
                                case "A2" :
                                    $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName('Amazon Gift Card');
                                    break;
                                case "A3" :
                                    $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName('None');
                                    break;
                            }
                        }
                        $this->createIncentive($participant, $intervention, $incentiveType->getIncentiveTypeName());
                        $completedStatus = $em->getRepository('CyclogramProofPilotBundle:Status')
                        ->findOneByStatusName("Closed");
                        $interventionLink->setStatus($completedStatus);
                        $status = "Closed";
                        $em->persist($interventionLink);
                        $em->flush();
                    }
                }
            }
        }
    }
    
    public function checkEligibility($surveyResult) {
        $isElegible = TRUE; //By Default the Participant is Elegible
        $reason = array();
        
        $allowedZipCodes = array(
        
                //ATLANTA
                "30002","30003","30004","30005","30006","30007","30008","30009","30010","30011","30012","30013","30014","30015","30016","30017","30018","30019","30021","30022","30023","30024","30025","30026","30028","30029","30030","30031","30032","30033","30034","30035","30036","30037","30038","30039","30040","30041","30042","30043","30044","30045","30046","30047","30048","30049","30052","30054","30055","30056","30058","30060","30061","30062","30063","30064","30065","30066","30067","30068","30069","30070","30071","30072","30073","30074","30075","30076","30077","30078","30079","30080","30081","30082","30083","30084","30085","30086","30087","30088","30090","30091","30092","30093","30094","30095","30096","30097","30098","30099","30101","30102","30103","30106","30107","30108","30109","30110","30111","30112","30113","30114","30115","30116","30117","30118","30119","30120","30121","30122","30123","30126","30127","30132","30133","30134","30135","30137","30140","30141","30142","30143","30144","30145","30146","30148","30150","30151","30152","30154","30156","30157","30160","30168","30169","30170","30171","30175","30176","30177","30178","30179","30180","30182","30183","30184","30185","30187","30188","30189","30204","30205","30206","30212","30213","30214","30215","30216","30217","30218","30219","30220","30222","30223","30224","30228","30229","30232","30233","30234","30236","30237","30238","30248","30250","30251","30252","30253","30256","30257","30258","30259","30260","30263","30264","30265","30266","30268","30269","30270","30271","30272","30273","30274","30275","30276","30277","30281","30284","30287","30288","30289","30290","30291","30292","30293","30294","30295","30296","30297","30298","30301","30302","30303","30304","30305","30306","30307","30308","30309","30310","30311","30312","30313","30314","30315","30316","30317","30318","30319","30320","30321","30322","30324","30325","30326","30327","30328","30329","30330","30331","30332","30333","30334","30336","30337","30338","30339","30340","30341","30342","30343","30344","30345","30346","30347","30348","30349","30350","30353","30354","30355","30356","30357","30358","30359","30360","30361","30362","30363","30364","30366","30368","30369","30370","30371","30374","30375","30376","30377","30378","30379","30380","30384","30385","30386","30387","30388","30389","30390","30392","30394","30396","30398","30399","30515","30518","30519","30534","30620","30641","30655","30656","30666","30680","31038","31064","31085","31106","31107","31119","31120","31126","31131","31132","31136","31139","31141","31145","31146","31150","31156","31169","31191","31192","31193","31195","31196","31197","31198","31199","31816","31830","39901","30104","30153","30161","30230","30285","30506","30517","30533","30536","30548","30622","30734","31016","31029","31097","31822",
                "20588","20701","20711","20723","20724","20733","20751","20755","20758","20759","20763","20764","20765","20776","20777","20778","20779","20794","21001","21005","21009","21010","21012","21013","21014","21015","21017","21018","21020","21022","21023","21027","21028","21029","21030","21031","21032","21034","21035","21036","21037","21040","21041","21042","21043","21044","21045","21046","21047","21048","21050","21051","21052","21053","21054","21055","21056","21057","21060","21061","21062","21065","21071","21074","21075","21076","21077","21078","21080","21082","21084","21085","21087","21088","21090","21092","21093","21094","21098","21102","21104","21105","21106","21108","21111","21113","21114","21117","21120","21122","21123","21128","21130","21131","21132","21133","21136","21139","21140","21144","21146","21150","21152","21153","21154","21155","21156","21157","21158","21160","21161","21162","21163","21201","21202","21203","21204","21205","21206","21207","21208","21209","21210","21211","21212","21213","21214","21215","21216","21217","21218","21219","21220","21221","21222","21223","21224","21225","21226","21227","21228","21229","21230","21231","21233","21234","21235","21236","21237","21239","21240","21241","21244","21250","21251","21252","21260","21261","21263","21264","21265","21268","21270","21273","21274","21275","21278","21279","21280","21281","21282","21283","21284","21285","21286","21287","21288","21289","21290","21297","21298","21401","21402","21403","21404","21405","21409","21411","21412","21607","21617","21619","21623","21628","21638","21644","21656","21657","21658","21666","21668","21690","21723","21737","21738","21757","21764","21765","21776","21784","21787","21791","21794","21797","20714","20736","20754","20833","21640","21649","21651","21771",
                "46301","46302","46303","46304","46307","46308","46310","46311","46312","46319","46320","46321","46322","46323","46324","46325","46327","46341","46342","46347","46349","46355","46356","46368","46372","46373","46375","46376","46377","46379","46380","46381","46383","46384","46385","46392","46393","46394","46401","46402","46403","46404","46405","46406","46407","46408","46409","46410","46411","47922","47943","47948","47951","47963","47964","47977","47978","53101","53102","53104","53109","53140","53141","53142","53143","53144","53152","53158","53159","53168","53170","53171","53179","53181","53192","53194","53199","60001","60002","60004","60005","60006","60007","60008","60009","60010","60011","60012","60013","60014","60015","60016","60017","60018","60019","60020","60021","60022","60025","60026","60029","60030","60031","60033","60034","60035","60037","60038","60039","60040","60041","60042","60043","60044","60045","60046","60047","60048","60049","60050","60051","60053","60055","60056","60060","60061","60062","60064","60065","60067","60068","60069","60070","60071","60072","60073","60074","60075","60076","60077","60078","60079","60080","60081","60082","60083","60084","60085","60086","60087","60088","60089","60090","60091","60092","60093","60094","60095","60096","60097","60098","60099","60101","60102","60103","60104","60105","60106","60107","60108","60109","60110","60111","60112","60115","60116","60117","60118","60119","60120","60121","60122","60123","60124","60125","60126","60128","60129","60130","60131","60132","60133","60134","60135","60136","60137","60138","60139","60140","60141","60142","60143","60144","60145","60146","60147","60148","60150","60151","60152","60153","60154","60155","60156","60157","60159","60160","60161","60162","60163","60164","60165","60168","60169","60170","60171","60172","60173","60174","60175","60176","60177","60178","60179","60180","60181","60182","60183","60184","60185","60186","60187","60188","60189","60190","60191","60192","60193","60194","60195","60196","60197","60199","60201","60202","60203","60204","60208","60209","60290","60296","60297","60301","60302","60303","60304","60305","60398","60399","60401","60402","60403","60404","60406","60407","60408","60409","60410","60411","60412","60415","60416","60417","60419","60421","60422","60423","60424","60425","60426","60428","60429","60430","60431","60432","60433","60434","60435","60436","60437","60438","60439","60440","60441","60442","60443","60444","60445","60446","60447","60448","60449","60450","60451","60452","60453","60454","60455","60456","60457","60458","60459","60461","60462","60463","60464","60465","60466","60467","60468","60469","60471","60472","60473","60474","60475","60476","60477","60478","60479","60480","60481","60482","60483","60484","60487","60490","60491","60499","60501","60502","60503","60504","60505","60506","60507","60510","60511","60512","60513","60514","60515","60516","60517","60519","60520","60521","60522","60523","60525","60526","60527","60532","60534","60536","60537","60538","60539","60540","60541","60542","60543","60544","60545","60546","60548","60550","60552","60554","60555","60556","60558","60559","60560","60561","60563","60564","60565","60566","60567","60568","60570","60572","60585","60586","60597","60598","60599","60601","60602","60603","60604","60605","60606","60607","60608","60609","60610","60611","60612","60613","60614","60615","60616","60617","60618","60619","60620","60621","60622","60623","60624","60625","60626","60628","60629","60630","60631","60632","60633","60634","60636","60637","60638","60639","60640","60641","60642","60643","60644","60645","60646","60647","60649","60651","60652","60653","60654","60655","60656","60657","60659","60660","60661","60663","60664","60665","60666","60667","60668","60669","60670","60671","60672","60673","60674","60675","60677","60678","60679","60680","60681","60682","60683","60684","60685","60686","60687","60688","60689","60690","60691","60693","60694","60695","60696","60697","60699","60701","60706","60707","60712","60714","60803","60804","60805","60827","46348","46360","46374","46390","46391","47946","47957","47959","47995","53105","53128","53139","53177","53182","53403","60420","60470","60518","60530","60531","60940","60950","60961","61038","61068","61360",
        
                //texas
                "75001","75002","75006","75007","75008","75009","75010","75011","75013","75014","75015","75016","75017","75019","75022","75023","75024","75025","75026","75027","75028","75029","75030","75032","75034","75035","75037","75038","75039","75040","75041","75042","75043","75044","75045","75046","75047","75048","75049","75050","75051","75052","75053","75054","75056","75057","75060","75061","75062","75063","75065","75067","75068","75069","75070","75071","75074","75075","75077","75078","75080","75081","75082","75083","75085","75086","75087","75088","75089","75093","75094","75097","75098","75099","75101","75104","75106","75114","75115","75116","75118","75119","75120","75121","75123","75125","75126","75132","75134","75135","75137","75138","75141","75142","75143","75146","75147","75149","75150","75152","75154","75155","75156","75157","75158","75159","75160","75161","75164","75165","75166","75167","75168","75172","75173","75180","75181","75182","75185","75187","75189","75201","75202","75203","75204","75205","75206","75207","75208","75209","75210","75211","75212","75214","75215","75216","75217","75218","75219","75220","75221","75222","75223","75224","75225","75226","75227","75228","75229","75230","75231","75232","75233","75234","75235","75236","75237","75238","75239","75240","75241","75242","75243","75244","75245","75246","75247","75248","75249","75250","75251","75252","75253","75254","75258","75260","75261","75262","75263","75264","75265","75266","75267","75270","75275","75277","75283","75284","75285","75286","75287","75295","75301","75303","75310","75312","75313","75315","75320","75323","75326","75334","75336","75339","75340","75342","75343","75344","75346","75353","75354","75355","75356","75357","75358","75359","75360","75363","75364","75367","75368","75369","75370","75371","75372","75373","75374","75376","75378","75379","75380","75381","75382","75386","75387","75388","75389","75390","75391","75392","75393","75394","75395","75396","75397","75398","75401","75402","75403","75404","75407","75409","75415","75422","75423","75424","75428","75429","75432","75441","75442","75448","75450","75453","75454","75458","75469","75474","75485","75496","76001","76002","76003","76004","76005","76006","76007","76008","76009","76010","76011","76012","76013","76014","76015","76016","76017","76018","76019","76020","76021","76022","76023","76028","76031","76033","76034","76036","76039","76040","76041","76044","76050","76051","76052","76053","76054","76058","76059","76060","76061","76063","76064","76065","76066","76071","76073","76078","76082","76084","76085","76086","76087","76088","76092","76093","76094","76095","76096","76097","76098","76099","76101","76102","76103","76104","76105","76106","76107","76108","76109","76110","76111","76112","76113","76114","76115","76116","76117","76118","76119","76120","76121","76122","76123","76124","76126","76127","76129","76130","76131","76132","76133","76134","76135","76136","76137","76140","76147","76148","76150","76155","76161","76162","76163","76164","76166","76177","76178","76179","76180","76181","76182","76185","76191","76192","76193","76195","76196","76197","76198","76199","76201","76202","76203","76204","76205","76206","76207","76208","76209","76210","76225","76226","76227","76234","76244","76246","76247","76248","76249","76258","76259","76262","76266","76267","76299","76426","76431","76439","76485","76487","76490","76623","76651","76670","75169","75449","75452","75491","75495","76035","76049","76067","76070","76270","76272","76462","76486",
        
                //Washington
                "20001","20002","20003","20004","20005","20006","20007","20008","20009","20010","20011","20012","20013","20015","20016","20017","20018","20019","20020","20022","20023","20024","20026","20027","20029","20030","20032","20033","20035","20036","20037","20038","20039","20040","20041","20042","20043","20044","20045","20046","20047","20049","20050","20051","20052","20053","20055","20056","20057","20058","20059","20060","20061","20062","20063","20064","20065","20066","20067","20068","20069","20070","20071","20073","20074","20075","20076","20077","20078","20080","20081","20082","20088","20090","20091","20097","20098","20099","20101","20102","20103","20104","20105","20107","20108","20109","20110","20111","20112","20113","20115","20116","20117","20118","20119","20120","20121","20122","20124","20128","20129","20130","20131","20132","20134","20135","20136","20137","20138","20139","20140","20141","20142","20143","20144","20146","20147","20148","20149","20151","20152","20153","20155","20156","20158","20159","20160","20163","20164","20165","20166","20167","20168","20169","20170","20171","20172","20175","20176","20177","20178","20180","20181","20182","20184","20185","20186","20187","20188","20189","20190","20191","20192","20193","20194","20195","20196","20197","20198","20199","20201","20202","20203","20204","20206","20207","20208","20210","20211","20212","20213","20214","20215","20216","20217","20218","20219","20220","20221","20222","20223","20224","20226","20227","20228","20229","20230","20231","20232","20233","20235","20237","20238","20239","20240","20241","20242","20244","20245","20250","20251","20254","20260","20261","20262","20265","20266","20268","20270","20277","20289","20299","20301","20303","20306","20307","20310","20314","20315","20317","20318","20319","20330","20332","20336","20337","20338","20340","20350","20355","20370","20372","20373","20374","20375","20376","20380","20388","20389","20390","20391","20392","20393","20394","20395","20398","20401","20402","20403","20404","20405","20406","20407","20408","20409","20410","20411","20412","20413","20414","20415","20416","20417","20418","20419","20420","20421","20422","20423","20424","20425","20426","20427","20428","20429","20431","20433","20434","20435","20436","20437","20439","20440","20441","20442","20444","20447","20451","20453","20456","20460","20463","20468","20469","20470","20472","20500","20501","20502","20503","20504","20505","20506","20507","20508","20509","20510","20511","20515","20520","20521","20522","20523","20524","20525","20526","20527","20528","20529","20530","20531","20532","20533","20534","20535","20536","20537","20538","20539","20540","20541","20542","20543","20544","20546","20547","20548","20549","20550","20551","20552","20553","20554","20555","20557","20558","20559","20560","20565","20566","20570","20571","20572","20573","20575","20576","20577","20578","20579","20580","20581","20585","20586","20590","20591","20593","20594","20597","20598","20599","20601","20602","20603","20604","20607","20608","20610","20611","20612","20613","20615","20616","20617","20623","20625","20629","20632","20637","20639","20640","20643","20645","20646","20657","20658","20661","20662","20664","20675","20676","20677","20678","20682","20685","20688","20689","20693","20695","20697","20703","20704","20705","20706","20707","20708","20709","20710","20712","20714","20715","20716","20717","20718","20719","20720","20721","20722","20725","20726","20731","20732","20735","20736","20737","20738","20740","20741","20742","20743","20744","20745","20746","20747","20748","20749","20750","20752","20753","20754","20757","20762","20768","20769","20770","20771","20772","20773","20774","20775","20781","20782","20783","20784","20785","20787","20788","20790","20791","20792","20797","20799","20810","20811","20812","20813","20814","20815","20816","20817","20818","20824","20825","20827","20830","20832","20833","20837","20838","20839","20841","20842","20847","20848","20849","20850","20851","20852","20853","20854","20855","20857","20859","20860","20861","20862","20866","20868","20871","20872","20874","20875","20876","20877","20878","20879","20880","20882","20883","20884","20885","20886","20889","20891","20892","20894","20895","20896","20897","20898","20899","20901","20902","20903","20904","20905","20906","20907","20908","20910","20911","20912","20913","20914","20915","20916","20918","20993","20997","21701","21702","21703","21704","21705","21709","21710","21714","21716","21717","21718","21727","21754","21755","21758","21759","21762","21769","21770","21771","21773","21774","21775","21777","21778","21780","21788","21790","21792","21793","21798","22003","22009","22015","22025","22026","22027","22030","22031","22032","22033","22034","22035","22036","22037","22038","22039","22040","22041","22042","22043","22044","22046","22047","22060","22066","22067","22079","22081","22082","22092","22093","22095","22096","22101","22102","22103","22106","22107","22108","22109","22116","22118","22119","22120","22121","22122","22124","22125","22134","22135","22150","22151","22152","22153","22156","22158","22159","22160","22161","22172","22180","22181","22182","22183","22184","22185","22191","22192","22193","22194","22195","22199","22201","22202","22203","22204","22205","22206","22207","22209","22210","22211","22212","22213","22214","22215","22216","22217","22218","22219","22222","22223","22225","22226","22227","22229","22230","22234","22240","22241","22242","22243","22244","22245","22246","22301","22302","22303","22304","22305","22306","22307","22308","22309","22310","22311","22312","22313","22314","22315","22320","22321","22331","22332","22333","22334","22336","22401","22402","22403","22404","22405","22406","22407","22408","22412","22430","22463","22471","22534","22545","22551","22553","22554","22555","22556","22565","22610","22611","22620","22630","22639","22642","22643","22646","22649","22663","22712","22720","22728","22734","22739","22742","25410","25414","25423","25425","25429","25430","25432","25438","25441","25442","25443","25446","56901","56902","56904","56915","56920","56933","56944","56945","56950","56965","56972","20106","20622","20659","20758","22508","22580","22645","22655","22657","22960","23015",
                "77001","77002","77003","77004","77005","77006","77007","77008","77009","77010","77011","77012","77013","77014","77015","77016","77017","77018","77019","77020","77021","77022","77023","77024","77025","77026","77027","77028","77029","77030","77031","77032","77033","77034","77035","77036","77037","77038","77039","77040","77041","77042","77043","77044","77045","77046","77047","77048","77049","77050","77051","77052","77053","77054","77055","77056","77057","77058","77059","77060","77061","77062","77063","77064","77065","77066","77067","77068","77069","77070","77071","77072","77073","77074","77075","77076","77077","77078","77079","77080","77081","77082","77083","77084","77085","77086","77087","77088","77089","77090","77091","77092","77093","77094","77095","77096","77097","77098","77099","77201","77202","77203","77204","77205","77206","77207","77208","77209","77210","77212","77213","77215","77216","77217","77218","77219","77220","77221","77222","77223","77224","77225","77226","77227","77228","77229","77230","77231","77233","77234","77235","77236","77237","77238","77240","77241","77242","77243","77244","77245","77246","77247","77248","77249","77250","77251","77252","77253","77254","77255","77256","77257","77258","77259","77260","77261","77262","77263","77265","77266","77267","77268","77269","77270","77271","77272","77273","77274","77275","77276","77277","77278","77279","77280","77281","77282","77284","77285","77286","77287","77288","77289","77290","77291","77292","77293","77294","77296","77297","77298","77299","77301","77302","77303","77304","77305","77306","77315","77316","77318","77325","77327","77328","77331","77333","77336","77337","77338","77339","77345","77346","77347","77353","77354","77355","77356","77357","77359","77362","77364","77365","77368","77369","77371","77372","77373","77375","77377","77378","77379","77380","77381","77382","77383","77384","77385","77386","77387","77388","77389","77391","77393","77396","77401","77402","77406","77407","77410","77411","77413","77417","77418","77422","77423","77429","77430","77431","77433","77441","77444","77445","77446","77447","77449","77450","77451","77452","77459","77461","77463","77464","77466","77469","77471","77473","77474","77476","77477","77478","77479","77480","77481","77484","77485","77486","77487","77489","77491","77492","77493","77494","77496","77497","77498","77501","77502","77503","77504","77505","77506","77507","77508","77510","77511","77512","77514","77515","77516","77517","77518","77520","77521","77522","77523","77530","77531","77532","77533","77534","77535","77536","77538","77539","77541","77542","77545","77546","77547","77549","77550","77551","77552","77553","77554","77555","77560","77561","77562","77563","77564","77565","77566","77568","77571","77572","77573","77574","77575","77577","77578","77580","77581","77582","77583","77584","77586","77587","77588","77590","77591","77592","77597","77598","77617","77623","77650","77661","77665","78931","78933","78944","78950","77320","77358","77363","77426","77833","77835","77868","77873","78940","78954",
                "90001","90002","90003","90004","90005","90006","90007","90008","90009","90010","90011","90012","90013","90014","90015","90016","90017","90018","90019","90020","90021","90022","90023","90024","90025","90026","90027","90028","90029","90030","90031","90032","90033","90034","90035","90036","90037","90038","90039","90040","90041","90042","90043","90044","90045","90046","90047","90048","90049","90050","90051","90052","90053","90054","90055","90056","90057","90058","90059","90060","90061","90062","90063","90064","90065","90066","90067","90068","90069","90070","90071","90072","90073","90074","90075","90076","90077","90078","90079","90080","90081","90082","90083","90084","90086","90087","90088","90089","90090","90091","90093","90094","90095","90096","90097","90099","90101","90102","90103","90174","90185","90189","90201","90202","90209","90210","90211","90212","90213","90220","90221","90222","90223","90224","90230","90231","90232","90233","90239","90240","90241","90242","90245","90247","90248","90249","90250","90251","90254","90255","90260","90261","90262","90263","90264","90265","90266","90267","90270","90272","90274","90275","90277","90278","90280","90290","90291","90292","90293","90294","90295","90296","90301","90302","90303","90304","90305","90306","90307","90308","90309","90310","90311","90312","90313","90397","90398","90401","90402","90403","90404","90405","90406","90407","90408","90409","90410","90411","90501","90502","90503","90504","90505","90506","90507","90508","90509","90510","90601","90602","90603","90604","90605","90606","90607","90608","90609","90610","90612","90620","90621","90622","90623","90624","90630","90631","90632","90633","90637","90638","90639","90640","90650","90651","90652","90659","90660","90661","90662","90665","90670","90671","90680","90701","90702","90703","90704","90706","90707","90710","90711","90712","90713","90714","90715","90716","90717","90720","90721","90723","90731","90732","90733","90734","90740","90742","90743","90744","90745","90746","90747","90748","90749","90755","90801","90802","90803","90804","90805","90806","90807","90808","90809","90810","90813","90814","90815","90822","90831","90832","90833","90834","90835","90840","90842","90844","90845","90846","90847","90848","90853","90888","90895","90899","91001","91003","91006","91007","91008","91009","91010","91011","91012","91016","91017","91020","91021","91023","91024","91025","91030","91031","91040","91041","91042","91043","91046","91050","91051","91066","91077","91101","91102","91103","91104","91105","91106","91107","91108","91109","91110","91114","91115","91116","91117","91118","91121","91123","91124","91125","91126","91129","91131","91175","91182","91184","91185","91186","91187","91188","91189","91191","91199","91201","91202","91203","91204","91205","91206","91207","91208","91209","91210","91214","91221","91222","91224","91225","91226","91301","91302","91303","91304","91305","91306","91307","91308","91309","91310","91311","91312","91313","91316","91321","91322","91324","91325","91326","91327","91328","91329","91330","91331","91333","91334","91335","91337","91340","91341","91342","91343","91344","91345","91346","91350","91351","91352","91353","91354","91355","91356","91357","91363","91364","91365","91367","91371","91372","91376","91380","91381","91382","91383","91384","91385","91386","91387","91388","91390","91392","91393","91394","91395","91396","91399","91401","91402","91403","91404","91405","91406","91407","91408","91409","91410","91411","91412","91413","91416","91423","91426","91436","91470","91482","91495","91496","91497","91499","91501","91502","91503","91504","91505","91506","91507","91508","91510","91521","91522","91523","91526","91601","91602","91603","91604","91605","91606","91607","91608","91609","91610","91611","91612","91614","91615","91616","91617","91618","91702","91706","91711","91714","91715","91716","91722","91723","91724","91731","91732","91733","91734","91735","91740","91741","91744","91745","91746","91747","91748","91749","91750","91754","91755","91756","91759","91765","91766","91767","91768","91769","91770","91771","91772","91773","91775","91776","91778","91780","91788","91789","91790","91791","91792","91793","91795","91797","91799","91801","91802","91803","91804","91841","91896","91899","92602","92603","92604","92605","92606","92607","92609","92610","92612","92614","92615","92616","92617","92618","92619","92620","92623","92624","92625","92626","92627","92628","92629","92630","92637","92646","92647","92648","92649","92650","92651","92652","92653","92654","92655","92656","92657","92658","92659","92660","92661","92662","92663","92672","92673","92674","92675","92676","92677","92678","92679","92683","92684","92685","92688","92690","92691","92692","92693","92694","92697","92698","92701","92702","92703","92704","92705","92706","92707","92708","92709","92710","92711","92712","92725","92728","92735","92780","92781","92782","92799","92801","92802","92803","92804","92805","92806","92807","92808","92809","92811","92812","92814","92815","92816","92817","92821","92822","92823","92825","92831","92832","92833","92834","92835","92836","92837","92838","92840","92841","92842","92843","92844","92845","92846","92850","92856","92857","92859","92861","92862","92863","92864","92865","92866","92867","92868","92869","92870","92871","92885","92886","92887","92899","93510","93532","93534","93535","93536","93539","93543","93544","93550","93551","93552","93553","93563","93584","93586","93590","93591","93599","91361","91362","92397","92530","93243","93560",
                "33002","33004","33008","33009","33010","33011","33012","33013","33014","33015","33016","33017","33018","33019","33020","33021","33022","33023","33024","33025","33026","33027","33028","33029","33030","33031","33032","33033","33034","33035","33039","33054","33055","33056","33060","33061","33062","33063","33064","33065","33066","33067","33068","33069","33071","33072","33073","33074","33075","33076","33077","33081","33082","33083","33084","33090","33092","33093","33097","33101","33102","33106","33107","33109","33110","33111","33112","33114","33116","33119","33121","33122","33124","33125","33126","33127","33128","33129","33130","33131","33132","33133","33134","33135","33136","33137","33138","33139","33140","33141","33142","33143","33144","33145","33146","33147","33148","33149","33150","33151","33152","33153","33154","33155","33156","33157","33158","33159","33160","33161","33162","33163","33164","33165","33166","33167","33168","33169","33170","33172","33173","33174","33175","33176","33177","33178","33179","33180","33181","33182","33183","33184","33185","33186","33187","33188","33189","33190","33192","33193","33194","33195","33196","33197","33199","33222","33231","33233","33234","33238","33239","33242","33243","33245","33247","33255","33256","33257","33261","33265","33266","33269","33280","33283","33296","33299","33301","33302","33303","33304","33305","33306","33307","33308","33309","33310","33311","33312","33313","33314","33315","33316","33317","33318","33319","33320","33321","33322","33323","33324","33325","33326","33327","33328","33329","33330","33331","33332","33334","33335","33336","33337","33338","33339","33340","33345","33346","33348","33349","33351","33355","33359","33388","33394","33400","33401","33402","33403","33404","33405","33406","33407","33408","33409","33410","33411","33412","33413","33414","33415","33416","33417","33418","33419","33420","33421","33422","33424","33425","33426","33427","33428","33429","33430","33431","33432","33433","33434","33435","33436","33437","33438","33439","33441","33442","33443","33444","33445","33446","33447","33448","33449","33454","33458","33459","33460","33461","33462","33463","33464","33465","33466","33467","33468","33469","33470","33472","33473","33474","33476","33477","33478","33480","33481","33482","33483","33484","33486","33487","33488","33493","33496","33497","33498","33499","33440",
        
                //NY
                "00501","00544","06390","07001","07002","07003","07004","07005","07006","07007","07008","07009","07010","07011","07012","07013","07014","07015","07016","07017","07018","07019","07020","07021","07022","07023","07024","07026","07027","07028","07029","07030","07031","07032","07033","07034","07035","07036","07039","07040","07041","07042","07043","07044","07045","07046","07047","07050","07051","07052","07054","07055","07057","07058","07059","07060","07061","07062","07063","07064","07065","07066","07067","07068","07069","07070","07071","07072","07073","07074","07075","07076","07077","07078","07079","07080","07081","07082","07083","07086","07087","07088","07090","07091","07092","07093","07094","07095","07096","07097","07099","07101","07102","07103","07104","07105","07106","07107","07108","07109","07110","07111","07112","07114","07175","07182","07184","07188","07189","07191","07192","07193","07194","07195","07197","07198","07199","07201","07202","07203","07204","07205","07206","07207","07208","07302","07303","07304","07305","07306","07307","07308","07309","07310","07311","07390","07395","07399","07401","07403","07405","07407","07410","07416","07417","07418","07419","07420","07421","07422","07423","07424","07428","07430","07432","07435","07436","07438","07439","07440","07442","07444","07446","07450","07451","07452","07456","07457","07458","07460","07461","07462","07463","07465","07470","07474","07477","07480","07481","07495","07498","07501","07502","07503","07504","07505","07506","07507","07508","07509","07510","07511","07512","07513","07514","07522","07524","07533","07538","07543","07544","07601","07602","07603","07604","07605","07606","07607","07608","07620","07621","07624","07626","07627","07628","07630","07631","07632","07640","07641","07642","07643","07644","07645","07646","07647","07648","07649","07650","07652","07653","07656","07657","07660","07661","07662","07663","07666","07670","07675","07676","07677","07699","07701","07702","07703","07704","07709","07710","07711","07712","07715","07716","07717","07718","07719","07720","07721","07722","07723","07724","07726","07727","07728","07730","07731","07732","07733","07734","07735","07737","07738","07739","07740","07746","07747","07748","07750","07751","07752","07753","07754","07755","07756","07757","07758","07760","07762","07763","07764","07765","07777","07799","07801","07802","07803","07806","07821","07822","07826","07827","07828","07830","07834","07836","07837","07839","07842","07843","07845","07847","07848","07849","07850","07851","07852","07853","07855","07856","07857","07860","07866","07869","07870","07871","07874","07875","07876","07877","07878","07879","07881","07885","07890","07901","07902","07920","07921","07922","07924","07926","07927","07928","07930","07931","07932","07933","07934","07935","07936","07938","07939","07940","07945","07946","07950","07960","07961","07962","07963","07970","07974","07976","07977","07978","07979","07980","07981","07983","07999","08005","08006","08008","08050","08087","08092","08501","08502","08504","08510","08512","08514","08526","08527","08528","08530","08533","08535","08536","08551","08553","08555","08556","08557","08558","08559","08570","08701","08720","08721","08722","08723","08724","08730","08731","08732","08733","08734","08735","08736","08738","08739","08740","08741","08742","08750","08751","08752","08753","08754","08755","08756","08757","08758","08759","08801","08803","08804","08805","08807","08809","08810","08812","08816","08817","08818","08820","08821","08822","08823","08824","08825","08826","08827","08828","08829","08830","08831","08832","08833","08834","08835","08836","08837","08840","08844","08846","08848","08850","08852","08853","08854","08855","08857","08858","08859","08861","08862","08863","08867","08868","08869","08870","08871","08872","08873","08875","08876","08877","08878","08879","08880","08882","08884","08885","08887","08888","08889","08890","08896","08899","08901","08902","08903","08904","08905","08906","08922","08933","08988","08989","10001","10002","10003","10004","10005","10006","10007","10008","10009","10010","10011","10012","10013","10014","10015","10016","10017","10018","10019","10020","10021","10022","10023","10024","10025","10026","10027","10028","10029","10030","10031","10032","10033","10034","10035","10036","10037","10038","10039","10040","10041","10043","10044","10045","10046","10047","10048","10055","10060","10065","10069","10072","10075","10079","10080","10081","10082","10087","10090","10094","10095","10096","10098","10099","10101","10102","10103","10104","10105","10106","10107","10108","10109","10110","10111","10112","10113","10114","10115","10116","10117","10118","10119","10120","10121","10122","10123","10124","10125","10126","10128","10129","10130","10131","10132","10133","10138","10149","10150","10151","10152","10153","10154","10155","10156","10157","10158","10159","10160","10161","10162","10163","10164","10165","10166","10167","10168","10169","10170","10171","10172","10173","10174","10175","10176","10177","10178","10179","10184","10185","10196","10197","10199","10203","10211","10212","10213","10242","10249","10256","10257","10258","10259","10260","10261","10265","10268","10269","10270","10271","10272","10273","10274","10275","10276","10277","10278","10279","10280","10281","10282","10285","10286","10292","10301","10302","10303","10304","10305","10306","10307","10308","10309","10310","10311","10312","10313","10314","10451","10452","10453","10454","10455","10456","10457","10458","10459","10460","10461","10462","10463","10464","10465","10466","10467","10468","10469","10470",
                "10470","10471","10472","10473","10474","10475","10499","10501","10502","10503","10504","10505","10506","10507","10509","10510","10511","10512","10514","10516","10517","10518","10519","10520","10521","10522","10523","10524","10526","10527","10528","10530","10532","10533","10535","10536","10537","10538","10540","10541","10542","10543","10545","10546","10547","10548","10549","10550","10551","10552","10553","10557","10558","10559","10560","10562","10566","10567","10570","10571","10572","10573","10576","10577","10578","10579","10580","10581","10583","10587","10588","10589","10590","10591","10592","10594","10595","10596","10597","10598","10601","10602","10603","10604","10605","10606","10607","10610","10625","10629","10633","10650","10701","10702","10703","10704","10705","10706","10707","10708","10709","10710","10801","10802","10803","10804","10805","10901","10911","10913","10920","10923","10927","10931","10952","10954","10956","10960","10962","10964","10965","10968","10970","10974","10976","10977","10980","10982","10983","10984","10986","10989","10993","10994","10995","11001","11002","11003","11004","11005","11010","11020","11021","11022","11023","11024","11025","11026","11027","11030","11040","11041","11042","11043","11044","11050","11051","11052","11053","11054","11055","11096","11099","11101","11102","11103","11104","11105","11106","11109","11120","11201","11202","11203","11204","11205","11206","11207","11208","11209","11210","11211","11212","11213","11214","11215","11216","11217","11218","11219","11220","11221","11222","11223","11224","11225","11226","11228","11229","11230","11231","11232","11233","11234","11235","11236","11237","11238","11239","11240","11241","11242","11243","11244","11245","11247","11248","11249","11251","11252","11254","11255","11256","11351","11352","11354","11355","11356","11357","11358","11359","11360","11361","11362","11363","11364","11365","11366","11367","11368","11369","11370","11371","11372","11373","11374","11375","11377","11378","11379","11380","11381","11385","11386","11390","11405","11411","11412","11413","11414","11415","11416","11417","11418","11419","11420","11421","11422","11423","11424","11425","11426","11427","11428","11429","11430","11431","11432","11433","11434","11435","11436","11439","11451","11484","11499","11501","11507","11509","11510","11514","11516","11518","11520","11530","11531","11535","11536","11542","11545","11547","11548","11549","11550","11551","11552","11553","11554","11555","11556","11557","11558","11559","11560","11561","11563","11564","11565","11566","11568","11569","11570","11571","11572","11575","11576","11577","11579","11580","11581","11582","11583","11588","11590","11592","11593","11594","11595","11596","11597","11598","11599","11690","11691","11692","11693","11694","11695","11697","11701","11702","11703","11704","11705","11706","11707","11708","11709","11710","11713","11714","11715","11716","11717","11718","11719","11720","11721","11722","11724","11725","11726","11727","11729","11730","11731","11732","11733","11735","11736","11737","11738","11739","11740","11741","11742","11743","11745","11746","11747","11749","11750","11751","11752","11753","11754","11755","11756","11757","11758","11760","11762","11763","11764","11765","11766","11767","11768","11769","11770","11771","11772","11773","11774","11775","11776","11777","11778","11779","11780","11782","11783","11784","11786","11787","11788","11789","11790","11791","11792","11793","11794","11795","11796","11797","11798","11801","11802","11803","11804","11805","11815","11819","11853","11854","11855","11901","11930","11931","11932","11933","11934","11935","11937","11939","11940","11941","11942","11944","11946","11947","11948","11949","11950","11951","11952","11953","11954","11955","11956","11957","11958","11959","11960","11961","11962","11963","11964","11965","11967","11968","11969","11970","11971","11972","11973","11975","11976","11977","11978","11980","12563","18324","18328","18336","18337","18340","18371","18373","18425","18426","18435","18451","18457","18458","18464","8525","8540","8691","8802","12531","12533","12582","18302","18325","18337","18405","18428","18445","18460",
        
                //NY
                "08001","08002","08003","08004","08007","08009","08010","08011","08012","08014","08015","08016","08018","08019","08020","08021","08022","08023","08025","08026","08027","08028","08029","08030","08031","08032","08033","08034","08035","08036","08038","08039","08041","08042","08043","08045","08046","08048","08049","08051","08052","08053","08054","08055","08056","08057","08059","08060","08061","08062","08063","08064","08065","08066","08067","08068","08069","08070","08071","08072","08073","08074","08075","08076","08077","08078","08079","08080","08081","08083","08084","08085","08086","08088","08089","08090","08091","08093","08094","08095","08096","08097","08098","08099","08101","08102","08103","08104","08105","08106","08107","08108","08109","08110","08224","08312","08318","08322","08328","08343","08344","08347","08505","08511","08515","08518","08554","08562","08640","08641","18039","18041","18054","18070","18073","18074","18076","18077","18081","18084","18901","18902","18910","18911","18912","18913","18914","18915","18916","18917","18918","18920","18921","18922","18923","18924","18925","18926","18927","18928","18929","18930","18931","18932","18933","18934","18935","18936","18938","18940","18942","18943","18944","18946","18947","18949","18950","18951","18953","18954","18955","18956","18957","18958","18960","18962","18963","18964","18966","18968","18969","18970","18971","18972","18974","18976","18977","18979","18980","18981","18991","19001","19002","19003","19004","19006","19007","19008","19009","19010","19012","19013","19014","19015","19016","19017","19018","19019","19020","19021","19022","19023","19025","19026","19027","19028","19029","19030","19031","19032","19033","19034","19035","19036","19037","19038","19039","19040","19041","19043","19044","19046","19047","19048","19049","19050","19052","19053","19054","19055","19056","19057","19058","19059","19060","19061","19063","19064","19065","19066","19067","19070","19072","19073","19074","19075","19076","19078","19079","19080","19081","19082","19083","19085","19086","19087","19088","19089","19090","19091","19092","19093","19094","19095","19096","19098","19099","19101","19102","19103","19104","19105","19106","19107","19108","19109","19110","19111","19112","19113","19114","19115","19116","19118","19119","19120","19121","19122","19123","19124","19125","19126","19127","19128","19129","19130","19131","19132","19133","19134","19135","19136","19137","19138","19139","19140","19141","19142","19143","19144","19145","19146","19147","19148","19149","19150","19151","19152","19153","19154","19155","19160","19161","19162","19170","19171","19172","19173","19175","19176","19177","19178","19179","19181","19182","19183","19184","19185","19187","19188","19190","19191","19192","19193","19194","19195","19196","19197","19244","19255","19301","19310","19311","19312","19316","19317","19318","19319","19320","19330","19331","19333","19335","19339","19340","19341","19342","19343","19344","19345","19346","19347","19348","19350","19351","19352","19353","19354","19355","19357","19358","19360","19362","19363","19365","19366","19367","19369","19370","19371","19372","19373","19374","19375","19376","19380","19381","19382","19383","19388","19390","19395","19397","19398","19399","19401","19403","19404","19405","19406","19407","19408","19409","19415","19420","19421","19422","19423","19424","19425","19426","19428","19429","19430","19432","19435","19436","19437","19438","19440","19441","19442","19443","19444","19446","19450","19451","19452","19453","19454","19455","19456","19457","19460","19462","19464","19465","19468","19470","19472","19473","19474","19475","19477","19478","19480","19481","19482","19483","19484","19485","19486","19487","19488","19489","19490","19492","19493","19494","19495","19496","19520","19525","19701","19702","19703","19706","19707","19708","19709","19710","19711","19712","19713","19714","19715","19716","19717","19718","19720","19721","19725","19726","19730","19731","19732","19733","19734","19735","19736","19801","19802","19803","19804","19805","19806","19807","19808","19809","19810","19850","19880","19884","19885","19886","19887","19889","19890","19891","19892","19893","19894","19895","19896","19897","19898","19899","21901","21902","21903","21904","21911","21912","21913","21914","21915","21916","21917","21918","21919","21920","21921","21922","21930","7840","7865","7882","8037","8087","8215","8302","8360","8501","8610","8620","17527","18036","18041","18055","19504","19505","19512","19543","19938","19977",
        
                //CA
                "94002","94003","94005","94010","94011","94012","94013","94014","94015","94016","94017","94018","94019","94020","94021","94025","94026","94027","94028","94029","94030","94031","94037","94038","94044","94045","94059","94060","94061","94062","94063","94064","94065","94066","94067","94070","94071","94074","94080","94083","94096","94098","94099","94101","94102","94103","94104","94105","94106","94107","94108","94109","94110","94111","94112","94114","94115","94116","94117","94118","94119","94120","94121","94122","94123","94124","94125","94126","94127","94128","94129","94130","94131","94132","94133","94134","94135","94136","94137","94138","94139","94140","94141","94142","94143","94144","94145","94146","94147","94150","94151","94152","94153","94154","94155","94156","94157","94158","94159","94160","94161","94162","94163","94164","94165","94166","94167","94168","94169","94170","94171","94172","94175","94177","94188","94199","94303","94307","94308","94401","94402","94403","94404","94405","94406","94407","94408","94409","94497","94501","94502","94505","94506","94507","94509","94511","94513","94514","94516","94517","94518","94519","94520","94521","94522","94523","94524","94525","94526","94527","94528","94529","94530","94531","94536","94537","94538","94539","94540","94541","94542","94543","94544","94545","94546","94547","94548","94549","94550","94551","94552","94553","94555","94556","94557","94560","94561","94563","94564","94565","94566","94568","94569","94570","94572","94575","94577","94578","94579","94580","94582","94583","94586","94587","94588","94595","94596","94597","94598","94601","94602","94603","94604","94605","94606","94607","94608","94609","94610","94611","94612","94613","94614","94615","94617","94618","94619","94620","94621","94622","94623","94624","94625","94626","94627","94643","94649","94659","94660","94661","94662","94666","94701","94702","94703","94704","94705","94706","94707","94708","94709","94710","94712","94720","94801","94802","94803","94804","94805","94806","94807","94808","94820","94850","94875","94901","94903","94904","94912","94913","94914","94915","94920","94924","94925","94929","94930","94933","94937","94938","94939","94940","94941","94942","94945","94946","94947","94948","94949","94950","94956","94957","94960","94963","94964","94965","94966","94970","94971","94973","94974","94976","94977","94978","94979","94998","94952","94972","95219","95377","95391"
        
        );
        
        if( isset($surveyResult['349799X591X5493']) && intval($surveyResult['349799X591X5493']) < 18 ){
            $isElegible = false;
            $reason[] = "Less than 18 years";
        }
        
        if( isset($surveyResult['349799X591X5496']) && ! in_array( $surveyResult['349799X591X5496'], $allowedZipCodes) ){
            $isElegible = false;
            $reason[] = "Zipcode not allowed";
        }
        
        if( isset($surveyResult['349799X592X5497']) && $surveyResult['349799X592X5497'] != "A1" ){
            $isElegible = false;
            $reason[] = "Sex at birth not male";
        }
        
        if( isset($surveyResult['349799X737X5499']) && $surveyResult['349799X737X5499'] != "A2" ){
            $isElegible = false;
            $reason[] = "No unprotected anal sex with male";
        }
        
        if( isset($surveyResult['349799X593X5501']) && ( $surveyResult['349799X593X5501'] == "A2" || $surveyResult['349799X593X5501'] == "A5" ) ){
            $isElegible = false;
            $reason[] = "HIV positive";
        }
        
        if( isset($surveyResult['349799X593X5502']) && $surveyResult['349799X593X5502'] != "A1" ){
            $isElegible = false;
            $reason[] = "Yes to bleeding desease";
        }
        
        if( isset($surveyResult['349799X594X5503']) && $surveyResult['349799X594X5503'] != "A1" ){
            $isElegible = false;
            $reason[] = "Yes to Prep antiretroviral ";
        }
        
        if( isset($surveyResult['349799X594X5504']) && $surveyResult['349799X594X5504'] != "A1" ){
            $isElegible = false;
            $reason[] = "Yes to vaccine trial";
        }
        return $isElegible;
    }

    public static function getStudyCode()
    {
        return 'knowathome';
    }
}
