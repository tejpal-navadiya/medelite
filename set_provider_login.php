<?php 
	include('config_front.php');
	if(isset($_POST['apitoken'])){
		$_SESSION['me_is_login'] = 1;
		$_SESSION['me_user_id'] = $_POST['id'];
		$_SESSION['me_user_type'] = 0;
		$_SESSION['me_user_type_name'] = "Provider";
		$_SESSION['me_firm_id'] = $_POST['firm_id'];
		$_SESSION['me_user_name'] = $_POST['provider_name'];
		$_SESSION['me_user_email'] = $_POST['provider_email'];
		$_SESSION['me_user_date_format'] = $_POST['date_format'];
		$_SESSION['me_apitoken'] = $_POST['apitoken'];
		if($_POST['remember_me']){
			setcookie('me_email', $_POST['email'], time()+3600, "/");
			setcookie('me_password', $_POST['password'], time()+3600, "/");
		}
	}
	// echo json_encode($_POST);
	return true;
 ?>