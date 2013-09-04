<?php

namespace Cyclogram\FrontendBundle\Controller;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityManager;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SurveyController extends Controller
{
    
    /**
     * Shows a survey. After completion of survey, survey results are saved in session, also
     * it is required to specify the redirect url
     *
     * @Route("/survey/{studyCode}/{surveyId}", name="_survey")
     * @Template()
     */
    public function surveyAction($studyCode, $surveyId)
    {
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
     * Main survey results processing function
     * @Route("/surveyResponse", name="_record_survey")
     */
    public function recordSurveyAction() {
        
        $request = $this->getRequest();
        $locale = $request->getLocale();
        $logic = $this->get('study_logic');
        
        
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
            $loggedUser = $this->get('security.context')->getToken()->getUser();
            $logic->participantSurveyLinkRegistration($surveyId, $saveId, $loggedUser, uniqid());
        }
        
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
        
        if($isEligible)
            return $this->redirect($redirectUrl);
        else
            return $this->redirect($this->generateUrl('_page', array(
                        'studyUrl' => $studyContent->getStudyUrl(),
                        'eligible' => false
                    )));
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
