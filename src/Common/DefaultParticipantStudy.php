<?php
namespace Common;
use Common\StudyInterface;

use Common\AbstractStudy;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\CyclogramCommon;

class DefaultParticipantStudy extends AbstractStudy
{
    public function getArmCodes()
    {
        return array('DefaultParticipantArm');

    }
    public function getInterventionCodes()
    {
        return array('DefaultParticipantEmailConfirm', 'DefaultParticipantCommunicationPreferences',
                'DefaultParticipantShippingInformation');
    }
    public function participantDefaultStudyRegistration($participant)
    {
        $em = $this->container->get('doctrine')->getManager();

        $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')
                ->findOneByArmCode('DefaultParticipantArm');
        $armData = (!is_null($armData)) ? $armData : false;
        
        $ArmParticipantLink = null;
        if ($armData) {
            $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
            $ArmParticipantLink->setArm($armData);
            $ArmParticipantLink->setParticipant($participant);
            $ArmParticipantLink->setStatus(ParticipantArmLink::STATUS_ACTIVE);
            $ArmParticipantLink
            ->setParticipantArmLinkDatetime(new \DateTime("now"));
        }
        $em->persist($ArmParticipantLink);
        
        $em->flush();
        //DefaultParticipantEmailConfirmInterventionLink
        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $intervention = $em
            ->getRepository('CyclogramProofPilotBundle:Intervention')
            ->findOneByInterventionCode('DefaultParticipantEmailConfirm');
        $participantInterventionLink->setIntervention($intervention);
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink
            ->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
        $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
        $em->persist($participantInterventionLink);
        $em->flush();
        //DefaultParticipantCommunicationPreferencesInterventionLink
        $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();
        $intervention = $em
            ->getRepository('CyclogramProofPilotBundle:Intervention')
            ->findOneByInterventionCode('DefaultParticipantCommunicationPreferences');
        $participantInterventionLink->setIntervention($intervention);
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink
            ->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
        $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
        $em->persist($participantInterventionLink);
        $em->flush();
    }
    public function participantDefaultInterventionLogic($participant, $update = null)
    {
        $em = $this->container->get('doctrine')->getManager();
        $shippingInformation = false;
        $shippingInformationintervention = $em
        ->getRepository('CyclogramProofPilotBundle:Intervention')->findOneByInterventionCode('DefaultParticipantShippingInformation');
        $existshippingInformation = $studies = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
            ->checkIfExistParticipantInterventionLink($shippingInformationintervention-> getInterventionCode(), $participant->getParticipantId());
        $studies = $em->getRepository('CyclogramProofPilotBundle:Participant')
        ->getEnrolledStudies($participant);
        foreach ($studies as $st) {
            if ($st->getEmailVerificationRequired())
                $shippingInformation = true;
        }
        if ($shippingInformation == true && $existshippingInformation == false) {
            $participantInterventionLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink();

            $participantInterventionLink->setIntervention($shippingInformationintervention);
            $participantInterventionLink->setParticipant($participant);
            $participantInterventionLink
                ->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
            $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
            $em->persist($participantInterventionLink);
            $em->flush();
        }
        
        $study = $em->getRepository('CyclogramProofPilotBundle:Study')
           ->findOneByStudyCode($this->getStudyCode());
        
        //get all participant intervention links
        $interventionLinks = $em
                ->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
                ->getStudyInterventionLinks($participant, $this->getStudyCode());
        foreach ($interventionLinks as $interventionLink) {
            $interventionCode = $interventionLink->getIntervention()
                ->getInterventionCode();
            $intervention = $interventionLink->getIntervention();
            $status = $interventionLink->getStatus();
            switch ($interventionCode) {
                case "DefaultParticipantEmailConfirm":
                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE && $participant->getParticipantEmailConfirmed() == true) {
                        $this->createIncentive($participant, $intervention);
                        $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                        $em->persist($interventionLink);
                        $em->flush();
                    }
                break;
                case "DefaultParticipantCommunicationPreferences":
                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE && $update == 'communicationPreferences') {
                        $this->createIncentive($participant, $intervention);
                        $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                        $em->persist($interventionLink);
                        $em->flush();
                    }
                    break;
                case "DefaultParticipantShippingInformation":
                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE && $update == 'shippingInformation') {
                        $this->createIncentive($participant, $intervention);
                        $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                        $em->persist($interventionLink);
                        $em->flush();
                    }
                    break;
            }
        }
    }
    public function getStudyCode()
    {
        return 'defaultparticipant';
    }

}
