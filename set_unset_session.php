<?php 
	session_start();
	if(isset($_POST['action']) && $_POST['action']!="")
	{
		if($_POST['action']=='SetErrorMsg')
		{	
			$_SESSION['me_custom_error']=array();
			$_SESSION['me_custom_error']['err_msg_title']=$_REQUEST['err_msg_title'];
			$_SESSION['me_custom_error']['err_msg']=$_REQUEST['err_msg'];
			$_SESSION['me_custom_error']['msg_type']=$_REQUEST['msg_type'];
		}
	}
	echo json_encode($_POST);
	return true;
 ?>