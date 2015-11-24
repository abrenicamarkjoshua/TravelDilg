<?php

use Illuminate\Database\Seeder;

class travelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('travelType')->delete();
         DB::table('travelType')->insert([ [
            'travelType' => "Individual"

        ],
        [
            'travelType' => "Group / Delegation"

        ]
        ]
        );
    }
}
