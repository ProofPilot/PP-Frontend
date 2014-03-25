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

namespace Cyclogram\FrontendBundle\Controller;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityManager;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

class SurveyController extends Controller
{
    private $parameters = array();
    
    public function preExecute()
    {
        $cc = $this->container->get('cyclogram.common');
        $this->parameters = $cc->defaultJsParameters($this->getRequest());
    }
    
    /**
     * Shows a survey. After completion of survey, survey results are saved in session, also
     * it is required to specify the redirect url
     *
     * @Route("/eligibility-survey/{studyCode}/{surveyId}", name="_eligibility_survey")
     * @Template()
     */
    public function surveyAction($studyCode, $surveyId= null)
    {
        $em = $this->getDoctrine()->getManager();
        $securityContext = $this->container->get('security.context');
        
            //if surveyid not equal to eligibility survey id
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
            $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->find(array('study' => $study->getStudyId(), 'language' => 1));
            if ($studyContent->getStudyElegibilitySurvey() != $surveyId)
                return $this->render("::error.html.twig", array(
                        "error" => "Please dont hack our site:)"));
            //If you are enrolled in study, no change to pass eligibility again
            if( $securityContext->isGranted('ROLE_PARTICIPANT') ){
                $participant = $securityContext->getToken()->getUser();
                $isEnrolled = $em->getRepository("CyclogramProofPilotBundle:Participant")->isEnrolledInStudy($participant, $studyCode);
                if ($isEnrolled)
                    return $this->redirect($this->get('router')->generate('_main'));
            }
            $lime_em = $this->getDoctrine()->getManager('limesurvey');
            $locale = $this->getRequest()->getLocale();
    
            $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContentByCode($studyCode, $locale);
            $studyId = $studyContent->getStudy()->getStudyId();
    
            $parameters = array();
            $parameters['studyCode'] = $studyCode;
            $parameters['survey'] = $this->getSurveyData($surveyId, $locale);
            $parameters['logo'] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
    
            $this->parameters = array_merge($this->parameters, $parameters);
            return $this->render('CyclogramFrontendBundle:Survey:survey.html.twig', $this->parameters);

    }
    
    /**
     * Shows a survey. After completion of survey, survey results are saved in session, also
     * it is required to specify the redirect url
     *
     * @Route("/surveyprotected/{studyCode}/{surveyId}", name="_survey_protected")
     * @Secure(roles="ROLE_PARTICIPANT, IS_AUTHENTICATED_REMEMBERED")
     * @Template()
     */
    public function surveyProtectedAction($studyCode, $surveyId)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $this->get('security.context')->getToken()->getUser();
        
        $closed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->checkIfSurveyClosed($participant, $surveyId);
        $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->checkIfSurveyPassed($participant, $surveyId);
        if($closed || $passed) {
            $this->parameters = array_merge($this->parameters, array(
                    "error" => "You have already passed this survey"));
            return $this->render("::error.html.twig", $this->parameters);
        }
        
        
//         $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->checkIfSurveyPassed($participant, $surveyId);
//         if($passed)
//             return $this->render("::error.html.twig", array(
//                     "error" => "You have already passed this survey"));
        
        $locale = $this->getRequest()->getLocale();
    
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContentByCode($studyCode, $locale);
        $studyId = $studyContent->getStudy()->getStudyId();
    
        $parameters = array();
        $parameters['studyCode'] = $studyCode;
        $parameters['survey'] = $this->getSurveyData($surveyId, $locale);
        $parameters['logo'] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
    
