<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        // Datos mínimos de prueba
        $units = [
            ['id' => 1, 'name' => 'Unidad Académica La Plata', 'institution_id' => 1],
            ['id' => 2, 'name' => 'Unidad Académica Buenos Aires', 'institution_id' => 1],
            ['id' => 3, 'name' => 'Unidad Académica Córdoba', 'institution_id' => 1],
        ];

        foreach ($units as $unit) {
            Unit::updateOrCreate(['id' => $unit['id']], $unit);
        }
    }
}
