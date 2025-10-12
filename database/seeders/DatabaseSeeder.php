<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\UnitCareer;
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
        ProvinceSeeder::class,
        InstitutionSeeder::class,
        BankBranchSeeder::class,
        CivilStatusSeeder::class,
        NationalitySeeder::class,
        VulnerableGroupSeeder::class,
        LevelSeeder::class,
        CareerSeeder::class,
        UnitSeeder::class,
        UnitCareerSeeder::class,
        StateSeeder::class,
        AcademicPlanSeeder::class,
        ScholarshipAcademicPlanSeeder::class,
        GenreSeeder::class,
        CallSeeder::class,
    ]);
    }
}