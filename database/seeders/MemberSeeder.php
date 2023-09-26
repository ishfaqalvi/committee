<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class MemberSeeder extends Seeder
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
                'name'          => 'Member 1',
                'email'         => 'member1@example.com',
                'mobile_number' => '1234567890',
                'password'      => 'password',
                'created_by'    => 3
            ],
            [
                'name'          => 'Member 2',
                'email'         => 'member2@example.com',
                'mobile_number' => '1234567891',
                'password'      => 'password',
                'created_by'    => 3
            ],
            [
                'name'          => 'Member 3',
                'email'         => 'member3@example.com',
                'mobile_number' => '1234567892',
                'password'      => 'password',
                'created_by'    => 3
            ],
            [
                'name'          => 'Member 4',
                'email'         => 'member4@example.com',
                'mobile_number' => '1234567893',
                'password'      => 'password',
                'created_by'    => 3
            ],
            [
                'name'          => 'Member 5',
                'email'         => 'member5@example.com',
                'mobile_number' => '1234567894',
                'password'      => 'password',
                'created_by'    => 3
            ],

            [
                'name'          => 'Member 6',
                'email'         => 'member6@example.com',
                'mobile_number' => '1234567895',
                'password'      => 'password',
                'created_by'    => 4
            ],
            [
                'name'          => 'Member 7',
                'email'         => 'member7@example.com',
                'mobile_number' => '1234567896',
                'password'      => 'password',
                'created_by'    => 4
            ],
            [
                'name'          => 'Member 8',
                'email'         => 'member8@example.com',
                'mobile_number' => '1234567897',
                'password'      => 'password',
                'created_by'    => 4
            ],
            [
                'name'          => 'Member 9',
                'email'         => 'member9@example.com',
                'mobile_number' => '1234567898',
                'password'      => 'password',
                'created_by'    => 4
            ],
            [
                'name'          => 'Member 10',
                'email'         => 'member10@example.com',
                'mobile_number' => '1234567899',
                'password'      => 'password',
                'created_by'    => 4
            ],
        ];

        foreach($users as $user){
            $member = User::create($user);
            $member->assignRole(3);
        }
    }
}
