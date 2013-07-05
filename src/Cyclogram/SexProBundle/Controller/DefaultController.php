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
     * @Route("/newslatter")
     * @Template()
     */
    public function newslatterAction()
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
                      'image' => 'newsletter/images/newsletter_tmp_image.jpg'
                )
        );
        
        return $this->render('CyclogramSexProBundle:Default:_newsletter.html.twig', $parameters);
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
