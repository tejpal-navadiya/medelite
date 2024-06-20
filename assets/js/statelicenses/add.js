var api_url = $('meta[name="api-url"]').attr('content');
var apitoken = $('meta[name="apitoken"]').attr('content');

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

$("#state").select2({
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
  


  $.validator.setDefaults({
    submitHandler: function () {
      var form = $("#statelicenses");
      $('#statelicenses_submit').attr('disabled' , true);
        // alert('ok');
        
        // var submit_data={};
      //  console.log(submit_data);
      $.ajax({
        type: "POST",
        url: api_url+"state_licenses/create.php",
        headers: {
          'apitoken': apitoken
        },
        data: {
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


       state: $("#state").val(),
       provider_id: $("#provider_id").val(), 
       license_type: $("#license_type").val(),
       license_number: $("#license_number").val(),
       issue_date: $("#issue_date").val(),
       exp_date	: $("#exp_date	").val(),
       last_updated: $("#last_updated").val(),
       suppervising_physician	: $("#suppervising_physician	").val(),
       practitioners_in_cpa: $("#practitioners_in_cpa").val(),
       renewal_id_pin: $("#renewal_id_pin").val(),
       primary_check: $("#primary_check").val(),
       compact: $("#compact").val(),
       collaborative_relationship: $("#collaborative_relationship").val(),
       enrolled_in_pmp: $("#enrolled_in_pmp").val(),
        receipt_amount : $("#receipt_amount").val(),
        document_type : $("#document_type").val(),
        doc_date : $("#doc_date").val(),
        doc_exp_date : $("#doc_exp_date").val(),
        doc_last_updated : $("#doc_last_updated").val(),
      //  id, note,note_date,note_issue_date, followup_type, note_exp_date, note_last_updated
        note: $("#note").val(),
        note_date: $("#note_date").val(),
       followup_type: $("#followup_type").val(),
       note_exp_date: $("#note_exp_date").val(),
       note_last_updated: $("#note_last_updated").val(),
       note_issue_date: $("#note_issue_date").val(),

          
        },
       
        
     
        success: function(data){
          if(data.code){
            // location.reload();
          
            $(document).Toasts('create', {
              class: 'bg-success',
              title: 'Success',
              autohide: true,
              delay: 5000,
              body: 'license added successfully.'
            })

            window.location.href = 'index.php?pid=license_state_list';
            reset_state_licenses_form();
            // reload_state_licenses_table();
            
            $('#statelicenses_submit').attr('disabled' , false);
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
            reload_state_licenses_table();
            $('#statelicenses_submit').attr('disabled' , false);
          }
        },
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					console.log(XMLHttpRequest); console.log("Error: " + errorThrown); 
				}
      });
      
      //add by me for debugging 
        console.log("Data to be sent:", {
        state: $("#state").val(),
        provider_id: $("#provider_id").val(),
        license_type : $("#license_type").val(),
        license_number : $("#license_number").val(),
        issue_date : $("#issue_date").val(),
        exp_date : $("#exp_date").val(),
        last_updated : $("#last_updated").val(),
        suppervising_physician : $("#suppervising_physician").val(),
        practitioners_in_cpa : $("#practitioners_in_cpa").val(),
          //last_updated_date : $("#last_updated_date").val(),
        // ... (other fields)
        renewal_id_pin : $("#renewal_id_pin").val(),
        primary_check : $("#primary_check").val(),
        compact : $("#compact").val(),
        collaborative_relationship : $("#collaborative_relationship").val(),
        enrolled_in_pmp : $("#enrolled_in_pmp").val(),
        receipt_amount : $("#receipt_amount").val(),
        document_type : $("#document_type").val(),
        doc_date : $("#doc_date").val(),
        doc_exp_date : $("#doc_exp_date").val(),
        doc_last_updated : $("#doc_last_updated").val(),

        note : $("#note").val(),
        note_date: $("#note_date").val(),
        note_issue_date : $("#note_issue_date").val(),
        followup_type : $("#followup_type").val(),
        note_exp_date : $("#note_exp_date").val(),
        note_last_updated : $("#note_last_updated").val(),
      });
    }
  });

  // $('#state_licenses_form').validate({
  //   rules: {
  //     // state: {
  //     //   required: true,
  //     // },
  //     // description: {
  //     //   required: true,
  //     // },
  //     issue_date: {
  //       required: true,
  //     },
  //     expiration_date: {
  //       required: true,
  //     },
  //     license_start_date: {
  //       required: true,
  //     },
  //     license_end_date: {
  //       required: true,
  //     },
   
  //   },
  //   messages: {
  //     // state: {
  //     //   required: "This field is required.",
  //     // },
  //     issue_date: {
  //       required: "This field is required.",
  //     },
  //     expiration_date: {
  //       required: "This field is required.",
  //     },
  //     license_start_date: {
  //       required: "This field is required.",
  //     },
  //     license_end_date: {
  //       required: "This field is required.",
  //     }
  //   },
  //   errorElement: 'span',
  //   errorPlacement: function (error, element) {
  //     error.addClass('invalid-feedback');
  //     element.closest('.form-group').append(error);
  //   },
  //   highlight: function (element, errorClass, validClass) {
  //     $(element).addClass('is-invalid');
  //   },
  //   unhighlight: function (element, errorClass, validClass) {
  //     $(element).removeClass('is-invalid');
  //   }
  // });

  


  // load_add_state_licenses_assigned_user();
});


function reset_state_licenses_form(){
  // $("#state").val("");
  // $("#description").val("");
  // $("#ce_completion_status").val("");
  // $("#license_start_date").val("");
  // $("#license_end_date").val("");
  // $("#first_renewal").val("");
  // $("#ce_broker").val("");
  // $("#issue_date").val("");
  // $("#expiration_date").val("");



  $("#state").val("");
  $("#provider_id").val("");
  $("#license_type").val("");
  $("#license_number").val("");
  $("#issue_date").val("");
  $("#exp_date").val("");
  $("#last_updated").val("");
  $("#suppervising_physician").val("");
  $("#practitioners_in_cpa").val("");

  $("#renewal_id_pin").val("");
  $("#primary_check").val("");
  $("#compact").val("");
  $("#collaborative_relationship").val("");
  $("#enrolled_in_pmp").trigger("reset");
  $("#receipt_amount").val("");
  $("#document_type").val("");
  $("#doc_date").val("");
  $("#doc_exp_date").val("");
  $("#doc_last_updated").val("");
 
  $("#note").val("");
 $("#note_date").val("");
  $("#note_issue_date").val("");
  $("#followup_type").val("");
  $("#note_exp_date").val("");
  $("#note_last_updated").trigger("reset");
  // $("#separate_state_content").trigger("reset");

}


$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});



