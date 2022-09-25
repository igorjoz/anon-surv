<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // * reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // * create permissions - users & departments
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // * create roles and assign existing permissions
        $userRole = Role::create(['name' => 'user']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('edit users');
        $adminRole->givePermissionTo('delete users');

        // * Super-Admin role - gets all permissions via Gate::before rule; see AuthServiceProvider
        $superAdminRole = Role::create(['name' => 'Super-Admin']);
    }
}
