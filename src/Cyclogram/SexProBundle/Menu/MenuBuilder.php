<?php
namespace Cyclogram\SexProBundle\Menu;
use Symfony\Component\Security\Core\SecurityContext;

// use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;

use Knp\Menu\FactoryInterface;


class MenuBuilder extends ContainerAware
{

    public function createTopMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'header_menu');
        
        $menu->addChild('Help', array('route' => '_page'))->setAttribute('class', 'icon_help');
        $menu->addChild('Logout', array('route' => '_logout'))->setAttribute('class', 'icon_logout normal');
        $menu->addChild('My Settings', array('route' => '_settings'))->setAttribute('class', 'icon_settings');

        return $menu;
    }

    public function createSideDashboardMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'left_menu');
        
        $menu->addChild('Dashboard', array('route' => '_main'))->setAttribute('class', 'icon_dashboard active');
        $menu->addChild('Survey', array('route' => '_survey'))->setAttribute('class', 'icon_survey');
        $menu->addChild('Activities', array('route' => '_study'))->setAttribute('class', 'icon_activities');
        $menu->addChild('Measurements', array('route' => '_secure'))->setAttribute('class', 'icon_measurments');
        $menu->addChild('Treatment', array('route' => '_newslatter'))->setAttribute('class', 'icon_treatment');

        return $menu;
    }

    public function createBottomRightMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->addChild('Help', array('route' => '_page'))->setAttribute('class', 'icon_help');
        $menu->addChild('Logout', array('route' => '_logout'))->setAttribute('class', 'icon_logout normal');
        $menu->addChild('My Settings', array('route' => '_settings'))->setAttribute('class', 'icon_settings');

        return $menu;
    }
    
    public function createBottomLeftMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
    
        $menu->addChild('Home', array('route' => '_main'))->setAttribute('class', 'icon_home');
        $menu->addChild('Fullscreen', array('route' => '_main'))->setAttribute('class', 'icon_fullscreen');
        $menu->addChild('Update', array('route' => '_main'))->setAttribute('class', 'icon_update');
    
        return $menu;
    }

}
