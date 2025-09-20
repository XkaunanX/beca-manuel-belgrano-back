<?php

namespace Database\Seeders;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            'Universitario',
            'Tecnicatura Universitaria',
            'Tecnicatura Terciaria'
        ];

        foreach ($levels as $levelName) {
            Level::firstOrCreate(['name' => $levelName]);
        }
    }
}
