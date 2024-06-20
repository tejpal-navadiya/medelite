var api_url = $('meta[name="api-url"]').attr('content');
var apitoken = $('meta[name="apitoken"]').attr('content');
let conditions = [];
var minDate, maxDate;

function countObjectKeys(obj) {
    return Object.keys(obj).length;
}



$(function() {
    $(".loading-overlay").addClass("active");


    const myTimeout = setTimeout(Hideloader, 4000);

    function Hideloader() {
        $(".loading-overlay").removeClass("active");
    }
    $('#degree_Table').DataTable({
        'order': [
            [0, 'desc']
        ],
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'type': "POST",
            'url': api_url + "degree/list.php",
            'headers': {
                'apitoken': apitoken
            },
            /*success: function(data) {
              // Request success
              console.log(data);       
            },
            error: function(data) {
              // Request failed
              console.log(data);
            },*/
            "data": function(d) {
                return $.extend({}, d, {
                    "filter_type": ""
                });
            },

        },
        'columns': [
            { data: 'id' },
            { data: 'name' },
            { data: 'id' },
        ],
        'columnDefs': [{
                "targets": [0, 2],
                "orderable": false,
                "searchable": false
            },

            {
                "targets": [-1],
                "data": "id",
                "render": function(data, type, row, meta) {
                    var btnGroup = '<div class="btn-group">' +
                        // '<a href="index.php?pid=user_role_access&id=' + row.id + '" class="btn btn-outline-primary btn-sm"><i class="fas fa-key"></i></a>' +
                        '<a href="index.php?pid=add_degree&id=' + row.id + '" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>' +
                        '<button type="button" onclick="delete_degree_btn(' + row.id + ')" class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt"></i></button>' 
                        '</div>';
                    return btnGroup;
                }
            },
        ],
        "language": {
            "emptyTable": "<p>No file-types found.</p>"

        }

    });
});

function reloadFundTable() {
    $('#degree_Table').DataTable().ajax.reload();
    location.reload();
}

$('#select_all_degree').on('click', function() {
    var status = $(this).is(":checked") ? true : false;
    $(".user_roles_selected").prop("checked", status);
});

function user_roleselected() {
    if ($('.user_roles_selected:checked').length == $('.user_roles_selected').length) {
        $("#select_all_degree").prop("checked", true);
    } else {
        $("#select_all_degree").prop("checked", false);
    }
}

$('#user_roles_delete').on('click', function() {
    var ids = [];
    $('input[class="user_roles_selected"]:checked').each(function() {
        ids.push(this.value);
    });
    delete_degreer_type(ids);

});



$("#degree_Table").on('draw.dt', function() {
    // $(".user_roles_selected").prop("checked", false);
    // $("#select_all_degree").prop("checked", false);
});

function changeFilterType(type) {
    $('#filter_type').val(type);
    $('#degree_Table').DataTable().ajax.reload();
}

function reload_degree_table(){
  $("#addTaskModal").modal("hide");
  $("#editTaskModal").modal("hide");
  $('#degree_Table').DataTable().ajax.reload();
}

function hideLoader() {
    $(".loading-overlay").removeClass("active");
}


function delete_degree_btn(id){
  var ids = [];
  ids.push(id);
  delete_degreer_type(ids);
}

$('#providers_delete').on('click', function(){
  var ids = [];
  $('input[class="providers_selected"]:checked').each(function() {
     ids.push(this.value); 
  });
  delete_degreer_type(ids);
});

function delete_degreer_type(ids){
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
            url: api_url+"degree/delete.php",
            headers: {
              'apitoken': apitoken
            },
            data: {
              ids : JSON.stringify(ids),
            },
            success: function(data){
              reload_degree_table();
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




  