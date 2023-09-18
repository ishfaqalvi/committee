<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
          'roles-list', 
          'roles-view', 
          'roles-create', 
          'roles-edit', 
          'roles-delete',

          'users-list', 
          'users-view', 
          'users-create', 
          'users-edit', 
          'users-delete',

          'audit-list', 
          'audit-view', 
          'audit-create', 
          'audit-edit', 
          'audit-delete',

          'log-list', 
          'log-view', 
          'log-create', 
          'log-edit', 
          'log-delete',

          'settings-list',
          'settings-create',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
