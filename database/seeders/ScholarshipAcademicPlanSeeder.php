<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScholarshipAcademicPlan;
use App\Models\AcademicPlan;
use App\Models\Scholarship;

class ScholarshipAcademicPlanSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar cualquier plan y beca existente (ya deberían estar creados)
        $academicPlan = AcademicPlan::first();
        $scholarship = Scholarship::first();

        // Si no existen, crear unos básicos
        if (!$academicPlan) {
            $academicPlan = AcademicPlan::create([
                'name' => 'Ingeniería en Sistemas de Información',
                'years' => 5,
            ]);
        }

        if (!$scholarship) {
            $scholarship = Scholarship::create([
                'user_id' => 1,
                'name' => 'Becario Demo',
                'last_name' => 'Ejemplo',
                'date_birth' => '1999-01-01',
                'civil_status_id' => 1,
                'nationality_id' => 1,
                'children' => 0,
                'vulnerable_group_id' => 1,
                'bank_branch_id' => 1,
                'state_id' => 1,
            ]);
        }

        ScholarshipAcademicPlan::create([
            'regular' => 1,
            'start_semester' => '2025-2',
            'start_date' => '2025-03-01',
            'end_date' => '2025-12-15',
            'approved_subjects' => 5,
            'academic_plan_id' => $academicPlan->id,
            'scholarship_id' => $scholarship->id,
        ]);
    }
}
