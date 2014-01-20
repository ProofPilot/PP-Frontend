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

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

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
    
    public function createIncentive(Participant $participant, Intervention $intervention, $incentiveTypeName = 'None') {
        $em = $this->container->get('doctrine')->getManager();
        $incentiveType = $em->getRepository('CyclogramProofPilotBundle:IncentiveType')->findOneByIncentiveTypeName($incentiveTypeName);
        $incentive = new Incentive();
        $incentive->setParticipant($participant);
        $incentive->setIncentiveDatetime(new \DateTime());
        $incentive->setIncentiveAmount($intervention->getInterventionIncentiveAmount());
        $incentive->setIncentiveType($incentiveType);
        $incentive->setStatus(Incentive::STATUS_PENDING_APPROVAL);
        $incentive->setIntervention($intervention);
        $incentive->setInterventionLanguageid($intervention->getLanguage()->getLanguageId());
        $em->persist($incentive);
        $em->flush();
        $participantIncentiveBalance = $participant->getParticipantIncentiveBalance();
        $sum = $intervention->getInterventionIncentiveAmount() + $participantIncentiveBalance;
        $participant->setParticipantIncentiveBalance($sum);
        $em->persist($participant);
        $em->flush();
    }
   
    public function setInterventionLinkExpiration(Intervention $intervention, ParticipantInterventionLink $interventionLink) {
        $interventionExpiredDate = $intervention->getInterventionExpirationDate();
        $interventionExpiredPeriod = $intervention->getInterventionExpirationPeriod();
        if (isset($interventionExpiredDate)) {
            $interventionLink->setParticipantInterventionLinkExpiarationDate($interventionExpiredDate);
        } elseif (isset($interventionExpiredPeriod)) {
            $date = new \DateTime("now");
            $date->add(new \DateInterval('P'.$interventionExpiredPeriod.'D'));
            $interventionLink->setParticipantInterventionLinkExpiarationDate($date);
        }
    }
}
