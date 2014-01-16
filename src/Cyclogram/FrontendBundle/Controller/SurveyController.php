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
    
    /**
     * Shows a survey. After completion of survey, survey results are saved in session, also
     * it is required to specify the redirect url
     *
     * @Route("/eligibility-survey/{studyCode}/{surveyId}", name="_eligibility_survey")
     * @Template()
     */
    public function surveyAction($studyCode, $surveyId)
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
    
            return $this->render('CyclogramFrontendBundle:Survey:survey.html.twig', $parameters);

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

        
        $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')->checkIfSurveyPassed($participant, $surveyId);
        if($passed)
            return $this->render("::error.html.twig", array(
                    "error" => "You have already passed this survey"));
        
        $locale = $this->getRequest()->getLocale();
    
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContentByCode($studyCode, $locale);
        $studyId = $studyContent->getStudy()->getStudyId();
    
        $parameters = array();
        $parameters['studyCode'] = $studyCode;
        $parameters['survey'] = $this->getSurveyData($surveyId, $locale);
        $parameters['logo'] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
    
        return $this->render('CyclogramFrontendBundle:Survey:survey.html.twig', $parameters);
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
        
        $isEligible = $sl->checkEligibility($studyCode, $surveyResult);

        

        //if the user is already logged in 
        if($this->get('security.context')->isGranted("ROLE_PARTICIPANT")) {
            $participant = $this->get('security.context')->getToken()->getUser();
            if ($studyContent->getStudyElegibilitySurvey() == $surveyId) {
                if ($session->has('referralSite') && $session->has('referralCampaign')){
                    if($isEligible)
                        $logic->studyRegistration($participant, $studyCode, $surveyId, $saveId);
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
            $session = $this->getRequest()->getSession();
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
            return $this->redirect($this->generateUrl('_page', array(
                        'studyUrl' => $studyContent->getStudyUrl(),
                        'eligible' => false
                    )));
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

}
