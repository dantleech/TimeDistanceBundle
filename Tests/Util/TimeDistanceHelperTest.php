<?php

namespace DTL\Bundle\TimeDistanceBundle\Tests\Util;

use DTL\Bundle\TimeDistanceBundle\Util\TimeDistanceHelper;

class TimeDistanceHelperTest extends \PHPUnit_Framework_Testcase
{
    public function setUp()
    {
        $this->dth = new TimeDistanceHelper;
    }

    public function provideSecondsToStopwatch()
    {
        return array(
            array('123', '00:02:03'),
            array('3600', '01:00:00'),
            array('86400', '24:00:00'), // one day..
            array('604800', '168:00:00'), // one week ..
        );
    }

    /**
     * @dataProvider provideSecondsToStopwatch
     */
    public function testSecondsToStopwatch($seconds, $stopwatch)
    {
        $res = $this->dth->secondsToStopwatch($seconds);
        $this->assertEquals($stopwatch, $res);
    }

    public function provideFormatDistance()
    {
        return array(
            array('33', 'k', 'mi', '20.51'),
            array('33', 'km', 'mile', '20.51'),
            array('1', 'mile', 'k', '1.61'),
            array('1', 'miles', 'k', '1.61'),
            array('1', 'mi', 'k', '1.61'),
        );
    }

    /**
     * @dataProvider provideFormatDistance
     */
    public function testFormatDistance($distance, $from, $to, $expected)
    {
        $res = $this->dth->formatDistance($distance, $from, $to);
        $this->assertEquals($expected, $res);
    }

    public function provideFormatAveragePace()
    {
        return array(
            array(2820, 10, '00:07:34'),
        );
    }

    /**
     * @dataProvider provideFormatAveragePace
     */
    public function testFormatAveragePace($seconds, $distance, $expected)
    {
        $res = $this->dth->formatAveragePace($seconds, $distance, 'km', 'mi');
        $this->assertEquals($expected, $res);
    }

    public function provideFormatAverageSpeed()
    {
        return array(
            array(2820, 10, '7.93'), // miles per hour
        );
    }

    /**
     * @dataProvider provideFormatAverageSpeed
     */
    public function testFormatAverageSpeed($seconds, $distance, $expected)
    {
        $res = $this->dth->formatAverageSpeed($seconds, $distance, 'km', 'mi');
        $this->assertEquals($expected, $res);
    }
}
