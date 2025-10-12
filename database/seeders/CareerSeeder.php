<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            ['id' => 1], // puedes crear más si querés
            ['id' => 2],
            ['id' => 3],
        ];

        foreach ($careers as $career) {
            Career::updateOrCreate(['id' => $career['id']], $career);
        }
    }
}
