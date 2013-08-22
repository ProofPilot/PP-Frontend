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

class LimeController extends Controller
{
    /**
     * @Route("/surveyResponse", name="_record_survey")
     */
    public function recordSurveyAction() {
        
        $loggedUser = $this->get('security.context')->getToken()->getUser();
        
        $surveyId = $this->getRequest()->query->get('surveyId');
        $saveId = $this->getRequest()->query->get('saveId');
        
        //If logged in save result immediately
        if(($loggedUser instanceof Participant) && ($this->get('security.context')->isGranted("ROLE_PARTICIPANT"))) {
            $this->get('study_logic')->participantSurveyLinkRegistration($surveyId, $saveId, $loggedUser, uniqid());
        }
        $redirectUrl = $this->getRequest()->query->get('redirectUrl');

        $session = $this->getRequest()->getSession();
        $bag = new AttributeBag();
        $bag->setName("SurveyInfo");
        $array = array();
        $bag->initialize($array);
        $bag->set('surveyId', $surveyId);
        $bag->set('saveId', $saveId);
        $session->registerBag($bag);
        $session->set('SurveyInfo', $bag);
        
        
        return $this->redirect($redirectUrl);
    }
    
    /**
     * Shows a survey. After completion of survey, survey results are saved in session, also
     * it is required to specify the redirect url
     *
     * @Route("/survey/{studyId}/{surveyId}", name="_survey")
     * @Template()
     */
    public function surveyAction($studyId, $surveyId)
    {
        $lime_em = $this->getDoctrine()->getManager('limesurvey');
        $locale = $this->getRequest()->getLocale();
    
        $parameters = array();
    

        $parameters['studyId'] = $studyId;
    
    
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContentById($studyId, $locale);
    
    
        $parameters['survey'] = $this->getSurveyData($surveyId, $locale);
        $parameters['logo'] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
    
    
        return $this->render('CyclogramStudyBundle:Study:survey.html.twig', $parameters);
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
