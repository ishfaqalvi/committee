<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'name'      	=> 'Super Admin',
            'email'     	=> 'superadmin@gmail.com',
            'password'  	=> 'password',
        ]);

        $admin = User::create([
            'name'          => 'Committee Application',
            'email'         => 'committe.application@gmail.com',
            'password'      => 'password',
        ]);

        $role = Role::create(['name' => 'Super Admin','guard_name' => 'web']);

        $role->syncPermissions(Permission::all());
        $superAdmin->assignRole(1);
        $admin->assignRole(1);
    }
}
