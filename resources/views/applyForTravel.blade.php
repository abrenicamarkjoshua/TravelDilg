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
                          <h4><?php echo App\viewStrategy::getAccountInfo();?></h4>
                          <form role="form" class="registration-form" enctype="multipart/form-data" name = 'applicationform' class="pure-form pure-form-aligned" method="POST" action="/applyForTravel">
                            
                       
                            <fieldset>
                               {!! csrf_field() !!}
                               <input type = 'hidden' name = 'userdepartment' id = 'userdepartment' value = '{{$department}}'/>
                              <div class="form-top">
                                <div class="form-top-left">
                                  <h3>Step 1 / 3 - Travel application</h3>
                                    <p>Personal Information</p>
                                </div>
                                <div class="form-top-right">
                                  <i class="fa fa-user"></i>
                                </div>
                                </div>
                                <div class="form-bottom pure-g">
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label for="region" class= "mylabel">Region:</label>
                                        <?php echo $region;?>
                                  </div>
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label for="province" class= "mylabel">{{($region == "NATIONAL CAPITAL REGION (NCR)") ? "City" : "Province"}}:</label>
                                      <?php
                                       if(Auth::user()->province){
                                         
                                          echo "<input name = 'selectprovince' value = '".Auth::user()->province."'' type = 'hidden' />";
                                        echo Auth::user()->province;
                                        } else{
                                          echo "<select required name = 'selectprovince' id = 'applySelectProvince'>";
                                        echo App\viewStrategy::getProvincesOptions(Auth::user()->region);
                                        echo "</select>";

                                        }
                                    ?>
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="municipality" class= "mylabel">Municipality:</label>
                                      <?php
                                      if(Auth::user()->municipality){
                                        ?>
                                        <input type = 'hidden' name = 'municipality' value = '<?php echo Auth::user()->municipality;?>'/>

                                        <?php
                                        echo Auth::user()->municipality;
                                      }else{
                                      ?>
                                      <select  class = "pure-u-11-24" required name = 'municipality' id = 'selectMunicipality'>

                                        <?php 
                                        //if lgu
                                        if(Auth::user()->department_id == 1){

                                          App\viewStrategy::getMunicipalitiessOptions(Auth::user()->province); 

                                          //elseif dilg ro
                                        } else if(Auth::user()->department_id == 3) {
                                           App\viewStrategy::getMunicipalitiessOptions2();
                                          
                                        }
                                      }
                                        ?>
                                      </select>
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="lastname" class= "mylabel">Last name:</label>
                                      <input   onkeypress = "return validate(event)" id = "applyLastname" class = "pure-u-11-24" autocomplete="off" required id="lastname" name = "lastname" type="text" >
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="firstname" class= "mylabel">First name:</label>
                                      <input onkeypress = "return validate(event)" class = "pure-u-11-24" autocomplete="off" required id="firstname" name = "firstname" type="text">
                                  </div>

                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="middlename" class= "mylabel">Middle name:</label>
                                      <input onkeypress = "return validate(event)" class = "pure-u-11-24"  autocomplete="off" id="middlename" name = "middlename" type="text" >
                                  </div>

                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label for="password" class= "mylabel">Suffix:</label>
                                      <input onkeypress = "return validate(event)"  class = "pure-u-11-24"  autocomplete="off" id="firstname" name = "suffix" type="text" >
                                  </div>
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label class= "mylabel">Birthdate:</label>
                                      <input class = "pure-u-11-24"  required id="birthdate" name = "birthdate" type="date">
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label  class= "mylabel" for="electiveposition">Position Type:</label>
                                      <select class = "pure-u-11-24"  name = 'positionType' id = "positiontype">
                                        <option value = "ELECTIVE">ELECTIVE</option>
                                        <option value = "NON ELECTIVE">NON ELECTIVE</option>
                                      </select> 
                                  </div>
                                  <div class="form-group  pure-u-1 pure-u-md-1-3">
                                      <label  class= "mylabel">Position:</label>
                                     <input class = "pure-u-11-24" type = 'Text' placeholder = "Please type the position" name= "nonelectiveposition" id = "nonelectiveposition"></input>
                                      <select name = 'position' id = "positionElective">
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
                                      <SELECT  class = "pure-u-11-24" required name = 'sex'>
                                        <option value = "">SELECT SEX</option>
                                        <option value = "male">MALE</option>
                                        <option value = "female">FEMALE</option>
                                      </select>
                                  </div>
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label  class= "mylabel" for="mobilenumber">Mobile number:</label>
                                      <input  class = "pure-u-11-24" maxlength="11" autocomplete="off" required id="mobilenumber" name = "mobilenumber" type="number" >
                                  </div>
                                    <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label  class= "mylabel" for="email">Email address:</label>
                                      <input  class = "pure-u-11-24" autocomplete="off" required id="email" name = "email" type="email">
                                  </div>
                                  <div class="form-group pure-u-1 pure-u-md-1-3">
                                      <label class= "mylabel" for="picture"><i style = "color:red">Attach only 2x2 picture</i></label>
                                        <input id = 'uploadpicture' required name = "picture" type="file" accept="image/gif, image/jpeg, image/png"></input>
                                      
                                  </div>
                                  <button type="button" class="btn btn-next">Next</button>
                                </div>
                          </fieldset>
                          
                          <fieldset>
                              <div class="form-top">
                                <div class="form-top-left">
                                  <h3>Step 2 / 3 - Travel application</h3>
                                    <p>Travel Information:</p>
                                </div>
                                <div class="form-top-right">
                                  <i class="fa fa-user"></i>
                                </div>
                                </div>
                                <div class="form-bottom">
                                
                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel" for="name">Country:</label>
                                    <select class = "pure-u-11-24" required name="country">
                                      <option value = "">Please select country</option>                      
                                      <?php
                                        foreach($countries as $country){
                                          
                                          echo "<option value = '{$country->country_name}'>{$country->country_name}</option>";
                                          
                                        }
                                      ?>
                                    </select>
                                </div>

                               

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel"for="name">Date from:</label>
                                    <input class = "pure-u-11-24" required id="datefrom" name = "datefrom" type="date">
                                </div>

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel" for="password">Date to:</label>
                                    <input class = "pure-u-11-24" required id="dateto" name = "dateto" type="date">
                                </div>
                                 <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel" for="password">Purpose:</label>
                                     <textarea autocomplete="off" required data-field="x_group_name" name="purpose" id="x_group_name" cols="40" rows="4"></textarea>
                                
                                </div>
                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class = "mylabel" for="password">Benefits:</label>
                                    <textarea autocomplete="off" data-field="x_group_name" name="benefits" id="x_group_name" cols="40" rows="4" placeholder=""></textarea>
                                
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
                                    <textarea data-field="x_group_name" name="groupDelegation" id="x_group_name" cols="40" rows="4" placeholder="IF GROUP/DELEGATION PLS LIST THE NAMES"></textarea>
                                </div>
                                

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel">Travel type:</label>
                                    <input type = 'checkbox' name = 'officialTime'>OTO (Official time only)</input>&nbsp&nbsp&nbsp
                                    <input type = 'checkbox' name = 'OfficialBusinesswithAirfare'>OB (Official Business)</input>&nbsp&nbsp&nbsp
                                    <input type = 'checkbox' name = 'OfficialLeaveOfAbsence'>OLA (Official leave of absence)</input>&nbsp&nbsp&nbsp
                                  
                                </div>

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel">Nature of travel requested:</label>
                                    
                                    <input required type = 'radio' name = 'natureOfTravelRequested' value = 'Study(Scholarship Grants)'>Study(Scholarship Grants)</input>&nbsp&nbsp&nbsp
                                    <input required type = 'radio' name = 'natureOfTravelRequested' value = 'Non study'>Non study</input>&nbsp&nbsp&nbsp
                                    <input required type = 'radio' name = 'natureOfTravelRequested' value = 'Personal'>Personal</input>
                                  
                                </div>

                                <div class="form-group pure-u-1 pure-u-md-1-3">
                                    <label class= "mylabel">Entitlement requested</label>
                                    
                                    <input  type = 'checkbox' name = 'entitlementrequestedInternationalAirfare' value = 'international airfaire (economy)'>International airfare (economy)</input>&nbsp&nbsp&nbsp
                                    <input  type = 'checkbox' name = 'entitlementrequestedTravelAllowance' value = 'travel allowance'>Travel allowance</input>&nbsp&nbsp&nbsp
                                    <input  type = 'checkbox' name = 'entitlementrequestedRegistrationParticipationFee' value = 'registration fee'>Registration fee / participation fee</input>
                                    <input  type = 'checkbox' name = 'entitlementrequestedOthers' value = 'Others'>Others</input>
                                  
                                </div>

                                <button type="button" class="btn btn-previous">Previous</button>
                                <button type="button" class="btn btn-next">Next</button>
                            </div>
                          </fieldset>
                          
                          <fieldset>
                              <div class="form-top">
                                <div class="form-top-left">
                                  <h3>Step 3 / 3 - Travel application</h3>
                                    <p>Upload documents:</p>
                                </div>
                                <div class="form-top-right">
                                  <i class="fa fa-user"></i>
                                </div>
                                </div>
                                <div class="form-bottom">
                                <div class="form-group pure-u-1 pure-u-md-1-3" id = "uploaddocuments">

                                    <label class = "mylabel" style = "color:red;">Updated picture (PLEASE UPLOAD 2x2 ONLY):</label>
                                    <input  name = "updatedPicture" type="file" required accept="image/gif, image/jpeg">
                                    <br><br><br>
                                    <h3>pls. for Administrative requirements uploading</h3>
                                    <input  name = "documents[]" type="file" accept="application/pdf"/>
                                    <label class = "mylabel" >document remarks/notes:</label>
                                    <input class = "pure-u-11-24" name = "documentremarks[]" type="text" placeholder = "type document notes/remarks"/>
                                    <br>
                                    
                                </div>
                                <button id = "addmoredocuments" type = 'button'>Add more documents</button>
                                <button type="button" class="btn btn-previous">Previous</button>
                                <button type="submit" class="btn" name = 'apply'>Apply</button>
                            </div>
                          </fieldset>
                        </form>
                        
                        </div>
                    </div>

     
     
@stop