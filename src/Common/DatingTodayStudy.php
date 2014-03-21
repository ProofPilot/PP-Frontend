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

class DatingTodayStudy extends AbstractStudy implements StudyInterface
{
    public function getArmCodes()
    {
        return array('BAsELINEONCE');
    }
    public function getInterventionCodes()
    {
        return array('REFER');
    }
    public function studyRegistration($participant, $surveyId, $saveId,
            $campaignLink)
    {
        $em = $this->container->get('doctrine')->getManager();
        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode($this->getStudyCode());
        $ArmParticipantLink = null;
        $armData = $em->getRepository('CyclogramProofPilotBundle:Arm')->findOneBy(array('armCode' => 'BAsELINEONCE', 'study' => $study));
        if ($armData) {
            $ArmParticipantLink = new \Cyclogram\Bundle\ProofPilotBundle\Entity\ParticipantArmLink();
            $ArmParticipantLink->setArm($armData);
            $ArmParticipantLink->setParticipant($participant);
            $ArmParticipantLink->setStatus(ParticipantArmLink::STATUS_ACTIVE);
           $ArmParticipantLink->setParticipantArmLinkDatetime(new \DateTime("now"));
        }
        $em->persist($ArmParticipantLink);
        $em->flush();

        $participantInterventionLink = new ParticipantInterventionLink();
        $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneBy(array('interventionCode' => 'BaseFull', 'study' => $study));

        $participantInterventionLink->setIntervention($intervention);
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
        $this->setInterventionLinkExpiration($intervention, $participantInterventionLink);
        if ($em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionlink')->checkIfIntervetionExpire($intervention))
           $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_EXPIRED);
        else
           $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
        $em->persist($participantInterventionLink);
        $em->flush();
        
        
        $participantInterventionLink = new ParticipantInterventionLink();
        $intervention = $em->getRepository('CyclogramProofPilotBundle:Intervention')->findOneBy(array('interventionCode' => 'REFER', 'study' => $study));
        
        $participantInterventionLink->setIntervention($intervention);
        $participantInterventionLink->setParticipant($participant);
        $participantInterventionLink->setParticipantInterventionLinkDatetimeStart(new \DateTime("now"));
        $this->setInterventionLinkExpiration($intervention, $participantInterventionLink);
        if ($em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionlink')->checkIfIntervetionExpire($intervention))
            $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_EXPIRED);
        else
            $participantInterventionLink->setStatus(ParticipantInterventionLink::STATUS_ACTIVE);
        $em->persist($participantInterventionLink);
        $em->flush();
//         $this->sendNotification($participantInterventionLink, $this->getStudyCode(), $participant);
        
        $this->setRefferal($participant, 'REFER');
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
                                case 'BaseFull' :
                                    $surveyId = $intervention->getSidId();
                                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                                        if ($em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionlink')->checkIfIntervetionExpire($intervention)) {
                                            $interventionLink->setStatus(ParticipantInterventionLink::STATUS_EXPIRED);
                                            $status == ParticipantInterventionLink::STATUS_EXPIRED;
                                            break;
                                        }
                                        $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                        ->checkIfSurveyPassed($participant, $surveyId);
                                        if ($passed) {
                                            $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                                            $em->persist($interventionLink);
                                            $em->flush();
                                            $status == ParticipantInterventionLink::STATUS_CLOSED;
                                        }
                                    }
                                    if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                        $this->createIncentive($participant, $intervention);
                                        $this->updatePromoCode($participant, $interventionLink);
                                    }
                                    break;
                                case 'REFER' :
                                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE) 
                                        break;
                                    if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                        $this->createIncentive($participant, $intervention);
                                        $this->updatePromoCode($participant, $interventionLink);
                                    }
                                break;
                                case 'REFER2' :
                                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE)
                                        break;
                                    if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                        $this->createIncentive($participant, $intervention);
                                        $this->updatePromoCode($participant, $interventionLink);
                                    }
                                    break;
                                case 'WEEK1' :
                                    $surveyId = $intervention->getSidId();
                                    if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                                        if ($em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionlink')->checkIfIntervetionExpire($intervention)) {
                                            $interventionLink->setStatus(ParticipantInterventionLink::STATUS_EXPIRED);
                                            $status == ParticipantInterventionLink::STATUS_EXPIRED;
                                            break;
                                        }
                                        $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                        ->checkIfSurveyPassed($participant, $surveyId);
                                        if ($passed) {
                                            $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                                            $em->persist($interventionLink);
                                            $em->flush();
                                            $status == ParticipantInterventionLink::STATUS_CLOSED;
                                        }
                                    }
                                    if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                        $this->createIncentive($participant, $intervention);
                                        $this->updatePromoCode($participant, $interventionLink);
                                    }
                                    break;
                                    case 'WEEK2' :
                                        $surveyId = $intervention->getSidId();
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                                            if ($em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionlink')->checkIfIntervetionExpire($intervention)) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_EXPIRED);
                                                $status == ParticipantInterventionLink::STATUS_EXPIRED;
                                                break;
                                            }
                                            $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                            ->checkIfSurveyPassed($participant, $surveyId);
                                            if ($passed) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                                                $em->persist($interventionLink);
                                                $em->flush();
                                                $status == ParticipantInterventionLink::STATUS_CLOSED;
                                            }
                                        }
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                        break;
                                    case 'WEEK3' :
                                        $surveyId = $intervention->getSidId();
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                                            if ($em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionlink')->checkIfIntervetionExpire($intervention)) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_EXPIRED);
                                                $status == ParticipantInterventionLink::STATUS_EXPIRED;
                                                break;
                                            }
                                            $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                            ->checkIfSurveyPassed($participant, $surveyId);
                                            if ($passed) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                                                $em->persist($interventionLink);
                                                $em->flush();
                                                $status == ParticipantInterventionLink::STATUS_CLOSED;
                                            }
                                        }
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                        break;
                                    case 'WEEK4' :
                                        $surveyId = $intervention->getSidId();
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                                            if ($em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionlink')->checkIfIntervetionExpire($intervention)) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_EXPIRED);
                                                $status == ParticipantInterventionLink::STATUS_EXPIRED;
                                                break;
                                            }
                                            $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                            ->checkIfSurveyPassed($participant, $surveyId);
                                            if ($passed) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                                                $em->persist($interventionLink);
                                                $em->flush();
                                                $status == ParticipantInterventionLink::STATUS_CLOSED;
                                            }
                                        }
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                        break;
                                    case 'WEEK5' :
                                        $surveyId = $intervention->getSidId();
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                                            if ($em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionlink')->checkIfIntervetionExpire($intervention)) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_EXPIRED);
                                                $status == ParticipantInterventionLink::STATUS_EXPIRED;
                                                break;
                                            }
                                            $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                            ->checkIfSurveyPassed($participant, $surveyId);
                                            if ($passed) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                                                $em->persist($interventionLink);
                                                $em->flush();
                                                $status == ParticipantInterventionLink::STATUS_CLOSED;
                                            }
                                        }
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                        break;
                                    case 'WEEK6' :
                                        $surveyId = $intervention->getSidId();
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE) {
                                            if ($em->getRepository('CyclogramProofPilotBundle:ParticipantInterventionlink')->checkIfIntervetionExpire($intervention)) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_EXPIRED);
                                                $status == ParticipantInterventionLink::STATUS_EXPIRED;
                                                break;
                                            }
                                            $passed = $em->getRepository('CyclogramProofPilotBundle:ParticipantSurveyLink')
                                            ->checkIfSurveyPassed($participant, $surveyId);
                                            if ($passed) {
                                                $interventionLink->setStatus(ParticipantInterventionLink::STATUS_CLOSED);
                                                $em->persist($interventionLink);
                                                $em->flush();
                                                $status == ParticipantInterventionLink::STATUS_CLOSED;
                                            }
                                        }
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                    break;
                                    case 'HUFF1' :
                                         if ($status == ParticipantInterventionLink::STATUS_ACTIVE) 
                                            break;
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                    break;
                                    case 'HUFF2' :
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE)
                                            break;
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                    break;
                                    case 'HUFF3' :
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE)
                                            break;
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                    break;
                                    case 'HUFF4' :
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE)
                                            break;
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                    break;
                                    case 'HUFF5' :
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE)
                                            break;
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                    break;
                                    case 'HUFF6' :
                                        if ($status == ParticipantInterventionLink::STATUS_ACTIVE)
                                            break;
                                        if ($status == ParticipantInterventionLink::STATUS_CLOSED) {
                                            $this->createIncentive($participant, $intervention);
                                            $this->updatePromoCode($participant, $interventionLink);
                                        }
                                    break;
                            }
                    }
        return true;
    }

    public function checkSurveyEligibility($surveyResult)
    {
        return true;
    }

    public function checkEligibility($studyCode, $participant) {
        $em = $this->container->get('doctrine')->getManager();
        $study = $em->getRepository('CyclogramProofPilotBundle:Study')->findOneByStudyCode('datingtoday');
        $studyCriteria = $em->getRepository('CyclogramProofPilotBundle:StudyCriteria')->findOneByStudy($study);
        $eligibilityData = get_object_vars(json_decode(stream_get_contents($studyCriteria->getStudyCriteriaJson())));
        $eligibilityData = array_map(null, $eligibilityData);
        
        $marital = $participant->getMaritalStatus();
        if(!isset($marital))
            return false;
        $maritalId = $marital->getMaritalStatusId();
        $age = $participant->getAge();
        if(!isset($age))
            return false;
        $m = $eligibilityData['MARITALSTATUS'];
        if(!in_array($maritalId, $eligibilityData['MARITALSTATUS'])) {
             return false;
        }
        if($age <= 18 || $age >= 75) {
             return false;
        }
        
        return true;
    }
    public static function getStudyCode()
    {
        return 'datingtoday';
    }
    public function commandInterventionLogic()
    {
        $this->addInterventionsbByPeriod($this->getStudyCode());
    }

}
