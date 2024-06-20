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
  $('#example12').DataTable({
    'order': [[ 0, 'desc' ]],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'type': "POST",
      'url': api_url+"onboarding_app_form/list.php",
      'headers': {
          'apitoken': apitoken
      },
      "data": function ( d ) {
        return $.extend( {}, d,{
          "filter_type": "",
          
        });
      }
    },success: function(data){
      console.log(data);
    },
    'columns': [
      { data: 'id' },
      { data: 'application_type' },
      { data: 'provider_name' },
      { data: 'organization' },
      { data: 'submission_date' },
      { data: 'application_status' },
      { data: 'followup_time' },
      { data: 'followup_date' },
      { data: 'application_method' },
      { data: 'specialist_reviewed' },
      { data: 'web_contact_info' },
      { data: 'app_id' },
      { data: 'user_id' },
      { data: 'Password' },
      { data: 'note' },
      { data: 'id' },
    ],
    'columnDefs': [
      {
        "targets": [0,14],
        "orderable": false,
        "searchable": false
      },
 {
                "targets": [ 1 ],
                "data":"id",
                "render": function(data, type, row, meta){
                  // console.log(row);
                   return row.provider_name+" - "+row.tages;
                }
            }
            ,
    //   {
    //     "targets": [ -1 ],
    //     "data":"id",
    //     "render": function(data, type, row, meta)
    //     {
    //       var btnGroup='<div class="btn-group">'+
    //                       '<a href="index.php?pid=add_onboarding_app_form&id='+row.id+'" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>'+
    //                       '<button type="button" onclick="delete_onboarding_app_btn('+row.id+')" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>'+
    //                     '</div>';
    //                     // console.log(btnGroup);
    //       return btnGroup;
    //     }
    //   },
    //   {
    //     "targets": [ -5 ],
    //     "data":"id",
    //     "render": function(data, type, row, meta){
          
    //       var provider_name=row.provider_title;
    //       if(row.provider_name!=""){provider_name+=" "+row.provider_name;}
          
    //       return provider_name;
    //     }
    //   },
    //  {
    //     "targets": [ -6 ],
    //     "data":"id",
    //     "render": function(data, type, row, meta){
    //       return "<input type='checkbox' class='onboarding_app_selected' name='onboarding_app_selected' onclick='onboarding_appselected()'value='"+row.id+"' />";
    //    }
    //   }
    ],
    "language": {
      "emptyTable": "<p>No Tasks found.</p>"
    }
  });
});

$('#select_all_onboarding_app').on('click', function(){
  var status = $(this).is(":checked") ? true : false;
    $(".onboarding_app_selected").prop("checked",status);
});

function onboarding_appselected(){
  if ($('.onboarding_app_selected:checked').length == $('.onboarding_app_selected').length) {
        $("#select_all_onboarding_app").prop("checked", true);
    }else{
      $("#select_all_onboarding_app").prop("checked", false);
    }
}

$("#example12").on('draw.dt', function () {
  $(".onboarding_app_selected").prop("checked",false);
  $("#select_all_onboarding_app").prop("checked", false);
});



function changeFilterType(type){
  // // $(".loading-overlay").addClass("active");
  // $(".onboarding_app_selected").prop("checked",false);
  // $("#select_all_onboarding_app").prop("checked", false);

  // if(type == "lists"){
  //   $('#add_new_btn').attr("data-target","#add_tl_modal");
  //   reload_tl_table();
  // }else{
  //   $('#filter_type').val(type);
  //   $('#add_new_btn').attr("data-target","#addTaskModal");
  //   reload_provider_table();
  // }
}










function reload_provider_table(){
  $("#addTaskModal").modal("hide");
  $("#editTaskModal").modal("hide");
  $('#example12').DataTable().ajax.reload();
}

$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});





function delete_provider_btn(id){
  var ids = [];
  ids.push(id);
  delete_onboarding_app(ids);
}

$('#onboarding_app_delete').on('click', function(){
  var ids = [];
  $('input[class="onboarding_app_selected"]:checked').each(function() {
     ids.push(this.value); 
  });
  delete_onboarding_app(ids);
});

function delete_onboarding_app(ids){
  if(ids.length){
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
            url: api_url+"onboarding_app_form/delete.php",
            headers: {
              'apitoken': apitoken
            },
            data: {
              ids : JSON.stringify(ids),
            },
            success: function(data){
              reload_provider_table();
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



