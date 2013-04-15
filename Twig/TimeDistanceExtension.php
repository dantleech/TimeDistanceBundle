<?php

namespace DTL\Bundle\TimeDistanceBundle\Twig;

use DTL\Bundle\TimeDistanceBundle\Util\TimeDistanceHelper;

/**
 * Twig extension providing useful time distance filters and functions
 *
 * @author Daniel Leech <daniel@dantleech.com>
 */
class TimeDistanceExtension extends \Twig_Extension
{
    public $tdh;
    public $baseDistanceUnit;

    public function __construct(TimeDistanceHelper $tdh, $baseDistanceUnit = 'm')
    {
        $this->tdh = $tdh;
        $this->baseDistanceUnit = $baseDistanceUnit;
    }

    public function getFilters()
    {
        return array(
            'seconds_as_stopwatch' => new \Twig_Filter_Method($this, 'secondsToStopwatch'),
            'format_distance' => new \Twig_Filter_Method($this, 'formatDistance'),
            'average_pace' => new \Twig_Filter_Method($this, 'averagePace'),
            'average_speed' => new \Twig_Filter_Method($this, 'averageSpeed'),
        );
    }

    public function secondsToStopwatch($seconds)
    {
        return $this->tdh->secondsToStopwatch($seconds);
    }

    public function formatDistance($distance, $to = 'km', $from = null, $precision = 2)
    {
        if (null === $from) {
            $from = $this->baseDistanceUnit;
        }

        return $this->tdh->formatDistance($distance, $from, $to, $precision);
    }

    public function averagePace($seconds, $distance, $to = 'km')
    {
        return $this->tdh->formatAveragePace($seconds, $distance, $this->baseDistanceUnit, $to);
    }

    public function averageSpeed($seconds, $distance, $to = 'km', $precision = 2)
    {
        return $this->tdh->formatAverageSpeed($seconds, $distance, $this->baseDistanceUnit, $to, $precision);
    }

    public function getName()
    {
        return "time_distance";
    }
}
