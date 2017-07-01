<?php

namespace YieldCLI\tests\Entity;

use YieldCLI\Entity\Task;
use YieldCLI\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProjectTest extends KernelTestCase
{
    /**
     * Tests the basic getter and setter methods.
     *
     * @return void
     */
    public function testBasicGetSet()
    {
        $p = new Project();

        $p->setName('Bees');

        $this->assertEquals('Bees', $p->getName());
    }//end testBasicGetSet()

    /**
     * Tests that a Task entity can be added properly.
     *
     * @return void
     */
    public function testTaskAssociation()
    {
        $proj  = new Project();
        $task1 = new Task();
        $task2 = new Task();

        $proj->addTask($task1);

        // Add a single task, and check
        $this->assertInternalType('array', $proj->getTasks());
        $this->assertContainsOnly($task1, $proj->getTasks());

        // Add another task
        $proj->addTask($task2);
        $this->assertContainsOnlyInstancesOf(Task::class, $proj->getTasks());

        // Remove a task.
        $proj->removeTask($task1);
        $this->assertContainsOnly($task1, $proj->getTasks());

        // Verify we have who we say we have.
        $this->assertTrue($proj->hasTask($task2));
        $this->assertFalse($proj->hasTask($task1));
    }//end testTaskGettersAndSetters()

    /**
     * Tests exception throwing for removing tasks that aren't really on the Project.
     *
     * @expectedException        Exception
     * @expectedExceptionMessage Could not remove that task; it doesn't exist on this project.
     *
     * @return void
     */
    public function testRemoveTaskThatWasntAdded()
    {
        $proj = new Project();
        $task = new Task();

        $proj->removeTask($task);
    }//end testRemoveTaskThatWasntAdded()
}//end class
