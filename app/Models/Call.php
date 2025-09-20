<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'points',
        'hours',
        'start_date', 
        'end_date',
        'socioeconomic_points_limit',
        'residency_required',
    ];

    protected $hidden = [];

    // Conversion de tipos
    protected $casts = [
        'points' => 'float',
        'hours' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'socioeconomic_points_limit' => 'float',
        'residency_required' => 'boolean',
    ];

    public $timestamps = true;

    // Una Call puede tener muchas Registrations
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    // Una Call puede tener muchas Renewals
    public function renewal()
    {
        return $this->hasMany(Renewal::class);
    }
}
