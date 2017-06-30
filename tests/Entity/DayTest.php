<?php

namespace YieldCLI\tests\Command;

use YieldCLI\Entity\Day;
use YieldCLI\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DayTest extends KernelTestCase
{
    /**
     * Tests the ability to use the getters and setters of the entity forthrightly.
     *
     * @return void
     */
    public function testGettersAndSetters()
    {
        $day = new Day();

        // Show that we serve a default date, at least.
        $this->assertInstanceOf(\DateTime::class, $day->getDate());

        $tomorrow = new \DateTime('+1 day');

        $day->setDate($tomorrow);

        $this->assertEquals($tomorrow, $day->getDate());
    }//end testGettersAndSetters()

    /**
     * Tests that a Task entity can be added properly.
     *
     * @return void
     */
    public function testTaskGettersAndSetters()
    {
        $day   = new Day();
        $task1 = new Task();
        $task2 = new Task();

        $day->addTask($task1);

        // Add a single task, and check
        $this->assertInternalType('array', $day->getTasks());
        $this->assertContainsOnly($task1, $day->getTasks());

        // Add another task
        $day->addTask($task2);
        $this->assertContainsOnlyInstancesOf(Task::class, $day->getTasks());

        // Remove a task.
        $day->removeTask($task1);
        $this->assertContainsOnly($task1, $day->getTasks());

        // Verify we have who we say we have.
        $this->assertTrue($day->hasTask($task2));
        $this->assertFalse($day->hasTask($task1));
    }//end testTaskGettersAndSetters()

    /**
     * Tests exception throwing for adding tasks that aren't really on the Day.
     *
     * @expectedException        Exception
     * @expectedExceptionMessage Could not remove that task; it doesn't exist on this day.
     *
     * @return void
     */
    public function testRemoveTaskThatWasntAdded()
    {
        $day  = new Day();
        $task = new Task();

        $day->removeTask($task);
    }//end testRemoveTaskThatWasntAdded()
}//end class

