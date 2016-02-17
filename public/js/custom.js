
$("#btnAddTravel").click(function(){
  suffix++;
var country = $("#country").val();

var datefrom = $("#datefrom").val();
 
var dateto = $("#dateto").val();
var purpose = $("#purpose").val();
var benefits = $("#benefits").val();
var groupDelegation = $("#groupDelegation").val();
var natureOfTravelRequested = $("#natureOfTravelRequested").val();
var travelType = $("#travelType").val();
var entitlementsRequested = "";
"<input type = 'checkbox' onchange = 'displayUnderTravelAllowance()' name = 'entitlementrequestedTravelAllowance' id = 'entitlementrequestedTravelAllowance' >Travel allowance</input>&nbsp&nbsp&nbsp<input type = 'checkbox' name = 'entitlementrequestedInternationalAirfare' >International airfare (economy)</input>&nbsp&nbsp&nbsp<input {{$checkParticipationFee}} type = 'checkbox' name = 'entitlementrequestedRegistrationParticipationFee' >Registration fee / participation fee</input><input {{$checkOthers}} type = 'checkbox' name = 'entitlementrequestedOthers' >Others</input>";
        
if($("#entitlementrequestedTravelAllowance").is(':checked')){
  entitlementsRequested += " Travel Allowance,";
}
if($("#entitlementrequestedInternationalAirfare").is(':checked')){
  entitlementsRequested += " International Airfare,";
}
if($("#entitlementrequestedInternationalAirfare").is(':checked')){
  entitlementsRequested += " International Airfare (economy),";
}
if($("#entitlementrequestedRegistrationParticipationFee").is(':checked')){
  entitlementsRequested += " Registration fee / participation fee,";
}
if($("#natureOfTravelRequested").val() == "Non study" || $("#natureOfTravelRequested").val() == "Personal"){
  if($("#travelType").val() == "OTO" || $("#travelType").val() == "OB"){
    entitlementsRequested += " " + $("#travel_administrativeRequirements").val() + ",";
  }
}
entitlementsRequested = entitlementsRequested.slice(0, -1);

var underTravelAllowance = "";
if($("#hotelLoggingExpenses").is(':checked')){
  underTravelAllowance  += " Hotel/Logging expenses,";
}
if($("#mealsExpenses").is(':checked')){
  underTravelAllowance  += " Meals expenses,";
}
if($("#Incidental").is(':checked')){
  underTravelAllowance  += " Incidental,";
}
underTravelAllowance = underTravelAllowance.slice(0, -1);



   $('#addTravelDiv:last-child').after('<div id = "addTravelDiv" style = "display:none;border-style:solid; padding:30px; margin-bottom:10px;">' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
    '<label class= "mylabel" for="name">Country:</label>' +
    country + '<input type = "hidden" name = "travel_country[]" value = "' + country + '" />' +
    '</div>' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
      '<label class= "mylabel"for="name">Date from:</label>' +
      datefrom + '<input type = "hidden" name = "travel_datefrom[]" value = "' + datefrom + '" />' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
      '<label class= "mylabel" for="password">Date to:</label>' +
      dateto + '<input type = "hidden" name = "travel_dateto[]" value = "' + dateto + '" />' +
    '</div>' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
      '<label class= "mylabel" for="password">Purpose:</label>' +
      purpose + '<input type = "hidden" name = "travel_purpose[]" value = "' + purpose + '" />' +
    '</div>' + 
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
      '<label class = "mylabel" for="password">Benefits:</label>' +
      benefits + '<input type = "hidden" name = "travel_benefits[]" value = "' + benefits + '" />' +
    '</div>' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">'+
        '<label class= "mylabel" for="password">If group/delegation, please list their names:</label>' +
        groupDelegation + '<input type = "hidden" name = "travel_groupdelegation[]" value = "' + groupDelegation + '" />' +
    '</div>' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
        '<label class= "mylabel">Nature of travel requested:</label>' +
        natureOfTravelRequested + '<input type = "hidden" name = "travel_natureoftravelrequested[]" value = "' + natureOfTravelRequested + '" />' +
    '</div>' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
        '<label class= "mylabel">Travel type:</label>' +
       travelType + '<input type = "hidden" name = "travel_traveltype[]" value = "' + travelType + '" />' +
    '</div>' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
        '<label class= "mylabel">Entitlement requested</label>' +
        entitlementsRequested + '<input type = "hidden" name = "travel_entitlmentsrequested[]" value = "' + entitlementsRequested + '" />' +
    '</div>' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
       '<label class= "mylabel">Under travel allowance (if selected)</label>' +
       underTravelAllowance + '<input type = "hidden" name = "travel_undertravelallowance[]" value = "' + underTravelAllowance + '" />' +
    
    '</div>' +
    '<div class="form-group pure-u-1 pure-u-md-1-3">' +
       '<button type = "button" class = "remove">Remove</button>' +
    '</div>' +
  '</div>'
      );
  
$('#addTravelDiv:last-child').show('slow');

 //clear data inputs

clear_form_elements("aform");

});
function clear_form_elements(class_name) {
  jQuery("."+class_name).find(':input').each(function() {
    switch(this.type) {
        case 'password':
        case 'text':
        case 'textarea':
        case 'file':
        case 'select-one':
        case 'select-multiple':
            jQuery(this).val('');
            break;
        case 'checkbox':
        case 'radio':
            this.checked = false;
    }
  });
}
function displayUnderTravelAllowance(){
  var output = "";
  var ischecked= $("#entitlementrequestedTravelAllowance").is(':checked');
  if(ischecked){
    output = "<label>Under travel allowance:&nbsp&nbsp</label><input type = 'checkbox' name = 'hotelLoggingExpenses' id = 'hotelLoggingExpenses'>Hotel/Logging expenses</input>&nbsp&nbsp&nbsp<input type = 'checkbox' name = 'mealsExpenses' id = 'mealsExpenses'>Meals expenses</input>&nbsp&nbsp&nbsp<input type = 'checkbox' name = 'Incidental' id = 'Incidental'>Incidental</input>&nbsp&nbsp&nbsp";
    
  } else{

    output = "";
  }
   $("#outputUnderTravelAllowance").html(output);
}
function populateTravelType(){
  var output = "";
  switch($("#natureOfTravelRequested").val()){
    case "Study(Scholarship Grants)": 
      output = "<option value = '' >please select</option><option value = 'OTO'>OTO (Official time only)</option><option value = 'OB'>OB (Official Business)</option>";
    break;

    case "Non study":
      output = "<option value = '' >please select</option><option value = 'OTO'>OTO (Official time only)</option><option value = 'OB'>OB (Official Business)</option>";
    break;

    case "Personal":
      output = "<option value = ''>please select</option><option value = 'OLA'>OLA (Official leave of absence)</option>";
    break;
  }
   $("#travelType").html(output);
 
}
function populateEntitlementsRequested(){
var output = "";
 switch($("#natureOfTravelRequested").val()){
    case "Study(Scholarship Grants)":
      switch($("#travelType").val()){
        case "OTO":
           output = "";
        break;
        case "OB":
          output = "<input type = 'checkbox' onchange = 'displayUnderTravelAllowance()' name = 'entitlementrequestedTravelAllowance' id = 'entitlementrequestedTravelAllowance' >Travel allowance</input>&nbsp&nbsp&nbsp<input type = 'checkbox' name = 'entitlementrequestedInternationalAirfare' >International airfare (economy)</input>&nbsp&nbsp&nbsp<input {{$checkParticipationFee}} type = 'checkbox' name = 'entitlementrequestedRegistrationParticipationFee' >Registration fee / participation fee</input><input {{$checkOthers}} type = 'checkbox' name = 'entitlementrequestedOthers' >Others</input>";
        break;

        
      } 
    break;
    case "Non study":

      switch($("#travelType").val()){
          case "OTO":
            output = "<label>choose only one for administrative requirements:</label> <select name = 'travel_administrativeRequirements[]' id = 'travel_administrativeRequirements'><option value = ''>Please select</option><option value ='Attendance to training, seminar and workshop'>Attendance to training, seminar and workshop</option><option value = 'Attendance to an event that promotes local government technical exchange and cooperation or sister-city/town twinning relations'>Attendance to an event that promotes local government technical exchange and cooperation or sister-city/town twinning relations</option><option value = 'LGUs initiated study cum observation tour'>LGUs initiated study cum observation tour</option><option value = 'national government agencies organized study cum observation tour'>national government agencies organized study cum observation tour</option></select>";
          break;
          case "OB":
          output = "<label>choose only one for administrative requirements:</label> <select name = 'travel_administrativeRequirements[]'  id = 'travel_administrativeRequirements'><option value = ''>Please select</option><option value ='Attendance to training, seminar and workshop'>Attendance to training, seminar and workshop</option><option value = 'Attendance to an event that promotes local government technical exchange and cooperation or sister-city/town twinning relations'>Attendance to an event that promotes local government technical exchange and cooperation or sister-city/town twinning relations</option><option value = 'LGUs initiated study cum observation tour'>LGUs initiated study cum observation tour</option><option value = 'national government agencies organized study cum observation tour'>national government agencies organized study cum observation tour</option></select>";
          break;

        } 
    break;

    case "Personal":
      switch($("#travelType").val()){
          case "OLA":
          output = "<label>choose only one for Official leave of absence:</label> <select name = 'travel_administrativeRequirements[]'  id = 'travel_administrativeRequirements'><option value = ''>Please select</option><option value ='Governor, mayor of highly urbanized cities and independent component cities'>Governor, mayor of highly urbanized cities and independent component cities</option><option value = 'Other Elected Officials and LGU Department heads'>Other Elected Officials and LGU Department heads</option><option value = 'under suspension'>under suspension</option><option value = 'without pending case'>without pending case</option><option value = 'SL'>SL</option><option value = 'VL'>VL</option><option value = 'SPL'>SPL</option></select>";
          break;
      }
    break;
  }


 
   $("#outputEntitlementsRequested").html(output);
 
}


