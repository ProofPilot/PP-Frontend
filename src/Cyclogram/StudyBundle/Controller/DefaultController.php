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

namespace Cyclogram\StudyBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

use Cyclogram\Bundle\ProofPilotBundle\Entity\StudyContent;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Cyclogram\FrontendBundle\Form\RegistrationForm;
use Cyclogram\FrontendBundle\Form\SignUpAboutForm;
use Cyclogram\FrontendBundle\Form\MailAddressForm;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends Controller

{
    private $parameters = array();
    
    public function preExecute()
    {
        $cc = $this->container->get('cyclogram.common');
        $this->parameters = $cc->defaultJsParameters($this->getRequest());
    }
    
    /**
     * @Route("/", name="_index")
     * @Template()
     */
    public function indexAction()
    {
        return new Response('sdfds');
    }
    
    /**
     * @Route("/is_it_secure", name="_secure")
     * @Template()
     */
    public function isItSecureAction()
    {
        $locale = $this->getRequest()->getLocale();
        $em = $this->getDoctrine()->getManager();
    
    
        $blockContent = $em->getRepository("CyclogramProofPilotBundle:StaticBlocks")->getBlockContent("security_privacy_title", $locale);
        $parameters["title"] = $blockContent;
    
        $blockContent = $em->getRepository("CyclogramProofPilotBundle:StaticBlocks")->getBlockContent("privacy_security", $locale);
        $parameters["content"] = $blockContent;
    
        $blockContent = $em->getRepository("CyclogramProofPilotBundle:StaticBlocks")->getBlockContent("about_proofpilot", $locale);
        $parameters["about"] = $blockContent;
    
        $this->parameters = array_merge($this->parameters, $parameters);
        return $this->render('CyclogramStudyBundle:Study:is_it_secure.html.twig', $this->parameters);
    }
}
