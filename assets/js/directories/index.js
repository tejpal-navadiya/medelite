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
  $('#directoryTable').DataTable({
    'order': [[ 0, 'desc' ]],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'type': "POST",
      'url': api_url+"directory/list.php",
      'headers': {
          'apitoken': apitoken
      },
      "data": function ( d ) {
        return $.extend( {}, d,{
          "filter_type": "",
          
        });
      }
    },
    // success: function(data){
    //   console.log(data);
    // },
    'columns': [
      { data: 'id' },
      { data: 'board_name' },
      { data: 'tel_number_1' },
      { data: 'board_email_licence' },
      { data: 'address_line_1' },
      { data: 'website' },
      { data: 'id' },
    ],
    'columnDefs': [
      {
        "targets": [0,5],
        "orderable": false,
        "searchable": false
      },
      {
        "targets": [ -1 ],
        "data":"id",
        "render": function(data, type, row, meta)
        {
          var btnGroup = '<div class="btn-group">' +
    '<a href="index.php?pid=add_directory&id=' + row.id + '" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>' +
    '<button type="button" onclick="makeCall(' + row.id + ')" class="btn btn-outline-primary btn-sm"><i class="fas fa-phone"></i></button>' + // Call button
    '<button type="button" onclick="sendMessage(' + row.id + ')"class="btn btn-outline-primary btn-sm"><i class="fas fa-envelope"></i></button>' + // Message button
   
    '<button type="button" onclick="delete_directory_btn(' + row.id + ')" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>' +
   
    '</div>';
return btnGroup;

        }
      },
      {
        "targets": [ -3 ],
        "data":"id",
        "render": function(data, type, row, meta){
          
          var address="";
          if(row.address_line_1!=""){address+=row.address_line_1;}
          if(row.address_line_2!=""){address+=","+row.address_line_2;}
          if(row.city!=""){address+=","+row.city;}
          if(row.state!=""){address+=","+row.state;}
          if(row.zip_code!=""){address+=" - "+row.zip_code+".";}
          
          return address;
        }
      },
      {
        "targets": [ -7 ],
        "data":"id",
        "render": function(data, type, row, meta){
          return "<input type='checkbox' class='directorys_selected' name='directorys_selected' onclick='directorysselected()'value='"+row.id+"' />";
        }
      }
    ],
    "language": {
      "emptyTable": "<p>No Directorys found.</p>"
    }
  });
});

$('#select_all_directorys').on('click', function(){
  var status = $(this).is(":checked") ? true : false;
    $(".directorys_selected").prop("checked",status);
});

function directorysselected(){
  if ($('.directorys_selected:checked').length == $('.directorys_selected').length) {
        $("#select_all_directorys").prop("checked", true);
    }else{
      $("#select_all_directorys").prop("checked", false);
    }
}

$("#directoryTable").on('draw.dt', function () {
  $(".directorys_selected").prop("checked",false);
  $("#select_all_directorys").prop("checked", false);
});



function changeFilterType(type){
  // // $(".loading-overlay").addClass("active");
  // $(".directorys_selected").prop("checked",false);
  // $("#select_all_directorys").prop("checked", false);

  // if(type == "lists"){
  //   $('#add_new_btn').attr("data-target","#add_tl_modal");
  //   reload_tl_table();
  // }else{
  //   $('#filter_type').val(type);
  //   $('#add_new_btn').attr("data-target","#addDirectoryModal");
  //   reload_directory_table();
  // }
}










function reload_directory_table(){
  $("#addDirectoryModal").modal("hide");
  $("#editDirectoryModal").modal("hide");
  $('#directoryTable').DataTable().ajax.reload();
}

$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});





function delete_directory_btn(id){
  var ids = [];
  ids.push(id);
  delete_directorys(ids);
}

$('#directorys_delete').on('click', function(){
  var ids = [];
  $('input[class="directorys_selected"]:checked').each(function() {
     ids.push(this.value); 
  });
  delete_directorys(ids);
});

function delete_directorys(ids){
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
            url: api_url+"directory/delete.php",
            headers: {
              'apitoken': apitoken
            },
            data: {
              ids : JSON.stringify(ids),
            },
            success: function(data){
              reload_directory_table();
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