        $this->parameters = array_merge($this->parameters, $parameters);
        return $this->render('CyclogramFrontendBundle:Survey:survey.html.twig', $this->parameters);
    }
    
    
    /**
     * Main survey results processing function
     * @Route("/surveyResponse", name="_record_survey")
     */
    public function recordSurveyAction() {
        
        $request = $this->getRequest();
        $locale = $request->getLocale();
        $logic = $this->get('study_logic');
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        
        
        $studyCode = $this->getRequest()->query->get('studyCode');
        $surveyId = $this->getRequest()->query->get('surveyId');
        $saveId = $this->getRequest()->query->get('saveId');
        $redirectUrl = $this->getRequest()->query->get('redirectUrl');
        
        
        $studyContent = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:StudyContent')->getStudyContentByCode($studyCode, $locale);
        
        //get db data
        $surveyResult = $this->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData($saveId, $surveyId);
        
        $sl = $this->get('study_logic');
        
        $isEligible = $sl->checkSurveyEligibility($studyCode, $surveyResult);

        

        //if the user is already logged in 
        if($this->get('security.context')->isGranted("ROLE_PARTICIPANT")) {
            $participant = $this->get('security.context')->getToken()->getUser();
            $conn = $this->container->get('database_connection');
            $sql = "UPDATE limesurvey.lime_survey_{$surveyId} SET token = {$participant->getParticipantId()} WHERE id = {$saveId}";
            $conn->query($sql);
            if ($studyContent->getStudyElegibilitySurvey() == $surveyId) {
                if ($session->has('referralSite') && $session->has('referralCampaign')){
                    if($isEligible)
                        $logic->studyRegistration($participant, $studyCode, $surveyId, $saveId);
                    $isFirstStudy = $em->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')->findByParticipant($participant);
                    if ($participant->getParticipantEmailConfirmed() == false && count($isFirstStudy) <= 1) {
                        $this->confirmParticipantEmail($participant);
                    }
                } else {
                    $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
                    $studyContent = $em->getRepository('CyclogramProofPilotBundle:StudyContent')->findOneByStudy($study);
                    $session->set("message", "There was a problem - try the entire registration process again");
                    return $this->redirect($this->generateUrl("_page", array("studyUrl" => $studyContent->getStudyUrl())));
                }
            } else {
                $loggedUser = $this->get('security.context')->getToken()->getUser();
                $logic->participantSurveyLinkRegistration($surveyId, $saveId, $loggedUser, uniqid());
            }
        } elseif($isEligible) {
            //store surveyid and saveid in session
            $bag = new AttributeBag();
            $bag->setName("SurveyInfo");
            $array = array();
            $bag->initialize($array);
            $bag->set('surveyId', $surveyId);
            $bag->set('saveId', $saveId);
            $bag->set('studyCode', $studyCode);
            $session->registerBag($bag);
            $session->set('SurveyInfo', $bag);
        }
        
        
        if($isEligible) {
            return $this->redirect($redirectUrl);
        } else{
            if($this->get('security.context')->isGranted("ROLE_PARTICIPANT")) {
                $participant = $this->get('security.context')->getToken()->getUser();
                $studyArms = $em->getRepository('CyclogramProofPilotBundle:Study')->getStudyArms($studyCode);
                $participantArmLink = new ParticipantArmLink();
                $participantArmLink->setArm($studyArms[0]);
                $participantArmLink->setParticipant($participant);
                $participantArmLink->setStatus(ParticipantArmLink::STATUS_NOT_ELIGIBLE);
                $participantArmLink->setParticipantArmLinkDatetime(new \DateTime());
                $em->persist($participantArmLink);
                $em->flush($participantArmLink);
            }
            $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
            if ($study->getParticipantRegisterLast()){
                $session->set('nonEligible', $studyCode);
                return $this->redirect($this->generateUrl('_signup', array(
                            'studyCode' => $studyCode,
                            'surveyId' => $surveyId,
                             'saveId' =>$saveId)));
            } else {
                return $this->redirect($this->generateUrl('_page', array(
                            'studyUrl' => $studyContent->getStudyUrl(),
                            'eligible' => false
                        )));
            }
        }
    }
    
    private function getSurveyData($surveyId, $locale)
    {
        $survey = $this->getDoctrine()
        ->getRepository("CyclogramProofPilotBundleLime:LimeSurveysLanguagesettings", "limesurvey")
        ->getSurvey($surveyId, $locale);
    
        $surveyData = array (
                'url' => "/lime/index.php/survey/index/sid/".$surveyId."/newtest/Y/lang/".$survey->getSurveylsLanguage(),
                'title' =>  $survey->getSurveylsTitle()
        );
    
        return $surveyData;
         
    }
    
    public  function confirmParticipantEmail(Participant $participant, $studyCode = null)
    {
        $locale = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
        if($participant->getParticipantEmailConfirmed() == false) {
            $cc = $this->get('cyclogram.common');
    
            $embedded = array();
            $embedded = $cc->getEmbeddedImages();
    
            $parameters['code'] = $participant->getParticipantEmailCode();
            $participant->setParticipantEmailCode($parameters['code']);
            $em->persist($participant);
            $em->flush($participant);
            if (!empty($studyCodey))
                $parameters['studyCode'] = $studyCode;
            $parameters['email'] = $participant->getParticipantEmail();
    
            $parameters['locale'] = $participant->getLocale() ? $participant->getLocale() : $request->getLocale();
            $parameters['host'] = $this->container->getParameter('site_url');
            $parameters["studies"] = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Study')->getRandomStudyInfo($locale, $participant);
    
            $cc->sendMail(null,
                    $participant->getParticipantEmail(),
                    $this->get('translator')->trans("email_title_verify", array(), "email", $parameters['locale']),
                    'CyclogramFrontendBundle:Email:email_confirmation.html.twig',
                    null,
                    $embedded,
                    true,
                    $parameters);
        }
    }

}
