<?php

namespace YieldCLI\Entity;

class Task
{
    /**
     * Task name
     *
     * @var string
     */
    protected $name;

    /**
     * Day to which the task belongs.
     *
     * @var Day
     */
    protected $day;

    /**
     * Length the task lasted for.
     *
     * @var TaskLength
     */
    protected $length;

    /**
     * The associated project
     *
     * @var Project
     */
    protected $project;

    /**
     * Getter for name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }//end getName()

    /**
     * Setter for name
     *
     * @param string $name
     *
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }//end setName()

    /**
     * Getter for Day
     *
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }//end getDay()

    /**
     * Setter for day. Adds this task to the list if it isn't already present.
     *
     * @param Day $day
     *
     * @return Task
     */
    public function setDay(Day $day)
    {
        $this->day = $day;

        if (false === $this->day->hasTask($this)) {
            $this->day->addTask($this);
        }

        return $this;
    }//end setDay()

    /**
     * Getter for length
     *
     * @return TaskLength
     */
    public function getLength()
    {
        return $this->length;
    }//end getLength()

    /**
     * Setter for length
     *
     * @param mixed $length
     * @return Task
     */
    public function setLength($length)
    {
        if ($length instanceof TaskLength) {
            $lengthVal = $length;
        }

        if (true === is_string($length)) {
            $lengthVal = new TaskLength($length);
        }

        $this->length = $lengthVal;

        return $this;
    }//end setLength()
}//end class
