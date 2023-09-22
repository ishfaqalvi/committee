<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CommitteeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('committee_types')->insert([
            ['name' => 'Weekly',  'type' => '1 Week',  'duration_days' => '7'],
            ['name' => 'Monthly', 'type' => '1 Month', 'duration_days' => '30']
        ]);
    }
}
