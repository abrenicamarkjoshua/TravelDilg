<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $password = bcrypt('dilg2015');
         DB::table('users')->delete();
         DB::table('users')->insert([
            'name' => "blgs",
            'accountType_id' => 1,
            'password' => $password,
            'accountStatus' => "active",
            'lastname' => '',
            'firstname' => '',
            'middlename' => '',
            'suffix' => '',
            'department_id' => 2,
        ]);
         DB::table('users')->insert([
            'name' => "usec",
            'accountType_id' => 1,
            'password' => $password,
            'accountStatus' => "active",
            'lastname' => '',
            'firstname' => '',
            'middlename' => '',
            'suffix' => '',
            'department_id' => 4,
        ]);
         DB::table('users')->insert([
            'name' => "osec",
            'accountType_id' => 1,
            'password' => $password,
            'accountStatus' => "active",
            'lastname' => '',
            'firstname' => '',
            'middlename' => '',
            'suffix' => '',
            'department_id' => 5
        ]);
         DB::table('users')->insert([
            'name' => "immigration",
            'accountType_id' => 1,
            'password' => $password,
            'accountStatus' => "active",
            'lastname' => '',
            'firstname' => '',
            'middlename' => '',
            'suffix' => '',
            'department_id' => 6
        ]);

        $regions = DB::table('regions')->get();
        $department_id = 3; //dilg ro 
        foreach($regions as $region){
            //if ncr
            if($region->region == "NATIONAL CAPITAL REGION (NCR)"){
             DB::table('users')->insert([
                'name' => "DILG RO-" . $this->getRegionCode($region->region),
                'password' => $password,
                'department_id' => $department_id,
                'region' => $region->region,
                'accountStatus' => 'not assigned'
                ]);    
            }
            else{
             DB::table('users')->insert([
            'name' => "DILG RO-" . $this->getRegionCode($region->region),
            'password' => $password,
            'department_id' => $department_id,
            'region' => $region->region,
            'accountStatus' => 'not assigned'
            ]);
             }
        }//end foreach regions
         $provinces = DB::table('provinces')->get();
         $department_id = 1; //lgu
        foreach($provinces as $province){
            //lgu users (province)
            $region = DB::table('regions')->where('id', $province->region_id)->first();
             DB::table('users')->insert([
            'name' => 'lgu-' . $province->province,
            'password' => $password,
            'department_id' => $department_id,
            'region' => $region->region,
            'province' => $province->province,
            'accountStatus' => 'not assigned'
            ]);

             //dilg po users (province)
             $region = DB::table('regions')->where('id', $province->region_id)->first();
             DB::table('users')->insert([
            'name' => 'dilg po-' . $province->province,
            'password' => $password,
            'department_id' => 7, /* dilg po*/
            'region' => $region->region,
            'province' => $province->province,
            'accountStatus' => 'not assigned'
            ]);

         }//end foreach province

          //lgu users (municipalities)
             $municipalities = DB::table('refcitymun')->get();
             $department_id = 1; //lgu
            foreach($municipalities as $municipality){

                $province =DB::table('refprovince')->where('provCode',$municipality->provCode)->first();
                $region = DB::table('refregion')->where('regCode', $municipality->regDesc)->first();
                 DB::table('users')->insert([
                'name' => 'lgu-' . $municipality->citymunDesc,
                'password' => $password,
                'department_id' => $department_id,
                'region' => $region->regDesc,
                'province' => $province->provDesc,
                'municipality' => $municipality->citymunDesc,
                'accountStatus' => 'not assigned'
                ]);
            }
    }
    public function getRegionCode($region){
        switch($region){
            case "REGION I (ILOCOS REGION)":
                return "RI";
            break;
            case "REGION II (CAGAYAN VALLEY)":
                return "RII";
            break;
            case "REGION III (CENTRAL LUZON)":
                return "RIII";
            break;
            case "REGION IV-A (CALABARZON)":
                return "RIVA";
            break;
            case "REGION IV-B (MIMAROPA)":
                return "RIVB";
            break;
            case "REGION V (BICOL REGION)":
                return "RV";
            break;
            case "REGION VI (WESTERN VISAYAS)":
                return "RVI";
            break;
            case "REGION VII (CENTRAL VISAYAS)":
                return "RVII";
            break;
            case "REGION VIII (EASTERN VISAYAS)":
                return "RVIII";
            break;
            case "REGION IX (ZAMBOANGA PENINSULA)":
                return "RIX";
            break;
            case "REGION X (NORTHERN MINDANAO)":
                return "RX";
            break;
            case "REGION XI (DAVAO REGION)":
                return "RXI";
            break;
            case "REGION XII (SOCCSKSARGEN)":
                return "RXII";
            break;
            case "NATIONAL CAPITAL REGION (NCR)":
                return "NCR";
            break;
            case "CORDILLERA ADMINISTRATIVE REGION (CAR)":
                return "CAR";
            break;
            case "AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)":
                return "ARMM";
            break;
            case "REGION XIII (Caraga)":
                return "RXIII";
            break;
        }
    }
}
