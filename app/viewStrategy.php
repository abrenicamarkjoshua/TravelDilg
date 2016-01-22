<?php


namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
class viewStrategy{
	public static function getApproveActions($department_id, $applicationForm, $mode = "view", $accountType = ""){
		$output = "";
		$userauthority = userauthority::where('department_id', $department_id)->get()->first();
		$sendTo = "SEND TO USEC";
			
		if($userauthority){
			switch($department_id){	
				//blgs
				case 2:
					if($accountType == ""){
						if($mode == "edit"){
							$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToUsec" class="pure-button pure-button-primary">FORWARD TO USEC</button>';
							$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToOsec" class="pure-button pure-button-primary">FORWARD TO OSEC</button>';
							$output .= '<button style = "margin-right:20px" type="submit" name = "btnInitialToUsec" class="pure-button pure-button-primary">INITIAL TO USEC</button>';
						}
					} else{
						switch($accountType){
							case 4:
							case 5:
							case 6:
							case 7:
								$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToBLGSDivisionChief" class="pure-button pure-button-primary">Send to BLGS Division Chief</button>';
								
							break;

							case 8:
								$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToBLGSStaff" class="pure-button pure-button-primary">Send to BLGS staff</button>';
								$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToBLGSDirector" class="pure-button pure-button-primary">Send to BLGS Director</button>';
								
							break;

							case 9:
								$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToUsec" class="pure-button pure-button-primary">FORWARD TO USEC</button>';
								$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToOsec" class="pure-button pure-button-primary">FORWARD TO OSEC</button>';
								$output .= '<button style = "margin-right:20px" type="submit" name = "btnInitialToUsec" class="pure-button pure-button-primary">INITIAL TO USEC</button>';
								$output .= '<button style = "margin-right:20px" type="submit" name = "btnSendToBLGSDivisionChief" class="pure-button pure-button-primary">Send to BLGS Division Chief</button>';
								
							break;
						}
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
		
		if($application->applicationstatuscode() != "APPROVED"){
			$onclick = "";
			switch($department){

				case "DILG PO":
				case "DILG RO":
				case "LGU":
						if($application->applicationstatus_id == 4  || $application->applicationstatus_id == 5){
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
					$form .= "<form  action = '$action/$application->id' method = 'post'>";
					$form .= "<input type = 'submit' name = '$btnName' value = '$btnValue' $onclick/>";
				break;
				case "BLGS":
					if($application->applicationstatus_id == 4  || $application->applicationstatus_id == 5){

						return "<textarea id = 'remarks".$application->id."' onchange='saveRemarks".$application->id."(this);' style = 'padding: 0px; margin: 0px; width: 257px; height: 54px;'>".$application->remarks."</textarea>";
					} else{
						switch($application->applicationstatus_id){
							case 1:
								if(Auth::user()->accountType_id == 4  || Auth::user()->accountType_id == 5  || Auth::user()->accountType_id == 6  || Auth::user()->accountType_id == 7){
									$action = 'edit';
									$btnName = 'btnedit';
									$btnValue = 'edit';
									$form .= "<form  action = '$action/$application->id' method = 'post'>";
									$form .= "<input type = 'submit' name = '$btnName' value = '$btnValue' $onclick/>";
								}
							break;

							case 2:
								if(Auth::user()->accountType_id == 8){
									$action = 'edit';
									$btnName = 'btnedit';
									$btnValue = 'edit';
									$form .= "<form  action = '$action/$application->id' method = 'post'>";
									$form .= "<input type = 'submit' name = '$btnName' value = '$btnValue' $onclick/>";
								}
							break;

							case 3:
								if(Auth::user()->accountType_id == 9){
									$action = 'edit';
									$btnName = 'btnedit';
									$btnValue = 'edit';
									$form .= "<form  action = '$action/$application->id' method = 'post'>";
									$form .= "<input type = 'submit' name = '$btnName' value = '$btnValue' $onclick/>";
								}
							break;

						}
						
					}

				break;

				case "OSEC":
				case "USEC":
					if($application->applicationstatus_id == 4 || $application->applicationstatus_id == 5){
						//show drop button
							$action = 'approve';
							$btnName = 'btnApprove';
							$btnValue = 'approve';
							$onclick = "onclick=\"return confirm('Are you sure you want to approve this document?');\"";
							$form .= "<form  action = '$action/$application->id' method = 'post'>";
							$form .= "<input type = 'submit' name = '$btnName' value = '$btnValue' $onclick/>";
							
					} else{
						return "";
					}
				break;
					
				default:
					return $form;
					break;
			}
			
			
			$form .= "<input type='hidden' name='_token' value='" . csrf_token() ."' />";
			$form .= "<input type = 'hidden' name = 'travelApplication_id' value = '$application->id' />";
          
			$form .= "</form>";
			if($application->applicationstatus_id != 6){
				$form .= "<textarea id = 'remarks".$application->id."' onchange='saveRemarks".$application->id."(this);' style = 'padding: 0px; margin: 0px;  width: 257px; height: 54px;'>".$application->remarks."</textarea>";
			}
			
		}
		else{
			if($department == "BLGS"){
				$form .= "<textarea id = 'remarks".$application->id."' onchange='saveRemarks".$application->id."(this);' style = 'padding: 0px; margin: 0px;  width: 257px; height: 54px;'>".$application->remarks."</textarea>";
			
			}
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
		$output = "<option value = ''>Any province/City</option>";
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
				if($_POST['accountstatus'] == $statusCode){
					$selected = " selected ";
				}
			}
			$output .= "<option $selected value = '$statusCode'>$statusCode</option>";
		}
		return $output;
	}
	public static function getAllTravelStatusOptions($department = "", $accountType_id = ""){
		$statusCodes = statusCode::all();
		$output = "<option value = ''>Any status</option>";
		foreach($statusCodes as $statusCode){
			$selected = "";
			if(isset($_POST['travelstatus'])){
				if($_POST['travelstatus'] == $statusCode->id){
					$selected = " selected ";
				}
			}
			switch($department){

			}
			if($department == "USEC" || $department == "OSEC"){
				if($statusCode->id < 4){
					continue;
				}
			}
			$output .= "<option $selected value = '$statusCode->id'>$statusCode->statusCode</option>";
		}
		switch($department){
			case "IMMIGRATION":
				$output = "
				<option selected value = 'APPROVED'>APPROVED</option>
				";
				return $output;
			break;
		}
		
		return $output;
	}
	public static function getProvincesOptions($region, $selectedValue = ""){
		$regCode = refregion::where('regDesc', $region)->first()->regCode;
		$provinces= refprovince::where('regCode', $regCode)->get();
		$output = "<option value = ''>choose province</option>";
		if($region == "NATIONAL CAPITAL REGION (NCR)"){
		$output = "<option value = ''>choose city</option>";
	
		}
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
	public static function getAccountInfo(){
		$region = (Auth::user()->region) ? ("Region: " . Auth::user()->region . "<br/>") : "";
		$provinceOrDistrict = (Auth::user()->region == "NATIONAL CAPITAL REGION (NCR)") ? "District: " : "Province ";
		$province = (Auth::user()->province) ? ($provinceOrDistrict . Auth::user()->province."<br>") : "" ;
		$municipality = (Auth::user()->municipality) ? ("Municipality: ".Auth::user()->municipality."<br>") : "" ;
		date_default_timezone_set("Asia/Manila");
		$today = date("Y-m-d");
		$department = accountsStrategy::determineDepartment(Auth::user()->department_id);
		$dept = 'Department: <label id = "mydepartment">'.$department.'';
		$output = 
		'
		Logged in as: '.Auth::user()->lastname . ', ' . Auth::user()->firstname . '</br>
           
            '.$region.'
            '.$province.'
            '.$municipality.'
           <br>
            Date today: '.$today.'<br/>

            '.$dept.'
            ';
		return $output;
	}
}
?>