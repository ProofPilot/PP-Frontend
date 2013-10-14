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
namespace Cyclogram\FrontendBundle\Menu;
use Doctrine\Bundle\DoctrineBundle\Registry;

use JMS\TranslationBundle\Model\Message;

use Symfony\Component\Security\Core\SecurityContext;

// use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;

use JMS\TranslationBundle\Translation\TranslationContainerInterface;

use Knp\Menu\FactoryInterface;

class MenuBuilder extends ContainerAware implements TranslationContainerInterface
{
//     private $factory;
//     private $container;
    
//     /**
//      * @param FactoryInterface $factory
//      */
//     public function __construct(FactoryInterface $factory, Container $container)
//     {
//         $this->factory = $factory;
//         $this->container = $container;
//     }
    private function getThemeParameter()
    {
        $branding = $this->container->getParameter('branding');
        if ($branding == 'default') {
            return 'sexpro';
        } else {
            return 'knowathome';
        }
    }

    public function createSideDashboardMenu(FactoryInterface $factory,
            array $options)
    {
        $studyCode = $this->container->get('request')->get('studyCode');
        
        $participant = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->container->get('doctrine')->getManager();
        $interventioncount = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->getActiveParticipantInterventionsCount($participant);
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'left_menu');

        $menu->addChild('side_dasboard_menu.dashboard', array(
                'route' => '_main'
                ))
                ->setAttribute('class', 'icon_dashboard')->setExtra('translation_domain', 'sidemenu')->setAttribute("news", $interventioncount);
//         $menu->addChild('side_dasboard_menu.survey', array(
//                 'route' => '_main',
//                 'routeParameters' => array(
//                         'studyCode' => $studyCode
//                         )))
//                 ->setAttribute('class', 'icon_survey')->setExtra('translation_domain', 'sidemenu');
//         $menu->addChild('side_dasboard_menu.activities', array(
//                 'route' => '_main',
//                 'routeParameters' => array(
//                         'studyCode' => $studyCode
//                         )))
//                 ->setAttribute('class', 'icon_activities')->setExtra('translation_domain', 'sidemenu');
//         $menu->addChild('side_dasboard_menu.measurements', array(
//                 'route' => '_main',
//                 'routeParameters' => array(
//                         'studyCode' => $studyCode
//                         )))
//                 ->setAttribute('class', 'icon_measurments');
//         $menu->addChild('side_dasboard_menu.treatment', array(
//                 'route' => '_main',
//                 'routeParameters' => array(
//                         'studyCode' => $studyCode
//                         )))
//                 ->setAttribute('class', 'icon_treatment')->setExtra('translation_domain', 'sidemenu');

        return $menu;
    }

    public function createBottomRightMenu(FactoryInterface $factory,
            array $options)
    {
        $studyCode = $this->container->get('request')->get('studyCode');
        
        $menu = $factory->createItem('root');

        $menu->addChild('bottom_right_menu.help', array('route' => '_page', 'routeParameters' => array('studyUrl' => $this->getThemeParameter())))
                ->setAttribute('class', 'icon_help')->setExtra('translation_domain', 'generalmenus');
        $menu->addChild('bottom_right_menu.logout', array('route' => '_logout'))
                ->setAttribute('class', 'icon_logout normal')->setExtra('translation_domain', 'generalmenus');
        $menu->addChild('bottom_right_menu.my_settings', array(
                'route' => '_settings',
                'routeParameters' => array(
                        'studyCode' => $studyCode
                        )))
                ->setAttribute('class', 'icon_settings')->setExtra('translation_domain', 'generalmenus');

        return $menu;
    }

    public function createBottomLeftMenu(FactoryInterface $factory,
            array $options)
    {
        $studyCode = $this->container->get('request')->get('studyCode');
        
        $menu = $factory->createItem('root');

        $menu->addChild('bottom_left_menu.home', array(
                'route' => '_main'))
                ->setAttribute('class', 'icon_home')->setExtra('translation_domain', 'generalmenus');
        $menu->addChild('bottom_left_menu.fullscreen', array(
                'route' => '_main'))
                ->setAttribute('class', 'icon_fullscreen')->setExtra('translation_domain', 'generalmenus');
        $menu->addChild('bottom_left_menu.update', array(
                'route' => '_main'))
                ->setAttribute('class', 'icon_update')->setExtra('translation_domain', 'generalmenus');

        return $menu;
    }

    public function createTopSettingsMenu(FactoryInterface $factory,
            array $options)
    {
        $studyCode = $this->container->get('request')->get('studyCode');
        
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'header_menu');

        $menu->addChild('top_menu.help', array('route' => '_page', 'routeParameters' => array('studyUrl' => $this->getThemeParameter())))
                ->setAttribute('class', 'icon_help')
                ->setExtra('translation_domain', 'generalmenus');
        $menu->addChild('top_menu.logout', array('route' => '_logout'))
                ->setAttribute('class', 'icon_logout normal')
                ->setExtra('translation_domain', 'generalmenus');
        $menu->addChild('top_menu.settings', array(
                'route' => '_settings',
                'routeParameters' => array(
                        'studyCode' => $studyCode
                        )))
                ->setAttribute('class', 'icon_settings')
                ->setAttribute("dropdown", true)
                ->setExtra('translation_domain', 'generalmenus');
        $menu['top_menu.settings']
                ->addChild('top_menu.general_settings',
                        array(
                            'route' => '_settings',
                            'routeParameters' => array(
                            'studyCode' => $studyCode
                        )))
                ->setAttribute('class', 'submenu_icon_general')
                ->setAttribute("nospan", true)
                ->setExtra('translation_domain', 'generalmenus');
        $menu['top_menu.settings']
                ->addChild('top_menu.contact_preferences',
                        array(
                            'route' => '_contact_prefs',
                            'routeParameters' => array(
                            'studyCode' => $studyCode
                        )))
                ->setAttribute('class', 'submenu_icon_contact')
                ->setAttribute("nospan", true)
                ->setExtra('translation_domain', 'generalmenus');
        $menu['top_menu.settings']
        ->addChild('top_menu.shipping_information',
                array(
                        'route' => '_shipping',
                        'routeParameters' => array(
                                'studyCode' => $studyCode
                        )))
                        ->setAttribute('class', 'submenu_icon_contact')
                        ->setAttribute("nospan", true)
                        ->setExtra('translation_domain', 'generalmenus');
        $menu['top_menu.settings']
        ->addChild('top_menu.about_me',
                array(
                        'route' => '_about_me',
                        'routeParameters' => array(
                                'studyCode' => $studyCode
                        )))
                        ->setAttribute('class', 'submenu_icon_contact')
                        ->setAttribute("nospan", true)
                        ->setExtra('translation_domain', 'generalmenus');
