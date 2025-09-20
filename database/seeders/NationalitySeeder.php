<?php

namespace Database\Seeders;
use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nationalities = [
            'Argentina',
            'Brasil',
            'Chile',
            'Uruguay',
            'Paraguay',
            'Bolivia',
            'Peru',
            'Colombia',
            'Venezuela',
            'Ecuador',
            'Mexico',
            'España',
            'Italia',
            'Francia',
            'Alemania'
        ];

        foreach ($nationalities as $nationalityName) {
            Nationality::firstOrCreate(['name' => $nationalityName]);
        }
    }
}
