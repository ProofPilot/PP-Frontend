<?php

namespace Cyclogram\SexProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/main")
     * @Template()
     */
    public function indexAction()
    {
        $parameters = array();
        
        $parameters['text'] = array(
                "title" => "title",
                "content" => "content");
        $parameters['message'] = array(
                "activity" => "activity");
        
        $parameters["surveys"] = array(
                array('title' => 'A survey title of some sort',
                      'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt',
                      'icon' => 'icon_1',
                      'image' => 'images/tmp_banner_1.jpg'
                      ),
                array(
                      'title' => 'An activity of some sort',
                      'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt',
                      'icon' => 'icon_2',
                      'image' => 'images/tmp_banner_2.jpg'
                      ),
                array(
                      'title' => 'A measurement of some sort',
                      'content' => 'After a pledge, confirm that you actually followed through on the pledge',
                      'icon' => 'icon_3',
                      'image' => 'images/tmp_banner_3.jpg'
                      ),
                array(
                      'title' => 'A Test of some sort',
                      'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt',
                      'icon' => 'icon_4',
                      'image' => 'images/tmp_banner_4.jpg'
                      )
                );
        $parameters["actions"] = array(
                array('activity' => 'Your e-mail address has been confirmed',
                      'class' => 'icon1 first'
                     ),
                array('activity' => 'Your mobile telephone number has been confirmed',
                      'class' => 'icon2'
                     ),
                array('activity' => 'Welcome to the study Know@Home: Putting the test to the test',
                      'class' => 'icon3'
                     ),
                array('activity' => 'Your mobile telephone number has been confirmed',
                      'class' => 'icon4 last'
                     )
                );
        $parameters["assistance"] = array(
                array('info' => 'Help', 'class' => 'first'),
                array('info' => 'How to activate your tests','class' => ''),
                array('info' => 'Read instructions to Perform the Tests', 'class' => ''),
                array('info' => 'Collect specimen', 'class' => ''),
                array('info' => 'Some other info', 'class' => 'last')
                );
        
       $parameters["lastaccess"] = new \DateTime("2013-07-01 10:05:00");
       
       $parameters["user"] = array('avatar' => 'images/tmp_avatar.jpg', 'name' => 'Damien Sonser');
        
        return $this->render('CyclogramSexProBundle:Default:main.html.twig', $parameters);
        
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
     * @Route("/page")
     * @Template()
     */
    public function pageAction()
    {
        $parameters = array();
        
        $parameters["study"] = array(
                'name' => 'Study name from CMS',
                'list' => 'List of Study organizations from CMS',
                'subtitle' => 'Study subtitle from CMS',
                'description' => 'Study short description from CMS (this appears to not be in the current wires from the CMS. It should be on the Study Description page.) '
        );
        
        $parameters["about"] = array(
                'title' => 'About',
                'info' => 'About, what\'s involved, Requirements, and Privacy and Security should be the headings from the CMS system.&nbsp; There should be 4 headings on this page.'
        );
        
        $parameters["heading"] = array(
                'title' => 'Heading',
                'text' => 'This is a secondary heading body text.'
        );
        
        $parameters["secure"] = array(
                'title' => 'Is it secure',
                'text' => 'ProofPilot takes a security-first approach. We understand
                  that you are sharing some sensitive data with us and our
                  partners. We house your data in secure servers in a highly
                  encrypted format. We take your security and privacy seriously.
                  Learn more about security with the link below.&nbsp;'
        );
        
        $parameters["proofpilot"] = array(
                'title' => 'About proofpilot',
                'text' => 'ProofPilot is a platform to create, manage and participate
                  in online research studies. We help researchers easily launch
                  studies that, you, the participant, can join in order to
                  answer some important questions about health, human behavior,
                  social and public policy. Learn more about ProofPilot with the
                  link below.'
        );
        
        return $this->render('CyclogramSexProBundle:Default:page.html.twig', $parameters);
        
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
