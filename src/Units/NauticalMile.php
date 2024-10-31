<?php

namespace Bitfactory\Lightyear\Units;

class NauticalMile extends BaseUnit
{
    public function getName(): string
    {
        return 'nautical miles';
    }

    public function getAbbreviation(): string
    {
        return 'NM';
    }

    public function alternativeNames(): array
    {
        return ['nautical mile'];
    }

    public function toBaseUnit(float $value): float
    {
        return $value * 1852;
    }

    public function fromBaseUnit(float $value): float
    {
        return $value / 1852;
    }
}
