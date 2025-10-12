<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $states = [
            ['name' => 'inscripto', 'description' => 'Beca inscrita correctamente.'],
            ['name' => 'inscripcion_pendiente', 'description' => 'Esperando completar inscripción.'],
            ['name' => 'activo', 'description' => 'Beca actualmente activa.'],
            ['name' => 'perdida', 'description' => 'Beca perdida o dada de baja.'],
        ];

        foreach ($states as $state) {
            State::firstOrCreate(['name' => $state['name']], $state);
        }
    }
}
