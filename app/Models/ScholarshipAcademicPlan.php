<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScholarshipAcademicPlan extends Model
{
    protected $fillable = ['regular', 'start_semester', 'start_date', 'end_date', 'approved_subjects'];
    public $timestamps = true;

     protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    // Una ScholarshipAcademicPlan pertenece a un AcademicPlan
    public function academicPlan(){
        return $this->belongsTo(AcademicPlan::class);
    }
    
    // Una ScholarshipAcademicPlan pertenece a una Scholarships
    public function scholarship(){
        return $this->belongsTo(Scholarship::class);
    }
}
