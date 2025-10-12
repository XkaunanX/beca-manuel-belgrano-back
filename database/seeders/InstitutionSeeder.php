<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        $institutions = [
            ['id' => 1, 'name' => 'Universidad Tecnológica Nacional'],
            ['id' => 2, 'name' => 'Universidad de Buenos Aires'],
            ['id' => 3, 'name' => 'Universidad Nacional de Córdoba'],
        ];

        foreach ($institutions as $inst) {
            Institution::updateOrCreate(['id' => $inst['id']], $inst);
        }
    }
}
