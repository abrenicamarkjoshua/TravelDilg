<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('regions')->delete();
         DB::table('regions')->insert([ [
            'region' => "REGION I (ILOCOS REGION)"

        ],[
            'region' => "REGION II (CAGAYAN VALLEY)"

        ],[
            'region' => "REGION III (CENTRAL LUZON)"

        ],[
            'region' => "REGION IV-A (CALABARZON)"

        ],[
            'region' => "REGION IV-B (MIMAROPA)"

        ],[
            'region' => "REGION V (BICOL REGION)"

        ],[
            'region' => "REGION VI (WESTERN VISAYAS)"

        ],[
            'region' => "REGION VII (CENTRAL VISAYAS)"

        ],[
            'region' => "REGION VIII (EASTERN VISAYAS)"

        ],[
            'region' => "REGION IX (ZAMBOANGA PENINSULA)"

        ],[
            'region' => "REGION X (NORTHERN MINDANAO)"

        ],[
            'region' => "REGION XI (DAVAO REGION)"

        ],[
            'region' => "REGION XII (SOCCSKSARGEN)"

        ],[
            'region' => "NATIONAL CAPITAL REGION (NCR)"

        ],[
            'region' => "CORDILLERA ADMINISTRATIVE REGION (CAR)"

        ],[
            'region' => "AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)"

        ],[
            'region' => "REGION XIII (Caraga)"

        ]
        ]
        );
    }
}
