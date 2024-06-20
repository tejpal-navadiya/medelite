var api_url = $('meta[name="api-url"]').attr('content');
var apitoken = $('meta[name="apitoken"]').attr('content');
// console.log(default_date_format);
var minDate, maxDate;
default_date_format="m-d-Y";
var set_date_format="";
if(default_date_format)
{
  set_date_format='MM-DD-YYYY';
  if(default_date_format=="m-d-Y"){set_date_format='MM-DD-YYYY';}else if(default_date_format=="d-m-Y"){set_date_format='DD-MM-YYYY';}else if(default_date_format=="d/m/Y"){set_date_format='DD/MM/YYYY';}else if(default_date_format=="m/d/Y"){set_date_format='MM/DD/YYYY';}
}else
{
  set_date_format='MM/DD/YYYY';
}


function countObjectKeys(obj) { 
  return Object.keys(obj).length; 
}

function InitializeCityList(ele_id,state_ele)
{
// console.log($("#"+state_ele).val());
$.ajax({
    type: "POST",
    url: api_url+"city/select_list.php",
    headers: {
    'apitoken': apitoken
    },
    data:{
    page_limit : 0,
    state_id:$("#"+state_ele).val(),    
    },
    success: function(data)
    {
    if(data.code){
      
        var stateList = data.data;
        var state_option_list="<option value=''>Select City</option>";
          $.each(stateList, function( index, state ) 
          {
            state_option_list+='<option value="'+state.id+'">'+state.text+'</option>';
          
          });
          $('#'+ele_id).html(state_option_list);
    }else{
        
        swal("Failure!", data.message, "error");
    }
    },
    statusCode: {
        401: function() {
        
          swal("Failure!", "Your login is expired. login again", "error");
            setTimeout(function(){ window.location.href="logout"; }, 3000);
        }
    }
});
}
$('#state').change(function (e) 
{
  InitializeStateList("city",'state');
});
$(function () {
  $(".static").select2({
    theme: 'bootstrap4',
  });
  $("#city").select2({
    theme: 'bootstrap4',
  });

  $('#state').select2({
      theme: 'bootstrap4',
      allowClear: true,
      ajax: {
          type: "POST",
          url: api_url+"/states/select_list.php",
          headers: {
              'apitoken': apitoken
          },
          dataType: 'json',
          delay: 250,
          data: function (params) {
              return {
                  search: params.term, // search term
                  page_no: params.page,
                  page_limit: 10,
              };
          },
          processResults: function (data, params) {
              params.page = params.page || 1;
              return {
                  results: data.data,
                  pagination: {
                      more: params.page < data.total_page
                  }
              };
          },
          cache: true
      },
      // minimumInputLength: 1,
      placeholder: "Select State",
  });

  $.ajax({
    type: "GET",
    url: api_url+"API/user/detail.php",
    headers: {
      'apitoken': apitoken
    },
    data: {
      user_id : $('#id').val(),
    },
    success: function(data)
    {
      $(".loading-overlay").removeClass("active");
      if(data.code){
        var ProfileDetails = data.data;
        console.log(ProfileDetails);
        // check is matter available for update
        
        
        if(ProfileDetails.state_name && ProfileDetails.state_name !="")
        {
          var state_option = new Option(ProfileDetails.state_name, ProfileDetails.state, true, true);
          $('#state').append(state_option).trigger('change');
        }
        setTimeout(function () {
          if(ProfileDetails.city_name && ProfileDetails.city_name !="")
          {
            var city_option = new Option(ProfileDetails.city_name, ProfileDetails.city, true, true);
            $('#city').append(city_option).trigger('change');
          }
        }, 1000);
        
        
        // matter_notifications
        var disp_address=ProfileDetails.address+", "+ProfileDetails.state_name+", "+ProfileDetails.city_name+", "+ProfileDetails.zip+".";

        $("#label_name").html(ProfileDetails.name);
        $("#label_name2").html(ProfileDetails.name);
        $("#label_email").html(ProfileDetails.email);
        $("#label_phone_number").html(ProfileDetails.phone_number);
        $("#label_address").html(disp_address);
        
        $("#name").val(ProfileDetails.name);
        // $("#fname").val(ProfileDetails.fname);
        // $("#lname").val(ProfileDetails.lname);
        $("#email").val(ProfileDetails.email);
        $("#phone_number").val(ProfileDetails.phone_number);
        $("#address").val(ProfileDetails.address);
        // $("#zip").val(ProfileDetails.zip);
        // $("#status").val(ProfileDetails.status).trigger('change');
        // $("#res_attorney").val(ProfileDetails.res_attorney).trigger('change');
        // $("#org_attorney").val(ProfileDetails.org_attorney).trigger('change');

        
        
        
        
      }else{
        // location.href = 'view-all-organization.php';
        console.log(data);
      }
    }
  });




  $.validator.setDefaults({
    submitHandler: function () {
      var form = $("#UpdateForm");
      $('#SubmitBtn').attr('disabled' , true);
    //  alert('test');

      $.ajax({
        type: "POST",
        url: api_url+"API/user/update_admin_profile.php",
        headers: {
          'apitoken': apitoken
        },
        data: {
          user_id : $("#id").val(),
          name : $("#name").val(),
          
          phone_number : $("#phone_number").val(),
          address : $("#address").val(),
          state : $("#state").val(),
          // city : $("#city").val(),
          zip : $("#zip").val(),
          
        },
        success: function(data)
        {
          // console.log(data);
          if(data.code){
            
            SetSWALmsg("Success!", data.message, "success");
            // reload_task_table();
            // reset_UpdateForm();
            location.reload();
            $('#SubmitBtn').attr('disabled' , false);
          }else{
            var errors = data.errors;
            if(countObjectKeys(errors)){
              $.each(errors, function( index, value ) {
                swal("Failure!", value, "error");  
                
              });
            }else{
              
              swal("Failure!", data.message, "error");
            }
            // reload_task_table();
            $('#SubmitBtn').attr('disabled' , false);
          }
        },error: function (jqXHR, exception) {
          var msg = '';
          if (jqXHR.status === 0) {
              msg = 'Not connect.\n Verify Network.';
          } else if (jqXHR.status == 404) {
              msg = 'Requested page not found. [404]';
          } else if (jqXHR.status == 500) {
              msg = 'Internal Server Error [500].';
          } else if (exception === 'parsererror') {
              msg = 'Requested JSON parse failed.';
          } else if (exception === 'timeout') {
              msg = 'Time out error.';
          } else if (exception === 'abort') {
              msg = 'Ajax request aborted.';
          } else {
              msg = 'Uncaught Error.\n' + jqXHR.responseText;
          }
          console.log(jqXHR);
      },
      });
    }
  });

  

  $('#UpdateForm').validate({
    rules: {
      name: {
        required: true,
      },
      fname: {
        required: true,
      },
      lname: {
        required: true,
      },
      email: {
        required: true,
      },
    },
    messages: {
      name: {
        required: "This field is required.",
      },
      fname: {
        required: "This field is required.",
      },
      lname: {
        required: "This field is required.",
      },
      email: {
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

  $.validator.setDefaults({
    submitHandler: function () {
      var form = $("#UpdatepassForm");
      $('#SubmitpassBtn').attr('disabled' , true);
    //  alert('test');

      $.ajax({
        type: "POST",
        url: api_url+"API/user/change_user_password.php",
        headers: {
          'apitoken': apitoken
        },
        data: {
          current_password : $("#current_password").val(),
          new_password : $("#new_password").val(),
          confirm_password : $("#confirm_password").val(),
        },
        success: function(data)
        {
          // console.log(data);
          if(data.code){
            
            SetSWALmsg("Success!", data.message, "success");
            // reload_task_table();
            // reset_UpdatepassForm();
            location.reload();
            $('#SubmitpassBtn').attr('disabled' , false);
          }else{
            var errors = data.errors;
            
            if(countObjectKeys(errors)){
              $.each(errors, function( index, value ) {
                swal("Failure!", value, "error");  
                
              });
            }else{
              
              swal("Failure!", data.message, "error");
            }
            // reload_task_table();
            $('#SubmitpassBtn').attr('disabled' , false);
          }
        },error: function (jqXHR, exception) {
          var msg = '';
          if (jqXHR.status === 0) {
              msg = 'Not connect.\n Verify Network.';
          } else if (jqXHR.status == 404) {
              msg = 'Requested page not found. [404]';
          } else if (jqXHR.status == 500) {
              msg = 'Internal Server Error [500].';
          } else if (exception === 'parsererror') {
              msg = 'Requested JSON parse failed.';
          } else if (exception === 'timeout') {
              msg = 'Time out error.';
          } else if (exception === 'abort') {
              msg = 'Ajax request aborted.';
          } else {
              msg = 'Uncaught Error.\n' + jqXHR.responseText;
          }
          console.log(jqXHR);
      },
      });
    }
  });

  

  $('#UpdatepassForm').validate({
    rules: {
      current_password: {
        required: true,
      },
      new_password: {
        required: true,
      },
      confirm_password: {
        required: true,
      },
      
    },
    messages: {
      name: {
        required: "This field is required.",
      },
      new_password: {
        required: "This field is required.",
      },
      confirm_password: {
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

  

  
  
  
  
  // $('#pending_date').daterangepicker({
  //   singleDatePicker: true,
  //   autoUpdateInput: false,
  //   locale: { format: set_date_format },
  // }, function(chosen_date) {
  //   // $('#pending_date').val(chosen_date.format(set_date_format));
  //   var formatted_date=chosen_date.format(set_date_format);
  //   // var check_res=formatted_date.includes(" ");
  //   // console.log(check_res);
  // });

  // $('#pending_date').on('apply.daterangepicker', function(ev, picker) {
  //   $(this).val(picker.endDate.format(set_date_format));
  // });

  // $('#pending_date').on('cancel.daterangepicker', function(ev, picker) {
  //     $(this).val('');
  // });


  
  
});

function reset_UpdateForm(){
  $('#UpdateForm').trigger("reset");
 
  var selBoxObj = $('#practice_area');
  selBoxObj.trigger("change.select2");
}
