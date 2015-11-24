<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
class viewStrategy{
	public static function getApproveActions($department_id, $applicationForm, $mode = "view"){
		$output = "";
		$userauthority = userauthority::where('department_id', $department_id)->get()->first();
		$sendTo = "SEND TO USEC";
			
		if($userauthority){
			switch($department_id){	
				//blgs
				case 2:
					if($mode == "edit"){
						$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToUsec" class="pure-button pure-button-primary">SEND TO USEC</button>';
						$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToOsec" class="pure-button pure-button-primary">SEND TO OSEC</button>';
						$output .= '<button style = "margin-right:20px" type="submit" name = "btnInitialToUsec" class="pure-button pure-button-primary">INITIAL TO USEC</button>';
					}
				break;
				
				//usec
				case 4:
					$output .= '<button style = "margin-right:20px" type="submit" name = "approve" class="pure-button pure-button-primary">APPROVE</button>';
			
				break;

				//osec
				case 5:
					//nothing. cuz osec doesn't have the power to approve travel applications anymore
				break;

			}
			//if blgs,
			if($department_id == 2){
			

			}
			
			return $output;
		}

	}
	public static function TravelListAction($department, $application){
		$form = "";
		$action = "view"; //by default
		$btnName = "";
		$btnValue = "";
		$onclick = "";
		
		if($application->applicationstatus != "APPROVED"){
			switch($department){

				case "DILG PO":
				case "DILG RO":
				case "LGU":
						if($application->applicationstatus == "ON PROCESS USEC"  || $application->applicationstatus == "ON PROCESS OSEC"){
							return "";
						} else{
							//show drop button
							$action = 'remove';
							$btnName = 'btnremove';
							$btnValue = 'drop';
							if($department == "LGU" || $department == "DILG RO"){
								$onclick = "onclick=\"return confirm('Are you sure you want to delete this item?');\"";

							}

						}
					
					//else, don't show 'drop'
				
				break;
				case "BLGS":
					if($application->applicationstatus == "ON PROCESS USEC"  || $application->applicationstatus == "ON PROCESS OSEC"){
						return "";
					} else{
						//show drop button
						$action = 'edit';
						$btnName = 'btnedit';
						$btnValue = 'edit';
					}

				break;

				case "OSEC":
				case "USEC":
					if($application->applicationstatus == "ON PROCESS USEC" || $application->applicationstatus == "ON PROCESS OSEC"){
						//show drop button
							$action = 'view';
							$btnName = 'btnview';
							$btnValue = 'view';
							
					} else{
						return "";
					}
				break;
					
				default:
					return $form;
					break;
			}
			$form .= "<form action = '$action/$application->id' method = 'post'>";
			$form .= "<input type = 'submit' name = '$btnName' value = '$btnValue' $onclick/>";
			$form .= "<input type='hidden' name='_token' value='" . csrf_token() ."' />";
			$form .= "<input type = 'hidden' name = 'travelApplication_id' value = '$application->id' />";
          
			$form .= "</form>";
		}

		return $form;
	}
	public static function getRegionCode($region){
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
	public static function getRegionsOptions($inputregion = ""){
		$regions= regions::all();
		$output = "<option value = ''>Any region</option>";
		foreach($regions as $region){
			$selected = (isset($_POST['region']) && $_POST['region'] == $region->region) ? "selected":"";
			if($inputregion != ""){
				$selected = (isset($_POST['selectregion']) && $region->region == $_POST['selectregion']) ? "selected":( ($inputregion == $region->region) ? "selected":"" ); 
			}
			$output .= "<option " . $selected . " value = '" . $region->region . "'>" . $region->region . "</option>";
		}
		echo $output;
	}	
	// public static function getMunicipalityOptions($inputmunicipality){
	// 	$municipalities= municipalities::all();
	// 	$output = "<option value = ''>Any municipalities</option>";
	// 	foreach($municipalities as $municipality){
	// 		$selected = (isset($_POST['municipalities']) && $_POST['municipalities'] == $municipality->citymunDesc ) ? "selected":"";
	// 		if($inputmunicipality != ""){
	// 			$selected = (isset($_POST['selectmunicipality']) && $municipality->citymunDesc == $_POST['selectmunicipality']) ? "selected":( ($inputmunicipality == $municipality->citymunDesc) ? "selected":""); 
	// 		}
	// 		$output .= "<option " . $selected . " value = '" . $municipality->citymunDesc . "'>" . $municipality->citymunDesc . "</option>";
	// 	}
	// 	echo $output;
	// }
	public static function getMunicipalitiessOptions($province, $selectedValue = ""){
		$provCode = refprovince::where('provDesc', $province)->first()->provCode;

		$municipalities= municipalities::where('provCode', $provCode)->get();
		$output = "<option value = ''>Any municipalities</option>";
		foreach($municipalities as $municipality){
			$selected =  "";
			if(isset($_POST['municipality'])){
				if($_POST['municipality'] == $municipality->citymunDesc){
					$selected = " selected ";
				}
			}
			if($selectedValue != ""){
				if($selectedValue == $municipality->citymunDesc){
						$selected = " selected ";
				}	
			}
			$output .= "<option " . $selected . " value = '" . $municipality->citymunDesc . "'>" . $municipality->citymunDesc . "</option>";
		}
		echo $output;
	}
	public static function getAllMunicipalitiesOptions(){
		$municipalities = municipalities::orderBy('citymunDesc')->get();
		$selected = "";
		$output = "<option value = ''>Any municipality</option>";
		foreach($municipalities as $municipality){
			$selected = "";
			if(isset($_POST['municipality'])){
				if($_POST['municipality'] == $municipality->citymunDesc){
					$selected = "selected";
				}
			}
			$output .= "<option $selected value = '" . $municipality->citymunDesc . "'>" . $municipality->citymunDesc . "</option>";
		}
		return $output;
	}
	public static function getMunicipalitiessOptions2(){
		
		
			$output = "<option  value = ''></option>";
		
		echo $output;
	}
	// public static function getProvincesOptions($inputprovince = ""){
	// 	$provinces= provinces::all();
	// 	$output = "<option value = ''>Any provinces</option>";
	// 	foreach($provinces as $province){
	// 		$selected = (isset($_POST['province']) && $_POST['province'] == $province->province ) ? "selected":"";
	// 		if($inputprovince != ""){
	// 			$selected = (isset($_POST['selectprovince']) && $province->province == $_POST['selectprovince']) ? "selected":( ($inputprovince == $province->province) ? "selected":""); 
	// 		}
	// 		$output .= "<option " . $selected . " value = '" . $province->province . "'>" . $province->province . "</option>";
	// 	}

	// 	echo $output;
	// }
	public static function getAllRegionsOptions(){
		$regions = regions::all();
		$output = "<option value = ''>Any region</option>";
		foreach($regions as $region){
			$selected = "";
			if(isset($_POST['region'])){
				if($_POST['region'] == $region->region){
					$selected = " selected ";
				}
			}
			$output .= "<option $selected value = '$region->region'>$region->region</option>";
		}
		return $output;
	}
	public static function getAllProvincesOptions(){
		$provinces = provinces::all();
		$output = "<option value = ''>Any province</option>";
		foreach($provinces as $province){
			$selected = "";
			if(isset($_POST['province'])){
				if($_POST['province'] == $province->province){
					$selected = " selected ";
				}
			}
			$output .= "<option $selected value = '$province->province'>$province->province</option>";
		}
		return $output;
	}
	public static function getAllDepartmentsOptions(){
		$departments = department::all();
		$output = "<option value = ''>Any department</option>";
		foreach($departments as $department){
			$selected = "";
			if(isset($_POST['department'])){
				if($_POST['department'] == $department->department){
					$selected = " selected ";
				}
			}
			$output .= "<option $selected value = '$department->department'>$department->department</option>";
		}
		return $output;
	}

	public static function getAllAccountStatusOptions(){
		$statusCodes = ['active', 'not assigned', 'locked'];
		$output = "<option value = ''>Any status</option>";
		foreach($statusCodes as $statusCode){
			$selected = "";
			if(isset($_POST['accountstatus'])){
				if($_POST['accountstatus'] == $statusCode->statusCode){
					$selected = " selected ";
				}
			}
			$output .= "<option $selected value = '$statusCode'>$statusCode</option>";
		}
		return $output;
	}
		public static function getAllTravelStatusOptions(){
		$statusCodes = statusCode::all();
		$output = "<option value = ''>Any status</option>";
		foreach($statusCodes as $statusCode){
			$selected = "";
			if(isset($_POST['travelstatus'])){
				if($_POST['travelstatus'] == $statusCode->statusCode){
					$selected = " selected ";
				}
			}
			$output .= "<option $selected value = '$statusCode->statusCode'>$statusCode->statusCode</option>";
		}
		return $output;
	}
	public static function getProvincesOptions($region, $selectedValue = ""){
		$regCode = refregion::where('regDesc', $region)->first()->regCode;
		$provinces= refprovince::where('regCode', $regCode)->get();
		$output = "<option value = ''>Any provinces</option>";
		foreach($provinces as $province){
			$selected =  "";
			if(isset($_POST['province'])){
				if($_POST['province'] == $province->provDesc){
					$selected = " selected ";
				}
			}
			if($selectedValue != ""){
				if($selectedValue == $province->provDesc){
						$selected = " selected ";
				}	
			}
			$output .= "<option " . $selected . " value = '" . $province->provDesc . "'>" . $province->provDesc . "</option>";
		}

		echo $output;
	}
	
	public static function getDepartmentsOptions(){
		$departments= department::all();
		$output = "<option value = ''>Any department</option>";
		foreach($departments as $department){
			$selected = (isset($_POST['department']) && $_POST['department'] == $department->id) ? "selected":"";
			$output .= "<option " . $selected . " value = '" . $department->id . "'>" . $department->department . "</option>";
		}
		echo $output;

	}
	public static function getAccountStatusOptions(){
		$output = "<option value = ''>Any account status</option>";
		$selected = (isset($_POST['accountstatus']) && $_POST['accountstatus'] == 'active') ? "selected":"";
		$selected2 = (isset($_POST['accountstatus']) && $_POST['accountstatus'] == 'locked') ? "selected":"";
		$selected3 = (isset($_POST['accountstatus']) && $_POST['accountstatus'] == 'not assigned') ? "selected":"";
		$output .= "<option  $selected value = 'active'>active</option>";
		$output .= "<option $selected2 value = 'locked'>locked</option>";
		$output .= "<option $selected3 value = 'not assigned'>not assigned</option>";
		echo $output;
			
	}

}
?>