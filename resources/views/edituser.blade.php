@extends('layout2.layoutEditUser')
@section('content')

<?php
use App\accountsStrategy;

?>

      <?php
      if(isset($_POST['apply'])){
      echo "<pre>";
        print_r($post);
      echo "</pre>";
      }
      
      ?>
      <div class="content">
          
          <div class = "header">
            <h2 style = 'color:black;'>{{$title}}</h2>
          </div>
          <div style = "margin-top:30px">
          </div>
        <div class = "">
          <a href = "{{$previousForm}}">previous</a>&nbsp&nbsp<a href = "{{$nextForm}}">next</a>
         <form class="pure-form pure-form-aligned" method="POST" action="">
           {!! csrf_field() !!}
            <fieldset style = "margin:auto;width:700px;">
                <legend style = "width=700px">Personal information</legend>
                
                <div class="pure-control-group">
                    <label for="name">Last name:</label>
                    <input id="lastname" name = "lastname" type="text" placeholder="last name" value = '{{$useraccount->lastname}}'>
                </div>
                <div class="pure-control-group">
                    <label for="password">First name:</label>
                    <input id="firstname" name = "firstname" type="text" placeholder="first name" value = '{{$useraccount->firstname}}'>
                </div>

                <div class="pure-control-group">
                    <label for="name">Middle name:</label>
                    <input id="middlename" name = "middlename" type="text" placeholder="middle name" value = '{{$useraccount->middlename}}'>
                </div>

                <div class="pure-control-group">
                    <label for="password">Suffix:</label>
                    <input id="firstname" name = "suffix" type="text" placeholder="suffix"  value = '{{$useraccount->suffix}}'>
                </div>

               <legend style = "width=700px">Account information</legend>
               
                <div class="pure-control-group">
                    <label>Account status</label>
                    <select name = 'accountstatus'>
                      <option value = 'active' {{($useraccount->accountStatus == "active") ? "selected":"" }}>Active</option>
                      <option value = 'locked' {{($useraccount->accountStatus == "locked") ? "selected":"" }}>locked</option>
                      <option value = 'not assigned' {{($useraccount->accountStatus == "not assigned") ? "selected":"" }}>not assigned</option>
                    </select>
                    
                </div> 
                <div class="pure-control-group">
                    <label>Username</label>
                    <input type = 'Text'  name= "name" value = '{{$useraccount->name}}'></input>
                    
                </div>
                <div class="pure-control-group">
                    <label>Email</label>
                    <input type = 'Text'  name= "email" value = '{{$useraccount->email}}'></input>
                </div>
                <div class="pure-control-group">
                    <label>Contact number</label>
                    <input type = 'Text'  name= "contactnumber" value = '{{$useraccount->contactnumber}}'></input>
                </div>
                <legend style = "width=700px">Assigned role</legend>



                <div class="pure-control-group">
                    <label for="password">Department:</label>
                    {{accountsStrategy::determineDepartment($useraccount->department_id)}}
                </div>

                <div class="pure-control-group">
                    <label for="password">Region:</label>
                    {{$useraccount->region}}
                </div>
               <?php if($useraccount->province): ;?>
                <div class="pure-control-group">
                    <label for="password">Province:</label>
                    {{$useraccount->province}}
                </div>
                <?php endif; ;?>
            </fieldset>

            


                <center>
                <div class="pure-controls">
                    <button type="submit" name = 'save' class="pure-button pure-button-primary">Save</button>
                  <button type="submit" name = 'resetpassword' class="pure-button pure-button-primary">reset password</button>
                  <a href = "{{$useraccount->id}}">Cancel changes</a>
                </div>
                </center>
        </form>
      </div><!-- class='content'-->
     
@stop