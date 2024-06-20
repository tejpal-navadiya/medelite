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
 $("#state_one ,#state_two ,#select_course,#course_content_requirements,#state_content_requirement").select2({
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
  
  var ce_tracking_id=$("#id").val();
  editContact(ce_tracking_id);

 


  
// add new
$.validator.setDefaults({
  submitHandler: function () {
    var form = $("#ce_tracking_form");
    $('#ce_tracking_submit').attr('disabled' , true);
      // alert('ok');
      
      // var submit_data={};
    //  console.log(submit_data);
    $.ajax({
      type: "POST",
      url: api_url+"ce_tracking/update.php",
      headers: {
        'apitoken': apitoken
      },
      data: 
      {
        // id : $('#id').val(),
        // state : $("#state").val(),
        // description : $("#description").val(),
        // ce_completion_status : $("#ce_completion_status").val(),
        // license_start_date : $("#license_start_date").val(),
        // license_end_date : $("#license_end_date").val(),
        // first_renewal : $("#first_renewal").val(),
        // ce_broker : $("#ce_broker").val(),
        // issue_date : $("#issue_date").val(),
        // expiration_date : $("#expiration_date").val(),
     //   last_updated_date : $("#last_updated_date").val(),
      //  add by me......................
 // id : $('#id').val(),
        // state : $("#state").val(),
        // description : $("#description").val(),
        // ce_completion_status : $("#ce_completion_status").val(),
        // license_start_date : $("#license_start_date").val(),
        // license_end_date : $("#license_end_date").val(),
        // first_renewal : $("#first_renewal").val(),
        // ce_broker : $("#ce_broker").val(),
        // issue_date : $("#issue_date").val(),
        // expiration_date : $("#expiration_date").val(),
        id : $('#id').val(),
        applay_to_all_state: $("#applay_to_all_state").val(),
        state_specific: $("#state_specific").val(),
        select_ce_course_catelog: $("#select_ce_course_catelog").val(),
        state_one: $("#state_one").val(),
        completed_date: $("#completed_date").val(),
        select_course: $("#select_course").val(),
        provider_approving_body: $("#provider_approving_body").val(),
        ce_course_transcript_description: $("#ce_course_transcript_description").val(),
        
        ce_hrs_first: $("#ce_hrs_first").val(),
        pharmacology_hrs: $("#pharmacology_hrs").val(),
        separate_add_ce_hrs: $("#separate_add_ce_hrs").val(),
        ce_hrs_two: $("#ce_hrs_two").val(),
        attachment: $("#attachment").val(),
        shaprate_ce_hrs: $("#shaprate_ce_hrs").val(),
        state_content_requirement: $("#state_content_requirement").val(),
        state_two: $("#state_two").val(),
        course_content_two: $("#course_content_two").val(),
        ce_hrs_three: $("#ce_hrs_three").val(),
        update_ce_course: $("#update_ce_course").val(),
        add_course_catelog: $("#add_course_catelog").val(),
        total_ce_hrs: $("#total_ce_hrs").val(),
        // $("#total_ce_hrs").val(rowdata.total_ce_hrs);
      // end by me......................
        
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
            body: 'ce_tracking updated successfully.'
          })

          window.location.href = 'index.php?pid=ce_tracking_list';
          reset_ce_tracking_form();
          // reload_ce_tracking_table();
          
          $('#ce_tracking_submit').attr('disabled' , false);
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
          reload_ce_tracking_table();
          $('#ce_tracking_submit').attr('disabled' , false);
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log(XMLHttpRequest); console.log("Error: " + errorThrown); 
      }
    });
  
  }
});

