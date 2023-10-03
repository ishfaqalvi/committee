<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managers = [
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

        foreach($managers as $manager){
            $user = User::create($manager);
            $user->assignRole(2);
        }

        $members = [
            [
                'name'          => 'Member 1',
                'email'         => 'member1@example.com',
                'mobile_number' => '1234567890',
                'password'      => 'password'
            ],
            [
                'name'          => 'Member 2',
                'email'         => 'member2@example.com',
                'mobile_number' => '1234567891',
                'password'      => 'password'
            ],
            [
                'name'          => 'Member 3',
                'email'         => 'member3@example.com',
                'mobile_number' => '1234567892',
                'password'      => 'password'
            ],
            [
                'name'          => 'Member 4',
                'email'         => 'member4@example.com',
                'mobile_number' => '1234567893',
                'password'      => 'password'
            ],
            [
                'name'          => 'Member 5',
                'email'         => 'member5@example.com',
                'mobile_number' => '1234567894',
                'password'      => 'password'
            ],

            [
                'name'          => 'Member 6',
                'email'         => 'member6@example.com',
                'mobile_number' => '1234567895',
                'password'      => 'password'
            ],
            [
                'name'          => 'Member 7',
                'email'         => 'member7@example.com',
                'mobile_number' => '1234567896',
                'password'      => 'password'
            ],
            [
                'name'          => 'Member 8',
                'email'         => 'member8@example.com',
                'mobile_number' => '1234567897',
                'password'      => 'password'
            ],
            [
                'name'          => 'Member 9',
                'email'         => 'member9@example.com',
                'mobile_number' => '1234567898',
                'password'      => 'password'
            ],
            [
                'name'          => 'Member 10',
                'email'         => 'member10@example.com',
                'mobile_number' => '1234567899',
                'password'      => 'password'
            ],
        ];

        foreach($members as $member){
            $user = User::create($member);
            $user->assignRole(3);
        }
    }
}
