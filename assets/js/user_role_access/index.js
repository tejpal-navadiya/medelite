var api_url = $('meta[name="api-url"]').attr('content');
var apitoken = $('meta[name="apitoken"]').attr('content');
let conditions = [];
var minDate, maxDate;

function countObjectKeys(obj) {
    return Object.keys(obj).length;
}

function delete_btn(id) {
    var ids = [];
    ids.push(id);
    delete_user_roles(ids);
}

$(function() {
    $(".loading-overlay").addClass("active");


    const myTimeout = setTimeout(Hideloader, 4000);

    function Hideloader() {
        $(".loading-overlay").removeClass("active");
    }
   
    var utype=$("#utype").val();
    $.ajax({
        type: "POST",
        url: api_url+"user_access/list.php",
        headers: {
          'apitoken': apitoken
        },
        data: {
          utype : utype,
        },
        success: function(data){
          // reload_activity_table();
          if(data.code){
            // console.log(data);
            var menu_list=[];
            var total_menu=data.data.length;
            for (let index = 0; index < total_menu; index++) 
            {
              var cur_data = data.data[index];
              if(cur_data.pmenu==0)
              {
                cur_data['sub_menu']=[];
                menu_list.push(cur_data);
              }
            }
    
            var total_menu_list=menu_list.length;
            for (let index = 0; index < total_menu_list; index++) 
            {
              var cur_data = menu_list[index];
              var cur_pmenu = cur_data.mid;
    
              for (let i = 0; i < total_menu; i++) 
              {
                var cmain_data = data.data[i];
                if(cmain_data.pmenu==cur_pmenu)
                {
                  
                  cur_data.sub_menu.push(cmain_data);
                }
              }
              
            }
            var chk_html='';
              chk_html+='<div class="row col-sm-12" style="margin-top:20px;border-bottom:1px solid #d2d2d2">';
              chk_html+='  <div class="col-sm-12">';
              chk_html+='     <div class="form-group">';
                        chk_html+='         <div class="custom-control custom-checkbox">';
                        chk_html+='				    <input class="custom-control-input" onchange="SelectMultipleCheck(this);" data-opt="custom-control-input" type="checkbox" id="role_access_all"  value="all">';
                        chk_html+='							<label for="role_access_all" class="custom-control-label">Select All</label>';
                        chk_html+='				  </div>';
                        chk_html+='		  </div>';
              chk_html+='  </div>';
            for (let index = 0; index < total_menu_list; index++) 
            {
              var cur_data = menu_list[index];
              var cur_mid = cur_data.mid;
              var cur_mtitle = cur_data.mtitle;
              var cur_is_access= cur_data.is_access;
              // console.log(cur_data);
              var chk_atr="";
              if(cur_is_access=="1"){chk_atr=" checked ";}
    
              chk_html+='<div class="row col-sm-12" style="margin-top:20px;border-bottom:1px solid #d2d2d2">';
              chk_html+='  <div class="col-sm-12">';
              chk_html+='     <div class="form-group">';
                        chk_html+='         <div class="custom-control custom-checkbox">';
                        chk_html+='				    <input class="custom-control-input" '+chk_atr+' onchange="SelectMultipleCheck(this);" data-opt="chk-main-menu'+cur_mid+'" type="checkbox" id="role_access'+cur_mid+'" name="role_access[]" value="'+cur_mid+'">';
                        chk_html+='							<label for="role_access'+cur_mid+'" class="custom-control-label">'+cur_mtitle+'</label>';
                        chk_html+='				  </div>';
                        chk_html+='		  </div>';
              chk_html+='  </div>';
              if(cur_data.sub_menu.length>0)
              {
                chk_html+='  <div class="row col-sm-3 col-md-2">&nbsp;</div>';
                chk_html+='  <div class="row col-sm-9 col-md-10">';
                  for (let i = 0; i < cur_data.sub_menu.length; i++) 
                  {
                    var cur_sub_data = cur_data.sub_menu[i];
                    var cur_sub_mid = cur_sub_data.mid;
                    var cur_sub_mtitle = cur_sub_data.mtitle;
                    var cur_sub_is_access= cur_sub_data.is_access;
                    // console.log(cur_data);
                    var sub_chk_atr="";
                    if(cur_sub_is_access=="1"){sub_chk_atr=" checked ";}
    
                    chk_html+='  <div class="col-sm-6 col-md-4 col-lg-3">';
                    chk_html+='     <div class="form-group">';
                    chk_html+='         <div class="custom-control custom-checkbox">';
                    chk_html+='				    <input onchange="SelectMultipleCheckParent(this);" data-parent_id="'+cur_mid+'" class="custom-control-input chk-main-menu'+cur_mid+'" '+sub_chk_atr+' type="checkbox" id="role_access'+cur_sub_mid+'" name="role_access[]" value="'+cur_sub_mid+'">';
                    chk_html+='							<label for="role_access'+cur_sub_mid+'" class="custom-control-label">'+cur_sub_mtitle+'</label>';
                    chk_html+='				  </div>';
                    chk_html+='		  </div>';
                    chk_html+='  </div>';
    
                  }
                chk_html+='  </div>';   
              }
              chk_html+='</div>';
              
            }
            $("#checkbox-wrapp").html(chk_html);
            // console.log(menu_list);                
          }else{
            $(document).Toasts('create', {
              class: 'bg-danger',
              title: 'Failure',
              autohide: true,
              delay: 5000,
              body: data.message
            });
            setTimeout(function(){ 
                window.location.href="user_type/index";
              }, 3000);
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
});

function reloadFundTable() {
    $('#user_roleTable').DataTable().ajax.reload();
    location.reload();
}



function hideLoader() {
    $(".loading-overlay").removeClass("active");
}



function SelectMultipleCheckParent(e) 
{
  var parent_id=$(e).data('parent_id');  
  var total_sub_checks=$(".chk-main-menu"+parent_id).length;
  var is_parent_check_required=0;
  for (let i = 0; i < total_sub_checks; i++) {
    var cur_element = $(".chk-main-menu"+parent_id)[i]['id'];
    if($('#'+cur_element).is(":checked"))
    {
      is_parent_check_required=1;
      break;
    }
    
  }
  if(is_parent_check_required==1)
  {
    $('#role_access'+parent_id).prop('checked', true);
    
  }else
  {
    $('#role_access'+parent_id).prop('checked', false);
  }
  // console.log(is_parent_check_required);
  // console.log(total_sub_checks);

}
function SelectMultipleCheck(e)
{
    check_class=$(e).data('opt');  
    total_ele=$("."+check_class).length;
    // console.log($(e).is(':checked'));
    if($(e).is(':checked') != true)
    {
        $("."+check_class).prop('checked', false);

    }else
    {
        
        $("."+check_class).prop('checked', true);
        
    }

}