//         $menu['top_menu.settings']
//                 ->addChild('top_menu.shipping_information',
//                         array(
//                               'route' => '_survey_eligibility', 
//                               'routeParameters' => array('studyUrl' => 'sexpro')))
//                 ->setAttribute('class', 'submenu_icon_shipping')
//                 ->setAttribute("nospan", true)
//                 ->setExtra('translation_domain', 'generalmenus');

        return $menu;
    }

    public function createSideSettingsMenu(FactoryInterface $factory,
            array $options)
    {
        $studyCode = $this->container->get('request')->get('studyCode');
        
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'left_menu')->setExtra('translation_domain', 'sidemenu');

        $menu->addChild('side_settings_menu.general_settings',                         
                        array(
                            'route' => '_settings',
                            'routeParameters' => array(
                            'studyCode' => $studyCode
                        )))
                ->setAttribute('class', 'icon_general_settings')->setExtra('translation_domain', 'sidemenu');
        $menu->addChild('side_settings_menu.contact_preferences',
                       array(
                            'route' => '_contact_prefs',
                            'routeParameters' => array(
                            'studyCode' => $studyCode
                        )))
                ->setAttribute('class', 'icon_contact_prefs')->setExtra('translation_domain', 'sidemenu');
        $menu->addChild('side_settings_menu.shipping_information',
                array(
                        'route' => '_shipping',
                        'routeParameters' => array(
                                'studyCode' => $studyCode
                        )))
                        ->setAttribute('class', 'icon_contact_prefs')->setExtra('translation_domain', 'sidemenu');
        $menu->addChild('side_settings_menu.about_me',
                array(
                        'route' => '_about_me',
                        'routeParameters' => array(
                                'studyCode' => $studyCode
                        )))
                        ->setAttribute('class', 'icon_contact_prefs')->setExtra('translation_domain', 'sidemenu');
        switch($this->container->get('request')->get('_route')) {
            case "_shipping":
                $menu['side_settings_menu.shipping_information']->setCurrent(true);
                break;
        }
        return $menu;
    }
    
    
    public static function getTranslationMessages()
    {
        
        // TODO: Auto-generated method stub
        
        $menuNames = array(
                //top menu
                'top_menu.help',
                'top_menu.logout',
                'top_menu.settings',
                'top_menu.general_settings',
                'top_menu.contact_preferences',
                'top_menu.shipping_information',
                'top_menu.about_me',
                //bottom right menu
                'bottom_right_menu.help',
                'bottom_right_menu.logout',
                'bottom_right_menu.my_settings',
                //bottom left menu
                'bottom_left_menu.home',
                'bottom_left_menu.fullscreen',
                'bottom_left_menu.update'
                );
        
        foreach ($menuNames as $name) {
            $menuMessages[] = new Message($name, "generalmenus");
        }
        
        $menuNames = array(
                //side dasboard menu
                'side_dasboard_menu.dashboard',
                'side_dasboard_menu.survey',
                'side_dasboard_menu.activities',
                'side_dasboard_menu.measurements',
                'side_dasboard_menu.treatment',
                //side_settigs_menu
                'side_settings_menu.general_settings',
                'side_settings_menu.contact_preferences',
                'side_settings_menu.shipping_information',
                'side_settings_menu.about_me'
        );
        
        foreach ($menuNames as $name) {
            $menuMessages[] = new Message($name, "sidemenu");
        }
        
//         $menuNames = array(
//                 'bottom_left_menu.home',
//                 'bottom_left_menu.fullscreen',
//                 'bottom_left_menu.update'
//         );
        
//         foreach ($menuNames as $name) {
//             $menuMessages[] = new Message($name, "generalmenus");
//         }
        return $menuMessages;
    }

}
