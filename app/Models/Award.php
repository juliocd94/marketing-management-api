<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array[] $awards)
 */
class Award extends Model
{
    protected $fillable = [
        'condition',
        'name',
        'draw_date',
        'status'
    ];
}
