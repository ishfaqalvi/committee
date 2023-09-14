<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'      => 'Super Admin',
            'email'     => 'superadmin@gmail.com',
            'password'  => 'password'
        ]);

        $role = Role::create(['name' => 'Super Admin']);

       	$permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);

        $role->syncPermissions(Permission::whereIn('name',$permissions)->pluck('id')->toArray());
        $user->assignRole(1);
    }
}
