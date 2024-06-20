<?php

ob_start();

session_start();

$is_provider_user=0;
if(isset($_SESSION['me_user_type_name']))
{
    if($_SESSION['me_user_type_name']=="Provider" && $_SESSION['me_user_type']=="0")
    {
      $is_provider_user=1;
    }
}
session_unset();

session_destroy();

session_start();

$_SESSION['msg'] = "logout";
if(isset($is_provider_user) && $is_provider_user==1)
{
    header("location:../login-povider.php");
}else
{
    header("location:../login.php");
}




?>