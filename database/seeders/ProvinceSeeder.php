<?php

namespace Database\Seeders;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            'Buenos Aires',
            'Córdoba',
            'Santa Fe',
            'Mendoza',
            'Tucumán',
            'Salta',
            'Entre Ríos',
            'Misiones',
            'Chaco',
            'Corrientes',
            'Santiago del Estero',
            'Formosa',
            'Jujuy',
            'Río Negro',
            'San Juan',
            'San Luis',
            'La Pampa',
            'Neuquén',
            'Chubut',
            'Santa Cruz',
            'Tierra del Fuego'
        ];

        foreach ($provinces as $provinceName) {
            Province::firstOrCreate(['name' => $provinceName]);
        }
    }
}