$('#ce_tracking_form').validate({
  rules: {
    // state: {
    //   required: true,
    // },
    // description: {
    //   required: true,
    // },
    issue_date: {
      required: true,
    },
    expiration_date: {
      required: true,
    },
    license_start_date: {
      required: true,
    },
    license_end_date: {
      required: true,
    },
 
  },
  messages: {
    // state: {
    //   required: "This field is required.",
    // },
   // issue_date: {
    //  required: "This field is required.",
   // },
    //expiration_date: {
     // required: "This field is required.",
   // },
   // license_start_date: {
    //  required: "This field is required.",
   // },
   // license_end_date: {
   //   required: "This field is required.",
   // }
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
    url: api_url+"ce_tracking/detail.php",
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
        
        // $("#state").val(rowdata.state);
        // $("#description").val(rowdata.description);
        // $("#ce_completion_status").val(rowdata.ce_completion_status);
        // $("#license_start_date").val(rowdata.license_start_date);
        // $("#license_end_date").val(rowdata.license_end_date);
        // $("#first_renewal").val(rowdata.first_renewal);
        // $("#ce_broker").val(rowdata.ce_broker);
        // $("#issue_date").val(rowdata.issue_date);
        // $("#expiration_date").val(rowdata.expiration_date);
       // $("#last_updated_date").val(rowdata.last_updated_date);


      //  add by me.............
      $("#apply_to_all_state").val(rowdata.apply_to_all_state);
      $("#state_specific").val(rowdata.state_specific);
      $("#state_one").val(rowdata.state_one);
      $("#completed_date").val(rowdata.completed_date);
      $("#select_course").val(rowdata.select_course);
      $("#provider_approving_body").val(rowdata.provider_approving_body);
      $("#ce_course_transcript_description").val(rowdata.ce_course_transcript_description);
      $("#ce_hrs_first").val(rowdata.ce_hrs_first);
      $("#pharmacology_hrs").val(rowdata.pharmacology_hrs);
      $("#total_ce_hrs").val(rowdata.total_ce_hrs);
      $("#add_course_content").val(rowdata.add_course_content);
      $("#separate_add_ce_hrs").val(rowdata.separate_add_ce_hrs);
      $("#note").val(rowdata.note);
      $("#update_ce_course").val(rowdata.update_ce_course);
      $("#ce_hrs_two").val(rowdata.ce_hrs_two);
      $("#attachment").val(rowdata.attachment);
      // $("#course_content_requirements").val(rowdata.apply_to_all_state);
      $("#shaprate_ce_hrs").val(rowdata.shaprate_ce_hrs);
      $("#state_content_requirement").val(rowdata.state_content_requirement);
   
      $("#state_two").val(rowdata.state_two);
      $("#course_content_two").val(rowdata.course_content_two);
      $("#ce_hrs_three").val(rowdata.ce_hrs_three);
      // $("#update_ce_course").val(rowdata.update_ce_course);
   
      $("#add_course_catelog").val(rowdata.add_course_catelog);

      // end by me.............
       
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






function reset_ce_tracking_form(){
  $('#id').val("");
  // $("#teams").val("");
  // $("#tages").val("");
  // $("#ce_tracking_name").val("");
  // $("#ce_tracking_title").val("");
  // $("#ce_tracking_email").val("");
  // $("#speciality").val("");
  $("#apply_to_all_state").val("");
  $("#state_specific").val("");
  $("#state_one").val("");
  $("#completed_date").val("");
  $("#select_course").val("");
  $("#provider_approving_body").val("");
  $("#ce_course_transcript_description").val("");
  $("#ce_hrs_first").val("");
  $("#pharmacology_hrs").val("");
  $("#total_ce_hrs").val("");
  $("#add_course_content").val("");
  $("#separate_add_ce_hrs").val("");
  $("#note").val("");
  $("#update_ce_course").val("");
  $("#ce_hrs_two").val("");
  $("#attachment").val("");
  // $("#course_content_requirements").val("");
  $("#shaprate_ce_hrs").val("");
  $("#state_content_requirement").val("");

  $("#state_two").val("");
  $("#course_content_two").val("");
  $("#ce_hrs_three").val("");
  $("#update_ce_course").val("");
  $("#add_course_catelog").trigger("reset");
}