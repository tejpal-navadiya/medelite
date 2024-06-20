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
  $('#providerTable').DataTable({
    'order': [[ 0, 'desc' ]],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'type': "POST",
      'url': api_url+"dashboard_providers/list.php",
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
      { data: 'profile_pic' },
      // { data: 'provider_name' },

      { data: 'provider_name' },
      { data: 'speciality' },
      { data: 'tages' },
      // { data: 'speciality' },
      { data: 'id' },
    ],
    'columnDefs': [
      {
        "targets": [0,4],
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
      } ,
            {
              "targets": [0],  // Image column
              "data": "profile_pic",
              "render": function(data, type, row, meta) {
                return '<img class="custom-table-round-img" src="assets/img/user1.jpg" />';
              }
            },
      // {
      //   "targets": [ -1 ],
      //   "data":"id",
      //   "render": function(data, type, row, meta)
      //   {
      //     var btnGroup='<div class="btn-group">'+
      //                     '<a href="index.php?pid=add_provider&id='+row.id+'" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>'+
      //                     '<button type="button" onclick="delete_provider_btn('+row.id+')" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>'+
      //                   '</div>';
      //                   // console.log(btnGroup);
      //     return btnGroup;
      //   }
      // },
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
    //       return "<input type='checkbox' class='providers_selected' name='providers_selected' onclick='providersselected()'value='"+row.id+"' />";
    //    }
    //   }
    ],
    "language": {
      "emptyTable": "<p>No Tasks found.</p>"
    }
  });
});

$('#select_all_providers').on('click', function(){
  var status = $(this).is(":checked") ? true : false;
    $(".providers_selected").prop("checked",status);
});

function providersselected(){
  if ($('.providers_selected:checked').length == $('.providers_selected').length) {
        $("#select_all_providers").prop("checked", true);
    }else{
      $("#select_all_providers").prop("checked", false);
    }
}

$("#providerTable").on('draw.dt', function () {
  $(".providers_selected").prop("checked",false);
  $("#select_all_providers").prop("checked", false);
});



function changeFilterType(type){
  // // $(".loading-overlay").addClass("active");
  // $(".providers_selected").prop("checked",false);
  // $("#select_all_providers").prop("checked", false);

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
  $('#providerTable').DataTable().ajax.reload();
}

$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});





function delete_provider_btn(id){
  var ids = [];
  ids.push(id);
  delete_providers(ids);
}

$('#providers_delete').on('click', function(){
  var ids = [];
  $('input[class="providers_selected"]:checked').each(function() {
     ids.push(this.value); 
  });
  delete_providers(ids);
});

function delete_providers(ids){
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
            url: api_url+"dashboard_providers/delete.php",
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



