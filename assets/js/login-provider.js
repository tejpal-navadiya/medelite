function countObjectKeys(obj) { 
    return Object.keys(obj).length; 
}

$(function () {
  	$.validator.setDefaults({
    	submitHandler: function () {
      		var form = $("#loginForm");
      		$('#loginSubmit').attr('disabled' , true);
      		var api_url = $('meta[name="api-url"]').attr('content');
			// console.log(api_url+"admin_user/login.php");
        	$.ajax({
            	type: "POST",
            	url: api_url+"provider/login.php",
            	data: form.serialize(),
            	success: function(data)
            	{
					console.log(data);
            		if(data.code){
            			var apidata = data.data;
            			apidata.password = $('#password').val();
						apidata.remember_me = $("input[name='remember_me']:checked").val();
            			
						$.ajax({
							type: "POST",
							url: "set_provider_login.php",
							data: data.data,
							success: function(data)
							{
								// console.log(data)
								location.href = 'index.php?pid=home';
							}
						});
					    $("#loginForm")[0].reset();
                		$('#loginSubmit').attr('disabled' , false);
                	}else{
                		var errors = data.errors;
						console.log(errors)
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
                		$("#loginForm")[0].reset();
                		$('#loginSubmit').attr('disabled' , false);
                	}
            	},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					console.log(XMLHttpRequest); console.log("Error: " + errorThrown); 
				}       
        	});
    	}
  	});
  	$('#loginForm').validate({
	    rules: {
	      	email: {
	        	required: true,
	        	email: true,
	      	},
	      	password: {
	        	required: true,
	        	minlength: 8,
	        	maxlength: 50,
	      	}
	    },
	    messages: {
	      	email: {
	        	required: "Please enter email address",
	        	email: "Please enter vaild email address"
	      	},
	      	password: {
	        	required: "Please enter password",
	        	minlength: "Password must contain 8 character",
	        	maxlength: "Password must contain less than 50 character",
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