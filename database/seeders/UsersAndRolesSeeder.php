<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersAndRolesSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles si no existen
        $roles = ['user', 'admin', 'reviewer'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Crear usuario 'user'
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User',
                'password' => bcrypt('password'),
            ]
        );
        $user->assignRole('user');

        // Crear usuario 'admin'
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('admin');

        // Crear usuario 'reviewer'
        $reviewer = User::firstOrCreate(
            ['email' => 'reviewer@example.com'],
            [
                'name' => 'Reviewer',
                'password' => bcrypt('password'),
            ]
        );
        $reviewer->assignRole('reviewer');
    }
}
