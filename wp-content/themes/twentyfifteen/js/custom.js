jQuery(document).ready(function(){
	
	jQuery(".edit_customer_address").click(function(){
		jQuery(".address-block-customer").hide();
		jQuery(".edit_customer_address").show();
	});
	
});

jQuery( "#foundanimallogin" ).submit(function( event ) {
	event.preventDefault();
	
	jQuery(".loadmoreimg").show();
	
	
	jQuery('form#foundanimallogin span.error-msg').remove();
			var data = {};
			var fieldName = '';
			var popMsg = '';
			var popError = false;
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var formTag = jQuery('form#foundanimallogin');
			
			jQuery('form#foundanimallogin').find('input,select').each(function(i, field) {
				data[field.name] = field.value;
				fieldName = field.name;
				fieldName = fieldName.replace(/_/gi, " ");
				fieldName = fieldName.replace("book", " ");
				fieldName = fieldName.replace("gift", " ");
				fieldName = fieldName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				}); 
				
				if(field.name == 'emailaddress'){
					if(field.value == ''){
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter </span>');
						if(popError == false)
							popError = true;
					} else if (!filter.test(field.value)) {
						formTag.find('input[name="'+field.name+'"]').val('').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter a valid </span>');
						if(popError == false)
							popError = true;
					}
				}  else if(field.name == 'password'){
					if(field.value == ''){
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter <strong>Password</strong></span>');
						if(popError == false)
							popError = true;
					} 
				}	
			});	
			if(popError == true){
				jQuery(".loadmoreimg").hide();
				jQuery(".error-message").show();	
				formTag.addClass('invalid');
				return false;
			}  else {
				formTag.removeClass('invalid');
				jQuery(".error-message").hide();	
				var form = jQuery('#foundanimallogin').serialize();
	
				jQuery.ajax({
					type: 'POST',
					url: adminUrl,
					data: form,					
					beforeSend:function(){ },					
					success:function(data){
						
						var responseData = JSON.parse(data);
						//console.log(responseData);
						//console.log(responseData.suite_response);
						//console.log(responseData.error_msg);
						
						if(responseData.result == 'fail'){
							jQuery('.login-form').find('.login-error').empty().append('<span class="error-msg">'+responseData.error_msg+'</span>');
							
						} else {
							window.location.href = responseData.redirect
							//jQuery('.login-form').find('.login-error').empty().append('<span class="error-msg">'+responseData.error_msg+'</span>');
						}
						jQuery(".loadmoreimg").hide();
					},
					error:function(){
						alert("Error: There is some issue please try agian.")
					}
				});	
			}	
});	


jQuery( "#foundanimalregister" ).submit(function( event ) {
	
	event.preventDefault();
	
	jQuery(".loadmoreimg").show();
	
	
	jQuery('form#foundanimalregister span.error-msg').remove();
			var data = {};
			var fieldName = '';
			var popMsg = '';
			var popError = false;
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var formTag = jQuery('form#foundanimalregister');
			
			jQuery('form#foundanimalregister').find('input,select').each(function(i, field) {
				data[field.name] = field.value;
				fieldName = field.name;
				fieldName = fieldName.replace(/_/gi, " ");
				fieldName = fieldName.replace("book", " ");
				fieldName = fieldName.replace("gift", " ");
				fieldName = fieldName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				}); 
				
				if(field.name == 'emailaddress'){
					if(field.value == ''){
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter </span>');
						if(popError == false)
							popError = true;
					} else if (!filter.test(field.value)) {
						formTag.find('input[name="'+field.name+'"]').val('').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter a valid </span>');
						if(popError == false)
							popError = true;
					}
				}  else if (field.name == 'firstname' || field.name == 'lastname' || field.name == 'phonenumber' || field.name == 'country' || field.name == 'street' || field.name == 'city' || field.name == 'state' || field.name == 'zip'){
					if(field.value == ''){
						
						if(field.name == 'country')
						{	
							formTag.find('select[name="'+field.name+'"]').parent().addClass('error wpcf7-not-valid').after('<span class="error-msg">please select country.</span>');
						} else {
							formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please fill in the the required field.</span>');
						}	
						if(popError == false)
							popError = true;
					}
						
				} else if(field.name == 'password' || field.name == 'confirmpassword'){
					if(field.value == ''){
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter password</span>');
						if(popError == false)
							popError = true;
					}else if(field.value.length < 6) {
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Password should be minimum 6 character long.</span>');
						if(popError == false)
							popError = true;
					} else if(jQuery("#password").val() != jQuery("#confirmpassword").val()){
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Password are not matach.</span>');
						if(popError == false)
							popError = true;
					}	
				}
			});	
			if(popError == true){
				jQuery(".loadmoreimg").hide();
				jQuery(".error-message").show();	
				formTag.addClass('invalid');
				return false;
			}  else {
				formTag.removeClass('invalid');
				jQuery(".error-message").hide();	
				var form = jQuery('#foundanimalregister').serialize();
	
				jQuery.ajax({
					type: 'POST',
					url: adminUrl,
					data: form,					
					beforeSend:function(){ },					
					success:function(data){
						
						var responseData = JSON.parse(data);
						//console.log(responseData);
						//console.log(responseData.suite_response);
						//console.log(responseData.error_msg);
						
						if(responseData.result == 'fail'){
							jQuery('.customer-register-form').find('.customer-error').empty().append('<span class="error-msg">'+responseData.error_msg+'</span>');
							
						} else {
						//	window.location.href = responseData.redirect
							jQuery('.customer-register-form').find('.customer-error').empty().append('<span class="error-msg">'+responseData.success_message+'</span>');
						}
						jQuery(".loadmoreimg").hide();
					},
					error:function(){
						alert("Error: There is some issue please try agian.")
					}
				});	
			}	
});	

