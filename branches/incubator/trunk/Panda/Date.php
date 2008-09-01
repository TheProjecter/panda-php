<?php

/**
 * A date comparison and manipulation library
 *
 * @package Panda
 * @author Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_Date
{
    /**
     * The default date and time is the time of instantiation
     *
     * @var string
     */
    const DEFAULT_DATE = 'now';

    /**
     * The default format is YYYY-MM-DD HH:MM:SS
     *
     * @var string
     */
    const DEFAULT_FORMAT = 'Y-m-d h:i:s';

    /**
     * The date's Unix timestamp
     *
     * @var int
     */
    private $timestamp;

    /**
     * The date's format (Matches PHP's date() function)
     *
     * @var string
     * @link http://www.php.net/date
     */
    private $format;

    /**
     * Constructs a new Date object
     *
     * @param mixed $date Any valid strtotime() format
     * @param string $format Any valid date() format
     */
    public function __construct($date = null, $format = null)
    {
        if (!$date) {
            $date = self::DEFAULT_DATE;
        }

        if (!$format) {
            $format = self::DEFAULT_FORMAT;
        }

        $this->timestamp = strtotime($date);
        $this->format = $format;
    }

    /**
     * Object to string converter
     *
     * @return string
     */
    public function __toString()
    {
        return date($this->format, $this->timestamp);
    }

    /**
     * Checks if the date is less than the supplied date
     *
     * @param mixed $date Any strtotime() format
     * @return boolean
     */
    public function isLessThan($date)
    {
        return $this->timestamp < strtotime($date);
    }

    /**
     * Checks if the date is greater than the supplied date
     *
     * @param mixed $date Any strtotime() format
     * @return boolean
     */
    public function isGreaterThan($date)
    {
        return $this->timestamp > strtotime($date);
    }
}