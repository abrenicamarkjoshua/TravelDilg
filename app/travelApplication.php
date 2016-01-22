<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class travelApplication extends Model{
	protected $table = 'travelapplication';
	 protected $fillable = [
	 'applicationstatus_id',
	 'remarks',
	 'region',
	 'province',
	 'municipality',
	 'firstname',
	 'lastname',
	 'middlename',
	 'sex',
	 'suffix',
	 'birthdate',
	 'positionType',
	 'position',
	 'picture',
	 'mobile',
	 'travelType',
	 'groupDelegation',
	 'sponsor',
	 'benefits',
	 'flightinfo_country',
	 'flightinfo_purpose',
	 'flightinfo_datefrom',
	 'flightinfo_dateto',
	 'flightinfo_natureOfTravelRequested',
	 'flightinfo_travelRequested',
	 'created_at',
	 'dateapproved',
	 'entitlements',
	 'copyFurnished',
	 'email',
	 'applyEntitlements',
	 'encodedBy',
	 'InitialToUsec'
	 ];
	 public function applicationstatuscode(){
	 	if($this->applicationstatus_id == null){
	 		return;
	 	} else{
	 		$output = statusCode::find($this->applicationstatus_id);
	 		return $output->statusCode;
	 	}
	 }
}
?>