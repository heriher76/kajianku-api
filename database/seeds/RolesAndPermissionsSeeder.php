<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         // give permissions
         Permission::create(['name' => 'register child']);
         Permission::create(['name' => 'get profile']);
         Permission::create(['name' => 'get other profile']);
         Permission::create(['name' => 'get all profile']);

         // or may be done by chaining
         $role = Role::create(['name' => 'parent'])
             ->givePermissionTo(['register child', 'get profile', 'get other profile', 'get all profile']);

         $role = Role::create(['name' => 'child'])
             ->givePermissionTo(['get profile', 'get other profile', 'get all profile']);
     }
}
