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
  $('#licensureTable').DataTable({
    'order': [[ 0, 'desc' ]],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'type': "POST",
      'url': api_url+"dashboard_providers/license_list.php",
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
      // { data: 'profile_pic' },
      // // { data: 'provider_name' },

      // { data: 'provider_name' },
      { data: 'name' },
      // { data: 'tages' },
      // { data: 'speciality' },
      { data: 'id' },
    ],
    'columnDefs': [
      {
        "targets": [0,1],
        "orderable": false,
        "searchable": false
      },
      // {
      //     "targets": [ 1 ],
      //     "data":"id",
      //     "render": function(data, type, row, meta){
      //       // console.log(row);
      //         return row.provider_name+" - "+row.tages;
      //     }
      // } ,
            // {
            //   "targets": [0],  // Image column
            //   "data": "profile_pic",
            //   "render": function(data, type, row, meta) {
            //     return '<img class="custom-table-round-img" src="assets/img/user1.jpg" />';
            //   }
            // },
      {
        "targets": [ -1 ],
        "data":"id",
        "render": function(data, type, row, meta)
        {
          var btnGroup='<div class="btn-group">'+
                          '<a href="" class="btn btn-warning btn-sm">expiring</a>'+
                          '<button type="button" class="btn btn-sm btn-danger">expired</button>'+
                          '<button type="button" class="btn btn-sm btn-secondary">total</button>'+
                          '</div>';
                        // console.log(btnGroup);
          return btnGroup;
        }
      },
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

$("#licensureTable").on('draw.dt', function () {
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
  $('#licensureTable').DataTable().ajax.reload();
}

$("select").on("select2:close", function (e) {  
  $(this).valid(); 
});





