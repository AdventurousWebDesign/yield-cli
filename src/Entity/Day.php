<?php

namespace YieldCLI\Entity;

class Day
{
    /**
     * The day (in DateTime terms) to which the object belongs.
     *
     * @var \DateTime
     */
    private $date;

    /**
     * Array of related tasks.
     *
     * @var Task[]
     */
    private $tasks = [];

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setDate(new \DateTime());
    }//end __construct()

    /**
     * Getter for date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }//end getDate()

    /**
     * Setter for date
     *
     * @param \DateTime $date
     * @return Day
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }//end setDate()

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
        $task->setDay($this);

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
            throw new \Exception('Could not remove that task; it doesn\'t exist on this day.');
        }

        unset($this->tasks[$i]);

        return $this;
    }//end removeTask()
}//end class
