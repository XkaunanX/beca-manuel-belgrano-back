<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    
    protected $fillable = ['name', 'last_name', 'date_birth', 'cuil', 'cuit', 'childen', 'social_coverage'];

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
    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    // Un scolarship tiene un VulnerableGroups
    public function vulnerableGroup()
    {
        return $this->belongsTo(VulnerableGroup::class);
    }

    // Un Scolarship tiene muchos Payment
    public function scholarshipPayments()
    {
        return $this->hasMany(Payment::class);
    }   

    // Un scolarship tiene un BankBranch
    public function bankBranch()
    {
         return $this->belongsTo(BankBranch::class);
    }

    // Un Scolarship tiene muchos Assets
    public function assets()
    {
        return $this->hasMany(Asset::class);    
    }
    
    //Un scolarship tiene muchos FamilyMembers
    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);

    }
}
