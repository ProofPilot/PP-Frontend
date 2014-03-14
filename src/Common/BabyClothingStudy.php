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
use Cyclogram\Bundle\ProofPilotBundle\Entity\Study;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantSurveyLink;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantInterventionLink;
use Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink;

use Symfony\Component\DependencyInjection\Container;
use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;
use Cyclogram\CyclogramCommon;

class BabyClothingStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes()
    {
        return array('BasicBabyClothing');
    }
    public function getInterventionCodes()
    {
        return array('howdoyoushopforbabyclothing');
    }
    public function studyRegistration($participant, $surveyId, $saveId,
            $campaignLink)
    {
        $em = $this->container->get('doctrine')->getManager();
        $participantSurveyLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
        ->findOneBy(array('saveId'=>$saveId, 'sidId'=>$surveyId));
        if (isset($participantSurveyLink)) {
            $participantSurveyLink->setStatus(ParticipantSurveyLink::STATUS_CLOSED);
            $em->persist($participantSurveyLink);
            
            //create eligibility intervention
            $intervention = $this->findIntervention('howdoyoushopforbabyclothing', $participant->getParticipantLanguage());
            $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')
            ->addParticipantInterventionLink($participant, $intervention);
            $newInterventionLink = $em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionLink')->findOneBy(array('intervention' => $intervention, 'participant' =>$participant));
            $newInterventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
            $em->persist($newInterventionLink);
            $em->flush();
            //endif
            
            $ArmParticipantLink = null;
            $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneByArmCode('BasicBabyClothing');
            if ($armData) {
                $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
                $ArmParticipantLink->setArm($armData);
                $ArmParticipantLink->setParticipant($participant);
                $ArmParticipantLink->setStatus(ParticipantArmLink::STATUS_ACTIVE);
                $ArmParticipantLink->setParticipantArmLinkDatetime(new \DateTime("now"));
            }
            $em->persist($ArmParticipantLink);
            $em->flush();
        }
    }
    public function interventionLogic($participant)
    {
        $em = $this->container->get('doctrine')->getManager();
        $participantArm = $em->getRepository('CyclogramProofPilotBundle:ParticipantArmLink')->getStudyArm($participant, $this->getStudyCode());
        if (isset($participantArm))
            $participantArmName = $participantArm->getArm()->getArmCode();
            //get all participant intervention links
            $interventionLinks = $em
            ->getRepository(
                    'CyclogramProofPilotBundle:ParticipantInterventionLink')
                    ->getStudyInterventionLinks($participant, $this->getStudyCode());
            foreach ($interventionLinks as $interventionLink) {
                $interventionCode = $interventionLink->getIntervention()->getInterventionCode();
                $intervention = $interventionLink->getIntervention();
                $status = $interventionLink->getStatus();
                switch ($interventionCode) {
                    case 'howdoyoushopforbabyclothing' :
                        $surveyId = $intervention->getSidId();
                        if (!$interventionLink->getPromoCodeUsed()) {
                            $psl = $em
                            ->getRepository(
                                    'CyclogramProofPilotBundle:ParticipantSurveyLink')->
                                    findOneBy(array('participant' => $participant, 'sidId' => $surveyId));
                            $sql = "select * from lime_survey_187572 where id = '" . $psl->getSaveId() . "'";
                            $lime_manager = $this->container->get('doctrine')->getManager('limesurvey');
                            $stmt = $lime_manager->getConnection()->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            $result = $result[0];
                            if($result['187572X778X8860'] == "Y"){
                                $this->updatePromoCode($participant, $interventionLink);
                            }
                        }
                        break;
                }
        }    
        return true;
    }
    
    public function checkSurveyEligibility($surveyResult)
    {
        $isEligible = true;
        $reason = array();

        if (isset($surveyResult['187572X763X7975'])
                && $surveyResult['187572X763X7975'] != 'A2') {
            $isEligible = false;
            $reason[] = "Not a woman";
        }
        
        if (isset($surveyResult['187572X763X7976'])
                && intval($surveyResult['187572X763X7976']) < 1964) {
            $isEligible = false;
            $reason[] = "Did not pass age criterea";
        }

        if (isset($surveyResult['187572X763X7978'])
                &&  in_array($surveyResult['187572X763X7978'], array('A1','A5'))) {
            $isEligible = false;
            $reason[] = "No children";
        }
        
        $not_eligible_array = array('A1','A2','A3');
        if (isset($surveyResult['187572X763X7979SQ004']) && in_array($surveyResult['187572X763X7979SQ004'], $not_eligible_array)) {
            $isEligible = false;
            $reason[] = "Unappropriate children age range";
        }
        
        if (isset($surveyResult['187572x763x7984'])
                && ($surveyResult['187572x763x7984'] == 'A1' || $surveyResult['187572x763x7984'] == 'A2')) {
            $isEligible = false;
            $reason[] = "Insufficient income";
        }

        return $isEligible;
    }
    
    public function checkEligibility($studyCode, $participant) {
        return true;
    }
    public static function getStudyCode()
    {
        return 'babyclothing';
    }
    public function commandInterventionLogic()
    {
        return;

    }

}
