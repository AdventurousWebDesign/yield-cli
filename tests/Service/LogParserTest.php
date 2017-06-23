<?php

namespace YieldCLI\tests\Command;

use YieldCLI\Service\LogParser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LogParserTest extends KernelTestCase
{
    /**
     * The Parser, instantiated.
     *
     * @var LogParser
     */
    public $logParser;

    public function setUp()
    {
        $logDir = __DIR__.'/../../build';

        $this->logParser = new LogParser(compact('logDir'));
    }

    /**
     * Tests read with the wrong type or param.
     *
     * @expectedException \Exception
     */
    public function testReadWithBadParams()
    {
        $this->logParser->read([]);
    }//end testExecute()

    /**
     * Give a date, but without a corresponding file to read.
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage Could not locate log file.
     */
    public function testReadWithDateButNoLogFile()
    {
        $this->logParser->read('1972-01-12');
    }//end testConstruct()
}//end class

