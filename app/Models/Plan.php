<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static insert(array[] $plans)
 */
class Plan extends Model
{
    protected $fillable = [
        'plan_id',
        'name',
        'description',
        'cost',
        'code'
    ];
}
