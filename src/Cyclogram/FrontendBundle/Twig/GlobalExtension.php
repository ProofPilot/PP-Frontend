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
                "twigtest" => new \Twig_Function_Method($this, 'twigTest', array(
                        'needs_environment' => true,
                        'needs_context' => true
                        )),
                'is_enrolled_in_study' => new \Twig_Function_Method($this, 'isEnrolledInStudy'),
                'is_study_logic_implemented' => new \Twig_Function_Method($this, 'isStudyLogicImplemented'),
                'is_participant_register_last'  => new \Twig_Function_Method($this, 'isParticipantRegisterLast'),
                'is_skip_consent'  => new \Twig_Function_Method($this, 'isSkipConsent'),
                'is_skip_about_me'=> new \Twig_Function_Method($this, 'isSkipAboutMe'),
                'is_not_eligible_in_study' => new \Twig_Function_Method($this, 'isNotEligible')
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
    
    public function studyBackground($branding, $random=false)
    {
        $nPic = rand ( 1, 4 );
        if($branding=="default")
            return "";
        else if($random==true)
            return "style=\"background-image:url('/branding/".$branding."/random/".$nPic.".jpg')\"";
        else if($random==false)
            return "";

    }

    
    public function twigTest(\Twig_Environment $environment, $context)
    {
        $b = $context;
    }
    
    public function isEnrolledInStudy($studyCode)
    {
        if (isset($studyCode) && $studyCode !== 'jsCode') {
            $participant = $this->securityContext->getToken()->getUser();
            return $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')->isEnrolledInStudy($participant, $studyCode);
        } else {
            return false;
        }
    }
    
    public function isNotEligible($studyCode)
    {
        if (isset($studyCode) && $studyCode !== 'jsCode') {
            $participant = $this->securityContext->getToken()->getUser();
            return $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Participant')->isNotEligibleInStudy($participant, $studyCode);
        } else {
            return false;
        }
    }
    
    public function isStudyLogicImplemented($studyCode) {
        if (isset($studyCode) && $studyCode !== 'jsCode') {
            $logic = $this->container->get('study_logic');
            
            $studies = $logic->getSupportedStudies();
            foreach ($studies as $study) {
                $supportedStudies[] = strtolower($study);
            }
            
            return in_array(strtolower($studyCode), $supportedStudies) ? true : false;
        } else {
            return false;
        }
    }
    
    public function isParticipantRegisterLast($studyCode)
    {
        if (isset($studyCode) && $studyCode !== 'jsCode') {
        $study =  $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
        if($study->getParticipantRegisterLast() == 1)
            return true;
        else return false;
        } else {
            return  false;
        }
    }
    
    public function isSkipConsent($studyCode)
    {
        if (isset($studyCode) && $studyCode !== 'jsCode') {
        $study =  $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
        if($study->getStudySkipConsent() == 1)
            return true;
        else return false;
        } else {
            return  false;
        }
    }
    
    public function isSkipAboutMe($studyCode)
    {
        if (isset($studyCode) && $studyCode !== 'jsCode') {
            $study =  $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
            if($study->getStudySkipAboutMe() == 1)
                return true;
           else return false;
       } else {
           return  false;
       }
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