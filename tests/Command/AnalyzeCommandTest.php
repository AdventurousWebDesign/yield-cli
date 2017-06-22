<?php

namespace YieldCLI\tests\Command;

use YieldCLI\Command\AnalyzeCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class AnalyzeCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $application->add(new AnalyzeCommand());

        $command = $application->find('analyze');

        $commandTester = new CommandTester($command);

        $commandTester->execute(['command' => $command->getName()]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();

        $this->assertContains('Hello, World', $output);
    }//end testExecute()
}//end class

