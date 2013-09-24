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
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;


class ExtractTranslationsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('gentrans')
            ->setDescription('Extract translations to XLIFF.')
            ->addArgument('domain', InputArgument::OPTIONAL, 'Explicit translation domain', 'all')
        ;
    }

    /**
    * @param InputInterface $input
    * @param OutputInterface $output
    * @throws \LogicException
    */
    protected function execute(InputInterface $input, OutputInterface $output) 
    {
        $command = $this->getApplication()->find('translation:extract');
        
        $arguments = array(
                'command' => 'translation:extract',
                '--config' => 'app',
                '--default-output-format' => 'yml'
        );
        
        if ($input->getArgument('domain') != 'all') {
            $arguments['--domain'] = array($input->getArgument('domain'));
        }
        
        $internalInput = new ArrayInput($arguments);
        $returnCode = $command->run($internalInput, $output);
    }

}
