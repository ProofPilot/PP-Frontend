<?php

namespace Cyclogram\SexProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GeneralSettingsController  extends Controller
{
    /**
     * @Route("/general_settings/", name="_settings")
     * @Template()
     */
    public function generalSettingsAction()
    {
        return $this->render('CyclogramSexProBundle:GeneralSettings:general_settings.html.twig');
    }
    
    /**
     * @Route("/contact_prefs")
     * @Template()
     */
    public function contactPrefsAction()
    {
        $parameters = array();
        
        $parameters['preferences'] = array(
                array('title' => 'Study Task Reminder Preferences'
                )
        );
        
        return $this->render('CyclogramSexProBundle:GeneralSettings:contact_prefs.html.twig', $parameters);
    }
}
