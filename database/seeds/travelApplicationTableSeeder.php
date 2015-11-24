<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
class travelApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('travelapplication')->delete();
		for($i = 0; $i <= 100 - 1; $i++){
		$data =	[
'status' => $this->pickStatus(),
'remarks' => '',
'region' => $this->pickRegion(),
'province' => $this->pickProvince(),
'firstname' =>  str_random(6),
'lastname' => str_random(6),
'middlename' => str_random(6),
'sex' => $this->pickSex(),
'suffix' => $this->pickSuffix(),
'birthdate' => '1993-05-21',
'position' => $this->pickPosition(),
'positionType' => "ELECTIVE",
'picture' => '',
'mobile' => mt_rand(9100000000, 9199999999),
'travelType' => $this->pickTravelType(),
'groupDelegation' => '',
'sponsor' => str_random(5),
'benefits' => str_random(5),
'flightinfo_country' => $this->pickCountry(),
'flightinfo_purpose' => str_random(5),
'flightinfo_datefrom' => '2016-05-21',
'flightinfo_dateto' => '2016-05-31',
'flightinfo_natureOfTravelRequested' => $this->pickNatureOfTravelRequested(),
'flightinfo_travelRequested' => $this->pickTravelRequested(),
'created_at' => date ("Y-m-d H:i:s")
        ];


          DB::table('travelapplication')->insert($data);

      }
    }

    public function pickStatus(){
        return App\statusCode::all()->random(1)->statusCode;
    }
    public function pickRegion(){
        return App\regions::all()->random(1)->region;
    }
    public  function pickTravelType(){
    	return App\travelType::all()->random(1)->travelType;
    }
    public  function pickPosition(){
    	return App\position::all()->random(1)->position;
    }
    public function pickProvince(){
		return App\provinces::all()->random(1)->province;
    }
    public function pickSex(){

    	$ran = ["male","female"];
    	return $ran[mt_rand(0, count($ran) - 1)];
    }
    public function pickSuffix(){
    	$ran = ["Sr","","Jr"];
    	return $ran[mt_rand(0, count($ran) - 1)];

    }
    public function pickCountry(){
    	return App\countries::all()->random(1)->country_name;
    }
    public function pickNatureOfTravelRequested(){
		$ran = ["Study(Scholarship Grants)","Non Study","Personal"];
    	return $ran[mt_rand(0, count($ran) - 1)];
    }
    public function pickTravelRequested(){
		$ran = ["Official Time","Official Business with Airfare"];
    	return $ran[mt_rand(0, count($ran) - 1)];
    }
}
