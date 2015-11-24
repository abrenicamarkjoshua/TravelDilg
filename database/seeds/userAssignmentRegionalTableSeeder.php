<?php

use Illuminate\Database\Seeder;

class userAssignmentRegionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         //
         DB::table('userAssignmentRegional')->delete();
         DB::table('userAssignmentRegional')->insert( [
            'user_id' => 1,
            'region_id' => 3

        ]
        
        );
    }
}
