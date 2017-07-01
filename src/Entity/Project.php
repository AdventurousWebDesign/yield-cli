<?php

namespace YieldCLI\Entity;

use YieldCLI\Common\TaskHaverTrait as TaskHaver;

class Project
{
    use TaskHaver;

    protected $name;

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
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }//end setName()
}//end class
