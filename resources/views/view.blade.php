@extends('layout2.layout')
@section('content')
      <?php
      if(isset($_POST['apply'])){
      echo "<pre>";
        print_r($post);
      echo "</pre>";
      }
      
      ?>

                    <div class="row" style = "margin-top:-30px">
                        <div class="col-lg-10 col-lg-offset-1 form-box">
                           <div>
            
                            <a href = '<?php echo $nextForm;?>' name = 'previous' value = 'previous'>previous record</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <a href = '<?php echo $previousForm;?>' name = 'next' value = 'next'>next record</a>
           
                          </div>
                          <form role="form" class="registration-form" enctype="multipart/form-data" name = 'applicationform' class="pure-form pure-form-aligned" method="POST" action="">
                            
                            
                            <fieldset>
                               {!! csrf_field() !!}
                               <input type = 'hidden' name = 'userdepartment' id = 'userdepartment' value = '{{$department}}'/>
                              <div class="form-top">
                                <div class="form-top-left">
                                  <h3>Page 1 / 3 - Travel application [ Travel no. {{$applicationForm->id}}]</h3>
                                    <p>Personal Information</p>
                                </div>
                                <div class="form-top-right">
                                  <i class="fa fa-user"></i>
                                </div>
                                </div>
                                <div class="form-bottom pure-g">
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label for="region" class= "mylabel">Region:</label>
                                        <?php echo $applicationForm->region;?>
                                  </div>
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label for="province" class= "mylabel">Province:</label>
                                      {{$applicationForm->province}}
                                      <?php
                                       
                                          // echo "<select required name = 'selectprovince' id = 'applySelectProvince'>";
                                          // echo App\viewStrategy::getProvincesOptions($applicationForm->region, $applicationForm->province);
                                          // echo "</select>";
                                        
                                       
                                    ?>
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="municipality" class= "mylabel">Municipality:</label>
                                      {{$applicationForm->municipality}}
                                      <!-- <select  class = "pure-u-11-24" required name = 'municipality' id = 'selectMunicipality'> -->
                                       
                                        <?php 
                                       
                                          //App\viewStrategy::getMunicipalitiessOptions($applicationForm->province, $applicationForm->municipality); 
                                       
                                        ?>
                                     <!--  </select> -->
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="lastname" class= "mylabel">Last name:</label>
                                      <input readonly value = "{{$applicationForm->lastname}}" onkeypress = "return validate(event)" id = "applyLastname" class = "pure-u-11-24" autocomplete="off" required  name = "lastname" type="text" >
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="firstname" class= "mylabel">First name:</label>
                                      <input readonly value = "{{$applicationForm->firstname}}" onkeypress = "return validate(event)" class = "pure-u-11-24" autocomplete="off" required id="firstname" name = "firstname" type="text">
                                  </div>

                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="middlename" class= "mylabel">Middle name:</label>
                                      <input readonly value = "{{$applicationForm->middlename}}" onkeypress = "return validate(event)" class = "pure-u-11-24"  autocomplete="off" id="middlename" name = "middlename" type="text" >
                                  </div>

                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="suffix" class= "mylabel">Suffix:</label>
                                      <input readonly value = "{{$applicationForm->suffix}}" onkeypress = "return validate(event)"  class = "pure-u-11-24"  autocomplete="off" id="firstname" name = "suffix" type="text" >
                                  </div>
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label class= "mylabel">Birthdate:</label>
                                      <input readonly value = "{{$applicationForm->birthdate}}" class = "pure-u-11-24"  required id="birthdate" name = "birthdate" type="date">
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label  class= "mylabel" for="electiveposition">Position Type:</label>
                                      <select disabled class = "pure-u-11-24"  name = 'positionType' id = "positiontype">
                                        <option {{($applicationForm->positionType == "ELECTIVE") ? "selected" : ""}} value = "ELECTIVE">ELECTIVE</option>
                                        <option {{($applicationForm->positionType == "NON ELECTIVE") ? "selected" : ""}} value = "NON ELECTIVE">NON ELECTIVE</option>
                                      </select> 
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label  class= "mylabel">Position:</label>
                                     <input readonly class = "pure-u-11-24" type = 'Text' placeholder = "Please type the position" name= "nonelectiveposition" id = "nonelectiveposition" value = "{{$applicationForm->position}}"></input>
                                      <select disabled name = 'position' id = "positionElective">
                                        <option value = "governor">GOVERNOR</option>
                                        <option value = "vice governor">VICE GOVERNOR</option>
                                        <option value = "mayor">MAYOR</option>
                                        <option value = "vice mayor">VICE MAYOR</option>
                                        <option value = "Sangguniang Panlalawigan Member">Sangguniang Panlalawigan Member</option>
                                        <option value = "Sangguniang Panglunsod Member">Sangguniang Panglunsod Member</option>
                                        <option value = "Sangguniang Bayan Member">Sangguniang Bayan Member</option>
                                      </select>
                                  </div>
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label  class= "mylabel" for="sex">Sex:</label>
                                      <SELECT disabled class = "pure-u-11-24" required name = 'sex'>
                                        <option value = "">SELECT SEX</option>
                                        <option {{($applicationForm->sex == "male") ? "selected" : ""}} value = "male">MALE</option>
                                        <option {{($applicationForm->sex == "female") ? "selected" : ""}} value = "female">FEMALE</option>
                                      </select>
                                  </div>
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label  class= "mylabel" for="mobilenumber">Mobile number:</label>
                                      <input readonly value = "{{$applicationForm->mobile}}" class = "pure-u-11-24" maxlength="11" autocomplete="off" required id="mobilenumber" name = "mobilenumber" type="number" >
                                  </div>
                                    <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label  class= "mylabel" for="email">Email address:</label>
                                      <input readonly value = "{{$applicationForm->email}}" class = "pure-u-11-24" autocomplete="off" required id="email" name = "email" type="email">
                                  </div>
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label class= "mylabel" for="picture">Picture:</label>
                                        <img src = "{{asset($applicationForm->picture)}}" />
                                  </div>
                                  <legend></legend>
                                  <button type="button" class="btn btn-next">Next</button>
                                </div>
                          </fieldset>
                          
                          <fieldset>
                              <div class="form-top">
                                <div class="form-top-left">
                                  <h3>Page 2 / 3 - Travel application [ Travel no. {{$applicationForm->id}}]</h3>
                                    <p>Travel Information:</p>
                                </div>
                                <div class="form-top-right">
                                  <i class="fa fa-user"></i>
                                </div>
                                </div>
                                <div class="form-bottom">
                                
                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel" for="name">Country:</label>
                                    <select disabled class = "pure-u-11-24" required name="country">
                                      <option value = "">Please select country</option>                      
                                      <?php
                                        foreach($countries as $country){
                                          $selected = "";
                                          if($country->country_name == $applicationForm->flightinfo_country){
                                            $selected = "selected";
                                          }
                                          echo "<option ".$selected." value = '{$country->country_name}'>{$country->country_name}</option>";
                                          
                                        }
                                      ?>
                                    </select>
                                </div>

                               

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel"for="name">Date from:</label>
                                    <input readonly value = '{{$applicationForm->flightinfo_datefrom}}' class = "pure-u-11-24" required id="datefrom" name = "datefrom" type="date">
                                </div>

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel" for="password">Date to:</label>
                                    <input readonly value = '{{$applicationForm->flightinfo_dateto}}' class = "pure-u-11-24" required id="dateto" name = "dateto" type="date">
                                </div>
                                 <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel" for="password">Purpose:</label>
                                     <textarea readonly autocomplete="off" required data-field="x_group_name" name="purpose" id="x_group_name" cols="40" rows="4">{{$applicationForm->flightinfo_purpose}}</textarea>
                                
                                </div>
                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class = "mylabel" for="password">Benefits:</label>
                                    <textarea readonly autocomplete="off" data-field="x_group_name" name="benefits" id="x_group_name" cols="40" rows="4" placeholder="">{{$applicationForm->flightinfo_benefits}}</textarea>
                                
                                </div>
                                <!-- <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label for="password">Travel type:</label>
                                    <select required name = "travelType">
                                      <option value = "">select travel type</option>
                                      <option value = "Individual">Individual</option>
                                      <option value = "groupDelegation">Group / Delegation</option>
                                    </select>
                                </div> -->

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel" for="password">If group/delegation, please list their names:</label>
                                    <textarea readonly data-field="x_group_name" name="groupDelegation" id="x_group_name" cols="40" rows="4" placeholder="IF GROUP/DELEGATION PLS LIST THE NAMES">{{$applicationForm->groupDelegation}}</textarea>
                                </div>
                                

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel">Travel type:</label>
                                    <?php
                                    $officialTimeCheck = "";
                                    $officialBusinessCheck = "";
                                    $OfficialLeaveOfAbsenceCheck = "";
                                    if(stripos($applicationForm->travelType, "OTO") !== false){
                                      $officialTimeCheck = " checked ";
                                    }
                                    if(stripos($applicationForm->travelType, "OB") !== false){
                                      $officialBusinessCheck = " checked ";
                                    }
                                    if(stripos($applicationForm->travelType, "OLA") !== false){
                                      $OfficialLeaveOfAbsenceCheck = " checked ";
                                    }
                                    ?>
                                    <input disabled {{$officialTimeCheck}} type = 'checkbox' name = 'officialTime'>OTO (Official time only)</input>&nbsp&nbsp&nbsp
                                    <input disabled {{$officialBusinessCheck}} type = 'checkbox' name = 'OfficialBusinesswithAirfare'>OB (Official Business)</input>&nbsp&nbsp&nbsp
                                    <input disabled {{$OfficialLeaveOfAbsenceCheck}} type = 'checkbox' name = 'OfficialLeaveOfAbsence'>OLA (Official leave of absence)</input>&nbsp&nbsp&nbsp
                                  
                                </div>

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel">Nature of travel requested:</label>
                                    <?php
                                    $checkedStudy = "";
                                    $checkedNonStudy = "";
                                    $checkPersonal = "";
                                    if(false !== stripos($applicationForm->flightinfo_natureOfTravelRequested, "Study(Scholarship Grants)")){
                                      $checkedStudy = " checked ";
                                    }
                                    if(false !== stripos($applicationForm->flightinfo_natureOfTravelRequested, "Non study")){
                                      $checkedNonStudy = " checked ";
                                    }
                                    if(false !== stripos($applicationForm->flightinfo_natureOfTravelRequested, "Personal")){
                                      $checkPersonal = " checked ";
                                    }

                                    ?>
                                    <input disabled {{$checkedStudy}} required type = 'radio' name = 'natureOfTravelRequested' value = 'Study(Scholarship Grants)'>Study(Scholarship Grants)</input>&nbsp&nbsp&nbsp
                                    <input disabled {{$checkedNonStudy}} required type = 'radio' name = 'natureOfTravelRequested' value = 'Non study'>Non study</input>&nbsp&nbsp&nbsp
                                    <input disabled {{$checkPersonal}} required type = 'radio' name = 'natureOfTravelRequested' value = 'Personal'>Personal</input>
                                  
                                </div>

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel">Entitlement requested</label>
                                    <?php
                                    $checkAirfare = "";
                                    $checkTravelAllowance = "";
                                    $checkParticipationFee = "";
                                    $checkOthers = "";
                                    if(false !== stripos($applicationForm->applyEntitlements, "International airfare (economy)")){
                                      $checkAirfare = " checked ";
                                    }
                                    if(false !== stripos($applicationForm->applyEntitlements, "travel allowance")){
                                      $checkTravelAllowance = " checked ";
                                    }
                                    if(false !== stripos($applicationForm->applyEntitlements, "registration fee")){
                                      $checkParticipationFee = " checked ";
                                    }
                                     if(false !== stripos($applicationForm->applyEntitlements, "Others")){
                                      $checkOthers = " checked ";
                                    }
                                    ?>
                                    <input disabled {{$checkAirfare}} type = 'checkbox' name = 'entitlementrequestedInternationalAirfare' value = 'international airfaire (economy)'>International airfare (economy)</input>&nbsp&nbsp&nbsp
                                    <input disabled {{$checkTravelAllowance}} type = 'checkbox' name = 'entitlementrequestedTravelAllowance' value = 'travel allowance'>Travel allowance</input>&nbsp&nbsp&nbsp
                                    <input disabled {{$checkParticipationFee}} type = 'checkbox' name = 'entitlementrequestedRegistrationParticipationFee' value = 'registration fee'>Registration fee / participation fee</input>
                                    <input disabled {{$checkOthers}} type = 'checkbox' name = 'entitlementrequestedOthers' value = 'Others'>Others</input>
                                  
                                </div>
                                <legend></legend>
                                <button type="button" class="btn btn-previous">Previous</button>
                                <button type="button" class="btn btn-next">Next</button>
                            </div>

                          </fieldset>
                          <fieldset>
                              <div class="form-top">
                                <div class="form-top-left">
                                  <h3>Finalize Entitlements</h3>
                                    <p>{{$department}}:</p>
                                </div>
                                <div class="form-top-right">
                                  <i class="fa fa-user"></i>
                                </div>
                              </div>
                                <div class="form-bottom">
                                  <div class="pure-control-group">
                                    <ul>
                                      <li><input disabled {{$withEntitlements}} type = 'radio' value = 'with entitlements' name = 'entitlements'>With entitlements</input>
                                        <div id = 'elementsToOperateOn'>
                                        <div class="pure-control-group">
                                          <ul>
                                            <li><input disabled {{$paymentOfInternationalAirfareSelected}} type = 'checkbox' name = 'paymentOfInternationalAirfare' value = 'payment of international airfare (economy)'>payment of international airfare (economy)</input></li>
                                            <li><input disabled {{$withTravelAllowanceRadio}} type = 'radio' name = 'percentTravelAllowance' value = 'with travel allowance'>with travel allowance</input></li>
                                            <li><input disabled {{$twentyPercentTravelAllowance}} type = 'radio' name = 'percentTravelAllowance' value = '20% travel allowance'>20% travel allowance</input></li>
                                            <li><input disabled {{$thirtyPercentTravelAllowance}} type = 'radio' name = 'percentTravelAllowance' value = '30% travel allowance'>30% travel allowance</input></li>
                                            <li><input disabled {{$fiftyPercentTravelAllowance}} type = 'radio' name = 'percentTravelAllowance' value = '50% travel allowance'>50% travel allowance</input></li>
                                              <div class="pure-control-group">
                                                Representing:
                                                <ul>
                                                  <li><input disabled {{$meals}} type = 'checkbox' name = 'meals' value = 'meals'>meals</input></li>
                                                  <li><input disabled {{$hotel}} type = 'checkbox' name = 'hotel' value = 'hotel'>hotel</input></li>
                                                  <li><input disabled {{$incidental}} type = 'checkbox' name = 'incidental' value = 'incidental'>incidental</input></li>
                                                </ul>
                                              </div>
                                            <li><input disabled {{$participationFeeInTheAmountNotExceeding}} type = 'checkbox' value = 'participation fee in the amount not exceeding ' name = 'participationFeeInTheAmountNotExceeding'>participation fee in the amount not exceeding </input><input readonly type = 'text' name = 'notExceeding' value = 'USD3,500.00'/></li>
                                            <li><input disabled {{$provincechargeableAgainstTheFunds}} type = 'radio' value = 'chargeable against the funds of that provincial government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations' name = 'chargeableAgainstTheFunds'>chargeable against the funds of that provincial government</input></li>
                                            <li><input disabled {{$citychargeableAgainstTheFunds}} type = 'radio' value = 'chargeable against the funds of that city government, subject to the availability thereof, and to the usual accounting and auditing rules and regulations' name = 'chargeableAgainstTheFunds'>chargeable against the funds of that city government</input></li>
                                          </ul>
                                        </div>
                                        </div>
                                      </li>
                                      <li><input disabled {{$withEntitlements2}} type = 'radio' value = 'on official time only, that is, no entitlements shall be charged against that municipal government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No. 2006-163 dated November 30, 2006.' name = 'entitlements'>on official time only [municipal government]</input></li>
                                      <li><input disabled {{$withEntitlements3}} type = 'radio' value = 'on official time only, that is, no entitlements shall be charged against that city government funds except for the usual salaries and other emoluments for the duration of the said foreign trip, and subject to the provisions under DILG Memorandum Circular No 2006-163 dated November 30, 2006.' name = 'entitlements'>on official time only [city government]</input></li>
                                    </ul>
                                  </div>
                                  <legend></legend>
                                  <button type="button" class="btn btn-previous">Previous</button>
                                  <button type="button" class="btn btn-next">Next</button>
                                </div>

                          </fieldset>

                          <fieldset>
                              <div class="form-top">
                                <div class="form-top-left">
                                  <h3>Page 3 / 3 - Travel application [ Travel no. {{$applicationForm->id}}]</h3>
                                    <p>Uploaded documents:</p>
                                </div>
                                <div class="form-top-right">
                                  <i class="fa fa-user"></i>
                                </div>
                                </div>
                                <div class="form-bottom">
                                <div class="form-group pure-u-1 pure-u-md-1-3" id = "uploaddocuments">

                                    <label class = "mylabel" >Updated picture (2x2):</label>
                                    <img src = "{{asset($updatedPicture)}}"/>
                                    <br><br><br>
                                    <legend>Uploaded documents</legend>
                                    @foreach($documents as $document)
                                    <a target="_blank" href = "{{asset($document->location)}}">{{$document->name}}</a> <i>{{$document->remarks}}</i><br>
                                    @endforeach
                                    
                                </div>
                               
                                <legend></legend>
                                <button type="button" class="btn btn-previous">Previous</button>
                                <button type="button" class="btn btn-next">Next</button>
                            </div>
                          </fieldset>
                          <fieldset>

                            <div class="form-top">
                              <div class="form-top-left">
                                <h3>Save</h3>
                                  <p>{{$department}}</p>
                              </div>
                              <div class="form-top-right">
                                <i class="fa fa-user"></i>
                              </div>
                            </div>
                            <div class="form-bottom">
                              
                              <div class="pure-control-group">
                                  <label for="name">Status:</label>
                                  <input type = 'hidden' name = 'status' value = '{{$applicationForm->applicationstatus}}'/>{{$applicationForm->applicationstatus}}
                                  @if($applicationForm->InitialToUsec)
                                  ,
                                  <i style = "color:orange">Initial to USEC</i>
                                  @endif
                              </div>  
                              <div class="pure-control-group">
                                  <label for="name">Remarks:</label>
                                  <textarea style = "width:400px" name = 'remarks' value = '<?php echo $applicationForm->remarks;?>'><?php echo $applicationForm->remarks;?></textarea>
                              </div>  
                              <div class="pure-controls" style = "margin-top:10px;">
                                <legend></legend>
                                 <button type="submit" name = 'save' class="pure-button pure-button-primary">Save remarks</button>
                                <div class="pure-control-group" style = "margin-top:10px">
                                  <button type="button" class="btn btn-previous">Previous</button>
                                  <button type="button" class="btn btn-next">Next</button>
                                </div>  
                              </div>
                            </div>
                          </fieldset>
                          <fieldset>
                               {!! csrf_field() !!}
                              <div class="form-top">
                                <div class="form-top-left">
                                  <h3>Action</h3>
                                    <p>{{$department}}</p>
                                </div>
                                <div class="form-top-right">
                                  <i class="fa fa-user"></i>
                                </div>
                                </div>
                                <div class="form-bottom pure-g">
                                  <?php
                                  
                                   echo App\viewStrategy::getApproveActions(Auth::user()->department_id, $applicationForm);
                                  ?>
                                  
                                   <a href = "../home"><button type = 'button'>Back to travel lists</button></a>
                                  
                                   <button type="button" class="btn btn-previous">Previous</button>
                                </div>

                            </fieldset>
                        </form>
                                   
                        </div>
                    </div>

     
     
@stop