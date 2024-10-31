<?php

namespace Bitfactory\Lightyear;

use Bitfactory\Lightyear\Units\Kilometer;
use Bitfactory\Lightyear\Units\Meter;
use Bitfactory\Lightyear\Units\Mile;
use Bitfactory\Lightyear\Units\NauticalMile;
use Bitfactory\Lightyear\Units\BaseUnit;
use Bitfactory\Lightyear\Units\UnitFactory;

class Distance
{
    private float $value;

    private BaseUnit $unit;

    private function __construct(float $value, BaseUnit $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    public static function createFromMeters(float $value): self
    {
        return new self($value, new Meter);
    }

    public static function createFromKilometers(float $value): self
    {
        return new self($value, new Kilometer);
    }

    public static function createFromMiles(float $value): self
    {
        return new self($value, new Mile);
    }

    public static function createFromNauticalMiles(float $value): self
    {
        return new self($value, new NauticalMile);
    }

    public static function create(float $value, string $unitConstant): self
    {
        $unit = UnitFactory::create($unitConstant);

        return new self($value, $unit);
    }

    public static function from(string $input): self
    {
        if (preg_match('/^(\d+(\.\d+)?)\s*([\w\s]+)$/', $input, $matches)) {
            $value = (float) $matches[1];
            $unit = UnitFactory::create(trim($matches[3]));

            return new self($value, $unit);
        }

        throw new \InvalidArgumentException("Invalid format: {$input}");
    }

    public function convertTo(string $targetUnitName): self
    {
        $baseValue = $this->unit->toBaseUnit($this->value);
        $convertedValue = UnitFactory::fromBaseUnit($baseValue, $targetUnitName);
        $targetUnitInstance = UnitFactory::create($targetUnitName);

        return new self($convertedValue, $targetUnitInstance);
    }

    public function toString(int $decimals = 1): string
    {
        return $this->unit->toString($this->value, $decimals);
    }

    public function toShortString(int $decimals = 1): string
    {
        return $this->unit->toString($this->value, $decimals, true);
    }

    public function toHumanReadableString(): string
    {
        return $this->unit->toHumanReadableString($this->value);
    }

    public function toShortHumanReadableString(): string
    {
        return $this->unit->toHumanReadableString($this->value, short: true);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getUnit(): BaseUnit
    {
        return $this->unit;
    }
}
