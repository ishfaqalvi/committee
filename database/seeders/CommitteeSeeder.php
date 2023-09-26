<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('committees')->insert([
            [
                'name'              => 'Committee A',
                'created_by'        => 3,
                'committee_type_id' => 1,
                'collection_days'   => 2,
                'amount'            => 500,
                'start_date'        => '2023-01-10',
                'description'       => 'Committee A is a mutual savings group where members contribute a fixed amount of money regularly to a communal fund, which is then awarded to one member at a time in a rotational manner. This committee aims to encourage savings and provide financial assistance, fostering a sense of community and mutual support amongst the members.',
            ],
            [
                'name'              => 'Committee B',
                'created_by'        => 3,
                'committee_type_id' => 2,
                'collection_days'   => 6,
                'amount'            => 500,
                'start_date'        => '2023-01-10',
                'description'       => 'Committee B is a mutual savings group where members contribute a fixed amount of money regularly to a communal fund, which is then awarded to one member at a time in a rotational manner. This committee aims to encourage savings and provide financial assistance, fostering a sense of community and mutual support amongst the members.',
            ]
        ]);   
    }
}
