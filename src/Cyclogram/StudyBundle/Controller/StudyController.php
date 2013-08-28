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
    private $parameters = array();

    
    public function preExecute()
    {
        $studyUrl = $this->getRequest()->get('studyUrl');
        $locale = $this->getRequest()->getLocale();
        
        $studyContent = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($studyUrl, $locale);
        $study = $studyContent->getStudy();
        $studyId = $studyContent->getStudyId();
        
        $logic = $this->get('study_logic');
        if(!$logic->supports($study->getStudyCode())) {
            $this->parameters["unsupportedStudy"] = $study->getStudyCode();
            $this->parameters["supported"] = $logic->getSupportedStudies();
            $this->parameters["studycontent"] = $studyContent;
            $this->parameters['studyUrl'] = $studyUrl;
            $this->parameters['studyId'] = $studyId;
            $this->parameters["logo"] = $this->container->getParameter('study_image_url') . '/' . $studyId. '/' .$studyContent->getStudyLogo();
            $this->parameters["graphic"] = $this->container->getParameter('study_image_url') . '/' .$studyId. '/' .$studyContent->getStudyGraphic();
            return true;
        }
        return false;
    }
    
    public function errorAction()
    {
        return $this->render('CyclogramStudyBundle:Study:error.html.twig', $this->parameters);
    }
    
    /**
     * @Route("", name="_page")
     * @Template()
     */
    public function pageAction($studyUrl)
    {
        $locale = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        
        $studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->getStudyContent($studyUrl, $locale);
        
        //$studyContent = $em->getRepository("CyclogramProofPilotBundle:StudyContent")->findOneBy(array('studyUrl' => $studyUrl, 'language' => $language->getLanguageId()));
        if (empty($studyContent))
            throw new ResourceNotFoundException('404 Not found');

        $studyId = $studyContent->getStudyId();

        $surveyId = $studyContent->getStudyElegibilitySurvey();
        
        $parameters = array();
        
        
        //depending on request parameters get campaign and site name
        if($this->getRequest()->get('utm_source') && $this->getRequest()->get('utm_campaign')) {
            $campaignName = $this->getRequest()->get('utm_campaign');
            $siteName = $this->getRequest()->get('utm_source');
        } else {
            $campaignParameters = $this->container->get('doctrine')->getRepository("CyclogramProofPilotBundle:Campaign")->getDefaultCampaignParameters($studyId);
            if(!empty($campaignParameters)) {
                $campaignName = $campaignParameters["campaignName"];
                $siteName = $campaignParameters["siteName"];
                
                $str = "utm_source=" . urlencode($campaignParameters["siteName"]);
                $str .= "&utm_medium=" . urlencode($campaignParameters["campaignTypeName"]);
                $str .= "&utm_term=" . urlencode($campaignParameters["placementName"]);
                $str .= "&utm_content=" . urlencode($campaignParameters["affinityName"]);
                $str .= "&utm_campaign="  . urlencode($campaignParameters["campaignName"]);
                
                $parameters["google_pars"] = $str;
                
            }
        }

        if($campaignName && $siteName) {
            $siteId = $this->getDoctrine()->getRepository("CyclogramProofPilotBundle:CampaignSiteLink")->getSiteIdByParameters($campaignName, $siteName);
            $session->save("referralSite", $siteId);
            echo "REFERRAL SITE ID: " . $siteId;
        } else {
            echo "Failed to determine default campaign & site";
        }


    
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





}
