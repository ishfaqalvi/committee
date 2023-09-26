<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managerPermissions =
        [
            'members-list', 
            'members-view', 
            'members-create', 
            'members-edit', 
            'members-delete',

            'committees-list', 
            'committees-view', 
            'committees-create', 
            'committees-edit', 
            'committees-delete',

            'intervals-list', 
            'intervals-view', 
            'intervals-create', 
            'intervals-edit', 
            'intervals-delete',

            'payments-list', 
            'payments-view', 
            'payments-create', 
            'payments-edit', 
            'payments-delete',
        ];
        $managerRole = Role::create(['name' => 'Manager',   'guard_name' => 'web']);
        $managerRole->syncPermissions(Permission::whereIn('name',$managerPermissions)->pluck('id')->toArray());


        $memberPermissions =
        [
            'committees-list', 
            'committees-view',
            
            'payments-list', 
            'payments-view', 
            'payments-create', 
            'payments-edit', 
            'payments-delete',
        ];
        $memberRole = Role::create(['name' => 'Member',    'guard_name' => 'web']);
        $memberRole->syncPermissions(Permission::whereIn('name',$memberPermissions)->pluck('id')->toArray());
    }
}
