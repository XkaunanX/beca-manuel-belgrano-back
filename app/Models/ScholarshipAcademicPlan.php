<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScholarshipAcademicPlan extends Model
{
    protected $table = 'scholarship_academic_plans';

    // Agregamos academic_plan_id y scholarship_id a fillable
    protected $fillable = [
        'regular',
        'start_semester',
        'start_date',
        'end_date',
        'approved_subjects',
        'academic_plan_id',
        'scholarship_id'
    ];

    public $timestamps = true;

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Relación con AcademicPlan
    public function academicPlan()
    {
        return $this->belongsTo(AcademicPlan::class);
    }

    // Relación con Scholarship
    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }
}
