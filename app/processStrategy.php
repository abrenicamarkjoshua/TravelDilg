<?php

namespace App;
use App\orderofapproval;
use Illuminate\Database\Eloquent\Model;
static class processStrategy{
	public static function processTravelApplication($user, $currentStatus, $travelApplication, $specificNextStatus = ""){
		if($specificNextStatus != ""){
			$travelApplication->applicationstatus = $specificNextStatus;
			$travelpplication->save();
		} else{
			$orderOfApproval = new orderofapproval();
			foreach($orderOfApproval as $approver){
				
			}

		}

	}
}

?>