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

     protected $casts = [
        'date_birth' => 'datetime',
    ];

    // Un Scholarship puede tener muchas ScolarshipAcademicPlan
    public function scholarshipAcademicPlans(){
        return $this->hasMany(ScholarshipAcademicPlan::class);
    }

    // Un Scholarship puede tener muchos Services
    public function services(){
        return $this->hasMany(Service::class);
    }

    // Un scolarship puede tener muchos jobs
    public function jobs(){
        return $this->hasMany(Job::class);
    }   
    // Un Scolarship se relaciona con un unico Gender
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    //Un Scolarship tiene una Nacionalidad
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    
    // Un Scolarship tiene un unico CivilStatus



    

}
