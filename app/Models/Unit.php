<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;

    // Una Unit pertenece a una Institutions
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function careers()
    {
        return $this->belongsToMany(Career::class, 'unit_career');
    }

    //Una Unit tiene muchos AcademicPlans
    public function academicPlans()
    {
        return $this->hasMany(AcademicPlan::class);
    }
}
