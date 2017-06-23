<?php

namespace YieldCLI\Service;

use Symfony\Component\PropertyAccess\PropertyAccess;

class LogParser
{
    /**
     * The directory to search your logs for.
     *
     * @var string
     */
    public $logDir = '~/.yield/logs';

    /**
     * Instantiates the Log Parser.
     *
     * @param array|null $params The config of the logger we might override.
     *
     * @return void
     */
    public function __construct($params = null)
    {
        $this->accessor = PropertyAccess::createPropertyAccessor();

        if (true === is_array($params)) {
            $this->setParams($params);
        }
    }//end __construct()

    /**
     * Tries to read a raw log file, or else a date.
     *
     * @param string $input The date, as it will correspond to a file, or a raw log file.
     *
     * @return LogParser
     */
    public function read($input)
    {
        if (false === is_string($input)) {
            throw new \Exception('Cannot parse input of '.gettype($input));
        }

        $dateFromInput = \DateTime::createFromFormat('Y-m-d', $input);

        if ($dateFromInput instanceof \DateTime) {
            $path = $this->getLogFilePathByDate($dateFromInput);
        }

        return $this;
    }//end read()

    /**
     * Extrapolates the logfile's location on the filesystem.
     *
     * @param \DateTime The corresponding to the log file.
     *
     * @return string
     */
    private function getLogFilePathByDate(\DateTime $input)
    {
        $path = sprintf(
            '%s/%s.log',
            $this->logDir,
            $input->format('Y-m-d')
        );

        if (false === file_exists($path)) {
            throw new \Exception('Could not locate log file. ('.$path.')');
        }

        if (false === is_readable($path)) {
            throw new \Exception('Cannot read the log file '.$path.'. (Do you have the correct permissions?)');
        }

        return $path;
    }//end getLogFilePath()

    /**
     * Sets parameters to class properties where applicable.
     *
     * @param array $params Parameters to possibly set.
     *
     * @return void
     */
    private function setParams(array $params)
    {
        foreach ($params as $param => $val) {
            if (true === $this->accessor->isWritable($this, $param)) {
                $this->accessor->setValue($this, $param, $val);
            }
        }
    }//end setParams()
}//end class

