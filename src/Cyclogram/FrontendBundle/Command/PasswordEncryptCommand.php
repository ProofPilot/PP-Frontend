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

class PasswordEncryptCommand extends ContainerAwareCommand
{
    protected function configure(){
    
        $this->setName('run:passwordencrypt')
        ->setDescription('Generate salt and encrypt password for old users');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $participants = $em->getRepository('CyclogramProofPilotBundle:Participant')->findBySalt(null);
        $factory = $this->getContainer()->get('security.encoder_factory');
        foreach ($participants as $participant) {
            $encoder = $factory->getEncoder($participant);
            $salt = hash("sha512", microtime());
            $participant->setSalt($salt);
            $participant->setParticipantPassword($encoder->encodePassword($participant->getParticipantPassword(), $salt));
            $em->persist($participant);
            $em->flush();
        }
    }
}
