<?php

namespace DTL\Bundle\TimeDistanceBundle\Util;

use Frost\Distance\Distance as DistanceConverter;

/**
 * Class providing lots of methods for formatting distances
 * and times.
 */
class TimeDistanceHelper
{
    protected $dth;

    protected $distanceAliases = array(
        'k' => 'km',
        'miles' => 'mi',
        'mile' => 'mi',
    );

    protected function average($v1, $v2)
    {
        if (!$v1) {
            return 0;
        }

        if (!$v2) {
            return 0;
        }

        return $v1 / $v2;
    }

    protected function normalizeDistanceUnit($unit)
    {
        if (isset($this->distanceAliases[$unit])) {
            return $this->distanceAliases[$unit];
        }

        return $unit;
    }

    public function getSuffix($unit)
    {
        return $this->normalizeDistanceUnit($unit);
    }

    public function secondsAsStopwatch($seconds)
    {
        $hours = floor($seconds / 60 / 60);
        $minutes = floor(($seconds - ($hours * 60 * 60)) / 60);
        $seconds = $seconds - (($hours * 60 * 60) + ($minutes * 60));
        $res = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        return $res;
    }

    public function formatDistance($distance, $from = 'm', $to = 'km', $precision = 2)
    {
        $converter = new DistanceConverter;
        $converter->setUnit($this->normalizeDistanceUnit($from));
        $converter->setDistance($distance);
        $res = $converter->convertTo($this->normalizeDistanceUnit($to));
        return number_format($res, $precision);
    }

    public function formatAveragePace($time, $distance, $from = 'm', $to = 'km')
    {
        $avg = $this->average($time, 
            $this->formatDistance($distance, $from, $to)
        );
        return $this->secondsToStopwatch($avg);
    }

    public function formatAverageSpeed($time, $distance, $from = 'm', $to = 'km', $prescision = 2)
    {
        $avg = $this->average(
            $this->formatDistance($distance, $from, $to),
            $time / 60 / 60
        );
    
        return number_format($avg, $prescision);
    }
}
