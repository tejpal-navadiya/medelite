var api_url = $('meta[name="api-url"]').attr('content');
var apitoken = $('meta[name="apitoken"]').attr('content');
function countObjectKeys(obj) { 
    return Object.keys(obj).length; 
}
function InitUploadProfileImg(e) 
{
    document.getElementById("profile_picture_image").click();    
}
$(function () {
    
    $.validator.setDefaults({
        submitHandler: function () {
            var form = $("#profile_picture_form");
            $('#profile_picture_submit').attr('disabled' , true);
            var file_data = $('#profile_picture_image').prop('files')[0];
            var form_data = new FormData();
            form_data.append('photo', file_data);
            $.ajax({
                url: api_url+"API/user/update_profile_picture.php",
                headers: {
                    'apitoken': apitoken
                },
                dataType: 'json',
                data: form_data,
                type: 'post',
                contentType : false,
                processData : false,
                success: function(data){
                    if(data.code)
                    {
                        var profile_img=data.data.profile_pic;
                        var set_session_data={profile_img:profile_img,action:"SetProfileImg"}
                        $.ajax({
							type: "POST",
							url: "set_unset_session.php",
							data: set_session_data,
							success: function(data)
							{
								SetSWALmsg("Success!", "Profile Image Updated Successfully", "success");
								
								setTimeout(function (e) {
									    location.reload();	
								}, 1000);
								
							}
						});
                        
                        $('#profile_picture_submit').attr('disabled' , false);
                    }else{
                        var errors = data.errors;
                        if(countObjectKeys(errors)){
                          $.each(errors, function( index, value ) {
                            // $(document).Toasts('create', {
                            //   class: 'bg-danger',
                            //   title: 'Failure',
                            //   autohide: true,
                            //   delay: 5000,
                            //   body: value
                            // })
                            swal("Failure!", value, "error");
                          });
                        }else{
                          
                          swal("Failure!", data.message, "error");
                        }
                        $('#profile_picture_submit').attr('disabled' , false);
                    }
                }
            });
        }
    });

    $('#profile_picture_form').validate({
        rules: {
        },
        messages: {
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});

function previewUserImage() {
  $('#profile_page_user_image').attr('src', URL.createObjectURL(event.target.files[0]));
  $("#profile_picture_submit").show();
  $("#profile_picture_cancel").show();
  $("#init_upload_image").html('change');
}

$("#profile_picture_cancel").click(function () {
   location.reload(); 
});