$(function(){
    $("select#applySelectProvince").change(function(){
        var token = document.getElementsByName('_token').value;
        $.ajax({
          type: 'GET',
          headers: {'X-CSRF-TOKEN': token},
          url: '../getMunicipalitiesByProvince',
          data: { 'province' : $("select#applySelectProvince").val() },
          dataType: 'json',
          success: function(j) {
              var options = '';
              for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].citymunDesc + '">' + j[i].citymunDesc + '</option>';
              }
              $("select#selectMunicipality").html(options);
          },
          error: function(j) {
            alert('Error loading: ');
          }
        });

    });
  // $("select#applySelectProvince").change(function(){
  //   $.getJSON("/getMunicipalitiesByProvince",
  //       {id: $(this).val(),
         
  //       ajax: 'true'}, function(j){
  //     var options = '';
  //     for (var i = 0; i < j.length; i++) {
  //       options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
  //     }
  //     $("select#selectMunicipality").html(options);
  //   });
  // })
});
$('#mobilenumber').unbind('keyup change input paste').bind('keyup change input paste',function(e){
    var $this = $(this);
    var val = $this.val();
    var valLength = val.length;
    var maxCount = $this.attr('maxlength');
    if(valLength>maxCount){
        $this.val($this.val().substring(0,maxCount));
    }
}); 

