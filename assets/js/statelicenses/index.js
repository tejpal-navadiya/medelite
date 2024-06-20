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

$('[name="selectall"]').on('change', function() {
  $('.filterbyselect').toggle(this.checked);
}).change();


$(function () {
  


  
  
  $(".loading-overlay").addClass("active");
  const myTimeout = setTimeout(Hideloader, 4000);
    function Hideloader()
    {
      $(".loading-overlay").removeClass("active");
    }
  $('#statlicensesTable').DataTable({
    'order': [[ 0, 'desc' ]],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'type': "POST",
      'url': api_url+"state_licenses/list.php",
      'headers': {
          'apitoken': apitoken
      },
      "data": function ( d ) {
        return $.extend( {}, d,{
          "filter_type": "",
          "provider_id":$('#provider_id').val(),
        });
      }
      
    },
    'columns': [
      { data: 'id' },
      { data: 'state_name' },
      { data: 'license_number' },
      { data: 'created_at' },
      { data: 'renewal_id_pin' },
      { data: 'issue_date'},
      { data: 'exp_date' },
    { data: 'last_updated' },
      { data: 'id' }
    ],
    'columnDefs': [
      {
        "targets": [0,8],
        "orderable": false,
        "searchable": false
      },
      {
        "targets": [ -1 ],
        "data":"id",
        "render": function(data, type, row, meta)
        {
         var btnGroup = '<div class="btn-group">' +
    '<a href="index.php?pid=add_license_state_list&id=' + row.id + '" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>' +
    '<button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-sync-alt"></i></button>' + // Load button with icon
    '<button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-bell"></i></button>' + // Notification button
    '<button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-times"></i></button>' + // Cross button
    '<button type="button" onclick="delete_state_licensesbtn(' + row.id + ')" class="btn btn-sm btn-outline-primary"><i class="fas fa-trash-alt"></i></button>' +
    '</div>';
// console.log(btnGroup);
return btnGroup;

        }
      },
      // {
      // 'data': function (d) {
      //   console.log("Data:", d);
      //   return $.extend({}, d, {
      //     "filter_type": "",
      //   });
      // }
      // }
      
      //COMMENT BY ME

      {
        "targets": [ -9 ],
               "data":"id",
               "render": function(data, type, row, meta){
                 return "<input type='checkbox' class='state_licenses_selected' name='state_licenses_selected' onclick='state_licensesselected()'value='"+row.id+"' />";     
      
      }
      },
//       {
//         "targets": [ -7 ],
//         "data":"id",
//         "render": function(data, type, row, meta){
//           return "<input type='checkbox' class='state_licenses_selected' name='state_licenses_selected' onclick='state_licensesselected()'value='"+row.id+"' />";
//         }
//       }
    ],
    "language": {
      "emptyTable": "<p>No state_licenses found.</p>"
    }
  });
});

$('#select_all_state_licenses').on('click', function(){
  var status = $(this).is(":checked") ? true : false;
    $(".state_licenses_selected").prop("checked",status);
});

function state_licensesselected(){
  if ($('.state_licenses_selected:checked').length == $('.state_licenses_selected').length) {
        $("#select_all_state_licenses").prop("checked", true);
    }else{
      $("#select_all_state_licenses").prop("checked", false);
    }
}

$("#state_licensesTable").on('draw.dt', function () {
  $(".state_licenses_selected").prop("checked",false);
  $("#select_all_state_licenses").prop("checked", false);
});



function changeFilterType(type){
  // $(".loading-overlay").addClass("active");
  // $(".state_licenses_selected").prop("checked",false);
  // $("#select_all_state_licenses").prop("checked", false);

  // if(type == "lists"){
  //   $('#add_new_btn').attr("data-target","#add_tl_modal");
  //   reload_tl_table();
  // }else{
  //   $('#filter_type').val(type);
  //   $('#add_new_btn').attr("data-target","#addStateLicensesModal");
  //   reload_state_licensestable();
  // }
}










function reload_state_licensestable(){
  $("#addStateLicensesModal").modal("hide");
  $("#editStateLicensesModal").modal("hide");
  $('#state_licensesTable').DataTable().ajax.reload();
}

$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});





function delete_state_licensesbtn(id){
  var ids = [];
  ids.push(id);
  delete_state_licenses(ids);
}

$('#state_licenses_delete').on('click', function(){
  var ids = [];
  $('input[class="state_licenses_selected"]:checked').each(function() {
     ids.push(this.value); 
  });
  delete_state_licenses(ids);
});

function delete_state_licenses(ids){
  if(ids.length)
  {
    bootbox.confirm({
      message: 'Are you sure to remove?',
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
          $.ajax({
            type: "POST",
            url: api_url+"state_licenses/delete.php",
            headers: {
              'apitoken': apitoken
            },
            data: {
              ids : JSON.stringify(ids),
            },
            error: function(data)
            {
              console.log(data);
            },
            success: function(data)
            {
              
              reload_state_licensestable();
              if(data.code){
                $(document).Toasts('create', {
                  class: 'bg-success',
                  title: 'Success',
                  autohide: true,
                  delay: 5000,
                    body: data.message
                  });                
              }else{
                $(document).Toasts('create', {
                  class: 'bg-danger',
                  title: 'Failure',
                  autohide: true,
                  delay: 5000,
                  body: data.message
                });
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
      }
    })
  }else{
    $(document).Toasts('create', {
          class: 'bg-danger',
          title: 'Failure',
          autohide: true,
      delay: 5000,
          body: "Please select at least one row."
      });
  }
}

$('#provider_id').change(function() {
  
  $('#statlicensesTable').DataTable().ajax.reload();
});