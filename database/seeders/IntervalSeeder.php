<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class IntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('intervals')->insert([
            ['committee_id' => 1, 'user_id' => 2, 'order' => 1, 'status' => 'Active'],
            ['committee_id' => 1, 'user_id' => 3, 'order' => 2, 'status' => 'Pending'],
            ['committee_id' => 2, 'user_id' => 2, 'order' => 1, 'status' => 'Active'],
            ['committee_id' => 2, 'user_id' => 3, 'order' => 2, 'status' => 'Pending'],
        ]);
    }
}
