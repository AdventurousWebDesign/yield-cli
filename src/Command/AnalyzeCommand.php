<?php

namespace YieldCLI\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalyzeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('analyze')
            ->setDescription('Analyzes today\'s timelog.');
    }//end configure()

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            [
                '',
                '<info>Hello, World</info>',
                '<comment>------------</comment>',
                'We been here for a minute now.',
                'Starting development on the yield-cli program!'
            ]
        );
    }//end execute()
}//end class
