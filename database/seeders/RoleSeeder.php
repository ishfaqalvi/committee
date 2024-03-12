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
            'committees-publish',
            'committees-delete',

            'committeeMembers-list',
            'committeeMembers-create',
            'committeeMembers-edit',
            'committeeMembers-delete',

            'committeeSubmission-list',
            'committeeSubmission-reminder',
            'committeeSubmission-received',

            'committeePayment-list',
            'committeePayment-approve',
            'committeePayment-reject',

            'payments-list',
            'payments-create',
            'payments-delete',
        ];
        $managerRole = Role::create(['name' => 'Manager',   'guard_name' => 'web']);
        $managerRole->syncPermissions(Permission::whereIn('name',$managerPermissions)->pluck('id')->toArray());


        $memberPermissions =
        [
            'committees-list', 
            'committees-view',

            'committeeMembers-list',

            'committeeSubmission-list',

            'committeePayment-list',

            'payments-list',
            'payments-create',
            'payments-delete',
        ];
        $memberRole = Role::create(['name' => 'Member',    'guard_name' => 'web']);
        $memberRole->syncPermissions(Permission::whereIn('name',$memberPermissions)->pluck('id')->toArray());
    }
}
