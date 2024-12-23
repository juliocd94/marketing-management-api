<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rifa extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'quantity_tickets',
        'description',
        'currency',
        'ticket_price',
        'init_date',
        'finish_date'
    ];

    public function awards(): HasMany
    {
        return $this->hasMany(Award::class);
    }

    protected $appends = ['status'];

    /**
     * Accesor para obtener el estatus de la rifa.
     */
    public function getStatusAttribute()
    {
        $currentDate = now();
        $initDate = \Carbon\Carbon::parse($this->init_date);
        $finishDate = \Carbon\Carbon::parse($this->finish_date);

        if ($currentDate->between($initDate, $finishDate)) {
            return 'Activo';
        } elseif ($currentDate->greaterThan($finishDate)) {
            return 'Cerrado';
        } elseif ($currentDate->lessThan($initDate)) {
            return 'Programado';
        }

        return 'Desconocido';
    }
}
