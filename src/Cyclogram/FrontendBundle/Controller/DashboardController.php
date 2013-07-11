<?php

namespace Cyclogram\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/{_locale}")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/main", name="_main")
     * @Template()
     */
    public function indexAction()
    {
        $participant = $this->get('security.context')->getToken()->getUser();
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
                        'image' => '/images/tmp_banner_1.jpg'
                ),
                array(
                        'title' => 'An activity of some sort',
                        'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt',
                        'icon' => 'icon_2',
                        'image' => '/images/tmp_banner_2.jpg'
                ),
                array(
                        'title' => 'A measurement of some sort',
                        'content' => 'After a pledge, confirm that you actually followed through on the pledge',
                        'icon' => 'icon_3',
                        'image' => '/images/tmp_banner_3.jpg'
                ),
                array(
                        'title' => 'A Test of some sort',
                        'content' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt',
                        'icon' => 'icon_4',
                        'image' => '/images/tmp_banner_4.jpg'
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
         
        $parameters["user"] = array('avatar' => '/images/tmp_avatar.jpg', 'name' => 'Damien Sonser');
        if ($participant->getParticipantEmailConfirmed()){
            $parameters["confirm_email"] = true;
        } else {
            $parameters["confirm_email"] = false;
            $parameters["email_alert"] = "Please verify your e-mail address. To participate in studies we need a valid e-mail address - please go to your e-mail and click the link";
        }
    
        return $this->render('CyclogramFrontendBundle:Dashboard:main.html.twig', $parameters);
    
    }
}
