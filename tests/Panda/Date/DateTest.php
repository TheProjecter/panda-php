<?php

require_once '../../configuration.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Panda/Date.php';

class DateTest
extends PHPUnit_Framework_TestCase
{
    public function testFormat()
    {
        $regexYMD = '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/';
        $regexHMS = '/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/';

        $todayYMD   = (string) new Panda_Date('today', 'Y-m-d');
        $weekAgoYMD = (string) new Panda_Date('1 week ago', 'Y-m-d');

        $todayHMS   = (string) new Panda_Date('today', 'H:i:s');
        $weekAgoHMS = (string) new Panda_Date('1 week ago', 'H:i:s');

        $this->assertRegExp($regexYMD, $todayYMD);
        $this->assertRegExp($regexYMD, $weekAgoYMD);

        $this->assertRegExp($regexHMS, $todayHMS);
        $this->assertRegExp($regexHMS, $weekAgoHMS);
    }

    public function testIsLessThan()
    {
        $today = new Panda_Date('today');
        $tomorrow = new Panda_Date('tomorrow');

        $this->assertTrue($today->isLessThan($tomorrow));
    }

    public function testIsGreaterThan()
    {
        $today = new Panda_Date('today');
        $yesterday = new Panda_Date('yesterday');

        $this->assertTrue($today->isGreaterThan($yesterday));
    }
}