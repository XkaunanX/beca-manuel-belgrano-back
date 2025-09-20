<?php

namespace Database\Seeders;
use App\Models\CivilStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Soltero/a',
            'Casado/a',
            'Divorciado/a',
            'Viudo/a',
            'Concubinato',
            'Separado/a'
        ];

        foreach ($statuses as $statusName) {
            CivilStatus::firstOrCreate(['name' => $statusName]);
        }
    }
}
