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
namespace Cyclogram\FrontendBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateParticipantAboutDataCommand extends ContainerAwareCommand
{
    protected function configure(){
    
        $this->setName('run:aboutdataupdate')
        ->setDescription('Generate json from participant about data');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')->findByParticipantAboutMe(null);
        foreach ($participants as $participant) {
            $jsonData = array();
            $sex = $participant->getSex()->getSexId();
            if(isset($sex))
                $jsonData['SEX'] = $sex;
            else 
                $jsonData['SEX'] = null;
            $races = $em->getRepository('CyclogramProofPilotBundle:ParticipantRaceLink')->findByParticipant($participant);
            if (!empty($races)) {
                foreach ($races as $race) 
                    $jsonData['RACE'][] = $race->getRace()->getRaceId();
            } else {
                $jsonData['RACE'] = null;
            }
            $gradeLevel = $participant->getGradeLevel()->getGradeLevelId();
            if(isset($gradeLevel)) 
                $jsonData['GRADELEVEL'] =  $participant->getGradeLevel()->getGradeLevelId();
            else 
                $jsonData['GRADELEVEL'] = null;
            $sexwith = $participant->getGradeLevel()->getGradeLevelId();
            if ($sexwith == 'm')
                $jsonData['SEXWITH'] = 1;
            if ($sexwith == 'w')
                $jsonData['SEXWITH'] = 2;
            if ($sexwith == 'mw'){
                $jsonData['SEXWITH'][] = 1;
                $jsonData['SEXWITH'][] = 2;
            }
            $indusrty = $participant->getIndustry()->getIndustryId();
            if(isset($industry))
                $jsonData['INDUSTRY'] = $industry;
            else 
                $jsonData['INDUSTRY'] = null;
            $maritalStatus = $participant->getMaritalStatus()->getMaritalStatusId();
            if(isset($maritalStatus))
                $jsonData['MARITALSTATUS'] = $maritalStatus;
            else 
                $jsonData['MARITALSTATUS'] = null;
            $children = $participant->getChildren();
            if($children == 0)
                $jsonData['CHILDREN'] = 'N';
            if($children == 1)
                $jsonData['CHILDREN'] = 'Y';
            $jsonData['AGE'] = $participant->getAge();
            $jsonData['INCOME'] = $participant->getAnnualIncome();
            $zipCode = $participant->getParticipantZipcode();
            if(empty($zipCode))
                $jsonData['ZIPCODE'] = null;
            else
                $jsonData['ZIPCODE'] = $participant->getParticipantZipcode();

            $jsonData['PHONE'] = $participant->getParticipantMobileNumber();
            $jsonData['MAILING_ADDRESS'] = $participant->getParticipantAddress1();
            $participant->setParticipantAboutMe(json_encode($jsonData));
            $em->persist($participant);
            $em->flush();
        }
    }
}