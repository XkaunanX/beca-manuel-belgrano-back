<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            ['name' => 'Grado', 'description' => 'Nivel de grado universitario'],
            ['name' => 'Posgrado', 'description' => 'Nivel de posgrado'],
        ];

        foreach ($levels as $level) {
            Level::updateOrCreate(['name' => $level['name']], $level);
        }
    }
}