//INPUT validation letters, spaces, and dot only
function validate(e){
    if(("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ. ").indexOf(String.fromCharCode(e.keyCode))===-1){
        e.preventDefault();
        return false;
    }
}

function checkEmail(emailAddress) {
 
   var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(emailAddress);
}

$('.optionBox').on('click','.remove',function() {
  //$(this).parent().parent().remove();
  $(this).parent().parent().parent().hide('slow', function(){ $(this).find("input[type=text], textarea, input[type=hidden]").val("").remove() });

});
$("#addmorecountry").click(function(){
        $('#addcountries').append("<br><select class='pure-u-11-24' name='country[]'><option value=''>Please select country</option><option value='United States'>United States</option><option value='Canada'>Canada</option><option value='Afghanistan'>Afghanistan</option><option value='Albania'>Albania</option><option value='Algeria'>Algeria</option><option value='American Samoa'>American Samoa</option><option value='Andorra'>Andorra</option><option value='Angola'>Angola</option><option value='Anguilla'>Anguilla</option><option value='Antarctica'>Antarctica</option><option value='Antigua and/or Barbuda'>Antigua and/or Barbuda</option><option value='Argentina'>Argentina</option><option value='Armenia'>Armenia</option><option value='Aruba'>Aruba</option><option value='Australia'>Australia</option><option value='Austria'>Austria</option><option value='Azerbaijan'>Azerbaijan</option><option value='Bahamas'>Bahamas</option><option value='Bahrain'>Bahrain</option><option value='Bangladesh'>Bangladesh</option><option value='Barbados'>Barbados</option><option value='Belarus'>Belarus</option><option value='Belgium'>Belgium</option><option value='Belize'>Belize</option><option value='Benin'>Benin</option><option value='Bermuda'>Bermuda</option><option value='Bhutan'>Bhutan</option><option value='Bolivia'>Bolivia</option><option value='Bosnia and Herzegovina'>Bosnia and Herzegovina</option><option value='Botswana'>Botswana</option><option value='Bouvet Island'>Bouvet Island</option><option value='Brazil'>Brazil</option><option value='British Indian Ocean Territory'>British Indian Ocean Territory</option><option value='Brunei Darussalam'>Brunei Darussalam</option><option value='Bulgaria'>Bulgaria</option><option value='Burkina Faso'>Burkina Faso</option><option value='Burundi'>Burundi</option><option value='Cambodia'>Cambodia</option><option value='Cameroon'>Cameroon</option><option value='Cape Verde'>Cape Verde</option><option value='Cayman Islands'>Cayman Islands</option><option value='Central African Republic'>Central African Republic</option><option value='Chad'>Chad</option><option value='Chile'>Chile</option><option value='China'>China</option><option value='Christmas Island'>Christmas Island</option><option value='Cocos (Keeling) Islands'>Cocos (Keeling) Islands</option><option value='Colombia'>Colombia</option><option value='Comoros'>Comoros</option><option value='Congo'>Congo</option><option value='Cook Islands'>Cook Islands</option><option value='Costa Rica'>Costa Rica</option><option value='Croatia (Hrvatska)'>Croatia (Hrvatska)</option><option value='Cuba'>Cuba</option><option value='Cyprus'>Cyprus</option><option value='Czech Republic'>Czech Republic</option><option value='Denmark'>Denmark</option><option value='Djibouti'>Djibouti</option><option value='Dominica'>Dominica</option><option value='Dominican Republic'>Dominican Republic</option><option value='East Timor'>East Timor</option><option value='Ecuador'>Ecuador</option><option value='Egypt'>Egypt</option><option value='El Salvador'>El Salvador</option><option value='Equatorial Guinea'>Equatorial Guinea</option><option value='Eritrea'>Eritrea</option><option value='Estonia'>Estonia</option><option value='Ethiopia'>Ethiopia</option><option value='Falkland Islands (Malvinas)'>Falkland Islands (Malvinas)</option><option value='Faroe Islands'>Faroe Islands</option><option value='Fiji'>Fiji</option><option value='Finland'>Finland</option><option value='France'>France</option><option value='France, Metropolitan'>France, Metropolitan</option><option value='French Guiana'>French Guiana</option><option value='French Polynesia'>French Polynesia</option><option value='French Southern Territories'>French Southern Territories</option><option value='Gabon'>Gabon</option><option value='Gambia'>Gambia</option><option value='Georgia'>Georgia</option><option value='Germany'>Germany</option><option value='Ghana'>Ghana</option><option value='Gibraltar'>Gibraltar</option><option value='Guernsey'>Guernsey</option><option value='Greece'>Greece</option><option value='Greenland'>Greenland</option><option value='Grenada'>Grenada</option><option value='Guadeloupe'>Guadeloupe</option><option value='Guam'>Guam</option><option value='Guatemala'>Guatemala</option><option value='Guinea'>Guinea</option><option value='Guinea-Bissau'>Guinea-Bissau</option><option value='Guyana'>Guyana</option><option value='Haiti'>Haiti</option><option value='Heard and Mc Donald Islands'>Heard and Mc Donald Islands</option><option value='Honduras'>Honduras</option><option value='Hong Kong'>Hong Kong</option><option value='Hungary'>Hungary</option><option value='Iceland'>Iceland</option><option value='India'>India</option><option value='Isle of Man'>Isle of Man</option><option value='Indonesia'>Indonesia</option><option value='Iran (Islamic Republic of)'>Iran (Islamic Republic of)</option><option value='Iraq'>Iraq</option><option value='Ireland'>Ireland</option><option value='Israel'>Israel</option><option value='Italy'>Italy</option><option value='Ivory Coast'>Ivory Coast</option><option value='Jersey'>Jersey</option><option value='Jamaica'>Jamaica</option><option value='Japan'>Japan</option><option value='Jordan'>Jordan</option><option value='Kazakhstan'>Kazakhstan</option><option value='Kenya'>Kenya</option><option value='Kiribati'>Kiribati</option><option value='Korea, Democratic People' s='' republic='' of'=''>Korea, Democratic People's Republic of</option><option value='Korea, Republic of'>Korea, Republic of</option><option value='Kosovo'>Kosovo</option><option value='Kuwait'>Kuwait</option><option value='Kyrgyzstan'>Kyrgyzstan</option><option value='Lao People' s='' democratic='' republic'=''>Lao People's Democratic Republic</option><option value='Latvia'>Latvia</option><option value='Lebanon'>Lebanon</option><option value='Lesotho'>Lesotho</option><option value='Liberia'>Liberia</option><option value='Libyan Arab Jamahiriya'>Libyan Arab Jamahiriya</option><option value='Liechtenstein'>Liechtenstein</option><option value='Lithuania'>Lithuania</option><option value='Luxembourg'>Luxembourg</option><option value='Macau'>Macau</option><option value='Macedonia'>Macedonia</option><option value='Madagascar'>Madagascar</option><option value='Malawi'>Malawi</option><option value='Malaysia'>Malaysia</option><option value='Maldives'>Maldives</option><option value='Mali'>Mali</option><option value='Malta'>Malta</option><option value='Marshall Islands'>Marshall Islands</option><option value='Martinique'>Martinique</option><option value='Mauritania'>Mauritania</option><option value='Mauritius'>Mauritius</option><option value='Mayotte'>Mayotte</option><option value='Mexico'>Mexico</option><option value='Micronesia, Federated States of'>Micronesia, Federated States of</option><option value='Moldova, Republic of'>Moldova, Republic of</option><option value='Monaco'>Monaco</option><option value='Mongolia'>Mongolia</option><option value='Montenegro'>Montenegro</option><option value='Montserrat'>Montserrat</option><option value='Morocco'>Morocco</option><option value='Mozambique'>Mozambique</option><option value='Myanmar'>Myanmar</option><option value='Namibia'>Namibia</option><option value='Nauru'>Nauru</option><option value='Nepal'>Nepal</option><option value='Netherlands'>Netherlands</option><option value='Netherlands Antilles'>Netherlands Antilles</option><option value='New Caledonia'>New Caledonia</option><option value='New Zealand'>New Zealand</option><option value='Nicaragua'>Nicaragua</option><option value='Niger'>Niger</option><option value='Nigeria'>Nigeria</option><option value='Niue'>Niue</option><option value='Norfolk Island'>Norfolk Island</option><option value='Northern Mariana Islands'>Northern Mariana Islands</option><option value='Norway'>Norway</option><option value='Oman'>Oman</option><option value='Pakistan'>Pakistan</option><option value='Palau'>Palau</option><option value='Palestine'>Palestine</option><option value='Panama'>Panama</option><option value='Papua New Guinea'>Papua New Guinea</option><option value='Paraguay'>Paraguay</option><option value='Peru'>Peru</option><option value='Philippines'>Philippines</option><option value='Pitcairn'>Pitcairn</option><option value='Poland'>Poland</option><option value='Portugal'>Portugal</option><option value='Puerto Rico'>Puerto Rico</option><option value='Qatar'>Qatar</option><option value='Reunion'>Reunion</option><option value='Romania'>Romania</option><option value='Russian Federation'>Russian Federation</option><option value='Rwanda'>Rwanda</option><option value='Saint Kitts and Nevis'>Saint Kitts and Nevis</option><option value='Saint Lucia'>Saint Lucia</option><option value='Saint Vincent and the Grenadines'>Saint Vincent and the Grenadines</option><option value='Samoa'>Samoa</option><option value='San Marino'>San Marino</option><option value='Sao Tome and Principe'>Sao Tome and Principe</option><option value='Saudi Arabia'>Saudi Arabia</option><option value='Senegal'>Senegal</option><option value='Serbia'>Serbia</option><option value='Seychelles'>Seychelles</option><option value='Sierra Leone'>Sierra Leone</option><option value='Singapore'>Singapore</option><option value='Slovakia'>Slovakia</option><option value='Slovenia'>Slovenia</option><option value='Solomon Islands'>Solomon Islands</option><option value='Somalia'>Somalia</option><option value='South Africa'>South Africa</option><option value='South Georgia South Sandwich Islands'>South Georgia South Sandwich Islands</option><option value='Spain'>Spain</option><option value='Sri Lanka'>Sri Lanka</option><option value='St. Helena'>St. Helena</option><option value='St. Pierre and Miquelon'>St. Pierre and Miquelon</option><option value='Sudan'>Sudan</option><option value='Suriname'>Suriname</option><option value='Svalbard and Jan Mayen Islands'>Svalbard and Jan Mayen Islands</option><option value='Swaziland'>Swaziland</option><option value='Sweden'>Sweden</option><option value='Switzerland'>Switzerland</option><option value='Syrian Arab Republic'>Syrian Arab Republic</option><option value='Taiwan'>Taiwan</option><option value='Tajikistan'>Tajikistan</option><option value='Tanzania, United Republic of'>Tanzania, United Republic of</option><option value='Thailand'>Thailand</option><option value='Togo'>Togo</option><option value='Tokelau'>Tokelau</option><option value='Tonga'>Tonga</option><option value='Trinidad and Tobago'>Trinidad and Tobago</option><option value='Tunisia'>Tunisia</option><option value='Turkey'>Turkey</option><option value='Turkmenistan'>Turkmenistan</option><option value='Turks and Caicos Islands'>Turks and Caicos Islands</option><option value='Tuvalu'>Tuvalu</option><option value='Uganda'>Uganda</option><option value='Ukraine'>Ukraine</option><option value='United Arab Emirates'>United Arab Emirates</option><option value='United Kingdom'>United Kingdom</option><option value='United States minor outlying islands'>United States minor outlying islands</option><option value='Uruguay'>Uruguay</option><option value='Uzbekistan'>Uzbekistan</option><option value='Vanuatu'>Vanuatu</option><option value='Vatican City State'>Vatican City State</option><option value='Venezuela'>Venezuela</option><option value='Vietnam'>Vietnam</option><option value='Virgin Islands (British)'>Virgin Islands (British)</option><option value='Virgin Islands (U.S.)'>Virgin Islands (U.S.)</option><option value='Wallis and Futuna Islands'>Wallis and Futuna Islands</option><option value='Western Sahara'>Western Sahara</option><option value='Yemen'>Yemen</option><option value='Yugoslavia'>Yugoslavia</option><option value='Zaire'>Zaire</option><option value='Zambia'>Zambia</option><option value='Zimbabwe'>Zimbabwe</option>                                      </select>");

});

