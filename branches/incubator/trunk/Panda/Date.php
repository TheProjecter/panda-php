<?php

class Panda_Date
{
    const DEFAULT_DATE = 'now';
    const DEFAULT_FORMAT = 'Y-m-d h:i:s';

    private $timestamp;
    private $format;

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

    public function __toString()
    {
        return date($this->format, $this->timestamp);
    }

    public function isLessThan($date)
    {
        return $this->timestamp < strtotime($date);
    }

    public function isGreaterThan($date)
    {
        return $this->timestamp > strtotime($date);
    }
}