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
     * @Route("/newslatter", name="_newsletter")
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
     * @Route("/page", name="_page")
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
     * @Route("/is_it_secure", name="_secure")
     * @Template()
     */
    public function isItSecureAction()
    {
        $parameters = array();
        
        $parameters["security"] = array(
                'note' => 'We understand that you may be sharing some really sensitive stuff with ProofPilot, so we take your privacy and security very seriously.'
        );
        
        $parameters["privacy"] = array(
                array('question' => 'How does this compare to participating in research where my data is housed at a doctors office, clinic, or other research facility?',
                      'answer' => 'ProofPilot is required to keep your information as – or more – secure than the medical information housed in a doctor’s office, 
                                   clinic or other research facility. In addition, you do not need to call to make an appointment, walk in the door, or wait in a 
                                   lobby where others may see you.'
                ),
                array('question' => 'Am I at greater risk of someone discovering sensitive information by using ProofPilot compared to other research venues?',
                      'answer' => 'ProofPilot is required to keep your information as – or more –                 secure than the medical information housed in 
                                   a doctor’s office, clinic or other research facility. In addition, you do not need to call to make an appointment, walk in the door, 
                                   or wait in a lobby where others may see you.'
                ),
                array('question' => 'What exactly do you mean by confidential?',
                      'answer' => 'You may have heard of anonymous research studies.  In those cases, you do not provide any identifying information. 
                                   With the Internet, anonymity is very difficult to achieve. IP addresses, usernames, passwords, logins – this is all identifying information. 
                                   ProofPIlot makes participation in research studies confidential.  Any data you provide to ProofPilot will stay completely encrypted - 
                                   strictly confidential. Make sure you carefully read the consent information for the specific study you are joining to understand how your 
                                   data will be used. '
                ),
                array('question' => 'What information do you collect and why?',
                      'answer' => 'ProofPilot collects information on behalf of research studies. This information spans a wide perspective – everything from sexual habits, to weight, 
                                   to how much money you make each year.  The exact data we collect depends on the research study goals.  Make sure you read the specific study consent 
                                   information carefully before joining a study to understand exactly what kinds of data are being collected.'
                ),
                array('question' => 'Most sites don’t ask for a mobile phone number. Why does ProofPilot?',
                      'answer' => 'To increase security, ProofPilot uses dual-factor authentication. We ask that you use your username and a password, like any other site, to log into 
                                   the system. However, to increase security, we then send you a random four-digit code by SMS text message. You must enter that code before getting 
                                   access to the site. We may also use this number to call you in case we need to speak with you personally.'
                ),
                array('question' => 'Who has access to my data?',
                      'answer' => 'When you choose to participate in a research study, you are choosing to share your data (based on the terms and conditions of the study available in 
                                   the consent information) with a research organization using the ProofPilot infrastructure to help manage their effort. The name of that research 
                                   organization is identified on the study homepage. It will have access to your data.'
                ),
                array('question' => 'How secure is my data? ',
                      'answer' => 'ProofPilot takes a security-first approach. ProofPilot houses your data in an encrypted form on a dedicated server separate from the website and the 
                                   Internet via advanced firewalls. We always transmit personal and financial information via industry standard secure socket layer technology, 
                                   preventing potential malicious hackers from accessing data while it is being transmitted.'
                ),
                array('question' => 'How can I protect my account?',
                      'answer' => 'ProofPilot goes to great lengths to protect your data. There are some things you can do to make it even safer: ',
                      'list' => array(
                                 'Choose a complex password with letters and numbers, and don’t share it with anyone.', 'Make sure you have virus protection software on any computer that you use to access ProofPilot.',
                                 'Be wary about installing programs from companies that you are not familiar with.', 'If you receive an email from ProofPilot that seems suspicious, contact us immediately and report it. 
                                 It could be another organization posing as ProofPilot.'
                      )
                ),
                array('question' => 'What happens to my data if I close my account or I’m finished with ProofPilot’s services? ',
                      'answer' => 'If you close your account, your data remains housed on the secure servers as an inactive participant for up to three years. Your data will stay on 
                                   the server in an encrypted format and it will not be shared with anyone.'
                )
        );
        
        $parameters["proofpilot"] = array(
                'title' => 'About Proofpilot',
                'info' => 'ProofPilot is a platform to create, manage, and participate in online research studies. We help researchers easily launch studies that you, the participant, 
                           can join in order to answer some important questions about health, human behavior, social and public policy. Learn more about ProofPiot with the link below.'
        );
        
        $parameters["blank"] = array(
                'title' => 'Because we\'re on the Privacy Page this should be blank - but filled with privacy and security on all other pages',
                'info' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim 
                           ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.Ut wisi enim ad minim veniam, quis nostrud 
                           exerci.'
        );
        
        return $this->render('CyclogramSexProBundle:Default:is_it_secure.html.twig', $parameters);
    }
    
    /**
     * @Route("/baseline")
     * @Template()
     */
    public function baseLineAction()
    {
        $parameters = array();
        
        $parameters["lastaccess"] = new \DateTime("2013-07-01 10:05:00");
         
        $parameters["user"] = array('avatar' => 'images/tmp_avatar.jpg', 'name' => 'Damien Sonser');
        
        $parameters["about"] = array('title' => 'About this survey',
                                     'info' => 'This survey helps researchers determine what you are up to now - so
                                                that we can compare how and if things have changed in the future.
                                                Please answer as honestly as possible.&nbsp; '
                                    );
        
        $parameters["page"] = array(
                'image' => 'images/tmp_banner_small.jpg',
                'title' => 'SexPro Baseline Survey',
                'step' => 'The first step in this study'
        );
        
        $parameters["survey"] = array(
                array('question' => 'How many sexual partners have you had in the past 12 months?',
                      'input' => array('Number')
                ),
                array('question' => 'What is your sexual orientation?',
                      'radio' => array('Homosexual/Gay', 'Heterosexual/Straight', 'Bisexual', 'Not sure'),
                      'radiogroupname' => 'group1'
                ),
                array('question' => 'With whom have you had sex with in the past 12 months?',
                      'radio' => array('Men', 'Women', 'Male to Female Trans-gendered', 'Female to Male Trans-gendered', 'Does not apply'),
                      'radiogroupname' => 'group1'
                ),
                array('question' => 'Just another question to fill out the empty space',
                      'input' => array('Your height', 'Your weight')
                )
        );
        
        return $this->render('CyclogramSexProBundle:Default:Sexpro_baseline.html.twig', $parameters);
    }
    
    /**
     * @Route("/study", name="_study")
     * @Template()
     */
    public function studyAction()
    {
        
        $parameters = array();
        
        $parameters["about"] = array(
                'title' => 'About this study',
                'info' => '{From CMS} Lorem ipsum dolor sit amet, consectetuer adipiscing
                           elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                           magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                           nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                           aliquip ex ea commodo consequat.'
        );
        
        $parameters["itemlist"] = array(
                array('items' => '1. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
                array('items' => '2. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.'),
                array('items' => '3. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.')
        );
        
        $parameters["study"] = array(
                'title' => 'Study Title from study CMS',
                'subtitle' => 'Study Subtitle from CMS'
        );
        
        $parameters["content"] = array(
                array('title' => 'Consent information from Study CMS',
                      'text' => 'This material should come from the CMS and have limited formating forms.  Heading, body, underline, bold, italics, bullets, and numbering. 
                                 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat 
                                 volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
                array('title' => 'What’s Involved?',
                      'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
                                 Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel 
                                 eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan 
                                 et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta 
                                 nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam;')
                
        );
        
        return $this->render('CyclogramSexProBundle:Default:study.html.twig', $parameters);
    }
    

}
