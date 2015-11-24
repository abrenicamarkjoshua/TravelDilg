<?php
namespace App\Http\Controllers;
use Illuminate\View\View;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\countries;
use App\refprovince;
use App\provinces;
use App\refregion;
use App\refcitymun;
use App\travelApplication;
use App\position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\loginStrategy;
use Auth;
use App\accountsStrategy;
use App\links;
use App\department;
use App\accountaccessiblelinks;
use App\attachedDocuments;
class HomeController extends Controller{
	protected $links;
	protected $countries;
	protected $regions;
	protected $region;
	protected $chooseProvince;
	protected $provinces;
	
	protected $department;
	protected $data;
	protected $travelApplications;
	protected $title = "";
	protected $chooseMunicipalities;
	protected $travelApplication_id;
	public function __construct(){

		date_default_timezone_set("Asia/Manila");
		$accessibles = accountaccessiblelinks::where("department_id", Auth::user()->department_id )->get(); 
		$collection = array();
		foreach($accessibles as $accessible){
			array_push($collection, $accessible->link_id);

		}
		$this->countries = countries::all();
		if(Auth::user()->province){
			$this->region = Auth::user()->region;
		} else{
			//user is not lgu/dilg ro
		}
		$this->chooseProvince = "<select name = 'province'>";
		if(Auth::user()->province){
			foreach(provinces::where("region_id", accountsStrategy::findRegionIdByName(Auth::user()->region))->get() as $province){
				$this->chooseProvince .= "<option value = '{$province->province}'>{$province->province}</option>";
			}
		}
		$this->chooseProvince .= "</select>";
		$this->provinces = (Auth::user()->province) ? Auth::user()->province : $this->chooseProvince;
		$this->department = accountsStrategy::determineDepartment(Auth::user()->department_id);
		$this->links = links::whereIn('id', $collection )->orderBy("id", "desc")->get();
		
		$matchThese = [];
		if(Auth::user()->province){
			$matchThese["province"]= Auth::user()->province;
		}
		if(Auth::user()->region){
			$matchThese["region"] = Auth::user()->region;
		}
		switch(Auth::user()->department_id){
			case 1:
				//lgu. see all. because lgu needs to see status and remarks
				
			break;
			case 2:
				//blgs
				//see only 'ON PROCESS (BLGS)' for correcting/giving remarks
				$matchThese["applicationstatus"] = "ON PROCESS (BLGS)";
			break;
			case 3:
				//DILGRO

				//same as lgu.
				break;
			case 4:
				//USEC                                    
				$matchThese["applicationstatus"] = "ON PROCESS USEC";
				break;
			case 5:
				//OSEC
				$matchThese["applicationstatus"] = "ON PROCESS OSEC";
				$matchThese["position"] = "GOVERNOR";
				break;
			case 6:
				//IMMIGRATION
				$matchThese["applicationstatus"] = "ON PROCESS IMMIGRATION";
				
			break;
		} 

		$travelApplications = travelApplication::where($matchThese)->orderBy('created_at', 'desc')->get();
		$this->data['municipalities'] = "";
		foreach(refcitymun::get() as $municipality){
			$this->data['municipalities'] .= "<option value = '" . $municipality->citymunDesc . "''>" . $municipality->citymunDesc . "</option>";
			
		}
		$this->data =
		[
			'links' => $this->links,
			'travelApplications' => $travelApplications,

			'department' => $this->department,
			'countries' => $this->countries,
			'region' => $this->region,
			'provinces' => $this->provinces,
		];
	}
	public function getAdminConsoleUsers(){
		$this->data['title'] = "Users";
		$users = User::all();
		$this->data['useraccounts'] = $users;
		$this->data['post'] = [];	
		//security check/account validation goes here
		return view('adminConsoleUsers',$this->data);
	}

	public function postAdminConsoleUsers(){
		$this->data['title'] = "Users";
		$this->data['post'] = [];
		if(isset($_POST['search'])){
			if(trim($_POST['username']) != ""){
				$this->data['post']['name'] = $_POST['username'];
			}
			if(trim($_POST['region']) != ""){
				$this->data['post']['region'] = $_POST['region'];
			}
			if(trim($_POST['province']) != ""){
				$this->data['post']['province'] = $_POST['province'];
			}
			if($_POST['department'] != 0){
				$this->data['post']['department_id'] = $_POST['department'];
			}
			
			if($_POST['accountstatus'] != ''){
				$this->data['post']['accountStatus'] = $_POST['accountstatus'];
			}
			if($_POST['municipality'] != ''){
				$this->data['post']['municipality'] = $_POST['municipality'];
			}
			
		}

		$users = User::where($this->data['post'])->get();
		$this->data['useraccounts'] = $users;
		//security check/account validation goes here
		return view('adminConsoleUsers',$this->data);
	}

