<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $modules = [
            'dashboard',
            'patients',
            'doctors',
            'appointments',
            'consultations',
            'tests',
            'lab orders',
            'lab results',
            'billing',
            'accounts',
            'reports',
            'staff',
            'settings',
            'roles'
        ];

        foreach ($modules as $module) {
            Permission::firstOrCreate(['name' => "view $module"]);
            Permission::firstOrCreate(['name' => "create $module"]);
            Permission::firstOrCreate(['name' => "edit $module"]);
            Permission::firstOrCreate(['name' => "delete $module"]);
        }

        // create roles and assign created permissions
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        $roleDoctor = Role::firstOrCreate(['name' => 'Doctor']);
        $roleDoctor->givePermissionTo([
            'view dashboard', 
            'view appointments', 'create appointments', 'edit appointments',
            'view consultations', 'create consultations', 'edit consultations',
            'view patients'
        ]);

        $roleReceptionist = Role::firstOrCreate(['name' => 'Receptionist']);
        $roleReceptionist->givePermissionTo([
            'view dashboard', 
            'view patients', 'create patients', 'edit patients',
            'view appointments', 'create appointments', 'edit appointments',
            'view billing', 'create billing', 'edit billing'
        ]);

        $roleLabTech = Role::firstOrCreate(['name' => 'Lab Technician']);
        $roleLabTech->givePermissionTo([
            'view dashboard', 
            'view lab orders', 'create lab orders', 'edit lab orders',
            'view lab results', 'create lab results', 'edit lab results',
            'view tests'
        ]);

        // Find Admin user and assign role
        $adminUser = \App\Models\User::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('Admin');
        }
    }
}
