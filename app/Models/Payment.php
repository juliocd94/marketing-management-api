<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static where(string $string, $id)
 * @method static create(array $array)
 */
class Payment extends Model
{
    protected $fillable = [
        'rifa_id',
        'customer_id',
        'ticket_id',
        'amount',
        'date',
        'currency',
        'payment_method',
        'reference_value'
    ];

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class, 'id', 'ticket_id');
    }
}
