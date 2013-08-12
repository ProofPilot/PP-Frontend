<?php

namespace Cyclogram\StudyBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyContent;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;


class StudyController extends Controller
{
    /**
     * @Route("", name="_page")
     * @Template()
     */
    public function pageAction($studyUrl)
    {
        $locale = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
        
        $studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($studyUrl, $locale);
        
        //$studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array('studyUrl' => $studyUrl, 'language' => $language->getLanguageId()));
        if (empty($studyContent))
            throw new ResourceNotFoundException('404 Not found');

        
        $studyId = $studyContent->getStudyId();
        
        
        $surveyId = $studyContent->getStudyElegibilitySurvey();
    
    
        $parameters = array();
    
        $parameters["studycontent"] = $studyContent;
        $parameters["studyUrl"] = $studyUrl;
        $parameters["studyId"] = $studyId;
        $parameters["surveyId"] = $surveyId;
        $parameters["logo"] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
        $parameters["graphic"] = $this->container->getParameter('study_image_url') . '/' .$studyId. '/' .$studyContent->getStudyGraphic();
        
    
        return $this->render('CyclogramStudyBundle:Study:page.html.twig', $parameters);
    
    }
    
    /**
     * @Route("/study/{studyId}", name="_study")
     * @Template()
     */
    public function studyAction($studyUrl, $studyId)
    {
        $session = $this->getRequest()->getSession();      
        
        
        $locale = $this->getRequest()->getLocale();
    
        $studyContent = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:StudyContent')
        ->getStudyContentById($studyId, $locale);
    
    
        $parameters = array();
    
        $parameters["studycontent"] = $studyContent;
        $parameters["studyUrl"] = $studyUrl;
        $parameters["studyId"] = $studyId;
        $parameters["logo"] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
        $parameters["graphic"] = $this->container->getParameter('study_image_url') . '/' .$studyId. '/' .$studyContent->getStudyGraphic();
    
    
    
        $parameters["content"] = array(
                array('title' => 'What’s Involved?',
                        'text' => 'Taking part in this study is your choice.  You may choose either to take part or not to take part in the study.  If you decide to take part in this
                        study, you may leave the study at any time.  No matter what decision you make, there will be no penalty to you in any way. You can still get your care
                        from our institution the way you usually do.We will tell you about new information or changes in the study that may affect your health or your willingness
                        to continue in the study.'),
                array('title' => 'What are my rights if I take part in this study?',
                        'text' => 'Taking part in this study is your choice. You may choose either to take part or not to take part in the study. If you decide to take part in this study,
                        you may leave the study at any time.  No matter what decision you make, there will be no penalty to you in any way. You can still get your care from our
                        institution the way you usually do.'),
                array('title' => 'Who can answer my questions about the study?',
                        'text' => 'You can talk to the researcher(s) about any questions, concerns, or complaints you have about this study.')
        );
    
        return $this->render('CyclogramStudyBundle:Study:study_eligibility.html.twig', $parameters);
    }
    
    
    /**
     * @Route("/newsletter", name="_newsletter")
     * @Template()
     */
    public function newslatterAction($studyUrl)
    {
        $parameters["email"] = array(
                'title' => 'E-mail title placeholder', 
                'info' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat 
                           volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. 
                           Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at 
                           vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. 
                           Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non 
                           habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius 
                           quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam 
                           littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. 
                           Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.',
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique, enim vel pretium commodo, dui purus cursus tellus, vel sodales 
                           nisl elit a arcu. Curabitur ultrices aliquam nisi, in venenatis arcu porta vitae. Sed hendrerit mollis nibh vel faucibus.'
                );
        $parameters["surveys"] = array(
                array('title' => 'iTest@Home Public Survey',
                      'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt',
                      'image' => '/newsletter/images/newsletter_tmp_image.jpg'
                )
        );
        
        return $this->render('CyclogramStudyBundle:Email:_newsletter.html.twig', $parameters);
    }
    

    
    /**
     * @Route("/is_it_secure/{studyId}", name="_secure")
     * @Template()
     */
    public function isItSecureAction($studyId)
    {
        $parameters = array();
        $parameters["studyId"] = $studyId;
        
        
        $locale = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
        
        $blockContent = $em->getRepository("CyclogramProofPilotBundle:StaticBlocks")->getBlockContent("privacy_security", $locale);
        $parameters["content"] = $blockContent;
        
        $blockContent = $em->getRepository("CyclogramProofPilotBundle:StaticBlocks")->getBlockContent("about_proofpilot", $locale);
        $parameters["about"] = $blockContent;

        
        return $this->render('CyclogramStudyBundle:Study:is_it_secure.html.twig', $parameters);
    }
    
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
    
        return $this->render('CyclogramStudyBundle:Study:survey.html.twig', $parameters);
    }

}
