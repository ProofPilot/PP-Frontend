<?php
namespace Cyclogram\FrontendBundle\Service;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Study;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\CyclogramCommon;

class KAHStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes() {
        return array('eStamp3');
    }
    
    public function getInterventionCodes() {
        return array();
    }
    
    public function studyRegistration($participant, $surveyId, $saveId) {
        $em = $this->container->get('doctrine')->getEntityManager();
        //Add participants to Default Arm at the moment.
        $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('eStamp3');
        $armData = ( ! is_null( $armData )  ) ? $armData : false;
        
        $armStatus = $em->getRepository('CyclogramProofPilotBundle:Status')->find( 1 );
        $armStatus = ( ! is_null( $armStatus ) ) ? $armStatus : false;
        
        $ArmParticipantLink = null;
        if( $armData ){
            $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
            $ArmParticipantLink->setArm($armData);
            $ArmParticipantLink->setParticipant($participant);
            $ArmParticipantLink->setStatus($armStatus);
            $ArmParticipantLink->setParticipantArmLinkDatetime( new \DateTime("now") );
        }
        $em->persist($ArmParticipantLink);
        
        $em->flush();
    }
    
    public function interventionLogic($participant) {
        return false;
    }
    
    public function checkEligibility($surveyResult) {
        // TODO: Auto-generated method stub

    }

}
