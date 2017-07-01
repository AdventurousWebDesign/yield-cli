<?php

namespace YieldCLI\tests\Entity;

use YieldCLI\Entity\Day;
use YieldCLI\Entity\Task;
use YieldCLI\Entity\TaskLength;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskTest extends KernelTestCase
{
    /**
     * Tests the ability to use the straightforward getters and setters of the
     * entity easily..
     *
     * @return void
     */
    public function testGettersAndSetters()
    {
        $task = new Task();

        $task->setName('Do laundry!');

        $this->assertEquals('Do laundry!', $task->getName());
    }

    /**
     * Tests that a day and task can associate dependably.
     *
     * @return void
     */
    public function testBiDirectionalDayHaving()
    {
        $task = new Task();
        $day  = new Day();

        $this->assertNull($task->getDay());

        $task->setDay($day);

        $this->assertEquals($day, $task->getDay());
        $this->assertEquals($day->getTasks()[0], $task);
    }//end testBiDirectionalDayHaving()

    public function testLengthSetting()
    {
        $task   = new Task();

        $task->setLength('1h5m');

        $this->assertEquals(1, $task->getLength()->getHours());
        $this->assertEquals(5, $task->getLength()->getMinutes());

        $length = new TaskLength('2h30m');

        $task->setLength($length);

        $this->assertEquals(2, $task->getLength()->getHours());
        $this->assertEquals(30, $task->getLength()->getMinutes());
    }//end testLengthSetting()
}//end class

