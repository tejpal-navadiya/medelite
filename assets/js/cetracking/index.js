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
  $('#cetrackingTable').DataTable({
    'order': [[ 0, 'desc' ]],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'type': "POST",
      'url': api_url+"ce_tracking/list.php",
      'headers': {
          'apitoken': apitoken
      },
      "data": function ( d ) {
        return $.extend( {}, d,{
          "filter_type": "",
          
        });
      }
    },
    'columns': [
     

      { data: 'id' },
      { data: 'state_name' },
      { data: 'state_content_requirement' },
      { data: 'completed_date' },
      { data: 'completed_date' },
      { data: 'state_content_requirement' },
      { data: 'provider_approving_body' },
      { data: 'completed_date' },
      { data: 'completed_date' },
      { data: 'updated_at' },
      { data: 'id' },
    ],
    'columnDefs': [
      {
        "targets": [0,1],
        "orderable": false,
        "searchable": false
      },
      {
        "targets": [ -1 ],
        "data":"id",
        "render": function(data, type, row, meta)
        {


         var btnGroup='<div class="btn-group">'+
                         '<a href="index.php?pid=add_ce_tracking&id='+row.id+'" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>'+
                          '<button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-sync-alt"></i></button>' + // Load button with icon
                          '<button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-times"></i></button>' + // Cross button
                         
                         '<button type="button" onclick="delete_ce_trackingbtn('+row.id+')" class="btn btn-sm btn-outline-primary"><i class="fas fa-trash-alt"></i></button>'+
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
        "targets": [ -11 ],
                "data":"id",
                "render": function(data, type, row, meta){
                  return "<input type='checkbox' class='ce_tracking_selected' name='ce_tracking_selected' onclick='ce_trackingselected()'value='"+row.id+"' />";     
      
      }
      }
//       {
//         "targets": [ -7 ],
//         "data":"id",
//         "render": function(data, type, row, meta){
//           return "<input type='checkbox' class='ce_tracking_selected' name='ce_tracking_selected' onclick='ce_trackingselected()'value='"+row.id+"' />";
//         }
//       }
    ],
    "language": {
      "emptyTable": "<p>No ce_tracking found.</p>"
    }
  });
});

$('#select_all_ce_tracking').on('click', function(){
  var status = $(this).is(":checked") ? true : false;
    $(".ce_tracking_selected").prop("checked",status);
});

function ce_trackingselected(){
  if ($('.ce_tracking_selected:checked').length == $('.ce_tracking_selected').length) {
        $("#select_all_ce_tracking").prop("checked", true);
    }else{
      $("#select_all_ce_tracking").prop("checked", false);
    }
}

$("#ce_trackingTable").on('draw.dt', function () {
  $(".ce_tracking_selected").prop("checked",false);
  $("#select_all_ce_tracking").prop("checked", false);
});



function changeFilterType(type){
  // $(".loading-overlay").addClass("active");
  // $(".ce_tracking_selected").prop("checked",false);
  // $("#select_all_ce_tracking").prop("checked", false);

  // if(type == "lists"){
  //   $('#add_new_btn').attr("data-target","#add_tl_modal");
  //   reload_tl_table();
  // }else{
  //   $('#filter_type').val(type);
  //   $('#add_new_btn').attr("data-target","#addCeTrackingModal");
  //   reload_ce_trackingtable();
  // }
}










function reload_ce_trackingtable(){
  $("#addCeTrackingModal").modal("hide");
  $("#editCeTrackingModal").modal("hide");
  $('#ce_trackingTable').DataTable().ajax.reload();
}

$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});





function delete_ce_trackingbtn(id){
  var ids = [];
  ids.push(id);
  delete_ce_tracking(ids);
}

$('#ce_tracking_delete').on('click', function(){
  var ids = [];
  $('input[class="ce_tracking_selected"]:checked').each(function() {
     ids.push(this.value); 
  });
  delete_ce_tracking(ids);
});

function delete_ce_tracking(ids){
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
            url: api_url+"ce_tracking/delete.php",
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
              
              reload_ce_trackingtable();
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



