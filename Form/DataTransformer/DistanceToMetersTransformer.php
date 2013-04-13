<?php

namespace DTL\Bundle\TimeDistanceBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use DTL\TimeDistanceBundle\Util\FormatUtil;
use DTL\Bundle\TimeDistanceBundle\Util\TimeDistanceHelper;

class DistanceToMetersTransformer implements DataTransformerInterface
{
    protected $tdh;

    public function __construct(TimeDistanceHelper $tdh)
    {
        $this->tdh = $tdh;
    }

    public function transform($value)
    {
        if ($value) {
            return $this->tdh->formatDistance($value, 'm', 'km');
        }
    }

    public function reverseTransform($value)
    {
        if ($value) {
            return $this->tdh->distanceToMeters($value);
        }
    }
}

