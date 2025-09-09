<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name', 'description'];
    public $timestamps = true;

    // Un Level lo pueden tener muchos AcademicPlan
    public function academicPlans(){
        return $this->hasMany(AcademicPlan::class);
    }
}
