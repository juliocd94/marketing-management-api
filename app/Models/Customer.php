<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static insert(array $customers)
 * @method static findOrFail(mixed $customerId)
 * @method static find(mixed $customerId)
 * @method create(array $array)
 */
class Customer extends Model
{
    protected $fillable = [
        'name',
        'identification_type',
        'company_id',
        'identification',
        'address',
        'phone'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
