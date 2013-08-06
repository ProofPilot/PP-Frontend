<?php

namespace Cyclogram\SexProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class SurveyController extends Controller
{
    /**
     * @Route("/survey/{studyId}/{surveyId}", name="_survey")
     * @Template()
     */
    public function surveyAction($studyUrl, $studyId, $surveyId)
    {
        $lime_em = $this->getDoctrine()->getManager('limesurvey');
        $locale = $this->getRequest()->getLocale();

        $parameters = array();
        
        $parameters['studyUrl'] = $studyUrl;
        $parameters['studyId'] = $studyId;
        
        $survey = $this->getDoctrine()
            ->getRepository("CyclogramProofPilotBundleLime:LimeSurveysLanguagesettings", "limesurvey")
            ->getSurvey($surveyId, $locale);
        
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContentById($studyId, $locale);

        
        $parameters['survey_url'] = "/lime/index.php/survey/index/sid/".$surveyId."/newtest/Y/lang/".$survey->getSurveylsLanguage();
        
        $parameters["lastaccess"] = new \DateTime("2013-07-01 10:05:00");
         
        $parameters["about"] = array('title' => 'About this survey',
                'info' => 'This survey helps researchers determine what you are up to now - so
                that we can compare how and if things have changed in the future.
                Please answer as honestly as possible.&nbsp; '
        );
        
        $parameters["list"] = array(
                array('item' => '1. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
                array('item' => '2. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.'),
                array('item' => '3. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.')
        );
        
        $parameters["page"] = array(
                'logo' => $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo(),
                'title' => $survey->getSurveylsTitle()
        );
        
        return $this->render('CyclogramSexProBundle:Survey:survey.html.twig', $parameters);
    }
    
    /**
     * @Route("/survey_next/")
     * @Template()
     */
    public function surveyNextAction()
    {
        return $this->render('CyclogramSexProBundle:Survey:survey_next.html.twig');
    }
    
    /**
     * @Route("/survey_with_error/")
     * @Template()
     */
    public function surveyErrorAction()
    {
        return $this->render('CyclogramSexProBundle:Survey:survey_with_error.html.twig');
    }
    
    /**
     * @Route("/survey_eligibility/", name="_survey_eligibility")
     * @Template()
     */
    public function surveyEligibilityAction()
    {
        return $this->render('CyclogramSexProBundle:Survey:survey_eligibility.html.twig');
    }
}
