<?php

namespace Cyclogram\FrontendBundle\Controller;

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
     * @Route("/surveyResponce", name="_record_survey")
     */
    public function recordSurveyAction() {
        
        $participant = $this->get('security.context')->getToken()->getUser();
        
        $surveyId = $this->getRequest()->query->get('surveyId');
        $saveId = $this->getRequest()->query->get('saveId');
        $studyUrl = $this->getRequest()->query->get('studyUrl');
        $studyId = $this->getRequest()->query->get('studyId');
        
        $uniqId = uniqid();
        
        $session = $this->getRequest()->getSession();
        
        $bag = new AttributeBag();
        $bag->setName("SurveyInfo");
        $session->registerBag($bag);
        
        $session->getBag("SurveyInfo")->initialize(array());
        $session->getBag("SurveyInfo")->set('surveyId', $surveyId);
        $session->getBag("SurveyInfo")->set('saveId', $saveId);
        
        

        
        
        return $this->redirect(($this->generateUrl("_study", array(
                'studyId'=> $studyId, 
                'studyUrl' => $studyUrl
                ))));

        
    }
}
