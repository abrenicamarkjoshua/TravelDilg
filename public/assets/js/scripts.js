
var travelApplication = {};
var picture;
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form
    */
    $('.registration-form fieldset:first-child').fadeIn('slow');
    
    $('.registration-form input[type="text"], .registration-form input[type="password"], .registration-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    // next step
    $('.registration-form .btn-next').on('click', function() {
     
     
    	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
         //    var email = $('#email').val();    	
         //    if(checkEmail(email)){
         //        $('#email').removeClass('input-error');
         //          next_step = true;
         //    } else{
         //          $('#email').addClass('input-error');
         //            alert('please input valid email');
         //            next_step = false;
         //    }
         //    var dob2 = $('#birthdate').val();
         //    var dob = new Date(dob2);
         //    var today = new Date();
         //    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
         //    if(age < 18){
         //        alert("Error! Applicant is less than 18"); 
         //        next_step = false;
         //    }
         //    var department = $('#userdepartment').val();
            
         //    if(department == "LGU" || department == "DILG RO" || department == "DILG PO"){
                
         //        if ($('#uploadpicture').get(0).files.length === 0) {
         //            alert("Please upload picture.");
         //        }
         //    }
        	// parent_fieldset.find('input[type="text"],input[type="number"], input[type="password"],input[type="file"],input[type="date"], select, textarea').each(function() {
        		
         //        if( $(this).val() == "" ) {
         //            if($(this).is("select")){
         //                $(this).addClass('input-error');
         //                next_step = false;
         //            }
         //            if($(this).prop("required")){
         //    			$(this).addClass('input-error');
         //    			next_step = false;
         //            }
                    

        	// 	}
        	// 	else {
        	// 		$(this).removeClass('input-error');
        	// 	}
        	// });
        	
    	if( next_step ) {
    		parent_fieldset.fadeOut(400, function() {
	    		$(this).next().fadeIn();
                
                $("html, body").animate({ scrollTop: 0 }, "slow");
	    	});
    	}
    	
    });
     $('#btnStep1Next').click(function() {
        
        travelApplication['region'] = $('#region').val();
        travelApplication['province'] = $('.province').val();
        travelApplication['municipality'] = $('#municipality').val();
        travelApplication['firstname'] = $('#firstname').val();
        travelApplication['lastname'] = $('#lastname').val();
        travelApplication['middlename'] = $('#middlename').val();
        travelApplication['sex'] = $('#sex').val();
        travelApplication['suffix'] = $('#suffix').val();
        travelApplication['birthdate'] = $('#birthdate').val();
        travelApplication['positionType'] = $('#positiontype').val();
        travelApplication['positionElective'] = $('#positionElective').val();
        travelApplication['nonelectivePosition'] = $('#nonelectiveposition').val();
        travelApplication['mobile'] = $('#mobilenumber').val();
        travelApplication['email'] = $('#email').val();

        picture = $('#uploadpicture').prop('files')[0];   
        travelApplication['picture'] = picture;

        console.log(travelApplication);
     });

    // previous step
    $('.registration-form .btn-previous').on('click', function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    	$(this).parents('fieldset').fadeOut(400, function() {
    		$(this).prev().fadeIn();
    	});
    });
    
    // submit
    $('.registration-form').on('submit', function(e) {
        
    	$(this).find('input[type="text"], input[type="email"],input[type="file"],input[type="date"], select').each(function() {
    		if( $(this).val() == "" ) {
                 if($(this).is("select")){
                    e.preventDefault();
                    $(this).addClass('input-error');
                }
                if($(this).prop("required")){
                   e.preventDefault();
                $(this).addClass('input-error');
                }
    			
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
    
    
});
