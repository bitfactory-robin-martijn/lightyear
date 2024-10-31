<?php

namespace Bitfactory\Lightyear\Units;

class Mile extends BaseUnit
{
    public function getName(): string
    {
        return 'miles';
    }

    public function getAbbreviation(): string
    {
        return 'mi';
    }

    public function alternativeNames(): array
    {
        return ['mile'];
    }

    public function toBaseUnit(float $value): float
    {
        return $value * 1609.344;
    }

    public function fromBaseUnit(float $value): float
    {
        return $value / 1609.344;
    }
}
