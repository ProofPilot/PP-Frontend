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
namespace Cyclogram\Bundle\ProofPilotBundle\Repository;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Campaign;

use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantCampaignLink;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Mapping as ORM;

use Cyclogram\CyclogramCommon;


class ParticipantCampaignLinkRepository extends EntityRepository
{
    public function setParticipantCampaignLink($participant, $siteId, $studyCode)
    {
        $em = $this->getEntityManager();
        
        $site = $em->getRepository('CyclogramProofPilotBundle:Site')->find($siteId);
        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($studyCode);
        
        //get campaign site link by site id
        $csl = $em
        ->createQuery('SELECT csl FROM CyclogramProofPilotBundle:CampaignSiteLink csl
                INNER JOIN csl.site s
                INNER JOIN csl.campaign c
                INNER JOIN c.placement p
                WHERE s.siteId = :siteid
                AND p.study = :study
                ')
                ->setParameter('siteid', $siteId)
                ->setParameter('study', $study)
                ->getOneOrNullResult();
        
        if(!$csl) return null;
        
        $campaign = $csl->getCampaign();
        
        $participantLevelRepo = $em->getRepository('CyclogramProofPilotBundle:ParticipantLevel');
        $participantLevel = $participantLevelRepo->findOneByParticipantLevelName('Pre-Launch');
        
        $ParticipantCampaignLinkCountData =  $em->getRepository('CyclogramProofPilotBundle:ParticipantCampaignLink')
        ->findBy( array("participantCampaignLinkParticipantEmail"=>$participant->getParticipantEmail()) );
        
        $ParticipantCampaignLinkCount = ( is_array($ParticipantCampaignLinkCountData) ) ? count($ParticipantCampaignLinkCountData) : 0;
        
        $participantCampaignLinkId = CyclogramCommon::generateParticipantCampaignLinkID(
                $participantLevel->getParticipantLevelId(),
                $participant->getParticipantId(),
                $campaign->getCampaignId(),
                $ParticipantCampaignLinkCount
        );
        
        $uniqId = uniqid();
        $campaignLinkCheck = $em
            ->getRepository('CyclogramProofPilotBundle:Campaign')
            ->checkIfIssetParticipanCampaigLink2($campaign->getCampaignId(), $siteId, $participant);
        $campaignLink = isset($campaignLinkCheck) ? $campaignLinkCheck : new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantCampaignLink();
        $campaignLink->setParticipant( $participant );
        $campaignLink->setCampaign( $campaign );
        $campaignLink->setParticipantLevel( $participantLevel );
        $campaignLink->setParticipantSurveyLinkUniqid( $uniqId );
        $campaignLink->setParticipantCampaignLinkId( $participantCampaignLinkId );
        $campaignLink->setParticipantCampaignLinkParticipantEmail( $participant->getParticipantEmail() );
        $campaignLink->setParticipantCampaignLinkIpAddress( $_SERVER['REMOTE_ADDR'] );
        $campaignLink->setParticipantCampaignLinkDatetime( new \DateTime("now") );
        $campaignSiteLink = $em->getRepository('CyclogramProofPilotBundle:CampaignSiteLink')->findOneBy(array('campaign' => $campaign,'site' => $site));
        $campaignLink->setCampaignSiteLink($campaignSiteLink);
        $campaignLink->setIsParticipantRecruiter(false);
        $campaignLink->setSite( $site );
        
        $em->persist( $campaignLink );
        $em->flush();
        return true;


    }

    
    
}
