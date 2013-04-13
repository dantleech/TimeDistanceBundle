<?php

namespace DTL\Bundle\TimeDistanceBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use DTL\Bundle\TimeDistanceBundle\Util\TimeDistanceHelper;

class StopwatchToSecondTransformer implements DataTransformerInterface
{
    protected $tdh;

    public function __construct(TimeDistanceHelper $tdh)
    {
        $this->tdh = $tdh;
    }

    public function transform($value)
    {
        if ($value) {
            return $this->tdh->secondsToStopwatch($value);
        }
    }

    public function reverseTransform($value)
    {
        if ($value) {
            return $this->tdh->stopwatchToSeconds($value);
        }
    }
}

