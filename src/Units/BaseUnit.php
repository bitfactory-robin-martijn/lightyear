<?php

namespace Bitfactory\Lightyear\Units;

abstract class BaseUnit
{
    abstract public function getName(): string;

    abstract public function getAbbreviation(): string;

    abstract public function toBaseUnit(float $value): float;

    abstract public function fromBaseUnit(float $value): float;

    public static function allVariants(BaseUnit $unit): array
    {
        return [
            $unit->getName(),
            $unit->getAbbreviation(),
            ...$unit->alternativeNames(),
        ];
    }

    public function toHumanReadableString(float $value, bool $short = false): string
    {
        return $this->toString($value, short: $short);
    }

    public function toShortHumanReadableString(float $value): string
    {
        return $this->toString($value, short: true);
    }

    public function toString(float $value, int $decimals = 1, bool $short = false): string
    {
        if ($decimals < 0) {
            throw new \InvalidArgumentException('Decimals must be a positive integer');
        }

        $value = number_format($value, $decimals);
        $unit = $short ? $this->getAbbreviation() : $this->getName();

        return "{$value} {$unit}";
    }

    public function alternativeNames(): array
    {
        return [];
    }
}