	//save user or got here by form submit.
	public function postEditUser($id){
		$this->data['title'] = "Edit user";
		$user = User::find($id);
		$this->data['useraccount'] = $user;
		$this->data['post'] = [
			'lastname' => (isset($_POST['lastname'])) ? ($_POST['lastname']): "",
			'firstname' => (isset($_POST['firstname'])) ? ($_POST['firstname']): "",
			'middlename' => (isset($_POST['middlename'])) ? ($_POST['middlename']): "",
			'accountStatus' => (isset($_POST['accountstatus'])) ? ($_POST['accountstatus']): "",
			'name' => (isset($_POST['name'])) ? ($_POST['name']): "",
			'email' => (isset($_POST['email'])) ? ($_POST['email']): "",
			'contactnumber' => (isset($_POST['contactnumber'])) ? $_POST['contactnumber'] : ""
			
		];
		$this->data['nextForm'] = $this->UserdetermineNextForm($id);
		$this->data['previousForm'] = $this->UserdeterminePreviousForm($id);

		if(isset($_POST['save'])){
			$user->update($this->data['post']);
		}
		//todo: security check/account validation goes here
		return view('edituser',$this->data);
	}
	public function getEditUser($id){
		$this->data['title'] = "Edit user";
		$user = User::find($id);
		$this->data['useraccount'] = $user;

		$this->data['nextForm'] = $this->UserdetermineNextForm($id);
		$this->data['previousForm'] = $this->UserdeterminePreviousForm($id);

		$this->data['post'] = [
			'lastname' => (isset($_POST['lastname'])) ? ($_POST['lastname']): "",
			'firstname' => (isset($_POST['firstname'])) ? ($_POST['firstname']): "",
			'middlename' => (isset($_POST['middlename'])) ? ($_POST['middlename']): "",
			'accountStatus' => (isset($_POST['accountstatus'])) ? ($_POST['accountstatus']): "",
			'name' => (isset($_POST['name'])) ? ($_POST['name']): "",
			'email' => (isset($_POST['email'])) ? ($_POST['email']): ""
			
		];

		//todo: security check/account validation goes here
		return view('edituser',$this->data);
	}
	//FOR USEC
	public function postApproveTravel($id){
		
		$this->data['nextForm'] = $this->determineNextForm($id);
		$this->data['previousForm'] = $this->determinePreviousForm($id);
		
		$travelApplication = travelApplication::find($id);
		if (trim($travelApplication->applicationstatus) == "ON PROCESS USEC") {
			$update = [];
			
			$update['applicationstatus'] = "APPROVED";
			date_default_timezone_set("Asia/Manila");
			$update['dateapproved'] = date("Y-m-d H:i:s");
			$travelApplication->update($update);
		}
		

		return redirect("view/$travelApplication->id");
	}
	public function postSendToUsec($id){
		
		$this->data['nextForm'] = $this->determineNextForm($id);
		$this->data['previousForm'] = $this->determinePreviousForm($id);
		
		$travelApplication = travelApplication::find($id);
		if (trim($travelApplication->applicationstatus) == "ON PROCESS (BLGS)") {
			$update = [];
			
			$update['applicationstatus'] = "ON PROCESS USEC";
			$travelApplication->update($update);
		}
		

		return redirect("view/$travelApplication->id");
	}
	public function postSendToOsec($id){
		
		$this->data['nextForm'] = $this->determineNextForm($id);
		$this->data['previousForm'] = $this->determinePreviousForm($id);
		
		$travelApplication = travelApplication::find($id);
		if (trim($travelApplication->applicationstatus) == "ON PROCESS (BLGS)") {
			$update = [];
			
			$update['applicationstatus'] = "ON PROCESS OSEC";
			$travelApplication->update($update);
		}
		

		return redirect("view/$travelApplication->id");
	}
	public function postInitialToUsec($id){

		$this->data['nextForm'] = $this->determineNextForm($id);
		$this->data['previousForm'] = $this->determinePreviousForm($id);
		
		$travelApplication = travelApplication::find($id);
		if (trim($travelApplication->applicationstatus) == "ON PROCESS (BLGS)") {
			$update = [];
			
			$update['applicationstatus'] = "ON PROCESS USEC";
			$update['InitialToUsec'] = true;
			
			$travelApplication->update($update);
		}
		

		return redirect("view/$travelApplication->id");	
	}
	public function getViewApplication($id){
		$applicationForm = travelApplication::find($id);
		$statusMatch = [];
		if(Auth::user()->department_id == 1 || Auth::user()->department_id == 3){
			return "Your account is not permitted to see this record";
		}
		$this->data['post'] = [];
		$this->data['nextForm'] = $this->determineNextForm($id);
		$this->data['previousForm'] =  $this->determinePreviousForm($id);
		$this->data['applicationForm'] = $applicationForm;
		$this->data['region'] = $applicationForm->region;
		$this->data['province'] = $applicationForm->province;
		

		$applicationEntitlements = $applicationForm->entitlements;
				

				if(stripos($applicationEntitlements, 'with entitlements')){
					$this->data['withEntitlements'] = "checked";
				}
				else{
				
					$this->data['withEntitlements'] = "checked";	
				}
				if(stripos($applicationEntitlements, 'payment of international airfare (economy)')){
					$this->data['paymentOfInternationalAirfareSelected'] = "checked";
				}
				else{
					$this->data['paymentOfInternationalAirfareSelected'] = "";
					
				}
				if(stripos($applicationForm, 'with travel allowance')){
					$this->data['withTravelAllowanceRadio'] = "checked";
				}
				else{
					$this->data['withTravelAllowanceRadio'] = "";	
				}

				if(stripos($applicationForm,"20% travel allowance" )){
					$this->data['twentyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['twentyPercentTravelAllowance'] = "";
				}
				if(stripos($applicationForm,"30% travel allowance" )){
					$this->data['thirtyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['thirtyPercentTravelAllowance'] = "";
				}
				
				if(stripos($applicationForm,"50% travel allowance" )){
					$this->data['fiftyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['fiftyPercentTravelAllowance'] = "";
				}
				
				if(stripos($applicationForm,"meals" )){
					$this->data['meals'] = "checked";	
				}else{

					$this->data['meals'] = "";
				}
				if(stripos($applicationForm,"hotel" )){
					$this->data['hotel'] = "checked";	
				}else{

					$this->data['hotel'] = "";
				}

				if(stripos($applicationForm,"incidental" )){
					$this->data['incidental'] = "checked";	
				}else{

					$this->data['incidental'] = "";
				}

				
				if(stripos($applicationForm,"participation fee in the amount not exceeding" )){
					$this->data['participationFeeInTheAmountNotExceeding'] = "checked";	
				}else{

					$this->data['participationFeeInTheAmountNotExceeding'] = "";
				}

				if(stripos($applicationForm,"chargeable against the funds of that provincial government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations" )){
					$this->data['provincechargeableAgainstTheFunds'] = "checked";	
				}else{

					$this->data['provincechargeableAgainstTheFunds'] = "";
				}




				if(stripos($applicationForm,"chargeable against the funds of that city government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations" )){
					$this->data['citychargeableAgainstTheFunds'] = "checked";	
				}else{

					$this->data['citychargeableAgainstTheFunds'] = "";
				}
				if(stripos($applicationForm,"on official time only, that is, no entitlements shall be charged against that municipal government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No. 2006-163 dated November 30, 2006." )){
					$this->data['withEntitlements2'] = "checked";	
				}else{

					$this->data['withEntitlements2'] = "";
				}
				if(stripos($applicationForm,"on official time only, that is, no entitlements shall be charged against that city government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No 2006-163 dated November 30, 2006." )){
					$this->data['withEntitlements3'] = "checked";	
				}else{

					$this->data['withEntitlements3'] = "";
				}
				$match = [
				'categories' => 'updated picture',
				'travelApplication_id' => $applicationForm->id
				];
				$this->data['updatedPicture'] = (attachedDocuments::where($match)->first()) ? attachedDocuments::where($match)->first()->location : "";
				$this->data['documents'] = attachedDocuments::where('travelApplication_id', $applicationForm->id)->get();
		return view("view", $this->data);
	}
	public function postViewApplication($id){
		if(isset($_POST['approve'])){
			return $this->postApproveTravel($id);
			
		}
		//
		//do if isset($_POST['sendToOsec'])
		$applicationForm = travelApplication::find($id);
		$statusMatch = [];
		if(Auth::user()->department_id == 1 || Auth::user()->department_id == 3){
			return "Your account is not permitted to see this record";
		}
		$this->data['applicationForm'] = $applicationForm;
		$this->data['nextForm'] = $this->determineNextForm($id);
		$this->data['previousForm'] = $this->determinePreviousForm($id);

		
		$this->data['post'] = [
			
			'remarks' => (isset($_POST['remarks'])) ? $_POST['remarks'] : "" ,	
			
		];
		if(isset($_POST['save'])){
			$applicationForm->update($this->data['post']);
			
		}


		$applicationEntitlements = $applicationForm->entitlements;
				

				if(stripos($applicationEntitlements, 'with entitlements') !== false){
					$this->data['withEntitlements'] = "checked";
				}
				else{
				
					$this->data['withEntitlements'] = "checked";	
				}
				if(stripos($applicationEntitlements, 'payment of international airfare (economy)') !== false){
					$this->data['paymentOfInternationalAirfareSelected'] = "checked";
				}
				else{
					$this->data['paymentOfInternationalAirfareSelected'] = "";
					
				}
				if(stripos($applicationForm, 'with travel allowance') !== false){
					$this->data['withTravelAllowanceRadio'] = "checked";
				}
				else{
					$this->data['withTravelAllowanceRadio'] = "";	
				}

				if(stripos($applicationForm,"20% travel allowance" ) !== false){
					$this->data['twentyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['twentyPercentTravelAllowance'] = "";
				}
				if(stripos($applicationForm,"30% travel allowance" ) !== false){
					$this->data['thirtyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['thirtyPercentTravelAllowance'] = "";
				}
				
				if(stripos($applicationForm,"50% travel allowance" ) !== false){
					$this->data['fiftyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['fiftyPercentTravelAllowance'] = "";
				}
				
				if(stripos($applicationForm,"meals" ) !== false){
					$this->data['meals'] = "checked";	
				}else{

					$this->data['meals'] = "";
				}
				if(stripos($applicationForm,"hotel" ) !== false){
					$this->data['hotel'] = "checked";	
				}else{

					$this->data['hotel'] = "";
				}

				if(stripos($applicationForm,"incidental" ) !== false){
					$this->data['incidental'] = "checked";	
				}else{

					$this->data['incidental'] = "";
				}

				
				if(stripos($applicationForm,"participation fee in the amount not exceeding" ) !== false){
					$this->data['participationFeeInTheAmountNotExceeding'] = "checked";	
				}else{

					$this->data['participationFeeInTheAmountNotExceeding'] = "";
				}

				if(stripos($applicationForm,"chargeable against the funds of that provincial government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations" ) !== false){
					$this->data['provincechargeableAgainstTheFunds'] = "checked";	
				}else{

					$this->data['provincechargeableAgainstTheFunds'] = "";
				}




				if(stripos($applicationForm,"chargeable against the funds of that city government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations" ) !== false){
					$this->data['citychargeableAgainstTheFunds'] = "checked";	
				}else{

					$this->data['citychargeableAgainstTheFunds'] = "";
				}
				if(false !== stripos($applicationForm,"on official time only, that is, no entitlements shall be charged against that municipal government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No. 2006-163 dated November 30, 2006." )){
					$this->data['withEntitlements2'] = "checked";	
				}else{

					$this->data['withEntitlements2'] = "";
				}
				if(false !== stripos($applicationForm,"on official time only, that is, no entitlements shall be charged against that city government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No 2006-163 dated November 30, 2006." )){
					$this->data['withEntitlements3'] = "checked";	
				}else{

					$this->data['withEntitlements3'] = "";
				}
				$match = [
				'categories' => 'updated picture',
				'travelApplication_id' => $applicationForm->id
				];
				$this->data['updatedPicture'] = (attachedDocuments::where($match)->first()) ? attachedDocuments::where($match)->first()->location : "";
				$this->data['documents'] = attachedDocuments::where('travelApplication_id', $applicationForm->id)->get();
		$this->data['province'] = $applicationForm->province;
		return view("view", $this->data);
	}
	public function postEdit(Request $request){
		$id = $request->id;
		if(isset($_POST['approve'])){
			return $this->postApproveTravel($id);
			
		}
		if(isset($_POST['btnSendToUsec'])){
			return $this->postSendToUsec($id);
		}
		if(isset($_POST['btnSendToOsec'])){

			return $this->postSendToOsec($id);
		}
		if(isset($_POST['btnInitialToUsec'])){
			return $this->postInitialToUsec($id);

		}
		
		$applicationForm = travelApplication::find($id);
		$statusMatch = [];
		if(Auth::user()->department_id == 1 || Auth::user()->department_id == 3){
			return "Your account is not permitted to see this record";
		}
		$this->data['applicationForm'] = $applicationForm;
		$this->data['nextForm'] = $this->determineNextForm($id);
		$this->data['previousForm'] = $this->determinePreviousForm($id);

		$travelRequested = "";
		if(isset($_POST['OfficialBusinesswithAirfare']) == true && $_POST['OfficialBusinesswithAirfare'] == true){
			$travelRequested .= "Official Business with Airfare,";
		}
		if(isset($_POST['officialTime']) == true && $_POST['officialTime'] == true){
			$travelRequested .= "Official time,";
		}
		
		if($travelRequested != ""){
			$travelRequested = rtrim($travelRequested, ",");
		}
		$entitlements = "";
		if(isset($_POST['entitlements'])){
			$entitlements .= $_POST['entitlements'];
			if($_POST['entitlements'] == "with entitlements"){
				$entitlements .= ", i.e. ";
				if(isset($_POST['participationFeeInTheAmountNotExceeding'])){
					$entitlements .= "(a) ";
				}

				if(isset($_POST['paymentOfInternationalAirfare'])){
					$entitlements .= $_POST['paymentOfInternationalAirfare'] . ", ";
				}
				if(isset($_POST['percentTravelAllowance'])){
					$entitlements .= $_POST['percentTravelAllowance'];
				}
				if(isset($_POST['percentTravelAllowance'])){
					if($_POST['percentTravelAllowance'] != "with travel allowance"){
						$entitlements .= " representing ";
					}
				}
				if(isset($_POST['meals'])){
					$entitlements .= $_POST['meals'] . ", ";
				}
				if(isset($_POST['hotel'])){
					$entitlements .= $_POST['hotel'] . ", ";
				}
				if(isset($_POST['incidental'])){
					$entitlements .= $_POST['incidental'] . ", ";
				}
				if(isset($_POST['percentTravelAllowance'])){
					if($_POST['percentTravelAllowance'] != "with travel allowance"){
						$entitlements .= "pursuant to OP Executive Order No. 298, s. 2004,";
					}
				}
				if(isset($_POST['participationFeeInTheAmountNotExceeding'])){
					$entitlements .= " and (b) ".$_POST['participationFeeInTheAmountNotExceeding'];
					$entitlements .= $_POST['notExceeding'];
				}
				if(isset($_POST['chargeableAgainstTheFunds'])){
					$entitlements .= ", ".$_POST['chargeableAgainstTheFunds'] . ".";
				}
			}
		}
		$travelRequested = "";
		if(isset($_POST['OfficialBusinesswithAirfare']) == true && $_POST['OfficialBusinesswithAirfare'] == true){
			$travelRequested .= "Official Business with Airfare,";
		}
		if(isset($_POST['officialTime']) == true && $_POST['officialTime'] == true){
			$travelRequested .= "Official time,";
		}
		
		if($travelRequested != ""){
			$travelRequested = rtrim($travelRequested, ",");
		}

		$applicationEntitlements = "";
		if(isset($_POST['entitlementrequestedInternationalAirfare'])){
			$applicationEntitlements .= "International airfare (economy);";
		}
		if(isset($_POST['entitlementrequestedTravelAllowance'])){
			$applicationEntitlements .= 'Travel allowance;';
		}
		if(isset($_POST['entitlementrequestedRegistrationParticipationFee'])){
			$applicationEntitlements .= 'Registration fee / participation fee;';

		}
		if(isset($_POST['entitlementrequestedOthers'])){
			$applicationEntitlements .= "others;";
		}


		$travelType = "";
		if(isset($_POST['officialTime'])){
			$travelType .= 'OTO;';
		}
		if(isset($_POST['OfficialBusinesswithAirfare'])){
			$travelType .= 'OB;';
		}
		if(isset($_POST['OfficialLeaveOfAbsence'])){
			$travelType .= 'OLA;';
		}
		
		$this->data['post'] = [
			'applicationstatus' => (isset($_POST['status'])) ? $_POST['status'] : "",
			'remarks' => (isset($_POST['remarks'])) ? $_POST['remarks'] : "" ,	
			'firstname' => (isset($_POST['firstname'])) ? $_POST['firstname'] : "",
			'lastname'=>(isset($_POST['lastname'])) ? $_POST['lastname'] : "",
			'middlename' =>(isset($_POST['middlename'])) ? $_POST['middlename'] : "",
			'sex' => (isset($_POST['sex'])) ? $_POST['sex'] : "",
			'suffix' =>(isset($_POST['suffix'])) ? $_POST['suffix'] : "" ,
			'birthdate'=> (isset($_POST['birthdate'])) ? $_POST['birthdate'] : "",
			'copyFurnished' => isset($_POST['copyFurnished']) ? trim($_POST['copyFurnished']) : "",
			'positionType'=> (isset($_POST['positionType'])) ? $_POST['positionType'] : "",
			'position'=> (isset($_POST['position'])) ? (($_POST['positionType'] == "NON ELECTIVE") ? $_POST['nonelectiveposition'] : $_POST['position']) : "",
			'mobile'=> (isset($_POST['mobilenumber'])) ? $_POST['mobilenumber'] : "",
			'travelType'=> $travelType,
			'groupDelegation'=> (isset($_POST['groupDelegation'])) ? $_POST['groupDelegation'] : "",
			'sponsor' =>(isset($_POST['sponsor'])) ? $_POST['sponsor'] : "",
			'benefits' =>(isset($_POST['benefits'])) ? $_POST['benefits'] : "",
			'flightinfo_country'=> (isset($_POST['country'])) ? $_POST['country'] : "",
			'flightinfo_purpose'=> (isset($_POST['purpose'])) ? $_POST['purpose'] : "",
			'flightinfo_datefrom'=> (isset($_POST['datefrom'])) ? $_POST['datefrom'] : "",
			'flightinfo_dateto'=> (isset($_POST['dateto'])) ? $_POST['dateto'] : "",
			'flightinfo_natureOfTravelRequested'=> (isset($_POST['natureOfTravelRequested'])) ? $_POST['natureOfTravelRequested'] : "",
			'flightinfo_travelRequested'=> $travelRequested,
			'created_at' => date("Y-m-d H:i:s"),
			'applyEntitlements' => $applicationEntitlements,
			'entitlements' => $entitlements
		];
		// $this->data['post']['region'] = (isset($_POST['selectregion'])) ?  $_POST['selectregion'] :"" ;
		// $this->data['post']['province'] = (isset($_POST['selectprovince'])) ?  $_POST['selectprovince'] :"" ;
		// $this->data['post']['municipality'] = (isset($_POST['selectmunicipality'])) ?  $_POST['selectmunicipality'] :"" ;
		$matchpicture = [
			'categories' => 'updated picture',
			'travelApplication_id' => $applicationForm->id
		];
		
		$updatedpicture_id = (attachedDocuments::where($matchpicture)->first()) ? attachedDocuments::where($matchpicture)->first()->id : "";
		$this->data['updatedpicture_id'] = $updatedpicture_id;
		if(isset($_POST['save'])){
			$applicationForm->update($this->data['post']);
			
			//upload updated pic
	       if($request->hasFile('updatedPicture')){
	       	//upload updated picture 
	       	if(strlen($request->file('updatedPicture')->getClientOriginalName()) > 0){
	       		$request->file('updatedPicture')->move('documents/', $request->file('updatedPicture')->getClientOriginalName());
	       		
    		} else{
    			
    		}
	       }
	       //update and upload docs
			if ($request->hasFile('documents')) {
	    		//
				for($i = 0; $i <= count($request->file('documents')) - 1; $i++){
					if(strlen($request->file('documents')[$i]->getClientOriginalName()) > 0){
						//upload revision. be sure that it is still the same name as the previous uploaded cuz we're not touching the database
		       			$request->file('documents')[$i]->move('documents/', $request->file('documents')[$i]->getClientOriginalName());
		       // 			$matchDocument = [
		       // 				'name' => $request->file('documents')[$i]->getClientOriginalName(),
		       // 				'travelApplication_id' = $applicationForm->id
		       // 			];
		       // 			$attachedDocument = attachedDocuments::where($matchDocument)->get()->first();
				    	
				    	// $attachedDocument->name = $request->file('documents')[$i]->getClientOriginalName();
				    	// $attachedDocument->location = 'documents/' . $request->file('documents')[$i]->getClientOriginalName();
				    	// $attachedDocument->travelApplication_id = $this->travelApplication_id;
				    	// $attachedDocument->created_at = date("Y-m-d");
				    	// $attachedDocument->remarks = $request->documentremarks[$i];

				    	// $attachedDocument->save();
			    	}
	       		}
	       		
	       }
		}


		$applicationEntitlements = $applicationForm->entitlements;
				

				if(stripos($applicationEntitlements, 'with entitlements') !== false){
					$this->data['withEntitlements'] = "checked";
				}
				else{
				
					$this->data['withEntitlements'] = "checked";	
				}
				if(stripos($applicationEntitlements, 'payment of international airfare (economy)') !== false){
					$this->data['paymentOfInternationalAirfareSelected'] = "checked";
				}
				else{
					$this->data['paymentOfInternationalAirfareSelected'] = "";
					
				}
				if(stripos($applicationForm, 'with travel allowance') !== false){
					$this->data['withTravelAllowanceRadio'] = "checked";
				}
				else{
					$this->data['withTravelAllowanceRadio'] = "";	
				}

				if(stripos($applicationForm,"20% travel allowance" ) !== false){
					$this->data['twentyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['twentyPercentTravelAllowance'] = "";
				}
				if(stripos($applicationForm,"30% travel allowance" ) !== false){
					$this->data['thirtyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['thirtyPercentTravelAllowance'] = "";
				}
				
				if(stripos($applicationForm,"50% travel allowance" ) !== false){
					$this->data['fiftyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['fiftyPercentTravelAllowance'] = "";
				}
				
				if(stripos($applicationForm,"meals" ) !== false){
					$this->data['meals'] = "checked";	
				}else{

					$this->data['meals'] = "";
				}
				if(stripos($applicationForm,"hotel" ) !== false){
					$this->data['hotel'] = "checked";	
				}else{

					$this->data['hotel'] = "";
				}

				if(stripos($applicationForm,"incidental" ) !== false){
					$this->data['incidental'] = "checked";	
				}else{

					$this->data['incidental'] = "";
				}

				
				if(stripos($applicationForm,"participation fee in the amount not exceeding" ) !== false){
					$this->data['participationFeeInTheAmountNotExceeding'] = "checked";	
				}else{

					$this->data['participationFeeInTheAmountNotExceeding'] = "";
				}

				if(stripos($applicationForm,"chargeable against the funds of that provincial government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations" ) !== false){
					$this->data['provincechargeableAgainstTheFunds'] = "checked";	
				}else{

					$this->data['provincechargeableAgainstTheFunds'] = "";
				}




				if(stripos($applicationForm,"chargeable against the funds of that city government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations" ) !== false){
					$this->data['citychargeableAgainstTheFunds'] = "checked";	
				}else{

					$this->data['citychargeableAgainstTheFunds'] = "";
				}
				if(false !== stripos($applicationForm,"on official time only, that is, no entitlements shall be charged against that municipal government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No. 2006-163 dated November 30, 2006." )){
					$this->data['withEntitlements2'] = "checked";	
				}else{

					$this->data['withEntitlements2'] = "";
				}
				if(false !== stripos($applicationForm,"on official time only, that is, no entitlements shall be charged against that city government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No 2006-163 dated November 30, 2006." )){
					$this->data['withEntitlements3'] = "checked";	
				}else{

					$this->data['withEntitlements3'] = "";
				}
				$match = [
				'categories' => 'updated picture',
				'travelApplication_id' => $applicationForm->id
				];
				$this->data['updatedPicture'] = (attachedDocuments::where($match)->first()) ? attachedDocuments::where($match)->first()->location : "";
				$this->data['documents'] = attachedDocuments::where('travelApplication_id', $applicationForm->id)->get();
		return view('edit', $this->data);
	
	}
	public function UserdeterminePreviousForm($id){
		$return = User::where('id', '<', $id)->first();
		return ($return) ? $return->id : "#";
	}
	public function postPrintCertificate($id){
		$applicationForm = travelApplication::find($id);
		
		$this->data['applicationForm'] = $applicationForm;
		return view("printcertificate2",$this->data);
	}
	public function UserdetermineNextForm($id){
		$return = User::where('id', '>', $id)->first();
		return ($return) ? $return->id : "#";	
	}
	public function determinePreviousForm($id){
		$matchThese = [];

		switch(Auth::user()->department_id){
			case 1:
				//lgu
				
			break;
			case 2:
				//blgs

				$matchThese["applicationstatus"] = "ON PROCESS (BLGS)";
			break;
			case 3:
				//DILGRO


				break;
			case 4:
				//USEC                                    
				$matchThese["applicationstatus"] = "ON PROCESS USEC";
				break;
			case 5:
				//OSEC
				$matchThese["applicationstatus"] = "ON PROCESS OSEC";
				$matchThese["position"] = "GOVERNOR";
				break;
			case 6:
			//IMMIGRATION
			
			$matchThese["applicationstatus"] = "APPROVED";
			break;
		}

		$return = travelApplication::where($matchThese)->where('id', '>', $id)->first();
		return ($return) ? $return->id : "#";
	}
	public function determineNextForm($id){
		$matchThese = [];

		switch(Auth::user()->department_id){
			case 1:
				//lgu
				
			break;
			case 2:
				//blgs

				$matchThese["applicationstatus"] = "ON PROCESS (BLGS)";
			break;
			case 3:
				//DILGRO

				break;
			case 4:
				//USEC                                    
				$matchThese["applicationstatus"] = "ON PROCESS USEC";
				break;
			case 5:
				//OSEC
				$matchThese["applicationstatus"] = "ON PROCESS OSEC";
				$matchThese["position"] = "GOVERNOR";
				break;
			case 6:
			//IMMIGRATION
			$matchThese["applicationstatus"] = "APPROVED";
			break;
		}

		$return = travelApplication::where($matchThese)->orderBy('id', 'desc')->where('id', '<', $id)->first();
		return ($return) ? $return->id : "#";
	}
	public function getEdit($id){
		$applicationForm = travelApplication::find($id);
		$statusMatch = [];
		if(Auth::user()->department_id == 1 || Auth::user()->department_id == 3){
			return "Your account is not permitted to see this record";
		}
		if($applicationForm->applicationstatus == "APPROVED" || $applicationForm->applicationstatus == "ON PROCESS USEC" || $applicationForm->applicationstatus == "ON PROCESS OSEC"){
			return redirect('/home');
		}
		$this->data['post'] = [];
		$this->data['nextForm'] = $this->determineNextForm($id);
		$this->data['previousForm'] =  $this->determinePreviousForm($id);
		$this->data['applicationForm'] = $applicationForm;
		$this->data['region'] = $applicationForm->region;
		$this->data['province'] = $applicationForm->province;
		

		$applicationEntitlements = $applicationForm->entitlements;
				

				if(stripos($applicationEntitlements, 'with entitlements')){
					$this->data['withEntitlements'] = "checked";
				}
				else{
				
					$this->data['withEntitlements'] = "checked";	
				}
				if(stripos($applicationEntitlements, 'payment of international airfare (economy)')){
					$this->data['paymentOfInternationalAirfareSelected'] = "checked";
				}
				else{
					$this->data['paymentOfInternationalAirfareSelected'] = "";
					
				}
				if(stripos($applicationForm, 'with travel allowance')){
					$this->data['withTravelAllowanceRadio'] = "checked";
				}
				else{
					$this->data['withTravelAllowanceRadio'] = "";	
				}

				if(stripos($applicationForm,"20% travel allowance" )){
					$this->data['twentyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['twentyPercentTravelAllowance'] = "";
				}
				if(stripos($applicationForm,"30% travel allowance" )){
					$this->data['thirtyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['thirtyPercentTravelAllowance'] = "";
				}
				
				if(stripos($applicationForm,"50% travel allowance" )){
					$this->data['fiftyPercentTravelAllowance'] = "checked";	
				}else{

					$this->data['fiftyPercentTravelAllowance'] = "";
				}
				
				if(stripos($applicationForm,"meals" )){
					$this->data['meals'] = "checked";	
				}else{

					$this->data['meals'] = "";
				}
				if(stripos($applicationForm,"hotel" )){
					$this->data['hotel'] = "checked";	
				}else{

					$this->data['hotel'] = "";
				}

				if(stripos($applicationForm,"incidental" )){
					$this->data['incidental'] = "checked";	
				}else{

					$this->data['incidental'] = "";
				}

				
				if(stripos($applicationForm,"participation fee in the amount not exceeding" )){
					$this->data['participationFeeInTheAmountNotExceeding'] = "checked";	
				}else{

					$this->data['participationFeeInTheAmountNotExceeding'] = "";
				}

				if(stripos($applicationForm,"chargeable against the funds of that provincial government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations" )){
					$this->data['provincechargeableAgainstTheFunds'] = "checked";	
				}else{

					$this->data['provincechargeableAgainstTheFunds'] = "";
				}




				if(stripos($applicationForm,"chargeable against the funds of that city government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations" )){
					$this->data['citychargeableAgainstTheFunds'] = "checked";	
				}else{

					$this->data['citychargeableAgainstTheFunds'] = "";
				}
				if(stripos($applicationForm,"on official time only, that is, no entitlements shall be charged against that municipal government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No. 2006-163 dated November 30, 2006." )){
					$this->data['withEntitlements2'] = "checked";	
				}else{

					$this->data['withEntitlements2'] = "";
				}
				if(stripos($applicationForm,"on official time only, that is, no entitlements shall be charged against that city government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No 2006-163 dated November 30, 2006." )){
					$this->data['withEntitlements3'] = "checked";	
				}else{

					$this->data['withEntitlements3'] = "";
				}
				$match = [
				'categories' => 'updated picture',
				'travelApplication_id' => $applicationForm->id
				];
				$this->data['updatedPicture'] = (attachedDocuments::where($match)->first()) ? attachedDocuments::where($match)->first()->location : "";
				$this->data['documents'] = attachedDocuments::where('travelApplication_id', $applicationForm->id)->get();
		return view('edit', $this->data);
	
	}
	public function getApplyForTravel(){
		
		switch(Auth::user()->department_id){
			case 1:
				//LGU
			case 3:
				//DILGRO
			break;
			default:
				return redirect('/home');
			break;
		} 
		$this->data['municipalities'] = "";
		foreach(refcitymun::get() as $municipality){
			$this->data['municipalities'] .= "<option value = '" . $municipality->citymunDesc . "'>" . $municipality->citymunDesc . "</option>";
			
		}
		$this->data['region'] = Auth::user()->region;
		return view('applyForTravel', $this->data);
	}
	public function postApplyForTravel(request $request){
		$travelRequested = "";
		if(isset($_POST['OfficialBusinesswithAirfare']) == true && $_POST['OfficialBusinesswithAirfare'] == true){
			$travelRequested .= "Official Business with Airfare,";
		}
		if(isset($_POST['officialTime']) == true && $_POST['officialTime'] == true){
			$travelRequested .= "Official time,";
		}
		
		if($travelRequested != ""){
			$travelRequested = rtrim($travelRequested, ",");
		}

		$applicationEntitlements = "";
		if(isset($_POST['entitlementrequestedInternationalAirfare'])){
			$applicationEntitlements .= "International airfare (economy);";
		}
		if(isset($_POST['entitlementrequestedTravelAllowance'])){
			$applicationEntitlements .= 'Travel allowance;';
		}
		if(isset($_POST['entitlementrequestedRegistrationParticipationFee'])){
			$applicationEntitlements .= 'Registration fee / participation fee;';

		}
		if(isset($_POST['entitlementrequestedOthers'])){
			$applicationEntitlements .= "others;";
		}


		$travelType = "";
		if(isset($_POST['officialTime'])){
			$travelType .= 'OTO;';
		}
		if(isset($_POST['OfficialBusinesswithAirfare'])){
			$travelType .= 'OB;';
		}
		if(isset($_POST['OfficialLeaveOfAbsence'])){
			$travelType .= 'OLA;';
		}

		$municipality = (isset($_POST['municipality'])) ? $_POST['municipality'] : "";
		$insert = [
		'applicationstatus' => "ON PROCESS (BLGS)",
		'remarks' => "",
		'region' => trim(Auth::user()->region),
		'province' => trim($_POST['selectprovince']) ,
		'municipality' => $municipality,
		'firstname' => trim($_POST['firstname']),
		'lastname'=> trim($_POST['lastname']),
		'middlename' =>trim($_POST['middlename']),
		'sex' =>trim($_POST['sex']),
		'suffix' =>trim($_POST['suffix']),
		'birthdate'=> $_POST['birthdate'],
		'positionType'=> $_POST['positionType'],
		'position'=>($_POST['positionType'] == "NON ELECTIVE") ? $_POST['nonelectiveposition'] : $_POST['position'],
		'picture'=> 'pictures/'.$_FILES['picture']['name'],
		'mobile'=> $_POST['mobilenumber'],
		'travelType'=> $travelType,
		'groupDelegation'=> $_POST['groupDelegation'],
		'benefits' =>$_POST['benefits'],
		'flightinfo_country'=> $_POST['country'],
		'flightinfo_purpose'=> $_POST['purpose'],
		'flightinfo_datefrom'=> $_POST['datefrom'],
		'flightinfo_dateto'=> $_POST['dateto'],
		'flightinfo_natureOfTravelRequested'=> $_POST['natureOfTravelRequested'],
		'flightinfo_travelRequested'=> $travelRequested,
		'created_at' => date("Y-m-d H:i:s"),
		'applyEntitlements' => $applicationEntitlements,
		'email' => $_POST['email'],
		'encodedBy' => Auth::user()->lastname . ", " . Auth::user()->firstname . ", " . Auth::user()->middlename
		];
		//todo: add some back-end validation

		if(isset($_POST['apply'])){
			
			$travel = travelApplication::create($insert);

			 	$this->travelApplication_id = $travel->id;
		 	if($travel->id){
			 	$travelApplication_id = $travel->id;
			 	$this->travelApplication_id = $travel->id;
			     


			     	//upload picture
    	if ($request->hasFile('picture')) {
    		//

	       $request->file('picture')->move('pictures/', $request->file('picture')->getClientOriginalName());
       }else{
       	die("error uploading picture");
       	exit();
       }
       //upload updated pic
       if($request->hasFile('updatedPicture')){
       	//upload updated picture
       	$request->file('updatedPicture')->move('documents/', $request->file('updatedPicture')->getClientOriginalName());
       		$attachedUpdatedPicture = new attachedDocuments();
			    	
			    	$attachedUpdatedPicture->name = $request->file('updatedPicture')->getClientOriginalName();
			    	$attachedUpdatedPicture->location = 'documents/' . $request->file('updatedPicture')->getClientOriginalName();
			    	$attachedUpdatedPicture->travelApplication_id = $this->travelApplication_id;
			    	$attachedUpdatedPicture->created_at = date("Y-m-d");
			    	$attachedUpdatedPicture->categories = "updated picture";
			    	$attachedUpdatedPicture->save();
       }
       //upload docs
		if ($request->hasFile('documents')) {
    		//
			for($i = 0; $i <= count($request->file('documents')) - 1; $i++){
				if($request->file('documents')[$i]){
	       			$request->file('documents')[$i]->move('documents/', $request->file('documents')[$i]->getClientOriginalName());
	       			$attachedDocument = new attachedDocuments();
			    	
			    	$attachedDocument->name = $request->file('documents')[$i]->getClientOriginalName();
			    	$attachedDocument->location = 'documents/' . $request->file('documents')[$i]->getClientOriginalName();
			    	$attachedDocument->travelApplication_id = $this->travelApplication_id;
			    	$attachedDocument->created_at = date("Y-m-d");
			    	$attachedDocument->remarks = $request->documentremarks[$i];

			    	$attachedDocument->save();
		    	}
       		}
       		
       }else{
       	// die("error uploading document(s)");
       	// exit();
       }
       //upload docs

       return redirect('home');

			}//	if($travel->id){
			
			//return redirect('home');
		
		}//end: if(isset($_POST['apply'])){

	}
	public function upload(Request $request)
    {
    	//upload picture
    	if ($request->hasFile('picture')) {
    		//

	       $request->file('picture')->move('pictures/', $request->file('picture')->getClientOriginalName());
       }else{
       	die(var_dump($request->file('picture')));
       	exit();
       }
       //upload docs
		if ($request->hasFile('documents')) {
    		//
			for($i = 0; $i <= count($request->file('documents')) - 1; $i++){
	       		$request->file('documents')[$i]->move('documents/', $request->file('documents')[$i]->getClientOriginalName());
	       			$attachedDocument = new attachedDocuments();
			    	
			    	$attachedDocument->name = $request->file('documents')[$i]->getClientOriginalName();
			    	$attachedDocument->location = 'documents/' . $request->file('documents')[$i]->getClientOriginalName();
			    	$attachedDocument->travelApplication_id = $this->travelApplication_id;
			    	$attachedDocument->created_at = date("Y-m-d");
			    	$attachedDocument->save();
       		}
       }else{
       	die(var_dump($request->file('documents')));
       	exit();
       }
       //upload docs

       return redirect('home');
    }

	
	public function getIndex(){
	
		$this->data['title'] = "Travel applications";	
		//if immigration...
		if(Auth::user()->department_id == 6){
			$this->data['title'] = "Approved travel applications";	
		$matchThese = [];
		
		$travelApplications = travelApplication::where($matchThese)->orderBy('applicationstatus', 'desc')->get();

		$this->data['travelApplications'] = $travelApplications;
		return view('dashboard', $this->data);
		} else{
			$matchThese = [];
		if(Auth::user()->province){
			$matchThese["province"]= Auth::user()->province;
		}
		if(Auth::user()->region){
			$matchThese["region"] = Auth::user()->region;
		}
		if(Auth::user()->municipality){
			$matchThese["municipality"] = Auth::user()->municipality;
		}
			
		$travelApplications = travelApplication::where($matchThese)->orderBy('applicationstatus')->get();

		$this->data['travelApplications'] = $travelApplications;
		return view('dashboard', $this->data);
	
		}
	}
	//search
	public function postIndex(request $request){
	
		$this->data['title'] = "Travel applications";	
		//if immigration...
		if(Auth::user()->department_id == 6){
			$this->data['title'] = "Approved travel applications";	
		$matchThese = [];
		
		$travelApplications = travelApplication::where($matchThese)->orderBy('applicationstatus', 'desc')->get();

		$this->data['travelApplications'] = $travelApplications;
		return view('dashboard', $this->data);
		} else{
			$matchThese = [];
		if($request->has('province')) {
			$matchThese["province"]= $request->province;
		} else{
			if(Auth::user()->province){
				$matchThese["province"]= Auth::user()->province;
			}
		}
		if($request->has('region')) {
			$matchThese["region"]= $request->region;
		} else{
			if(Auth::user()->region){
				$matchThese["region"]= Auth::user()->region;
			}
		}
		if($request->has('municipality')) {
			$matchThese["municipality"]= $request->municipality;
		}else{
			if(Auth::user()->municipality){
				$matchThese["municipality"]= Auth::user()->municipality;
			}
		}
		if($request->has('travelstatus')){
			$matchThese["applicationstatus"]= $request->travelstatus;
		}
		
		$travelApplications = travelApplication::where($matchThese)->orderBy('applicationstatus')->get();

		$this->data['travelApplications'] = $travelApplications;
		return view('dashboard', $this->data);
	
		}
	}
	public function getApprovedTA(){
		$this->data['title'] = "Approved travel applications";
		$matchThese = [];
		$matchThese["region"] = Auth::user()->region;
		if(Auth::user()->province){
			$matchThese["province"]= Auth::user()->province;
		}
		switch(Auth::user()->department_id){
			case 1:
				//LGU
			case 3:
				//DILGRO
			case 6:
				//IMMIGRATION
				$matchThese["applicationstatus"] = "APPROVED";
			break;
			default:
				return redirect('home');
			break;
		} 

		$travelApplications = travelApplication::where($matchThese)->orderBy('created_at', 'desc')->get();

		$this->data['travelApplications'] = $travelApplications;
		return view('dashboard', $this->data);
	}
	public function postRemoveApplication($id){
		$travel = travelApplication::find($id);
		$travel->forceDelete();

		return redirect('home');
	}
	public function getMunicipalitiesByProvince(Request $request){

			$province = $request->input('province');
        	$provinceCode = DB::table('refprovince')->select('provCode')->where('provDesc', $province)->first()->provCode;
            $municipalities = DB::table('refcitymun')->select('citymunDesc', 'citymunDesc')->where('provCode', '=', $provinceCode)->get();
           
       
        // $provinceCode = DB::table('refprovince')->select('provCode')->where('provDesc', $province)->first()->provCode;
        //     $municipalities = DB::table('refcitymun')->select('citymunDesc', 'citymunDesc')->where('provCode', '=', $provinceCode)->get();
        //     return Response::json( $municipalities );
         // $municipalities =[ 
	        //  [
	        //  	"optionValue" => 0, 
	        //  	"optionDisplay" => "Mark"
         // 	 ], 
	        //  [
	        //  	"optionValue" => 1, 
	        //  	"optionDisplay" => "Andy"
	        //  ], 
	        //  [
	        //  	"optionValue" => 2, 
	        //  	"optionDisplay" => "Richard"
         // 	 ] 
         // ];
            return response()->json( $municipalities );
	}
}
?>