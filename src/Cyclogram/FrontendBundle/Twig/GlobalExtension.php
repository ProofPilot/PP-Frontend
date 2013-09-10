<?php
namespace Cyclogram\FrontendBundle\Twig;

use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\DependencyInjection\ContainerInterface;

class GlobalExtension extends \Twig_Extension
{
    private $container;
    private $securityContext;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->securityContext = $this->container->get('security.context');
    }
    
    public function getFunctions()
    {
        return array(
                'study_background' => new \Twig_Function_Method($this, 'studyBackground'),
                'study_logo' => new \Twig_Function_Method($this, 'studyLogo'),
                'dashboard_logo' => new \Twig_Function_Method($this, 'dashboardLogo'),
                "twigtest" => new \Twig_Function_Method($this, 'twigTest', array(
                        'needs_environment' => true,
                        'needs_context' => true
                        )),
                'is_enrolled_in_study' => new \Twig_Function_Method($this, 'isEnrolledInStudy'),
                'is_stytdy_logic_implemented' => new \Twig_Function_Method($this, 'isStudyLogicImplemented')
//                 'google_campaign_info' => new \Twig_Function_Method($this, 'getGoogleCampaignInfo')
        );
    }
    
    public function getName()
    {
        return 'global_extension';
    }


    public function setContainer($container)
    {
        $this->container = $container;
    }
    
    public function studyBackground($studyCode)
    {
        $nPic = rand ( 1, 4 );
        if($studyCode == 'kah')
            return "style=\"background-image:url('/images/study/1/".$nPic.".jpg')\"";
        else 
            return "";
    }
    
    public function studyLogo($studyCode)
    {
        $loginUrl = $this->container->get('router')->generate('_login');
        if($studyCode == 'kah')
            return "<a href=\"$loginUrl\" class=\"logo knowathome\"></a>";
        else
            return "<a class=\"logo\" href=\"$loginUrl\">ProofPilot</a>";
    }
    
    public function dashboardLogo($studyCode, $url)
    {
        if($studyCode == 'kah')
            return "<a class=\"logo knowathome\" href=\"$url\">
                 <img src=\"/2cd1c6ecec2c6d908b3ed66d4ea7b902/1/logo-1-en.png\" width=\"234\" height=\"44\" />
            </a>";
        else
            return "<a class=\"site_logo\" href=\"$url\">ProofPilot</a>";
    }
    
    public function twigTest(\Twig_Environment $environment, $context)
    {
        $b = $context;
    }
    
    public function isEnrolledInStudy($studyCode)
    {
        $participant = $this->securityContext->getToken()->getUser();
        return $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')->isEnrolledInStudy($participant, $studyCode);
    }
    
    public function isStudyLogicImplemented($studyCode) {
        $logic = $this->container->get('study_logic');
        if ($logic->supports($studyCode))
            return true;
    }
    
//     public function getGoogleCampaignInfo($studyId)
//     {
//         $campaignParameters = $this->container->get('doctrine')->getRepository("CyclogramProofPilotBundle:Campaign")->getDefaultCampaignParameters($studyId);
        
//         if(empty($campaignParameters))
//             return "";
            
//         $str = "utm_source=" . urlencode($campaignParameters["siteName"]);
//         $str .= "&utm_medium=" . urlencode($campaignParameters["campaignTypeName"]);
//         $str .= "&utm_term=" . urlencode($campaignParameters["placementName"]);
//         $str .= "&utm_content=" . urlencode($campaignParameters["affinityName"]);
//         $str .= "&utm_campaign="  . urlencode($campaignParameters["campaignName"]);

//         return $str;
//     }

}