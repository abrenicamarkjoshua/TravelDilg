<?php

use Illuminate\Database\Seeder;

class AccountTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //
         DB::table('accountType')->delete();
         DB::table('accountType')->insert([ [
            'accountType' => "admin",
            'accessibleLinks' => 
                "'links' : {
                    '0' : 'admin/console',
                    '1' : 'travels',
                    '2' : 'dilg-ro/travels'
                }
                "

        ],
        [
            'accountType' => "TA-regionalFocalPerson",
            'accessibleLinks' => 
                "'links' : {
                    '0' : 'travels',
                    '1' : '',
                    '2' : 'dilg-ro/travels'
                }
                "

        ],
        [
            'accountType' => "TA-provincialFocalPerson",
            'accessibleLinks' => 
                "'links' : {
                    '0' : 'travels',
                    '1' : '',
                    '2' : 'dilg-ro/travels'
                }
                "

        ]
        ]
        );
    }
}
