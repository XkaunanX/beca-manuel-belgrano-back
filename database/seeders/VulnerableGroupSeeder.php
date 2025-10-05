<?php

namespace Database\Seeders;
use App\Models\VulnerableGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VulnerableGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            'Discapacidad',
            'Población indígena',
            'Ninguno'
        ];

        foreach ($groups as $groupName) {
            VulnerableGroup::firstOrCreate(['name' => $groupName]);
        }
    }
}
