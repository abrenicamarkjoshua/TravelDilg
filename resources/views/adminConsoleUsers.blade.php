@extends('layout2.layout')
@section('content')
<?php
use App\accountsStrategy;
use App\viewStrategy;
?>
      <div class="content">
           <h4>Logged in as: <?php echo Auth::user()->lastname . ", " . Auth::user()->firstname;?></br>
           Region: <?php echo Auth::user()->region;?><br/>
           <?php
           if(Auth::user()->province){
            ?>
            Province: <?php echo Auth::user()->province;?>
           
            <?php
           }


           ?><br>
            Date today: <?php 

date_default_timezone_set("Asia/Manila"); 
            echo date("Y-m-d")?><br/>

            Department: <?php echo $department;?>
           </h4>
          <div style = "margin-top:30px">
          </div>
          <div class = "header">
            <h2 style = 'color:white;'>{{$title}}</h2>

          </div>

<form class="pure-form pure-form-aligned" action = '' method = 'post'>
   {!! csrf_field() !!}
    <div>
        <legend>Search</legend>
        <div class = "pure-control-group">
          <input type="text" placeholder="username" name = "username" value = "{{(isset($_POST['username'])) ? $_POST['username'] : ''}}"/>
        </div>
        <div class = "pure-control-group">
          <select name = 'region' placeholder = 'region'>
            <?php
            echo viewStrategy::getAllRegionsOptions();
            ?>
          </select>
        </div>
        <div class = "pure-control-group">
          <select name = 'province'>
            
            <?php echo viewStrategy::getAllProvincesOptions(); ?>
          </select>
        </div>
        <div class = "pure-control-group">
          <select name = 'municipality'>
            
            <?php echo viewStrategy::getAllMunicipalitiesOptions(); ?>
          </select>
        </div>
        <div class = "pure-control-group">
          <select name = 'department'>
          
          <?php
          echo viewStrategy::getAllDepartmentsOptions();
          ?>
          </select>
        </div>
        <div class = "pure-control-group">
          <select name = 'accountstatus'>
          
          <?php
          echo viewStrategy::getAllAccountStatusOptions();
          ?>
          </select>
        </div>
        <button type="submit" name = 'search' class="pure-button pure-button-primary">Search</button>
    </div>
</form>

          <table class="pure-table">
                  <thead>
                  <tr>
                      <th>Account status</th>
                      <th>last name</th>
                      <th>first name</th>
                      <th>middlename</th>
                      <th>suffix</th>
                      <th>username</th>
                      <th>email</th>
                      <th>region</th>
                      <th>province</th>
                      <th>city/municipality</th>
                      <th>department</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <?php
                  $i = 0;
                  foreach($useraccounts as $useraccount){
                  ?>
                  <tr  <?php if($i % 2 == 0) {echo 'class="pure-table-odd"';} else {echo 'class="pure-table-even"';} $i++; ;?>>
                    <td>{{$useraccount->accountStatus}}               </td>
                    <td>{{$useraccount->lastname}}                    </td>
                    <td>{{$useraccount->firstname}}                   </td>
                    <td>{{$useraccount->middlename}}                  </td>
                    <td>{{$useraccount->suffix}}                      </td>
                    <td>{{$useraccount->name}}                        </td>
                    <td>{{$useraccount->email}}                       </td>
                    <td>{{$useraccount->region}}                      </td>
                    <td>{{$useraccount->province}}                    </td>
                    <td>{{$useraccount->municipality}}                    </td>
                   
                    <td>{{accountsStrategy::determineDepartment($useraccount->department_id)}}</td>
                    <td><form action = '../editUser/{{$useraccount->id}}' method = 'post'>
                       {!! csrf_field() !!}
                      <input type = 'hidden' name = 'user_id' value = '{{$useraccount->id}}' />
                      <input type = 'submit' name = 'btnsubmit' value = 'Edit' />
                      </form>
                    </td>
                    <td>

                      </td>
                  </tr>
                  
                  
                  <?php
                    }
                  ?>
          </table>
      </div><!-- class='content'-->
     
@stop