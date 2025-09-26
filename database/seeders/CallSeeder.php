<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Call;
use Carbon\Carbon;

class CallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYear = now()->year;

        Call::create([
            'points' => 100, // valor de ejemplo
            'hours' => 40, // valor de ejemplo
            'start_date' => Carbon::create($currentYear, 1, 1), // 1 de enero
            'end_date' => Carbon::create($currentYear, 12, 31), // 31 de diciembre
            'socioeconomic_points_limit' => 50, // valor de ejemplo
            'residency_required' => true,
            'inscription_start' => Carbon::create($currentYear, 1, 1),
            'inscription_end' => Carbon::create($currentYear, 11, 30), // hasta noviembre
        ]);
    }
}
