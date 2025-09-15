<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    
    protected $fillable = ['name', 'last_name', 'date_birth', 'cuil', 'cuit', 'childen', 'state'];

    // Un Scholarship tiene solo un User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Un Scholarship puede tener muchas ScolarshipAcademicPlan
    public function scholarshipAcademicPlans(){
        return $this->hasMany(ScholarshipAcademicPlan::class);
    }

    // Un Scholarship puede tener muchos Services
    public function services(){
        return $this->hasMany(Service::class);
    }
}
