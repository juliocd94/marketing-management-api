<?php

namespace App\Enums;

enum Currency: string
{
    case Bolivar = 'VES';
    case Dollar = 'USD';
    case ColombianPeso = 'COP';
    case Euro = 'EUR';

    /**
     * Get an array of all currencies with their codes.
     */
    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get an array of currencies with their names.
     */
    public static function names(): array
    {
        return array_map(fn ($case) => $case->name, self::cases());
    }

    /**
     * Get a map of currency names to codes.
     */
    public static function map(): array
    {
        return array_combine(
            array_map(fn ($case) => $case->name, self::cases()),
            array_map(fn ($case) => $case->value, self::cases())
        );
    }
}
