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
