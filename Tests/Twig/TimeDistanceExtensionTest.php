<?php

namespace DTL\Bundle\TimeDistanceBundle\Tests\Twig;

use DTL\Bundle\TimeDistanceBundle\Twig\TimeDistanceExtension;


class TimeDistanceExtensionTest extends \PHPUnit_Framework_Testcase
{
    public function setUp()
    {
        $this->helper = $this->getMockBuilder('DTL\Bundle\TimeDistanceBundle\Util\TimeDistanceHelper')
            ->disableOriginalConstructor()
            ->getMock();

        $this->ext = new TimeDistanceExtension($this->helper, 'm');
    }

    // Just a dumb test to ensure that everything works (more or less)
    public function testFilters()
    {
        $args = array(
            'seconds_as_stopwatch' => array(3600),
            'format_distance' => array(1000, 'm'),
            'average_pace' => array(1000, 1000),
            'average_speed' => array(1000, 1000),
        );

        foreach ($this->ext->getFilters() as $ext => $filter) {
            $callable = $filter->getCallable();
            call_user_func_array($callable, $args[$ext]);
        }
    }
}
