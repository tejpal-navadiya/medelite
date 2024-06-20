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
    $('#websiteTable').DataTable({
        'order': [
            [0, 'desc']
        ],
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'type': "POST",
            'url': api_url + "website/list.php",
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
                        '<a href="index.php?pid=add_website&id=' + row.id + '" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>' +
                        '<button type="button" onclick="delete_website_btn(' + row.id + ')" class="btn btn-outline-primary btn-sm"><i class="fas fa-trash-alt"></i></button>' 
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
    $('#websiteTable').DataTable().ajax.reload();
    location.reload();
}

$('#select_all_website').on('click', function() {
    var status = $(this).is(":checked") ? true : false;
    $(".user_roles_selected").prop("checked", status);
});

function user_roleselected() {
    if ($('.user_roles_selected:checked').length == $('.user_roles_selected').length) {
        $("#select_all_website").prop("checked", true);
    } else {
        $("#select_all_website").prop("checked", false);
    }
}

$('#user_roles_delete').on('click', function() {
    var ids = [];
    $('input[class="user_roles_selected"]:checked').each(function() {
        ids.push(this.value);
    });
    delete_website(ids);

});



$("#websiteTable").on('draw.dt', function() {
    // $(".user_roles_selected").prop("checked", false);
    // $("#select_all_website").prop("checked", false);
});

function changeFilterType(type) {
    $('#filter_type').val(type);
    $('#websiteTable').DataTable().ajax.reload();
}

function reload_provider_table(){
  $("#addTaskModal").modal("hide");
  $("#editTaskModal").modal("hide");
  $('#websiteTable').DataTable().ajax.reload();
}

function hideLoader() {
    $(".loading-overlay").removeClass("active");
}


function delete_website_btn(id){
  var ids = [];
  ids.push(id);
  delete_website(ids);
}

$('#providers_delete').on('click', function(){
  var ids = [];
  $('input[class="providers_selected"]:checked').each(function() {
     ids.push(this.value); 
  });
  delete_website(ids);
});

function delete_website(ids){
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
            url: api_url+"website/delete.php",
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




  