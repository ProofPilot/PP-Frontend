<?php
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
                '--config' => 'app'
        );
        
        if ($input->getArgument('domain') != 'all') {
            $arguments['--domain'] = array($input->getArgument('domain'));
        }
        
        $internalInput = new ArrayInput($arguments);
        $returnCode = $command->run($internalInput, $output);
    }

}