$("#addmoredocuments").click(function(){
        $('#uploaddocuments').append(' <input  name = "documents[]" type="file" accept="application/pdf"><label class = "mylabel" for="password">document remarks/notes:</label><input class = "pure-u-11-24" name = "documentremarks[]" type="text" placeholder = "type document notes/remarks"/><br>');

});

$("#positionElective").show();
$("#nonelectiveposition").hide();
if($("#positiontype").val() == "NON ELECTIVE"){
  $("#positionElective").hide();
  $("#nonelectiveposition").show();

}
$(document).ready(function() {
    $("#positiontype").change(function(){
        if($(this).val() == "NON ELECTIVE")
            {
                $("#nonelectiveposition").show();
                $("#positionElective").hide();
            }
            else{
                $("#nonelectiveposition").hide();
                $("#positionElective").show();
            }
        });
});

(function (window, document) {
document.getElementById('toggle').addEventListener('click', function (e) {
    document.getElementById('tuckedMenu').classList.toggle('custom-menu-tucked');
    document.getElementById('toggle').classList.toggle('x');
});
})(this, this.document);


// $(function(){

//     $("table").stickyTableHeaders();
// });

(function ($) {
    $.StickyTableHeaders = function (el, options) {
        // To avoid scope issues, use 'base' instead of 'this'
        // to reference this class from internal events and functions.
        var base = this;

        // Access to jQuery and DOM versions of element
        base.$el = $(el);
        base.el = el;

        // Add a reverse reference to the DOM object
        base.$el.data('StickyTableHeaders', base);

        base.init = function () {
            base.options = $.extend({}, $.StickyTableHeaders.defaultOptions, options);

            base.$el.each(function () {
                var $this = $(this);
                $this.wrap('<div class="divTableWithFloatingHeader" style="position:relative"></div>');

                var originalHeaderRow = $('thead:first', this);
                originalHeaderRow.before(originalHeaderRow.clone());
                var clonedHeaderRow = $('thead:first', this);

                clonedHeaderRow.addClass('tableFloatingHeader');
                clonedHeaderRow.css('position', 'fixed');
                clonedHeaderRow.css('top', '0px');
                clonedHeaderRow.css('left', $this.css('margin-left'));
                clonedHeaderRow.css('display', 'none');

                originalHeaderRow.addClass('tableFloatingHeaderOriginal');

                // enabling support for jquery.tablesorter plugin
                $this.bind('sortEnd', function (e) { base.updateCloneFromOriginal(originalHeaderRow, clonedHeaderRow); });
            });

            base.updateTableHeaders();
            $(window).scroll(base.updateTableHeaders);
            $(window).resize(base.updateTableHeaders);
        };

        base.updateTableHeaders = function () {
            base.$el.each(function () {
                var $this = $(this);
                var $window = $(window);

                var fixedHeaderHeight = isNaN(base.options.fixedOffset) ? base.options.fixedOffset.height() : base.options.fixedOffset;

                var originalHeaderRow = $('.tableFloatingHeaderOriginal', this);
                var floatingHeaderRow = $('.tableFloatingHeader', this);
                var offset = $this.offset();
                var scrollTop = $window.scrollTop() + fixedHeaderHeight;
                var scrollLeft = $window.scrollLeft();

                if ((scrollTop > offset.top) && (scrollTop < offset.top + $this.height())) {
                    floatingHeaderRow.css('top', fixedHeaderHeight + 'px');
                    floatingHeaderRow.css('margin-top', 0);
                    floatingHeaderRow.css('left', (offset.left - scrollLeft) + 'px');
                    floatingHeaderRow.css('display', 'block');

                    base.updateCloneFromOriginal(originalHeaderRow, floatingHeaderRow);
                }
                else {
                    floatingHeaderRow.css('display', 'none');
                }
            });
        };

        base.updateCloneFromOriginal = function (originalHeaderRow, floatingHeaderRow) {
            // Copy cell widths and classes from original header
            $('th', floatingHeaderRow).each(function (index) {
                $this = $(this);
                var origCell = $('th', originalHeaderRow).eq(index);
                $this.removeClass().addClass(origCell.attr('class'));
                $this.css('width', origCell.width() + 10);
            });

            // Copy row width from whole table
            floatingHeaderRow.css('width', originalHeaderRow.width());
        };

        // Run initializer
        base.init();
    };

    $.StickyTableHeaders.defaultOptions = {
        fixedOffset: 0
    };

    $.fn.stickyTableHeaders = function (options) {
        return this.each(function () {
            (new $.StickyTableHeaders(this, options));
        });
    };

})(jQuery);

