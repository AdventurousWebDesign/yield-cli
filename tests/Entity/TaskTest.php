<?php

namespace YieldCLI\tests\Command;

use YieldCLI\Entity\Day;
use YieldCLI\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskTest extends KernelTestCase
{
    /**
     * Tests the ability to use the getters and setters of the entity forthrightly.
     *
     * @return void
     */
    public function testGettersAndSetters()
    {
        $task = new Task();

        $task->setName('Do laundry!');

        $this->assertEquals('Do laundry!', $task->getName());

        $day = new Day();

        $this->assertNull($task->getDay());

        $task->setDay($day);

        $this->assertEquals($day, $task->getDay());
        $this->assertEquals($day->getTasks()[0], $task);
    }//end testGettersAndSetters()
}//end class

