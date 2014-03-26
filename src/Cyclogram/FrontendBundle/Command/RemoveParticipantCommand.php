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

use Cyclogram\CyclogramCommon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveParticipantCommand extends ContainerAwareCommand
{
    protected function configure(){
    
        $this->setName('remove:participant')
        ->setDescription('Remove participant')
        ->addArgument('participantEmail', InputArgument::OPTIONAL,'Input participant email address');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $participantEmail = $input->getArgument('participantEmail');
        $participant = $em->getRepository('CyclogramProofPilotBundle:Participant')->findOneByParticipantEmail($participantEmail);
        $em->getRepository('CyclogramProofPilotBundle:Participant')->deleteParticipant($participant->getParticipantId());
        $output->writeln("Particpant deleted! ");
    }
}
