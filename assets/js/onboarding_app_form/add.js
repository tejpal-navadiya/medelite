var api_url = $('meta[name="api-url"]').attr('content');
var apitoken = $('meta[name="apitoken"]').attr('content');

function countObjectKeys(obj) { 
    return Object.keys(obj).length; 
}
var set_date_format="";
// 
  set_date_format='MM/DD/YYYY';



$(document).ready(function() {


});

$(function () {
  


  $.validator.setDefaults({
    submitHandler: function () {
      var form = $("#add_boarding_app_form");
      $('#onboarding_app_form_submit').attr('disabled' , true);
      
      
      // console.log(all_reminder);
      $.ajax({
        type: "POST",
        url: api_url+"onboarding_app_form/create.php",
        headers: {
          'apitoken': apitoken
        },
        data: {
          application_type : $("#application_type").val(),
          organization : $("#organization").val(),
          provider_name : $("#provider_name").val(),
          submission_date : $("#submission_date").val(),
          application_status : $("#application_status").val(),
          followup_time : $("#followup_time").val(),
          followup_date : $("#followup_date").val(),
          application_method : $("#application_method").val(),
          specialist_reviewed : $("#specialist_reviewed").val(),
          web_contact_info : $("#web_contact_info").val(),

          
        },
        success: function(data){
          if(data.code){
            // location.reload();
            console.log(data);
            $(document).Toasts('create', {
              class: 'bg-success',
              title: 'Success',
              autohide: true,
              delay: 5000,
              body: 'Task added successfully.'
            })
             reset_add_boarding_app_form();
             window.location.href = 'index.php?pid=add_boarding_form&id=' + data.id;
            // reload_provider_table();
            
            $('#onboarding_app_form_submit').attr('disabled' , false);
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
            reload_provider_table();
            $('#onboarding_app_form_submit').attr('disabled' , false);
          }
        },
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					console.log(XMLHttpRequest); console.log("Error: " + errorThrown); 
				}
      });
    }
  });

  $('#add_boarding_app_form').validate({
    rules: {
      provider_name: {
        required: true,
      },
      application_type: {
        required: true,
      }
    },
    messages: {
      provider_name: {
        required: "This field is required.",
      },
      application_type: {
        required: "This field is required.",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  


  // load_add_provider_assigned_user();
});


function reset_add_boarding_app_form(){
  $("#application_type").val("");
  $("#organization").val("");
  $("#provider_name").val("");
  $("#submission_date").val("");
  $("#application_status").val("");
  $("#followup_time").val("");
  // $("#followup_time").val();
  $("#followup_date").val();
  $("#application_method").val();
  $("#specialist_reviewed").val();
  $("#web_contact_info").val();
  

}



$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});



