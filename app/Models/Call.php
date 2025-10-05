<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = [
        'points',
        'hours',
        'start_date', 
        'end_date',
        'socioeconomic_points_limit',
        'residency_required',
        'enrollment_start_date',
        'enrollment_end_date',
    ];

    protected $hidden = [];

    protected $casts = [
        'points' => 'float',
        'hours' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'socioeconomic_points_limit' => 'float',
        'residency_required' => 'boolean',
        'enrollment_start_date' => 'date',
        'enrollment_end_date' => 'date',
    ];

    public $timestamps = true;

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function renewal()
    {
        return $this->hasMany(Renewal::class);
    }
}
