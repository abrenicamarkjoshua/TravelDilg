<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
class accountsStrategy{
	public static function determinePositionType($position){
		$test = position::where('position', $position)->firstOrFail()->positionType;
		if($test){
			return $test;
		} else{
			return "NON ELECTIVE";
		}
	}
	public static function determineDepartment($id){
		
		return department::where('id', $id)->firstOrFail()->department;
	}
	public static function findRegionIdByName($name){
		return regions::where('region', $name)->firstOrFail()->id;
		
	}	

}
?>