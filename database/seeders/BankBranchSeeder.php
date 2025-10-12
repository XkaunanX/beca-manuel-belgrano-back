<?php

namespace Database\Seeders;

use App\Models\BankBranch;
use App\Models\Province;
use Illuminate\Database\Seeder;

class BankBranchSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurarnos de que existan provincias
        $province = Province::firstOrCreate(['name' => 'Buenos Aires']);

        // Sucursales con provincia válida
        $branches = [
            [
                'name' => 'Sucursal Central',
                'street' => 'Av. Principal 123',
                'number' => '123',
                'city' => 'La Plata',
                'province_id' => $province->id,
            ],
            [
                'name' => 'Sucursal Norte',
                'street' => 'Calle 10',
                'number' => '456',
                'city' => 'Berisso',
                'province_id' => $province->id,
            ],
            [
                'name' => 'Sucursal Sur',
                'street' => 'Calle 50',
                'number' => '789',
                'city' => 'Ensenada',
                'province_id' => $province->id,
            ],
        ];

        foreach ($branches as $branch) {
            BankBranch::updateOrCreate(
                ['name' => $branch['name']],
                $branch
            );
        }
    }
}
