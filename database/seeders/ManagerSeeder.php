<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;


class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'          => 'Manager 1',
                'email'         => 'manager1@example.com',
                'mobile_number' => '03001234560',
                'password'      => 'password',
            ],
            [
                'name'          => 'Manager 2',
                'email'         => 'manager2@example.com',
                'mobile_number' => '03001234561',
                'password'      => 'password',
            ],
            [
                'name'          => 'Manager 3',
                'email'         => 'manager3@example.com',
                'mobile_number' => '03001234562',
                'password'      => 'password',
            ],
            [
                'name'          => 'Manager 4',
                'email'         => 'manager4@example.com',
                'mobile_number' => '03001234563',
                'password'      => 'password',
            ],
        ];

        foreach($users as $user){
            $manager = User::create($user);
            $manager->assignRole(2);
        }
    }
}
