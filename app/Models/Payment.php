<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
