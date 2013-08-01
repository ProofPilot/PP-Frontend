<?php
namespace Cyclogram\FrontendBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class GlobalExtension extends \Twig_Extension
{
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function getFunctions()
    {
        return array(
                'study_background' => new \Twig_Function_Method($this, 'studyBackground'),
                'study_logo' => new \Twig_Function_Method($this, 'studyLogo')
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
    
    public function studyBackground($studyId)
    {
        if(!$studyId)
            return "";

        $study = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
        if(!$study)
            return "";

        $hasRealGraphics =  $study->getStudyRealTimeGraphics();

        if(!$hasRealGraphics)
            return "";
        
        $nPic = rand ( 1, 4 );
        $url = $this->container->getParameter('admin_project_url') . '/images/study/' . $studyId . '/' .$nPic.'.jpg';
        return "style=\"background-image:url('$url')\"";
    }
    
    public function studyLogo($studyId)
    {
        $loginUrl = $this->container->get('router')->generate('_login');
        if($studyId)
        {
            $study = $this->container->get('doctrine')->getRepository('CyclogramProofPilotBundle:Study')->find($studyId);
            if($study) 
            {
                $hasRealGraphics =  $study->getStudyRealTimeGraphics();
                if($hasRealGraphics) {
                    return "<a href=\"$loginUrl\" class=\"logo knowathome\"></a>";
                }
            }
        }
        
        
        
        return "<a class=\"logo\" href=\"$loginUrl\">ProofPilot</a>";
    }
}