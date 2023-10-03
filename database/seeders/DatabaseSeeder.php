<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(CommitteeTypeSeeder::class);
        $this->call(CommitteeSeeder::class);
        $this->call(IntervalSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