jQuery( "#netsuiteupdatepprofile" ).submit(function( event ) {
	
	event.preventDefault();
	
	jQuery(".loadmoreimg").show();
	

	
	jQuery('form#netsuiteupdatepprofile span.error-msg').remove();
			var data = {};
			var fieldName = '';
			var popMsg = '';
			var popError = false;
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var formTag = jQuery('form#netsuiteupdatepprofile');
			
			jQuery('form#netsuiteupdatepprofile').find('input,select').each(function(i, field) {
				data[field.name] = field.value;
				fieldName = field.name;
				fieldName = fieldName.replace(/_/gi, " ");
				fieldName = fieldName.replace("book", " ");
				fieldName = fieldName.replace("gift", " ");
				fieldName = fieldName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				}); 
				
				if(field.name == 'emailaddress'){
					if(field.value == ''){
						formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter </span>');
						if(popError == false)
							popError = true;
					} else if (!filter.test(field.value)) {
						formTag.find('input[name="'+field.name+'"]').val('').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please enter a valid </span>');
						if(popError == false)
							popError = true;
					}
				}  else if (field.name == 'firstname' || field.name == 'lastname' || field.name == 'phonenumber'){
						if(field.value == ''){
							formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please fill in the the required field.</span>');
						
							if(popError == false)
								popError = true;
						}
						
				} else if(field.name == 'password' || field.name == 'confirmpassword'){
					if(jQuery("#password").val() != "" || jQuery("#confirmpassword").val() != ""){
						 if(field.value.length < 6) {
							formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Password should be minimum 6 character long.</span>');
							if(popError == false)
								popError = true;
						} else if(jQuery("#password").val() != jQuery("#confirmpassword").val()){
							formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Password are not matach.</span>');
							if(popError == false)
								popError = true;
						}	
					}	
				}
			});	
			if(popError == true){
				jQuery(".loadmoreimg").hide();
				jQuery(".error-message").show();	
				formTag.addClass('invalid');
				return false;
			}  else {
				formTag.removeClass('invalid');
				jQuery(".error-message").hide();	
				var form = jQuery('#netsuiteupdatepprofile').serialize();
	
				jQuery.ajax({
					type: 'POST',
					url: adminUrl,
					data: form,					
					beforeSend:function(){ },					
					success:function(data){
						
						var responseData = JSON.parse(data);
						//console.log(responseData);
						console.log(responseData.result);
						console.log(responseData.redirect);
						
						if(responseData.result == 'fail'){
							jQuery('.customer-update-form').find('.customer-error').empty().append('<span class="error-msg">'+responseData.error_msg+'</span>');
							
						} else {
							window.location.href = responseData.redirect
							//jQuery('.customer-update-form').find('.customer-error').empty().append('<span class="error-msg">'+responseData.error_msg+'</span>');
						}
						jQuery(".loadmoreimg").hide();
					},
					error:function(){
						alert("Error: There is some issue please try agian.")
					}
				});	
			}	
});	


jQuery( "#netsuite_update_profile_address" ).submit(function( event ) {
	
	event.preventDefault();
	
	jQuery(".loadmoreimg").show();
	

	
	jQuery('form#netsuite_update_profile_address span.error-msg').remove();
			var data = {};
			var fieldName = '';
			var popMsg = '';
			var popError = false;
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var formTag = jQuery('form#netsuite_update_profile_address');
			
			jQuery('form#netsuite_update_profile_address').find('input,select').each(function(i, field) {
				data[field.name] = field.value;
				fieldName = field.name;
				fieldName = fieldName.replace(/_/gi, " ");
				fieldName = fieldName.replace("book", " ");
				fieldName = fieldName.replace("gift", " ");
				fieldName = fieldName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				}); 
				
				 if (field.name == 'address1' || field.name == 'city' || field.name == 'state' || field.name == 'zip'){
						if(field.value == ''){
							formTag.find('input[name="'+field.name+'"]').addClass('error wpcf7-not-valid').after('<span class="error-msg">Please fill in the the required field.</span>');
						
							if(popError == false)
								popError = true;
						}
						
				} 
			});	
			if(popError == true){
				jQuery(".loadmoreimg").hide();
				jQuery(".error-message").show();	
				formTag.addClass('invalid');
				return false;
			}  else {
				formTag.removeClass('invalid');
				jQuery(".error-message").hide();	
				var form = jQuery('#netsuite_update_profile_address').serialize();
	
				jQuery.ajax({
					type: 'POST',
					url: adminUrl,
					data: form,					
					beforeSend:function(){ },					
					success:function(data){
						
						var responseData = JSON.parse(data);
						//console.log(responseData);
						console.log(responseData.result);
						console.log(responseData.redirect);
						
						if(responseData.result == 'fail'){
							jQuery('.customer-update-form').find('.customer-error').empty().append('<span class="error-msg">'+responseData.error_msg+'</span>');
							
						} else {
							window.location.href = responseData.redirect
							//jQuery('.customer-update-form').find('.customer-error').empty().append('<span class="error-msg">'+responseData.error_msg+'</span>');
						}
						jQuery(".loadmoreimg").hide();
					},
					error:function(){
						alert("Error: There is some issue please try agian.")
					}
				});	
			}	
});