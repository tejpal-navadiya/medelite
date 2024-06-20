var api_url = $('meta[name="api-url"]').attr('content');
var apitoken = $('meta[name="apitoken"]').attr('content');

function InitCountryDropDown(ele)
{
  // alert(ele);
    $(ele).select2({
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
            // alert(params);
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
}
function InitStateDropDown(ele)
{
    $(ele).select2({
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
}
$(document).ready(function () {
  var country_ele=".country_dropdown"; 
  if($(country_ele).length)
  {
    InitCountryDropDown(country_ele);
  }

  var state_ele=".state_dropdown"; 
  if($(state_ele).length)
  {
    // console.log($(state_ele));
    InitStateDropDown(state_ele);
  }

  setTimeout(function (e) {
    if($(country_ele).length)
    {
      var total_ele=$(country_ele).length;
      for (let ci = 0; ci < total_ele; ci++) {
        var cur_element = $(country_ele)[ci];
        // console.log(cur_element);
        var data_val_enc=$(cur_element).data('val_sel');
        if(data_val_enc!=undefined && data_val_enc!="")
        {
        // console.log(data_val_enc);

          var data_val=atob(data_val_enc);
          var data_val_json=JSON.parse(data_val);
          
          if(data_val_json.id != "0" && data_val_json.name!="" && data_val_json.name!=null){
            var country_option = new Option(data_val_json.name, data_val_json.id, true, true);
            $(cur_element).append(country_option).trigger('change');  
          }
        }
      }
    }

    if($(state_ele).length)
    {
      var total_ele=$(state_ele).length;
      for (let ci = 0; ci < total_ele; ci++) {
        var cur_element = $(state_ele)[ci];
        var data_val_enc=$(cur_element).data('val_sel');
        if(data_val_enc!=undefined && data_val_enc!="")
        {
          var data_val=atob(data_val_enc);
          var data_val_json=JSON.parse(data_val);
          // console.log(data_val_json);
          if(data_val_json.id != "0" && data_val_json.name!="" && data_val_json.name!=null){
            var state_option = new Option(data_val_json.name, data_val_json.id, true, true);
            $(cur_element).append(state_option).trigger('change');  
          }
        }
      }
    }
  }, 1000);
    
});
function SubmitCurrentForm()
{
  document.getElementById('submit').click();
}
function SubmitLastOnboardingForm(status)
{
  var application_status=status;
  if(application_status=="1" || application_status==1)
    {
      bootbox.confirm({
        message: 'Are you sure to submit form\n No changes will be done after submit form?',
        buttons: {
        confirm: {
        label: 'Yes',
        className: 'btn-success'
        },
        cancel: {
        label: 'No',
        className: 'btn-danger'
        }
        },
        callback: function (result) 
        {
          // console.log(result);
          if(result)
          {
            $("#application_status").val(application_status);

            setTimeout(function (e) {
              document.getElementById('submit').click();
            }, 1000);
          
            
          }
        }
      });
    }else
    {
      $("#application_status").val(application_status);

      setTimeout(function (e) {
        document.getElementById('submit').click();
      }, 1000);
    }
  
}


function InitInstituteTypeDropDown(ele)
{
  // alert('data:::'+ele);
    $(ele).select2({
        theme: 'bootstrap4',
        allowClear: false,
        ajax: {
          type: "POST",
          url: api_url+"institution_type/select_list.php",
          headers: {
            'apitoken': apitoken
          },
          dataType: 'json',
          delay: 250,
          data: function (params) {
            // alert(params);
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
}



function InitDegreeDropDown(ele)
{
  // alert('data:::'+ele);
    $(ele).select2({
        theme: 'bootstrap4',
        allowClear: false,
        ajax: {
          type: "POST",
          url: api_url+"degree/select_list.php",
          headers: {
            'apitoken': apitoken
          },
          dataType: 'json',
          delay: 250,
          data: function (params) {
            // alert(params);
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
}