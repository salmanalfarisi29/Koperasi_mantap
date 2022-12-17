<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //// reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'reportStock']);
        Permission::create(['name' => 'view transaction']);
        Permission::create(['name' => 'reportStock']);

        //create roles and assign existing permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('products.create');
        $adminRole->givePermissionTo('create product');
        $adminRole->givePermissionTo('edit product');
        $adminRole->givePermissionTo('delete product');
        $adminRole->givePermissionTo('reportStock');
        $adminRole->givePermissionTo('view transaction');
        $adminRole->givePermissionTo('reportStock');

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view posts');
        $adminRole->givePermissionTo('create posts');
        $adminRole->givePermissionTo('edit posts');
        $adminRole->givePermissionTo('delete posts');
        $adminRole->givePermissionTo('publish posts');
        $adminRole->givePermissionTo('unpublish posts');

        $superadminRole = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule

        // create demo users
        $user = User::factory()->create([
            'name' => 'Example user',
            'email' => 'writer@qadrlabs.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($writerRole);

        $user = User::factory()->create([
            'name' => 'Example admin user',
            'email' => 'admin@qadrlabs.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($adminRole);

        $user = User::factory()->create([
            'name' => 'Example superadmin user',
            'email' => 'superadmin@qadrlabs.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($superadminRole);

    }
}
