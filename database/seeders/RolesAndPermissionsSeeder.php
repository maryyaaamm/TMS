<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions if they don't exist
        $permissions = ['create tasks', 'edit tasks', 'delete tasks', 'assign tasks', 'change task status'];

        foreach ($permissions as $permission) {
            if (Permission::where('name', $permission)->doesntExist()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Create Superadmin role and assign all permissions if not exists
        if (Role::where('name', 'superadmin')->doesntExist()) {
            $superAdminRole = Role::create(['name' => 'superadmin']);
            $superAdminRole->givePermissionTo(Permission::all());
        }

        // Create User role with limited permissions if not exists
        if (Role::where('name', 'user')->doesntExist()) {
            $userRole = Role::create(['name' => 'user']);
            $userRole->givePermissionTo(['change task status']);
        }
    }
}
