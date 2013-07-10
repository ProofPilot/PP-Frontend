<?php

namespace Cyclogram\SexProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SurveyController extends Controller
{
    /**
     * @Route("/survey", name="_survey")
     * @Template()
     */
    public function surveyAction()
    {
        return $this->render('CyclogramSexProBundle:Survey:survey.html.twig');
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
     * @Route("/survey_eligibility/")
     * @Template()
     */
    public function surveyEligibilityAction()
    {
        return $this->render('CyclogramSexProBundle:Survey:survey_eligibility.html.twig');
    }
}
