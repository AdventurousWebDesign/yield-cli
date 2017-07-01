<?php

namespace YieldCLI\Common;

use YieldCLI\Entity\Task;

trait TaskHaverTrait
{
    /**
     * Array of related tasks.
     *
     * @var Task[]
     */
    private $tasks = [];

    /**
     * Gets the tasks stored on this day.
     *
     * @return Task[]
     */
    public function getTasks()
    {
        return $this->tasks;
    }//end getTasks()

    /**
     * Adds a task to the stack.
     *
     * @param Task $task The task to add.
     *
     * @return Day
     */
    public function addTask(Task $task)
    {
        $this->tasks[] = $task;

        $relationshipMethod = 'set'.$this->getEntityName();
        // setDay, setProject ... whoever's using the trait, right?

        if (true === method_exists($task, $relationshipMethod)) {
            $task->$relationshipMethod($this);
        }

        return $this;
    }//end addTask()

    /**
     * Checks if a task can be added.
     *
     * @return bool
     */
    public function hasTask(Task $task)
    {
        // Strict checking enabled. (Third param).
        return false !== array_search($task, $this->tasks, true);
    }//end hasTask()

    /**
     * If a task can be located on the parent object, remove it.
     *
     * @param Task $task The task to remove.
     *
     * @throws Exception when asked to remove a task that isn't present.
     *
     * @return Day
     */
    public function removeTask(Task $task)
    {
        $i = array_search($task, $this->tasks);

        if (false === $i) {
            throw new \Exception('Could not remove that task; it doesn\'t exist on this '.strtolower($this->getEntityName()).'.');
        }

        unset($this->tasks[$i]);

        return $this;
    }//end removeTask()

    /**
     * Negating the namespace, find the class name.
     *
     * @return string
     */
    public function getEntityName()
    {
        preg_match('/\\\(\w+)$/', self::class, $matches);
        return array_pop($matches);
    }//end getEntityName()
}//end trait
