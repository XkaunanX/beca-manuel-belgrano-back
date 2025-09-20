<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;

    // Una Career puede pertenecer a muchas Unit
    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_career');
    }

    // Una Career puede tener muchos AcademicPlan
    public function academicPlans()
    {
        return $this->hasMany(AcademicPlan::class);
    }
}
