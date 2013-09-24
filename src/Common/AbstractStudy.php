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