// // Jquery Function to Validate Patterns on Input Objects
// (function( $ ){
//     $.fn.validatePattern = function(search) {
//         // Get the current element's siblings
//         var pattern = this.attr('pattern');
//         var value = this.val();

//         return !(pattern&&(value.length>0)&&!value.match( new RegExp('^'+pattern+'$') ));
//     };
// })( jQuery );

// $(document).ready(function() {
//     // Bind pattern checking (invalid) to on change
//     $(':input').keypress(function() {
//         if (!$(this).validatePattern()) {
//             $(this).addClass('input-error');
//         } else{
//            $(this).removeClass('input-error');
//         }
//     });
//     // // Bind pattern valid to keyUp
//     // $(':input').keyUp(function() {
//     //     if ($(this).validatePattern()) {
//     //         $(this).removeClass('input-error');
//     //     } else{
//     //        $(this).addClass('input-error');
//     //     }
//     // });
// });

var entitlementOptions = applicationform.entitlements;
for(var i = 0; i <= entitlementOptions.length - 1; i++){
  entitlementOptions[i].onclick = function(){
    if(entitlementOptions.value == 'with entitlements'){
      $('#elementsToOperateOn :input').removeAttr('disabled');

    }else{
      $('#elementsToOperateOn :input').attr('disabled', true);

      $('#elementsToOperateOn :input').val('');
      $('#elementsToOperateOn :input').attr("checked",false);
    }
  };
}
