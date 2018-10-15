<?php

namespace Wucdbm\SymfonyFormTypes\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class Ip2LongTransformer implements DataTransformerInterface {

    public function transform($long) {
        if (null === $long) {
            return null;
        }

        $ip = long2ip($long);

        return $ip ? $ip : null;
    }

    public function reverseTransform($ip) {
        if (!$ip) {
            return null;
        }

        $long = ip2long($ip);

        return $long ? $long : null;
    }
}