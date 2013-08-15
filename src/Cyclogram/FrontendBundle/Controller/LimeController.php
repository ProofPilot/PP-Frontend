<?php

namespace Cyclogram\FrontendBundle\Controller;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityManager;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LimeController extends Controller
{
    /**
     * @Route("/surveyResponse", name="_record_survey")
     */
    public function recordSurveyAction() {
        
        $loggedUser = $this->get('security.context')->getToken()->getUser();
        
        $surveyId = $this->getRequest()->query->get('surveyId');
        $saveId = $this->getRequest()->query->get('saveId');
        
        //If logged in save result immediately
        if(($loggedUser instanceof Participant) && ($this->get('security.context')->isGranted("ROLE_PARTICIPANT"))) {
            $this->get('fpp_ls')->participantSurveyLinkRegistration($surveyId, $saveId, $participant, uniqid());
        }
        $redirectUrl = $this->getRequest()->query->get('redirectUrl');

        $session = $this->getRequest()->getSession();
        $bag = new AttributeBag();
        $bag->setName("SurveyInfo");
        $array = array();
        $bag->initialize($array);
        $bag->set('surveyId', $surveyId);
        $bag->set('saveId', $saveId);
        $session->registerBag($bag);
        $session->set('SurveyInfo', $bag);
        
        
        return $this->redirect($redirectUrl);
        

        
    }
}
