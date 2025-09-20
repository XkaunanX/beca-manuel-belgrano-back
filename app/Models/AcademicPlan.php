<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicPlan extends Model
{
    protected $fillable = [
        'name',
        'years',
        'subject_count',
    ];

    public $timestamps = true;

    // Un AcademicPlan tiene un Level
    public function level(){
        return $this->belongsTo(Level::class);
    }

    // Un AcademicPlan tiene una sola Career
    public function career(){
        return $this->belongsTo(Career::class);
    }

    // Un AcademicPlan es de una sola unit
    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    // Un academicPlan puede tener muchos ScholarshipAcademicPlans
    public function scholarshipAcademicPlans(){
        return $this->hasMany(ScholarshipAcademicPlan::class);
    }
}
