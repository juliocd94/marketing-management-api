<?php

namespace App\Enums;

enum Lottery: string
{
    case TachiraTripleA = 'Lotería del Táchira Triple A';
    case TachiraTripleB = 'Lotería del Táchira Triple B';
    case TachiraTripleZodiacal = 'Lotería del Táchira Triple Zodiacal';
    case BoyacaSerie = 'Lotería de Boyacá Serie';

    /**
     * Get an array of all lotteries.
     */
    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get an array of lottery names.
     */
    public static function names(): array
    {
        return array_map(fn ($case) => $case->name, self::cases());
    }

    /**
     * Get a map of lottery names to values.
     */
    public static function map(): array
    {
        return array_combine(
            array_map(fn ($case) => $case->name, self::cases()),
            array_map(fn ($case) => $case->value, self::cases())
        );
    }
}
