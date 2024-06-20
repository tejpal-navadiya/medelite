var api_url = $('meta[name="api-url"]').attr('content');
var apitoken = $('meta[name="apitoken"]').attr('content');
var id_matter="";
if($('#id_matter').length>0){id_matter=$('#id_matter').val();}

function countObjectKeys(obj) { 
    return Object.keys(obj).length; 
}
var set_date_format="";
// 
  set_date_format='MM/DD/YYYY';



$(document).ready(function() {


});

$(function () {
  
  var provider_id=$("#id").val();
  editContact(provider_id);

  $.validator.setDefaults({
    submitHandler: function () {
      var form = $("#add_boarding_app_form");
      $('#onboarding_app_form_submit').attr('disabled' , true);
      
      $.ajax({
        type: "POST",
        url: api_url+"onboarding_app_form/update.php",
        headers: {
          'apitoken': apitoken
        },
        data: {
        
          id : $('#id').val(),
          application_type : $("#application_type").val(),
          organization : $("#organization").val(),
          provider_name : $("#provider_name").val(),
          submission_date : $("#submission_date").val(),
          application_status : $("#application_status").val(),
          follow_up_time : $("#follow_up_time").val(),
          follow_up_date : $("#follow_up_date").val(),
          application_method : $("#application_method").val(),
          specialist_reviewed : $("#specialist_reviewed").val(),
          web_contact_info : $("#web_contact_info").val(),

        },
        success: function(data){
          console.log(data);
          if(data.code){
            // location.reload();
            $(document).Toasts('create', {
              class: 'bg-success',
              title: 'Success',
              autohide: true,
              delay: 5000,
              body: 'app updated successfully.'
            })
            // reload_provider_table();
           window.location.href = 'index.php?pid=boarding_form_list&id';
            // reset_add_boarding_app_form();
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
      },
      organization: {
        required: true,
      },
      submission_date: {
        required: true,
      },
      application_status: {
        required: true,
      },
      specialist_reviewed: {
        required: true,
      },
      web_contact_info: {
        required: true,
      },
      follow_up_time: {
        required: true,
      },
      follow_up_date: {
        required: true,
      },
      
    },
    messages: {
      provider_name: {
        required: "This field is required.",
      },

      application_type: {
        required: "This field is required.",
      },

      organization: {
        required: "This field is required.",
      },

      submission_date: {
        required: "This field is required.",
      },

      application_status: {
        required: "This field is required.",
      },


      specialist_reviewed: {
        required: "This field is required.",
      },
      web_contact_info: {
        required: "This field is required.",
      },

      follow_up_time: {
        required: "This field is required.",
      },
      follow_up_date: {
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



});




$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});



function editContact(id)
{
  // console.log(id);
  $(".loading-overlay").addClass("active");
  $.ajax({
    type: "GET",
    url: api_url+"onboarding_app_form/detail.php",
    headers: {
      'apitoken': apitoken
    },
    data: {
      id : id,
    },
    success: function(data)
    {
      $(".loading-overlay").removeClass("active");
      if(data.code){
        var rowdata = data.data;
        console.log(rowdata);
        // $('#id').val(rowdata.id);
  
        $("#application_type").val(rowdata.application_type);
        $("#organization").val(rowdata.organization);
        $("#provider_name").val(rowdata.provider_name);
        $("#submission_date").val(rowdata.submission_date);
        $("#application_status").val(rowdata.application_status);
        $("#follow_up_time").val(rowdata.follow_up_time);
        $("#follow_up_date").val(rowdata.follow_up_date);
        $("#application_method").val(rowdata.application_method);
        $("#specialist_reviewed").val(rowdata.specialist_reviewed);
        $("#web_contact_info").val(rowdata.web_contact_info);
      
        
        
      }else{
        $(document).Toasts('create', {
          class: 'bg-danger',
          title: 'Failure',
          autohide: true,
          delay: 5000,
          body: data.message
        });
        // console.log(data);
      }
    },
    statusCode: {
      401: function() {
        $(document).Toasts('create', {
          class: 'bg-danger',
          title: 'Failure',
          autohide: true,
          delay: 5000,
          body: "Your login is expired. login again"
        });
        setTimeout(function(){ 
          window.location.href="logout";
        }, 3000);
      }
    }
  });
}






function reset_add_boarding_app_form(){
  $("#application_type").val("");
  $("#organization").val("");
  $("#provider_name").val("");
  $("#submission_date").val("");
  $("#application_status").val("");
  $("#follow_up_time").val("");
  // $("#follow_up_time").val();
  $("#follow_up_date").val();
  $("#application_method").val();
  $("#specialist_reviewed").val();
  $("#web_contact_info").val();
}
