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
  
  var provider_id=$("#user_role_id").val();
  editContact(provider_id);
console.log(provider_id);
  $.validator.setDefaults({
    submitHandler: function () {
      var form = $("#user_role_form");
      $('#add_task_submit').attr('disabled' , true);
      
      $.ajax({
        type: "POST",
        url: api_url+"user_role/update.php",
        headers: {
          'apitoken': apitoken
        },
        data: {
          id : $('#user_role_id').val(),
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
            $(document).Toasts('create', {
              class: 'bg-success',
              title: 'Success',
              autohide: true,
              delay: 5000,
              body: 'User role updated successfully.'
            })
            // reload_provider_table();
window.location.href = 'index.php?pid=user_role';
            // reset_user_role_form();
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



});




$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});



function editContact(id)
{
  console.log(id);
  $(".loading-overlay").addClass("active");
  $.ajax({
    type: "POST",
    url: api_url+"user_role/detail.php",
    headers: {
      'apitoken': apitoken
    },
    data: {
      id : id,
    },
    error: function(data)
    {
      console.log(data);
    },
    success: function(data)
    {
      console.log(data);
      $(".loading-overlay").removeClass("active");
      if(data.code){

        var rowdata = data.data;
        console.log(rowdata);
        // $('#id').val(rowdata.id);
        
        // $("#teams").val(rowdata.teams);
        // $("#tages").val(rowdata.tages);
        $("#name").val(rowdata.name);
        // $("#provider_title").val(rowdata.provider_title).trigger('change');
        // $("#provider_email").val(rowdata.provider_email);
        // $("#speciality").val(rowdata.speciality);
        
        
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






function reset_user_role_form(){
  $('#user_role_id').val("");
  // $("#teams").val("");
  // $("#tages").val("");
  $("#name").val("");
  // $("#provider_title").val("");
  // $("#provider_email").val("");
  // $("#speciality").val("");
}
