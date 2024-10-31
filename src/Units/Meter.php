<?php

namespace Bitfactory\Lightyear\Units;

class Meter extends BaseUnit
{
    public function getName(): string
    {
        return 'meters';
    }

    public function getAbbreviation(): string
    {
        return 'm';
    }

    public function alternativeNames(): array
    {
        return ['meter'];
    }

    public function toHumanReadableString(float $value, bool $short = false): string
    {
        if ($value >= 1000) {
            return (new Kilometer())->toHumanReadableString($value / 1000, $short);
        }

        return parent::toHumanReadableString($value, $short);
    }

    public function toBaseUnit(float $value): float
    {
        return $value;
    }

    public function fromBaseUnit(float $value): float
    {
        return $value;
    }
}
