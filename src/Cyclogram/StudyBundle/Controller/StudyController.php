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
     * @Route("/study", name="_study")
     * @Template()
     */
    public function studyAction($studyUrl)
    {
        $session = $this->getRequest()->getSession();      
        
        
        $locale = $this->getRequest()->getLocale();
    
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($studyUrl, $locale);
    
        $parameters = array();
    
        $parameters["studycontent"] = $studyContent;
        $parameters["studyUrl"] = $studyUrl;
        $parameters["studyId"] = $studyContent->getStudy()->getStudyId();
        $parameters["logo"] = $this->container->getParameter('study_image_url') . '/' . $studyContent->getStudy()->getStudyId() . '/' .$studyContent->getStudyLogo();
        $parameters["graphic"] = $this->container->getParameter('study_image_url') . '/' . $studyContent->getStudy()->getStudyId() . '/' .$studyContent->getStudyGraphic();

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
        
        $studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContentById($studyId, $locale);
        
        $parameters["studyUrl"] = $studyContent->getStudyUrl();
        
        
        $locale = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
        
        
        $blockContent = $em->getRepository("CyclogramProofPilotBundle:StaticBlocks")->getBlockContent("security_privacy_title", $locale);
        $parameters["title"] = $blockContent;
        
        $blockContent = $em->getRepository("CyclogramProofPilotBundle:StaticBlocks")->getBlockContent("privacy_security", $locale);
        $parameters["content"] = $blockContent;
        
        $blockContent = $em->getRepository("CyclogramProofPilotBundle:StaticBlocks")->getBlockContent("about_proofpilot", $locale);
        $parameters["about"] = $blockContent;

        
        return $this->render('CyclogramStudyBundle:Study:is_it_secure.html.twig', $parameters);
    }

    /**
     * @Route("/studySurveyResponse/{studyId}/{sid}/{svid}", name="_studySurveyResponse")
     * @Template()
     */
    public function studySurveyResponseAction($studyId, $sid, $svid){

        $session = $this->getRequest()->getSession();

        $locale = $this->getRequest()->getLocale();

        //get study
        $studyContent = $this->getDoctrine()->getRepository('CyclogramProofPilotBundle:StudyContent')
            ->getStudyContentById($studyId, $locale);

        //get db data
        $surveyResult = $this->get('custom_db')->getFactory('ElegibilityCustom')->getSurveyResponseData($svid, $sid);

        $bag = new AttributeBag();
        $bag->setName("SurveyInfo");
        $array = array();
        $bag->initialize($array);
        $bag->set('surveyId', $sid);
        $bag->set('saveId', $svid);
        $session->registerBag($bag);
        $session->set('SurveyInfo', $bag);

        //get specific study criteria
        switch($studyId){
            case 12:
                //move this to LimeSurvey service
                $KoCEligible = $this->getKoCEligibilityriteria($surveyResult);
                //redirect to eligible page
                if( $KoCEligible ){
                     $redirectUrl = $this->generateUrl("_study", array("studyId"=>12, "studyUrl"=>"kocsocialmedia"));
                     return $this->render('CyclogramStudyBundle:Study:surveyResponse.html.twig', array("redirectUrl"=>$redirectUrl));
                }else{
                    $redirectUrl = $this->generateUrl("_page", array("studyUrl"=>"kocsocialmedia"));
                    return $this->render('CyclogramStudyBundle:Study:surveyResponse.html.twig', array("redirectUrl"=>$redirectUrl));
                }

                break;
        }

        return new Response("");
    }

    private function getKoCEligibilityriteria($surveyResponse){
        $isEligible = true;
        $reason = array();

        if( isset($surveyResponse['382539X701X6985']) && intval($surveyResponse['382539X701X6985']) < 18 ){
            $isEligible = false;
            $reason[] = "Less than 18 years";
        }

        if( isset($surveyResponse['382539X701X6987']) && $surveyResponse['382539X701X6987'] != "A1" ){
            $isEligible = false;
            $reason[] = "Sex not male";
        }

        if( isset($surveyResponse['382539X701X6984other']) && ! empty($surveyResponse['382539X701X6984other']) ){
            $isEligible = false;
            $reason[] = "Parish is other";
        }

        if( isset($surveyResponse['382539X701X6986SQ003']) && $surveyResponse['382539X701X6986SQ003'] != "Y" ){
            $isEligible = false;
            $reason[] = "Race Not Black/African American";
        }

        if( isset($surveyResponse['382539X701X6988SQ005']) && $surveyResponse['382539X701X6988SQ005'] == "Y" ){
            $isEligible = false;
            $reason[] = "No sex in the last 12 months";
        }

        return $isEligible;
    }


}
