<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $allPermissions = Permission::all();

        Role::updateOrCreate([
            'name' => 'Admin',
            'slug' => 'admin',
            'deletable' => false
        ])->permissions()
        ->sync($allPermissions->pluck('id'));

        Role::updateOrCreate([
            'name' => 'User',
            'slug' => 'user',
            'deletable' => false
        ]);



    }
}
