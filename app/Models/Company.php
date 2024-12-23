<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array[] $companies)
 * @method static insert(array[] $companies)
 * @method static where(string $string, string $uniqueCode)
 */
class Company extends Model
{
    protected $fillable = [
        'plan_id',
        'name',
        'code'
    ];

    public function rifas(): HasMany
    {
        return $this->hasMany(Rifa::class);
    }
}
