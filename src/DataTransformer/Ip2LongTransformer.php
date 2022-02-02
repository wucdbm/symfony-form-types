<?php

namespace Wucdbm\SymfonyFormTypes\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class Ip2LongTransformer implements DataTransformerInterface {

    public function transform($value) {
        if (null === $value) {
            return null;
        }

        $ip = long2ip($value);

        return $ip ?: null;
    }

    public function reverseTransform($value) {
        if (!$value) {
            return null;
        }

        if (false === filter_var($value, FILTER_VALIDATE_IP)) {
            throw new TransformationFailedException(
                sprintf('Provided IP "%s" is not a valid IP Address', $value)
            );
        }

        $long = ip2long($value);

        return $long ?: null;
    }
}