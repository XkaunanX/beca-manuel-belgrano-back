<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;

    // Una Career puede tener muchas UnitCareer
    public function unitCareers(){
        return $this->hasMany(UnitCareer::class);  
    }

    // Una Career puede tener muchos AcademicPlan
    public function academicPlans(){
        return $this->hasMany(AcademicPlan::class);
    }
}