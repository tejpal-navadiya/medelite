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
  $("#country,#p_country").select2({
    theme: 'bootstrap4',
    allowClear: false,
    ajax: {
      type: "POST",
      url: api_url+"countries/select_list.php",
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
});
$("#state,#p_state").select2({
  theme: 'bootstrap4',
  allowClear: false,
  ajax: {
    type: "POST",
    url: api_url+"states/select_list.php",
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
});



});

$(function () {
  
  var directory_id=$("#id").val();
  editContact(directory_id);

  $.validator.setDefaults({
    submitHandler: function () {
      var form = $("#directory_form");
      $('#directory_submit').attr('disabled' , true);
      
      $.ajax({
        type: "POST",
        url: api_url+"directory/update.php",
        headers: {
          'apitoken': apitoken
        },
        data: {
          id : $('#id').val(),
          directry_type : $("#directry_type").val(),
          board_name : $("#board_name").val(),
          attention_to : $("#attention_to").val(),
          address_line_1 : $("#address_line_1").val(),
          address_line_2 : $("#address_line_2").val(),
          state : $("#state").val(),
          city : $("#city").val(),
          country : $("#country").val(),
          zip_code : $("#zip_code").val(),
          p_address_line_1 : $("#p_address_line_1").val(),
          p_address_line_2 : $("#p_address_line_2").val(),
          p_country : $("#p_country").val(),
          p_state : $("#p_state").val(),
          p_city : $("#p_city").val(),
          p_zip_code : $("#p_zip_code").val(),
          fax : $("#fax").val(),
          website : $("#website").val(),
          online_portal : $("#online_portal").val(),
          notes : $("#notes").val(),
          tel_number_1 : $("#tel_number_1").val(),
          tel_number_2 : $("#tel_number_2").val(),
          board_email_licence : $("#board_email_licence").val(),
          board_email_verification : $("#board_email_verification").val(),
          board_email : $("#board_email").val(),
          application_processing_time : $("#application_processing_time").val(),
          initial_application_base_fee : $("#initial_application_base_fee").val(),
          initial_application_base_fee2 : $("#initial_application_base_fee2").val(),
          application_processing_fee : $("#application_processing_fee").val(),
          full_biennuim_fee : $("#full_biennuim_fee").val(),
          half_biennuim_fee : $("#half_biennuim_fee").val(),
          exam_fee : $("#exam_fee").val(),
          fp_cbc_fee : $("#fp_cbc_fee").val(),
          additional_fee : $("#additional_fee").val(),
          issuance_fee : $("#issuance_fee").val(),
          total_fee : $("#total_fee").val(),  
        },
        success: function(data){
          if(data.code){
            // location.reload();
            $(document).Toasts('create', {
              class: 'bg-success',
              title: 'Success',
              autohide: true,
              delay: 5000,
              body: 'Directory updated successfully.'
            })
            // reload_directory_table();
  window.location.href = 'index.php?pid=directory_list';
            // reset_directory_form();
            $('#directory_submit').attr('disabled' , false);
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
            reload_directory_table();
            $('#directory_submit').attr('disabled' , false);
          }
        }
      });
    }
  });

  $('#directory_form').validate({
    rules: {
      // attention_to: {
      //   required: true,
      // },
      address_line_1: {
        required: true,
      },
      tel_number_1: {
        required: true,
      },
      website: {
        required: true,
      },
      board_name: { 
        required: true,
      }
    },
    messages: {
      // attention_to: {
      //   required: "This field is required.",
      // },
     address_line_1: {
        required: "This field is required.",
      },
    tel_number_1: {
        required: "This field is required.",
      },
   website: {
        required: "This field is required.",
      },

      board_name: {
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
    url: api_url+"directory/detail.php",
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
        // console.log(rowdata);
        // $('#id').val(rowdata.id);
        
        $("#directry_type").val(rowdata.directry_type);
        $("#board_name").val(rowdata.board_name);
        $("#attention_to").val(rowdata.attention_to);
        $("#address_line_1").val(rowdata.address_line_1);
        $("#address_line_2").val(rowdata.address_line_2);
        $("#state").val(rowdata.state);
        $("#city").val(rowdata.city);
        $("#country").val(rowdata.country);
        $("#zip_code").val(rowdata.zip_code);
        $("#p_address_line_1").val(rowdata.p_address_line_1);
        $("#p_address_line_2").val(rowdata.p_address_line_2);
        $("#p_country").val(rowdata.p_country);
        $("#p_state").val(rowdata.p_state);
        $("#p_city").val(rowdata.p_city);
        $("#p_zip_code").val(rowdata.p_zip_code);
        $("#fax").val(rowdata.fax);
        $("#website").val(rowdata.website);
        $("#online_portal").val(rowdata.online_portal);
        $("#notes").val(rowdata.notes);
        $("#tel_number_1").val(rowdata.tel_number_1);
        $("#tel_number_2").val(rowdata.tel_number_2);
        $("#board_email_licence").val(rowdata.board_email_licence);
        $("#board_email_verification").val(rowdata.board_email_verification);
        $("#board_email").val(rowdata.board_email);
        $("#application_processing_time").val(rowdata.application_processing_time);
        $("#initial_application_base_fee").val(rowdata.initial_application_base_fee);
        $("#initial_application_base_fee2").val(rowdata.initial_application_base_fee2);
        $("#application_processing_fee").val(rowdata.application_processing_fee);
        $("#full_biennuim_fee").val(rowdata.full_biennuim_fee);
        $("#half_biennuim_fee").val(rowdata.half_biennuim_fee);
        $("#exam_fee").val(rowdata.exam_fee);
        $("#fp_cbc_fee").val(rowdata.fp_cbc_fee);
        $("#additional_fee").val(rowdata.additional_fee);
        $("#issuance_fee").val(rowdata.issuance_fee);
        $("#total_fee").val(rowdata.total_fee);   
        
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






function reset_directory_form(){
  $('#id').val("");
  $("#teams").val("");
  $("#tages").val("");
  $("#directory_name").val("");
  $("#directory_title").val("");
  $("#directory_email").val("");
  $("#speciality").val("");
}
