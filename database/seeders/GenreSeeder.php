<?php

namespace Database\Seeders;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = ['Masculino', 'Femenino', 'No Binario', 'Prefiero no decir', 'Otro'];

        foreach ($genres as $genreName) {
            Genre::firstOrCreate(['name' => $genreName]);
        }
    }
}
