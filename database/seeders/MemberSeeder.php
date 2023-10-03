<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            ['user_id'   => 7, 'created_by'=> 3],
            ['user_id'   => 8, 'created_by'=> 3],
            ['user_id'   => 9, 'created_by'=> 3],
            ['user_id'   => 10, 'created_by'=> 3],
            ['user_id'   => 11, 'created_by'=> 3],
            ['user_id'   => 12, 'created_by'=> 4],
            ['user_id'   => 13, 'created_by'=> 4],
            ['user_id'   => 14, 'created_by'=> 4],
            ['user_id'   => 15, 'created_by'=> 4],
            ['user_id'   => 16, 'created_by'=> 4]
        ]);
    }
}
