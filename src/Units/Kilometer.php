<?php

namespace Bitfactory\Lightyear\Units;

class Kilometer extends Meter
{
    public function getName(): string
    {
        return 'kilometers';
    }

    public function getAbbreviation(): string
    {
        return 'km';
    }

    public function alternativeNames(): array
    {
        return ['kilometer'];
    }

    public function toBaseUnit(float $value): float
    {
        return $value * 1000;
    }

    public function fromBaseUnit(float $value): float
    {
        return $value / 1000;
    }
}
