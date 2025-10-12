<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UnitCareer;

class UnitCareerSeeder extends Seeder
{
    public function run(): void
    {
        $unitCareers = [
            ['unit_id' => 1, 'career_id' => 1],
            ['unit_id' => 2, 'career_id' => 1],
            ['unit_id' => 3, 'career_id' => 2],
        ];

        foreach ($unitCareers as $uc) {
            UnitCareer::updateOrCreate($uc, $uc);
        }
    }
}
