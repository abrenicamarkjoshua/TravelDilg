<?php

use Illuminate\Database\Seeder;

class positionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         //
         DB::table('position')->delete();
         DB::table('position')->insert([ 
        [
            'positionType' => "ELECTIVE",
            'position' => "GOVERNOR"

        ],[
            'positionType' => "ELECTIVE",
            'position' => "VICE GOVERNOR"

        ],[
            'positionType' => "ELECTIVE",
            'position' => "BOARD MEMBER"

        ],[
            'positionType' => "ELECTIVE",
            'position' => "MAYOR"

        ],[
            'positionType' => "ELECTIVE",
            'position' => "VICE MAYOR"

        ],[
            'positionType' => "ELECTIVE",
            'position' => "COUNCILOR"

        ],[
            'positionType' => "ELECTIVE",
            'position' => "BARANGGAY OFFICIALS"

        ]

        ]
        );
    }
}
