<?php
if(isset($_SESSION['print']) && $_SESSION['print']!="")
{	$print = $_SESSION['print']; } else { $print = ""; }
if(isset($_SESSION['msg']) && $_SESSION['msg'] != "")
{
	$msg = $_SESSION['msg'];
	if($msg == "up_black")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
         <strong> Error!</strong> Username and password required.
       </div>
    <?php
	}
	 if($msg == "subscription_deactive")
  {
  ?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
         <strong> Error!</strong> Your company subscription is de-active.
       </div>
    <?php
  }
  if($msg == "invalid_arguments")
  {
  ?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
         <strong> Error!</strong> Please Enter valid arguments.
       </div>
    <?php
  }
	if($msg == "register_done")
	{
	?>
       <div class="alert alert-success alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Done!</strong> You are registration successfully. when administrator approved your account, you will able to login in panel.
       </div>
    <?php
	}
	
	if($msg == "stock_not_avail")
	{
	?>
       <div class="alert alert-success alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> Stock is not available.
       </div>
    <?php
	}
	if($msg == "alreay_reg")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> Already email address use for registration, use different and try again.
       </div>
    <?php
	}
	if($msg == "avail")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> Already available please use different.
       </div>
    <?php
	}
	if($msg == "bemail")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> Email id is required.
       </div>
    <?php
	}
	if($msg == "emailnotmatch")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> your email not found in database.
       </div>
    <?php
	}
	if($msg == "passnotsend")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> some problem. please try later.
       </div>
    <?php
	}
	if($msg == "passsend")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> your login details send. please check email.
       </div>
	<?php
	}
	if($msg == "login_fail")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> Username and password not match. please try gain.
       </div>
	<?php
	}
	if($msg == "course_avail")
	{
	?>
       <div class="alert alert-warning alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Warning!</strong> Course available please enter others.
       </div>
	<?php
	}
	if($msg == "cat_avail")
	{
	?>
       <div class="alert alert-warning alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Warning!</strong> Category available please enter others..
       </div>
	<?php
	}
	if($msg == "done")
	{
	?>
       <div class="alert alert-success alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Success!</strong> Your action complete successfully.
       </div>
	<?php
	}
	if($msg == "report_succ")
	{
	?>
       <div class="alert alert-success alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Success!</strong> your work details save successfully.
       </div>
    <?php
	}
	if($msg == "transfer")
	{
	?>
       <div class="alert alert-success alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Success!</strong>  Inquiry transfer successfully.
       </div>
	<?php
	}
	if($msg == "error")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> Some problem please try again.
       </div>

	<?php
	}
	if($msg == "report_err")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong>  Some problem to save your work details.
       </div>
    <?php
	}
	if($msg == "mailsendyes")
	{
	?>
       <div class="alert alert-success alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Success!</strong>  Mail send successfully.
       </div>
	<?php
	}
	if($msg == "mailsendno")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong>  Some problem in mail sending please try again.
       </div>
	<?php
	}
	if($msg == "deleteyes")
	{
	?>
       <div class="alert alert-success alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Success!</strong> Details delete successfully.
       </div>
	<?php
	}
	if($msg == "otp_not_match")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> OTP not match. please try again.
       </div>
	<?php
	}
	if($msg == "logout")
	{
	?>
       <div class="alert alert-success alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
         <strong> Success!</strong>  You Logout successfully.
       </div>
	<?php
	}if($msg == "password_match")
	{
	?>
         
     <div class="alert alert-success alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
         <strong> Success!</strong>  Change Password Succesfully.
       </div>
	<?php
	}if($msg == "invalid_token")
	{
	?><div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> Invalid token please try again.
       </div>
	
     
    <?php
	}
	if($msg == "required")
	{
	?>
      
	   <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> Fields required.
       </div>
    <?php
	}
	if($msg == "not_pass_match")
	{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> password and confirm password not match.
       </div>
	<?php
	}

}
if(isset($_SESSION['print1']))
{
	?>
       <div class="alert alert-danger alert-block">
         <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <strong> Error!</strong> <?php echo $_SESSION['print1']; ?>
       </div>
   <?php
}

if(isset($_SESSION['me_custom_error']) && $_SESSION['me_custom_error'] != "")
{
  if(isset($_SESSION['me_custom_error']['msg_type']) && $_SESSION['me_custom_error']['msg_type']=="error" && isset($_SESSION['me_custom_error']['err_msg']))
  {
      ?>
      <div class="alert alert-danger">
        <button data-dismiss="alert" class="close close-sm" type="button">x</button>
        <strong> Error!</strong> <?php echo $_SESSION['me_custom_error']['err_msg']; ?>
      </div>
      <?php 
  }else
  {
    if(isset($_SESSION['me_custom_error']['msg_type']) && $_SESSION['me_custom_error']['msg_type']!="error" && isset($_SESSION['me_custom_error']['err_msg']))
    {
      ?>
        <div class="alert alert-success">
          <button data-dismiss="alert" class="close close-sm" type="button">x</button>
          <strong> Success!</strong> <?php echo $_SESSION['me_custom_error']['err_msg']; ?>
        </div>
      <?php
    }
  }
}
unset($_SESSION['msg']);
unset($_SESSION['print']);
unset($_SESSION['print1']);
unset($_SESSION['me_custom_error']);
?>





