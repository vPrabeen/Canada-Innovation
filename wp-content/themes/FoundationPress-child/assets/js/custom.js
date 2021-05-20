jQuery(document).ready(function(){ // Start Document Ready
	
	//** Display Mortgage Details on Page Load by Ajax **//
	var form_data = jQuery('#mortgage_form').serialize();
	jQuery.ajax({
		url: 'https://bc-mortgage-broker.ca/calculate-mortgage.php',	
		type: 'POST',
		data: form_data,
		success: function(response) {
			
			//console.log(response);
			
			var res = JSON.parse(response); // Parse Server Response JSON Data
			if(res.status=="success"){	 
				//** Pass the data to the Result Section **//
				jQuery("#display_payment").html(res.display_payment);
				jQuery("#display_mortgage_amount").html(res.display_mortgage_amount);
				jQuery("#display_payment_term").html(res.display_payment_term);				
				jQuery("#down_pmr").attr("href", res.mortgage_report_path);
				
				if(res.display_payment_term_boost!=""){
					jQuery("#mortgage_term_booster").removeClass("invisible");
					jQuery("#mortgage_term_booster").html('<p class="label label-success"><abbr>'+res.display_payment_term_boost+'</abbr></p>').fadeIn(1500);
										
				} else {
					jQuery("#mortgage_term_booster").addClass("invisible");
					jQuery("#mortgage_term_booster").html('');
				}	
			}
			
		}
	});
	
	/*    */
	
	//** Number Validation  **//
	jQuery(".calcV").on("keypress keyup blur paste",function (event) { // 
		if (event.which != 46 && event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)){		
			return false;
			//event.preventDefault();
		} else if(jQuery(this).val() == 0 && event.which == 48){
			return false;
			//event.preventDefault();
		} else if(event.which == 0){
			return false;
			//event.preventDefault();
		}		
	});	
	
	//** Float Number Validation  **//
	jQuery(".calcFV").on("keypress keyup blur paste",function (event) { //keypress keyup 
		
		var value = jQuery(this).val();
		
		if(event.which < 45 || event.which > 58 || event.which == 47 ) {
			//return false;
			event.preventDefault();
        } 

        if(event.which == 46 && value.indexOf('.') != -1) {
            //return false;
            event.preventDefault();
        } 

        if(event.which == 45 && value.indexOf('-') != -1) {
            //return false;
            event.preventDefault();
        } 

        if(event.which == 45 && value.length>0) {
            event.preventDefault();
        } 

		//return true;
	});	
	
	jQuery(".calcM").on("keyup keypress paste input",function (event) {
		var ip_val 	= jQuery(this).val();
		if (ip_val.indexOf(',') > -1) { 
			jQuery("#comma_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> A special character comma has been detected. Comma has been removed from your recently given input value to make consistent the realtime calculation.');
			jQuery("#comma_err").removeClass('invisible');
			
			jQuery("#comma_err").fadeIn('slow');
			setTimeout(function(){	
				jQuery("#comma_err p").html('');
				jQuery("#comma_err").addClass('invisible');
			}, 5000);
		} 
	});	
	
	
	//** Set the Input Id and Value **//
	var input_id,input_val;
	jQuery(".calcM").on("keyup keypress blur paste click input ",function (event) {
		
		var keycode = event.keyCode || event.which;
		if (keycode === 9) {  
			input_id 	= jQuery(this).attr('id');
			input_val 	= jQuery(this).val().replace(/,/g, '');			
		} else {
			input_id 	= jQuery(this).attr('id');
			input_val 	= jQuery(this).val().replace(/,/g, '');
		}
		
	});	
	
	//** Real Time Mortgage Calculation Depends on User Inputs **//
	jQuery( document.body ).click(function() {
		
		var minMA_val,minYr_val,maxYr_val,minMon_val,maxMon_val,minINT_val; // Blank Parameters
		
		//***** Default Min-Max Value Declaration
		minMA_val 	= 	5000; // Minimum Mortgage Amount
		maxMA_val 	= 	9999999; // Maximum Mortgage Amount
		
		minYr_val	=	1; // Minimum Mortgage Year 
		maxYr_val	=	30; // Maximum Mortgage Years
		
		minMon_val	=	0;	// Minimum Mortgage Month 
		maxMon_val 	=	11; // Maximum Mortgage Months 
		
		minINT_val	=	0.50; // Minimum Mortgage Interest Rate
		maxINT_val	=	10.00; // Maximum Mortgage Interest Rate
		
		//***** Click on body except on current input element
		jQuery('#'+input_id).on('click', function (event) {
		  event.stopPropagation();
		});
		
				
		//***** Validate the Input fields as follows *****//		
		
		//*** Mortgage Amount Validation
		if( input_id=="mortgage_amount" && ( input_val=="" || input_val!="" || isNaN(input_val) ) ){ 
			
			if(input_val!=""){ // If Input Field is Not Blank or Blanked by useing Backspace
				
				if(input_val < minMA_val){ // If Inputed value is less then Minimum value
					
					jQuery("#"+input_id).val(minMA_val);
				
					jQuery("#mamt_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to minimum of '+minMA_val+'.');
					jQuery("#mamt_err").removeClass('invisible');
					
					jQuery("#mamt_err").fadeIn(4000);
					setTimeout(function(){	
						jQuery("#mamt_err p").html('');
						jQuery("#mamt_err").addClass('invisible');
					}, 3000);
					
				} else if(input_val > maxMA_val){ // If Inputed value is greater then Maximum value
					
					jQuery("#"+input_id).val(maxMA_val);
					jQuery("#mamt_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to maximum of '+maxMA_val+'.');
					jQuery("#mamt_err").removeClass('invisible');
					
					jQuery("#mamt_err").fadeIn(4000);
					setTimeout(function(){	
						jQuery("#mamt_err p").html('');
						jQuery("#mamt_err").addClass('invisible');
					}, 3000);
					
				} else { // If Inputed value is greater then Minimum value then Round off the value 
					
					var parsed_val 	= parseFloat(input_val);
					var roff_val 	= Math.round(parsed_val.toFixed(6));
					
					jQuery("#"+input_id).val(roff_val);
					
				}
				
			} else if(input_val==""){ // If Input Field is Blank and clicked outside the input field
				
				jQuery("#"+input_id).val(minMA_val);
				
				jQuery("#mamt_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to minimum of '+minMA_val+'.');
				jQuery("#mamt_err").removeClass('invisible');
				
				jQuery("#mamt_err").fadeIn(4000);
				setTimeout(function(){	
					jQuery("#mamt_err p").html('');
					jQuery("#mamt_err").addClass('invisible');
				}, 3000);
				
			} 	
			
		} 

		//*** Mortgage Year Validation
		if( input_id=="starting_mortgage_year" && ( input_val=="" || input_val!="" || isNaN(input_val) ) ){  
			
			if(input_val!=""){ // If Input Field is Not Blank or Blanked by useing Backspace
				
				if(input_val < minYr_val){ // If Inputed value is less then Minimum value
					
					jQuery("#"+input_id).val(minYr_val);
				
					jQuery("#mynm_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to minimum of '+minYr_val+'.');
					jQuery("#mynm_err").removeClass('invisible');
					
					jQuery("#mynm_err").fadeIn(4000);
					setTimeout(function(){	
						jQuery("#mynm_err p").html('');
						jQuery("#mynm_err").addClass('invisible');
					}, 3000);
					
				} else if(input_val > maxYr_val){ // If Inputed value is greater then Maximum value
					
					jQuery("#"+input_id).val(maxYr_val);
					jQuery("#mynm_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to maximum of '+maxYr_val+'.');
					jQuery("#mynm_err").removeClass('invisible');
					
					jQuery("#mynm_err").fadeIn(4000);
					setTimeout(function(){	
						jQuery("#mynm_err p").html('');
						jQuery("#mynm_err").addClass('invisible');
					}, 3000);
					
				} else { // If Inputed value is greater then Minimum value then Round off the value 
					
					var parsed_val 	= parseFloat(input_val);
					var roff_val 	= Math.round(parsed_val.toFixed(6));
					
					if(roff_val==maxYr_val){ // If Mortgage Year is Max then Month will be 0 and Disable Input
						jQuery("#starting_mortgage_month").val(0);
						jQuery("#starting_mortgage_month").prop( "disabled", true );
					} else { // Reset disable field
						jQuery("#starting_mortgage_month").prop( "disabled", false );
					}
					
					jQuery("#"+input_id).val(roff_val);
					
				}
				
			} else if(input_val==""){ // If Input Field is Blanked and Clicked on body
				
				jQuery("#"+input_id).val(minYr_val);
				
				jQuery("#mynm_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to minimum of '+minYr_val+'.');
				jQuery("#mynm_err").removeClass('invisible');
				
				jQuery("#mynm_err").fadeIn(4000);
				setTimeout(function(){	
					jQuery("#mynm_err p").html('');
					jQuery("#mynm_err").addClass('invisible');
				}, 3000);
				
			} 	
			
		} 
		
		//*** Mortgage Month Validation
		if( input_id=="starting_mortgage_month" && ( input_val=="" || input_val!="" || isNaN(input_val) ) ){  
			
			if(input_val!=""){ // If Input Field is Not Blank or Blanked by useing Backspace
				
				if(input_val < minMon_val){ // If Inputed value is less then Minimum value
					
					jQuery("#"+input_id).val(minMon_val);
				
				} else if(input_val > maxMon_val){ // If Inputed value is greater then Maximum value
					
					jQuery("#"+input_id).val(maxMon_val);
					jQuery("#mynm_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to maximum of '+maxMon_val+'.');
					jQuery("#mynm_err").removeClass('invisible');
					
					jQuery("#mynm_err").fadeIn(4000);
					setTimeout(function(){	
						jQuery("#mynm_err p").html('');
						jQuery("#mynm_err").addClass('invisible');
					}, 3000);
					
				} else { // If Inputed value is greater then Minimum value then Round off the value 
					
					var parsed_val 	= parseFloat(input_val);
					var roff_val 	= Math.round(parsed_val.toFixed(6));
					
					jQuery("#"+input_id).val(roff_val);
					
				}
				
			} else if(input_val==""){ // If Input Field is Blanked and Clicked on body
				
				jQuery("#"+input_id).val(minMon_val);
				
			} 	
			
		} 
		
		
		//*** Mortgage Rate of Interest Validation
		if( input_id=="interest_rate" && ( input_val=="" || input_val!="" || isNaN(input_val) ) ){ 
			
			if(input_val!=""){ // If Input Field is Not Blank or Blanked by useing Backspace
				
				if(input_val < minINT_val){ // If Inputed value is less then Minimum value
					
					jQuery("#"+input_id).val(minMA_val);
				
					jQuery("#int_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to minimum of '+minINT_val+'.');
					jQuery("#int_err").removeClass('invisible');
					
					jQuery("#int_err").fadeIn(4000);
					setTimeout(function(){	
						jQuery("#int_err p").html('');
						jQuery("#int_err").addClass('invisible');
					}, 3000);
					
				} else if(input_val > maxINT_val){ // If Inputed value is greater then Maximum value
					
					jQuery("#"+input_id).val(maxINT_val);
					jQuery("#int_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to maximum of '+maxINT_val+'.');
					jQuery("#int_err").removeClass('invisible');
					
					jQuery("#int_err").fadeIn(4000);
					setTimeout(function(){	
						jQuery("#int_err p").html('');
						jQuery("#int_err").addClass('invisible');
					}, 3000);
					
				} else { // If Inputed value is greater then Minimum value then Round off the value 
					
					var parsed_val 	= parseFloat(input_val);
					var roff_val 	= parsed_val.toFixed(2,0);
					
					jQuery("#"+input_id).val(roff_val);
					
				}
				
			} else if(input_val==""){ // If Input Field is Blank and clicked outside the input field
				
				jQuery("#"+input_id).val(minINT_val);
				
				jQuery("#int_err p").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your value has been reset to minimum of '+minINT_val+'.');
				jQuery("#int_err").removeClass('invisible');
				
				jQuery("#int_err").fadeIn(4000);
				setTimeout(function(){	
					jQuery("#int_err p").html('');
					jQuery("#int_err").addClass('invisible');
				}, 3000);
				
			} 	
			
		} 
		
		calculate(); // Call Mortgage Calucation Function
		
	});		
	
	
	//** Call Mortgage Calucation Function as per Payment Frequency **//
	jQuery('#payment_frequency').on('change', function(){
		calculate(); // Call Mortgage Calucation Function //
	});		
	
	//** Change Interest Rate depend on Mortgage Type **//
	jQuery('#type_of_mortgage').on('change', function(){ 
		var rate;
		var mortgage_type = jQuery(this).val();
		if(mortgage_type==0){ rate=5.34; }
		if(mortgage_type==1){ rate=4.75; }
		if(mortgage_type==2){ rate=7.25; }
		if(mortgage_type==3){ rate=7.25; }
		if(mortgage_type==4){ rate=3.64; }
		if(mortgage_type==5){ rate=3.74; }
		if(mortgage_type==6){ rate=4.39; }
		if(mortgage_type==7){ rate=4.59; }
		if(mortgage_type==8){ rate=5.19; }
		if(mortgage_type==9){ rate=5.69; }
		if(mortgage_type==10){ rate=6.19; }
		if(mortgage_type==11){ rate=4.15; }
		if(mortgage_type==12){ rate=5.75; }
		if(mortgage_type==13){ rate=4.25; }
		
		jQuery('#interest_rate').val(rate);
		
		calculate(); // Call Mortgage Calucation Function //
	});
	
	//** Year Input String Change **//
	if(jQuery("#starting_mortgage_year").val()==""){ 
		jQuery("#starting_mortgage_year").val('0');
		jQuery("#year_str").html('year'); 
	}
	
	//** Mortgage Year Text Change **//
	jQuery("#starting_mortgage_year").on('keyup', function(){
		if(jQuery(this).val()>1){ jQuery("#year_str").html('years'); }
		else{  jQuery("#year_str").html('year'); }
	});
	
	//** Month Input Value Reset **//
	if(jQuery("#starting_mortgage_month").val()==""){ 
		jQuery("#starting_mortgage_month").val('0');
		jQuery("#month_str").html('month'); 
	}	
	
	//** Mortgage Month Text Change **//
	jQuery("#starting_mortgage_month").on('keyup', function(){
		if(jQuery(this).val()>1){ 
			jQuery("#month_str").html('months');
		} else if(jQuery(this).val()==0){ 
			jQuery("#month_str").html('month'); 
		} else if(jQuery(this).val()==""){  
			jQuery(this).val('0');
			jQuery("#month_str").html('month'); 
		}
	});
	
}); // End Document Ready

//** Display Mortgage Details on Page Load by Ajax **//
function calculate(){
	var form_data = jQuery('#mortgage_form').serialize();
	
	//console.log(form_data);
	
	jQuery.ajax({
		url: 'https://bc-mortgage-broker.ca/calculate-mortgage.php',
		type: 'POST',
		data: form_data,
		success: function(response) {
			
			//console.log(response);
			
			var res = JSON.parse(response); // Parse Server Response JSON Data
			
			if(res.status=="success"){	 
				/** Pass the data to the Result Section **/
				 jQuery("#display_payment").html(res.display_payment);
				jQuery("#display_mortgage_amount").html(res.display_mortgage_amount);
				jQuery("#display_payment_term").html(res.display_payment_term);
				jQuery("#down_pmr").attr("href", res.mortgage_report_path);
				
				if(res.display_payment_term_boost!=""){
					jQuery("#mortgage_term_booster").removeClass("invisible");
					jQuery("#mortgage_term_booster").html('<p class="label label-success"><abbr>'+res.display_payment_term_boost+'</abbr></p>').fadeIn(1500);
										
				} else {
					jQuery("#mortgage_term_booster").addClass("invisible");
					jQuery("#mortgage_term_booster").html('');					
				}
				
			}
			
		}
	}); 
}


