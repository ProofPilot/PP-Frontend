<?php
namespace Common;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Incentive;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Intervention;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Status;

class AbstractStudy
{
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function createIncentive(Participant $participant, Intervention $intervention ) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $incentive = new Incentive();
        $incentive->setParticipant($participant);
        $incentive->setIncentiveDatetime(new \DateTime());
        $incentive->setIncentiveAmount($intervention->getInterventionIncentiveAmount());
        $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->find(1);
        $incentive->setIncentiveType($incentiveType);
        $status = $em->getRepository('CyclogramProofPilotBundle:Status')->find(25);
        $incentive->setStatus($status);
        $incentive->setIntervention($intervention);
        $incentive->setInterventionLanguageid($intervention->getLanguage()->getLanguageId());
        $em->persist($incentive);
        $em->flush();
        $participantIncentiveBalance = $participant->getParticipantIncentiveBalance();
        $sum = $intervention->getInterventionIncentiveAmount() + $participantIncentiveBalance;
        $participant->setParticipantIncentiveBalance($sum);
    }

}
