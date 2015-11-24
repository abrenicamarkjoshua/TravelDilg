<?php

use Illuminate\Database\Seeder;

class statusCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('statusCode')->delete();
         DB::table('statusCode')->insert([ [
            'statusCode' => "ON PROCESS (BLGS)"

        ],
        [
            'statusCode' => "ON PROCESS USEC"

        ],
        
        [
            'statusCode' => "ON PROCESS OSEC"

        ],
        
        [
            'statusCode' => "SEE REMARKS"

        ],
        
        [
            'statusCode' => "APPROVED"

        ]
        ]
        );
    }
}
