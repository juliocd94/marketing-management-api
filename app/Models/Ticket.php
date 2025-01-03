<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static findOrFail(mixed $ticketId)
 * @method static find(mixed $ticketId)
 * @method static where(string $string, $null)
 * @method static insert(array $tickets)
 */
class Ticket extends Model
{
    protected $fillable = [
        'rifa_id',
        'customer_id',
        'number',
        'payment_progress',
        'total_paid'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function rifa(): BelongsTo
    {
        return $this->belongsTo(Rifa::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
