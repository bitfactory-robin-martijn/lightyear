<?php

use Bitfactory\Lightyear\Distance;
use Bitfactory\Lightyear\Units\Kilometer;
use Bitfactory\Lightyear\Units\Meter;
use Bitfactory\Lightyear\Units\Mile;
use Bitfactory\Lightyear\Units\NauticalMile;
use Bitfactory\Lightyear\Units\Unit;

covers(Distance::class);

it('creates a Distance instance in meters', function () {
    $distance = Distance::createFromMeters(100);
    expect($distance->getValue())->toBe(100.0)
        ->and($distance->getUnit())->toBeInstanceOf(Meter::class);
});

it('creates a Distance instance in kilometers', function () {
    $distance = Distance::createFromKilometers(1.5);
    expect($distance->getValue())->toBe(1.5)
        ->and($distance->getUnit())->toBeInstanceOf(Kilometer::class);
});

it('creates a Distance instance in miles', function () {
    $distance = Distance::createFromMiles(2.3);
    expect($distance->getValue())->toBe(2.3)
        ->and($distance->getUnit())->toBeInstanceOf(Mile::class);
});

it('creates a Distance instance in nautical miles', function () {
    $distance = Distance::createFromNauticalMiles(4.7);
    expect($distance->getValue())->toBe(4.7)
        ->and($distance->getUnit())->toBeInstanceOf(NauticalMile::class);
});

it('creates a Distance instance from a string', function () {
    $distance = Distance::from('10.5 kilometers');
    expect($distance->getValue())->toBe(10.5)
        ->and($distance->getUnit())->toBeInstanceOf(Kilometer::class);
});

it('throws an exception for invalid string format', function () {
    expect(fn () => Distance::from('invalid format'))->toThrow(\InvalidArgumentException::class);
});

it('converts Distance to another unit', function () {
    $distance = Distance::createFromKilometers(1);
    $converted = $distance->convertTo(Unit::METER);
    expect($converted->getValue())->toBe(1000.0)
        ->and($converted->getUnit())->toBeInstanceOf(Meter::class);
});

it('returns the string representation of Distance', function () {
    $distance = Distance::createFromMiles(3.5);
    expect($distance->toString())->toBe('3.5 miles');
});

it('returns the short string representation of Distance', function () {
    $distance = Distance::createFromNauticalMiles(2.5);
    expect($distance->toShortString())->toBe('2.5 NM');
});

it('outputs human readable string representation of Distance', function () {
    $distance = Distance::createFromMeters(2500);
    expect($distance->toHumanReadableString())->toBe('2.5 kilometers');
});

it('outputs short human readable string representation of Distance', function () {
    $distance = Distance::createFromMeters(3500);
    expect($distance->toShortHumanReadableString())->toBe('3.5 km');
});
