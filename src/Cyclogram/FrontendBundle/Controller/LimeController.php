<?php

namespace Cyclogram\FrontendBundle\Controller;

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
        
        $ParticipantSurveyLink = new ParticipantSurveyLink();
        $ParticipantSurveyLink->setParticipant($this->getDoctrine()->getRepository('CyclogramProofPilotBundle:Participant')->find(1));
        $ParticipantSurveyLink->setParticipantSurveyLinkUniqid($uniqId);
        $ParticipantSurveyLink->setSaveId($saveId);
        $ParticipantSurveyLink->setSidId($surveyId);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($ParticipantSurveyLink);
        $em->flush();
        
        return $this->redirect(($this->generateUrl("_study", array('studyId'=> $studyId, 'studyUrl' => $studyUrl))));

        
    }
}
