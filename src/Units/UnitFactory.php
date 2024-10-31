<?php

namespace Bitfactory\Lightyear\Units;

use ReflectionClass;

class UnitFactory
{
    private static array $units = [];

    private static array $unitAliases = [];

    public static function initialize(): void
    {
        $reflection = new ReflectionClass(Unit::class);
        foreach ($reflection->getConstants() as $constant => $unitName) {
            $unitClass = __NAMESPACE__.'\\'.str_replace(' ', '', $unitName);
            self::$units[$unitName] = $unitClass;

            if (method_exists($unitClass, 'allVariants')) {
                $unitInstance = new $unitClass;
                foreach ($unitClass::allVariants($unitInstance) as $variant) {
                    self::$unitAliases[strtolower($variant)] = $unitName;
                }
            }
        }
    }

    public static function create(string $unit): BaseUnit
    {
        $unit = strtolower($unit);
        if (isset(self::$unitAliases[$unit])) {
            $unit = self::$unitAliases[$unit];
        }

        if (! isset(self::$units[$unit])) {
            throw new \InvalidArgumentException("Unknown unit: $unit");
        }

        $unitClass = self::$units[$unit];

        return new $unitClass;
    }

    public static function toBaseUnit(float $value, string $unit): float
    {
        $unitInstance = self::create($unit);

        return $unitInstance->toBaseUnit($value);
    }

    public static function fromBaseUnit(float $value, string $unit): float
    {
        $unitInstance = self::create($unit);

        return $unitInstance->fromBaseUnit($value);
    }
}

UnitFactory::initialize();
