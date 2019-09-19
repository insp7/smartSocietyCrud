<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Insider']);
        Role::create(['name' => 'Outsider']);
        Role::create(['name' => 'Criminal']);
    }
}
