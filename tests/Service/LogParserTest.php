<?php

namespace YieldCLI\tests\Command;

use YieldCLI\Service\LogParser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LogParserTest extends KernelTestCase
{
    const DDAY = '1944-06-06';

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

        copy(__DIR__.'/../fixtures/'.self::DDAY.'.log', __DIR__.'/../../build/'.self::DDAY.'.log');
    }//end setUp()

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

    /**
     * Reads a *valid* log file.
     */
    public function testReadWithDate()
    {
        $this->logParser->read(self::DDAY);
    }//end testReadWithDate()

    /**
     * Be sure that an alternatively instantiated class operates independently.
     */
    public function testAlternativeInstantiation()
    {
        $altParser = new LogParser(['logDir' => 'foo']);

        $this->assertEquals('foo', $altParser->logDir);
    }//end testAlternativeInstantiation()

    /**
     * Test reading an unreadable log file.
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage Could not read the log file
     */
    public function testUnreadableLog()
    {
        $day = date('Y-m-d');

        copy(__DIR__.'/../fixtures/unreadable.log', __DIR__.'/../../build/'.$day.'.log');
        chmod(__DIR__.'/../../build/'.$day.'.log', '222');

        $this->logParser->read($day);
    }//end testUnreadableLog()
}//end class

