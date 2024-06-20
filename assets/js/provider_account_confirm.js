function countObjectKeys(obj) { 
    return Object.keys(obj).length; 
}

$(function () {
  	$.validator.setDefaults({
    	submitHandler: function () {
      		var form = $("#confirmForm");
      		$('#confirmSubmit').attr('disabled' , true);
      		var api_url = $('meta[name="api-url"]').attr('content');
			// console.log(api_url+"admin_user/confirm.php");
        	$.ajax({
            	type: "POST",
            	url: api_url+"provider/verify_email.php",
            	data: {
					token : $("#token").val(),
					password : $('#password').val(),
					confirm_password : $('#confirm_password').val()
				},
            	success: function(data)
            	{
            		if(data.code){
                    	$(document).Toasts('create', {
					        class: 'bg-success',
					        title: 'Success',
					        autohide: true,
	        				delay: 5000,
					        body: 'Account Verified successfully.'
					    })
					    $("#confirmForm")[0].reset();
                		$('#confirmSubmit').attr('disabled' , false);
						window.location.href = 'login-povider.php';
                		// $.ajax({
						// 	type: "POST",
						// 	url: "set_confirm",
						// 	data: data.data,
						// 	success: function(data)
						// 	{
						// 		location.href = 'dashboard/index';		
						// 	}
						// });
                	}else{
                		var errors = data.errors;
                		if(countObjectKeys(errors)){
                			$.each(errors, function( index, value ) {
							  	$(document).Toasts('create', {
							        class: 'bg-danger',
							        title: 'Failure',
							        autohide: true,
			        				delay: 5000,
							        body: value
							    })
							});
                		}else{
						  	$(document).Toasts('create', {
						        class: 'bg-danger',
						        title: 'Failure',
						        autohide: true,
		        				delay: 5000,
						        body: data.message
						    })
                		}
                		$("#confirmForm")[0].reset();
                		$('#confirmSubmit').attr('disabled' , false);
                	}
            	}
        	});
    	}
  	});
  	$('#confirmForm').validate({
	    rules: {
	    	password: {
	        	required: true,
	        	minlength: 8,
	        	maxlength: 30,
	      	},
		    confirm_password: {
		      equalTo: "#password"
		    }
	    },
	    messages: {
	      	password: {
	        	required: "Please enter password",
	        	minlength: "Password must be 8 character",
	        	maxlength: "Password must be below 30 character",
	      	},
	      	confirm_password: {
	        	equalTo: "Password & Confirm Password must match",
	      	}
	    },
	    errorElement: 'span',
    	errorPlacement: function (error, element) {
      		error.addClass('invalid-feedback');
      		element.closest('.input-group').append(error);
    	},
    	highlight: function (element, errorClass, validClass) {
      		$(element).addClass('is-invalid');
    	},
    	unhighlight: function (element, errorClass, validClass) {
      		$(element).removeClass('is-invalid');
    	}
	});
});