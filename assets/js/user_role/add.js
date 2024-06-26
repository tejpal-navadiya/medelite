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
      var form = $("#user_role_form");
      $('#add_task_submit').attr('disabled' , true);
      
      
      // console.log(all_reminder);
      $.ajax({
        type: "POST",
        url: api_url+"user_role/create.php",
        headers: {
          'apitoken': apitoken
        },
        data: {
          // teams : $("#teams").val(),
          // tages : $("#tages").val(),
          name : $("#name").val(),
          // provider_title : $("#provider_title").val(),
          // provider_email : $("#provider_email").val(),
          // speciality : $("#speciality").val(),
          
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
              body: 'User role added successfully.'
            })
            reset_user_role_form();
window.location.href = 'index.php?pid=user_role';
            // reload_provider_table();
            
            $('#add_task_submit').attr('disabled' , false);
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
            $('#add_task_submit').attr('disabled' , false);
          }
        },
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					console.log(XMLHttpRequest); console.log("Error: " + errorThrown); 
				}
      });
    }
  });

  $('#user_role_form').validate({
    rules: {
      name: {
        required: true,
      }
      // teams: {
      //   required: true,
      // }
    },
    messages: {
      name: {
        required: "This field is required.",
      },
      // teams: {
      //   required: "This field is required.",
      // },
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


function reset_user_role_form(){
  $("#teams").val("");
  $("#tages").val("");
  $("#name").val("");
  // $("#provider_title").val("");
  // $("#provider_email").val("");
  // $("#speciality").val("");
  
  

}



$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});



