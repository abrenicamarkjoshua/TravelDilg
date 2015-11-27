
@extends('layout2.layout')
@section('content')

      <div class="content">
           <h4>Logged in as: <?php echo Auth::user()->lastname . ", " . Auth::user()->firstname;?></br>
           <?php 
            echo (Auth::user()->region) ? ("Region: " . Auth::user()->region . "<br/>") : "";
            $provinceOrCity = (Auth::user()->region == "NATIONAL CAPITAL REGION (NCR)") ? "City: " : "Province: ";
            echo (Auth::user()->province) ? ($provinceOrCity . Auth::user()->province."<br>") : "" ;
            echo (Auth::user()->municipality) ? ("Municipality: ".Auth::user()->municipality."<br>") : "" ;
           
            ?><br>
            Date today: <?php 

date_default_timezone_set("Asia/Manila"); 
            echo date("Y-m-d")?><br/>

            Department: <label id = "mydepartment"><?php echo $department;?></label>
           </h4>
          <div class = "header">
            <h2 style = 'color:white;'>{{$title}}</h2>

          </div>
          <div style = "margin-top:30px">
          </div>
           <div style="width: 100%;background-color:white; margin-bottom:10px;">
            <table class = "pure-table"  style="table-layout:fixed;">
                
                <tr style = "background-color:white;">
                  <form action = '' method = 'post'>
                    {!! csrf_field() !!}
                   
                    <td  style = "width:197px">
                      <select name = 'travelstatus'>
                        <?php
                        echo App\viewStrategy::getAllTravelStatusOptions($department);
                        ?>
                      </select>
                    </td>
                    
                  @if($department != "LGU" && $department != "DILG PO")
                    @if($department != "DILG RO")
                    <td style = "width:197px">
                      <select name = 'region' placeholder = 'region'>
                        <?php
                        echo App\viewStrategy::getAllRegionsOptions();
                        ?>
                      </select>
                    </td>
                    @endif
                    <td style = "width:197px">
                      <select name = 'province'>
                        
                        <?php echo App\viewStrategy::getAllProvincesOptions(); ?>
                      </select>
                    </td>
                  @endif
                    <?php
                       if(Auth::user()->municipality){
                       }
                       else{
                      ?>
                    <td  style = "width:197px" >

                      <select name = 'municipality'>
                        
                        <?php 

                        echo (Auth::user()->province) ?App\viewStrategy::getMunicipalitiessOptions(Auth::user()->province, (isset($_POST['municipality']) ? $_POST['municipality']: ""))  : App\viewStrategy::getAllMunicipalitiesOptions(); 


                        ?>
                      </select>
                    </td>
                   <?php
                    }
                      ?>
                      <td>
                      </td>
                    <td><button type = 'submit' class="btn btn-next" name = 'btnSearch'>Search</button></td>
                  </form>
                </tr>
            </table>
           </div>
          <div>
          <table class="pure-table">

                  <thead>
                  <tr>
                      <th style = "width:197px">Travelcode</th>
                      <th  style = "width:197px">STATUS</th>
                     
                   @if($department != "LGU")
                      @if($department != "DILG RO")
                      
                      <th style = "width:197px">REGION</th>
                      @endif
                      <th style = "width:197px">{{(Auth::user()->region == "NATIONAL CAPITAL REGION (NCR)" ) ? "CITY" : "PROVINCE/DISTRICT"}}</th>
                    @endif
                      <th  style = "width:197px" >{{(Auth::user()->region == "NATIONAL CAPITAL REGION (NCR)" ) ? "MUNICIPALITY" : "CITY/MUNICIPALITY"}}</th>
                      <th  style = "width:197px" >FIRSTNAME</th>
                      <th  style = "width:197px" >LASTNAME</th>
                      <th  style = "width:197px" >TYPE OF POSITION</th>
                      <th  style = "width:197px" >NATURE OF TRAVEL</th>
                      <th  style = "width:197px" >DESIGNATION</th>
                      <th  style = "width:197px" >DURATION</th>
                      <th  style = "width:197px" >DATE APPLIED</th>
                      <th style = "width:197px">DATE APPROVED</th>
                      <th></th>
                    </tr>
                  </thead>
                  <?php
                  for($i = 0; $i <= count($travelApplications)-1; $i++){
                  ?>
                  
                    
                  <tr  <?php if($i % 2 == 0) {echo 'class="pure-table-odd"';} else{echo 'class="pure-table-even"';} ;?>>
                    <td>{{$travelApplications[$i]->id}}</td>
                    <td>{{$travelApplications[$i]->applicationstatus}}</td>
                    @if($department != "LGU")
                      @if($department != "DILG RO")
                      <td>{{$travelApplications[$i]->region}}</td>
                      @endif
                    <td>{{$travelApplications[$i]->province}}</td>
                    @endif
                    <td>{{$travelApplications[$i]->municipality}}</td>
                    <td>{{$travelApplications[$i]->firstname}}</td>
                    <td>{{$travelApplications[$i]->lastname}}</td>
                    <td>{{$travelApplications[$i]->positionType}}</td>
                    <td>{{$travelApplications[$i]->travelType}}</td>
                    <td>{{$travelApplications[$i]->position}}</td>
                    <td><?php
                    $datetime1 = new DateTime($travelApplications[$i]->flightinfo_datefrom);
                        $datetime2 = new DateTime($travelApplications[$i]->flightinfo_dateto);
                        $interval = $datetime1->diff($datetime2);
                        $days = ($interval->d > 1) ? "days" : "day";
                      echo $interval->format('%a') . " " .$days;
                    ?></td>
                    <td>{{$travelApplications[$i]->created_at}}</td>

                    <td>{{$travelApplications[$i]->dateapproved}}</td>
                    <td style="white-space:nowrap">
                      <?php
                      echo App\viewStrategy::TravelListAction($department, $travelApplications[$i]);
                      ?>
                      <form action = 'printcertificate/{{$travelApplications[$i]->id}}' method = 'post'>
                      {!! csrf_field() !!}
                        <input type = 'submit' name = 'btnViewCertificate' value = 'View Travel Authority' />

                      </form>
                    </td>
                    @if($travelApplications[$i]->applicationstatus != "APPROVED")
                  <script>
function saveRemarks{!! $travelApplications[$i]->id !!}(){
    
        var token = document.getElementsByName('_token').value;
        $.ajax({
          type: 'GET',
          headers: {'X-CSRF-TOKEN': token},
          url: '../saveRemarks',
          data: { 'remarks' : $("textarea#remarks{!! $travelApplications[$i]->id !!}").val(), 'applicationId' : {!! $travelApplications[$i]->id !!} },
          dataType: 'json',
          success: function(travel) {
              
              $("textarea#remarks{!! $travelApplications[$i]->id !!}").html(travel.remarks);
          },
          error: function(j) {
            alert('Error loading: ');
          }
        });

    
}
                  </script> 
                  @endif
                  </tr>
                  
                  
                  <?php
                    }
                  ?>
          </table>
        </div>
      </div><!-- class='content'-->
     
@stop