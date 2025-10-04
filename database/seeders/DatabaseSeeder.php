<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
        RolesAndPermissionsSeeder::class,
        UsersAndRolesSeeder::class,
        GenreSeeder::class,
        CivilStatusSeeder::class,
        NationalitySeeder::class,
        LevelSeeder::class,
        ProvinceSeeder::class,
        CallSeeder::class,
        ProvinceSeeder::class,
        VulnerableGroupSeeder::class
    ]);
    }
}