<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case BBVA = 'Transferencia bancaria BBVA';
    case Banesco = 'Transferencia bancaria Banesco';
    case Sofitasa = 'Transferencia bancaria Sofitasa';
    case Bicentenario = 'Transferencia bancaria Bicentenario';
    case Mercantil = 'Transferencia bancaria Mercantil';
    case Cash = 'Efectivo';
    case Zelle = 'Zelle';
    case Binance = 'Binance';

    /**
     * Get an array of all payment methods.
     */
    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
