<?php

namespace YieldCLI\Entity;

use YieldCLI\Common\TaskHaverTrait as TaskHaver;

class Day
{
    use TaskHaver;

    /**
     * The day (in DateTime terms) to which the object belongs.
     *
     * @var \DateTime
     */
    private $date;

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
}//end class
