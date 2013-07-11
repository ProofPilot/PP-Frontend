<?php

namespace Cyclogram\SexProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}/sexpro")
 */
class SurveyController extends Controller
{
    /**
     * @Route("/survey", name="_survey")
     * @Template()
     */
    public function surveyAction()
    {
        
        $parameters = array();
        
        $parameters["lastaccess"] = new \DateTime("2013-07-01 10:05:00");
         
        $parameters["user"] = array('avatar' => 'images/tmp_avatar.jpg', 'name' => 'Damien Sonser');
        
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
                'image' => 'images/tmp_banner_small.jpg',
                'title' => 'Know@home baseline study',
                'subtitle' => 'Surveys allow you to provide feedback, input information all online.'
        );
        
//         $parameters["survey"] = array(
//                 array('question' => 'How many sexual partners have you had in the past 12 months?',
//                         'input' => array('Number')
//                 ),
//                 array('question' => 'What is your sexual orientation?',
//                         'radio' => array('Homosexual/Gay', 'Heterosexual/Straight', 'Bisexual', 'Not sure'),
//                         'radiogroupname' => 'group1'
//                 ),
//                 array('question' => 'With whom have you had sex with in the past 12 months?',
//                         'radio' => array('Men', 'Women', 'Male to Female Trans-gendered', 'Female to Male Trans-gendered', 'Does not apply'),
//                         'radiogroupname' => 'group1'
//                 ),
//                 array('question' => 'Just another question to fill out the empty space',
//                         'input' => array('Your height', 'Your weight')
//                 )
//         );
        
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
