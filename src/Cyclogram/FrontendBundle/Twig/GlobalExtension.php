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
                'is_study_logic_implemented' => new \Twig_Function_Method($this, 'isStudyLogicImplemented')
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
        if($studyCode == 'knowathome')
            return "style=\"background-image:url('/images/study/1/".$nPic.".jpg')\"";
        else 
            return "";
    }
    
    public function studyLogo($studyCode)
    {
        $loginUrl = $this->container->get('router')->generate('_login');
        if($studyCode == 'knowathome')
            return "<a href=\"$loginUrl\" class=\"logo knowathome\"></a>";
        else
            return "<a class=\"logo\" href=\"$loginUrl\">ProofPilot</a>";
    }
    
    public function dashboardLogo($studyCode, $url)
    {
        if($studyCode == 'knowathome')
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

        return in_array(strtolower($studyCode), $logic->getSupportedStudies()) ? true : false;
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