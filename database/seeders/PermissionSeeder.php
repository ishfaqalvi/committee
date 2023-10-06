<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
      /**
      * Run the database seeds.
      *
      * @return void
      */
      public function run()
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

                  'committeeTypes-list',
                  'committeeTypes-view',
                  'committeeTypes-create',
                  'committeeTypes-edit',
                  'committeeTypes-delete',

                  'notifications-list',
                  'notifications-view',
                  'notifications-create',
                  'notifications-edit',
                  'notifications-delete',

                  'audits-list',
                  'audits-view',
                  'audits-create',
                  'audits-edit',
                  'audits-delete',

                  'logs-list',
                  'logs-view',
                  'logs-create',
                  'logs-edit',
                  'logs-delete',

                  'settings-list',
                  'settings-create',

                'appStrings-list',
                'appStrings-view',
                'appStrings-create',
                'appStrings-edit',
                'appStrings-delete',
            ];

            foreach ($permissions as $permission) {
                  Permission::create(['name' => $permission]);
            }
      }
}
