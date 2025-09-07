<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear Permisos
        $entitiesWithCrud = [
            'user',
            'role',
            'permission',
            'career',
            'unit',
            'institution',
            'academic_plan',
            'province',
            'bank_branch',
            'payments',
            'gender',
            'nationality',
            'civil_status',
            'vulnerable_group',
            'call',
            'renewal',
            'registration',
            'scolarship',
            'family_group',
            'family_member',
            'type',
            'job_category'
        ];

        foreach ($entitiesWithCrud as $entity) {
            Permission::create(['name' => "create {$entity}"]);
            Permission::create(['name' => "read {$entity}"]);
            Permission::create(['name' => "update {$entity}"]);
            Permission::create(['name' => "delete {$entity}"]);
        }


        // Crea roles y asigna permisos
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $editor = Role::create(['name' => 'reviewer']);
        $editor->givePermissionTo(['read payments', 'read call']);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['create registration', 'read registration',]);
    }
}