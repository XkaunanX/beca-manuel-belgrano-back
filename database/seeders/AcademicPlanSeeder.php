<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicPlan;
use App\Models\Level;
use App\Models\Career;
use App\Models\Unit;

class AcademicPlanSeeder extends Seeder
{
    public function run(): void
    {
        $level = Level::first();
        $career = Career::first();
        $unit = Unit::first();

        $plans = [
            [
                'name' => 'Ingeniería en Sistemas de Información',
                'years' => 5,
                'subject_count' => 45,
                'level_id' => $level->id,
                'career_id' => $career->id,
                'unit_id' => $unit->id,
            ],
            [
                'name' => 'Ingeniería Industrial',
                'years' => 5,
                'subject_count' => 43,
                'level_id' => $level->id,
                'career_id' => $career->id,
                'unit_id' => $unit->id,
            ],
        ];

        foreach ($plans as $plan) {
            AcademicPlan::updateOrCreate(['name' => $plan['name']], $plan);
        }
    }
}
