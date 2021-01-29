<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // permissions
        // admin page
        Permission::create(['name' => 'view admin']);

        // users
        Permission::create(['name' => 'manage users']);

        // roles
        Permission::create(['name' => 'manage roles']);

        //pages
        Permission::create(['name' => 'manage pages']);

        //menu
        Permission::create(['name' => 'manage menu']);

        //categories
        Permission::create(['name' => 'manage category']);

        // product
        Permission::create(['name' => 'manage product']);

        // recipe
        Permission::create(['name' => 'manage recipe']);

        // vacancy
        Permission::create(['name' => 'manage vacancy']);

        // tenders\purchases
        Permission::create(['name' => 'manage tender']);

        // qa
        Permission::create(['name' => 'manage review']);

        // news / post
        Permission::create(['name' => 'manage post']);

        // map
        Permission::create(['name' => 'manage map']);

        Permission::create(['name' => 'manage contact requests']);

        Permission::create(['name' => 'manage catalog requests']);

        Permission::create(['name' => 'manage tender requests']);

        Permission::create(['name' => 'manage vacancy inquirers']);

        Permission::create(['name' => 'manage manager mailing list']);

        $user = User::create([
            'name'     => 'Super-Admin',
            'email'    => 'email@domain.com',
            'password' => Hash::make('password')
        ]);

        $permissions = Permission::all();

        // create admin and assign role
        $adminRole = Role::create(['name' => 'admin', 'essential' => true]);
        $adminRole->givePermissionTo($permissions);

        $user->assignRole($adminRole);

        $dummyRole = Role::create(['name' => 'dummy']);
        $dummyRole->givePermissionTo($permissions->slice(0, $permissions->count() / 2));
    }
}
