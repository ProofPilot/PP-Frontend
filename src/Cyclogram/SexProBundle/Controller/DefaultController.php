<?php

namespace Cyclogram\SexProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/main", name="_main")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('CyclogramSexProBundle:Default:main.html.twig');
    }
    
    /**
     * @Route("/newslatter/")
     * @Template()
     */
    public function newslatterAction()
    {
        return $this->render('CyclogramSexProBundle:Default:_newsletter.html.twig');
    }
    
    /**
     * @Route("/page/")
     * @Template()
     */
    public function pageAction()
    {
        return $this->render('CyclogramSexProBundle:Default:page.html.twig');
    }
    
    /**
     * @Route("/is_it_secure/")
     * @Template()
     */
    public function isItSecureAction()
    {
        return $this->render('CyclogramSexProBundle:Default:is_it_secure.html.twig');
    }
    
    /**
     * @Route("/baseline/")
     * @Template()
     */
    public function baseLineAction()
    {
        return $this->render('CyclogramSexProBundle:Default:Sexpro_baseline.html.twig');
    }
    
    /**
     * @Route("/study/")
     * @Template()
     */
    public function studyAction()
    {
        return $this->render('CyclogramSexProBundle:Default:study.html.twig');
    }
    

}
