<?php

namespace YieldCLI\Entity;

class TaskLength
{
    /**
     * Matches like this
     * 1h22m
     *  1. 1h   # hours
     *  1. 22m  # minutes
     *
     * 12m
     *  1. null # hours
     *  3. 12m  # minutes
     */
    const LENGTH_REGEX  = '/^(\d+\.?\d*h)?(\d+m)?$/';

    const HOURS_INDEX   = 1;

    const MINUTES_INDEX = 2;

    /**
     * The number of minutes corresponding to the task.
     *
     * @var integer
     */
    protected $minutes = 0;

    /**
     * The number of hours corresponding to the task.
     *
     * @var integer
     */
    protected $hours = 0;

    /**
     * Constructor
     *
     * @return TaskLength
     */
    public function __construct($val = null)
    {
        if (true === is_null($val)) {
            return $this;
        }

        $matchResult = preg_match(self::LENGTH_REGEX, $val, $matches);

        if (false === $matchResult || 0 === $matchResult) {
            throw new \Exception('Could not parse task length of '.$val);
        }

        if (true === array_key_exists(self::MINUTES_INDEX, $matches)) {
            $this->processMinutes($matches[self::MINUTES_INDEX]);
        }

        if (true === array_key_exists(self::HOURS_INDEX, $matches)) {
            $this->processHours($matches[self::HOURS_INDEX]);
        }

        return $this;
    }//end __construct()

    /**
     * Handles a string representing minutes, setting hours and minutes
     * properties as appropriate.
     *
     * @param mixed $minutes Minutes to be processed.
     *
     * @return TaskLength
     */
    private function processMinutes($minutes)
    {
        $val     = (int) $minutes;
        $hours   = floor($val / 60);
        $minutes = ($val - ($hours * 60));

        $this->addHours($hours);
        $this->addMinutes($minutes);

        return $this;
    }//end processMinutes()

    /**
     * Handles input representing hours, setting hours and minutes as
     * approproate.
     *
     * @param mixed $hours The number of hours to add.
     *
     * @return TaskLength
     */
    private function processHours($hours)
    {
        $val     = floatval($hours);
        $hours   = floor($val);
        $minutes = (($val - $hours) * 60);


        $this->addHours($hours);
        $this->addMinutes($minutes);

        return $this;
    }//end processHours()

    /**
     * Getter for minutes
     *
     * @return integer
     */
    public function getMinutes()
    {
        return $this->minutes;
    }//end getMinutes()

    /**
     * Setter for minutes
     *
     * @param integer $minutes
     *
     * @return TaskLength
     */
    public function setMinutes($minutes)
    {
        $this->minutes = $minutes;

        return $this;
    }//end setMinutes()

    /**
     * Adds to existing minutes tally.
     *
     * @param integer $minutes The minutes to increment by.
     *
     * @return TaskLength
     */
    public function addMinutes($minutes)
    {
        $currentMinutes = $this->minutes;

        if (true === is_null($currentMinutes) || !is_numeric($currentMinutes)) {
            $currentMinutes = 0;
        }

        $this->minutes = ($currentMinutes + (int) $minutes);

        return $this;
    }//end addMinutes()

    /**
     * Getter for Hours
     *
     * @return integer
     */
    public function getHours()
    {
        return $this->hours;
    }//end getHours()

    /**
     * Setter for Hours
     *
     * @param  integer $Hours
     *
     * @return TaskLength
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }//end setHours()

    /**
     * Adds to existing hours tally.
     *
     * @param integer $hours The hours to increment by.
     *
     * @return TaskLength
     */
    public function addHours($hours)
    {
        $currentHours = $this->hours;

        if (true === is_null($currentHours) || !is_numeric($currentHours)) {
            $currentHours = 0;
        }

        $this->hours = ($currentHours + (int) $hours);

        return $this;
    }//end addHours()
}//end class
