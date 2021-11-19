<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allMuduleAdmin = Module::updateOrCreate(['name'=>'Admin Dashboard']);

        Permission::updateOrCreate([
            'module_id' => $allMuduleAdmin->id,
            'name' => 'Access Dashboard',
            'slug' => 'app.dashboard'
        ]);

        $allMuduleRole = Module::updateOrCreate(['name'=>'Role Management']);
        Permission::updateOrCreate([
            'module_id' => $allMuduleRole->id,
            'name' => 'Access Role',
            'slug' => 'app.role.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $allMuduleRole->id,
            'name' => 'Create Role',
            'slug' => 'app.role.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $allMuduleRole->id,
            'name' => 'Edit Role',
            'slug' => 'app.role.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $allMuduleRole->id,
            'name' => 'Delete Role',
            'slug' => 'app.role.destroy'
        ]);
        
        $allMuduleUser = Module::updateOrCreate(['name'=>'User Management']);
        Permission::updateOrCreate([
            'module_id' => $allMuduleUser->id,
            'name' => 'Access User',
            'slug' => 'app.user.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $allMuduleUser->id,
            'name' => 'Create User',
            'slug' => 'app.user.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $allMuduleUser->id,
            'name' => 'Edit User',
            'slug' => 'app.user.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $allMuduleUser->id,
            'name' => 'Delete User',
            'slug' => 'app.user.destroy'
        ]);

    }
}
