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

    // Una Unit puede tener muchas UnitCareers
    public function unitCareers(){
        return $this->hasMany(UnitCareer::class);
    }

    //Una Unit tiene muchos AcademicPlans
    public function academicPlans(){
        return $this->hasMany(AcademicPlan::class); 
    }
}
