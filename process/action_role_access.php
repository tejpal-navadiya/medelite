<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ob_start();
include('../config.php');



$utype=mysqli_real_escape_string($conn,$_REQUEST['utype']);
$is_deleted="0";
$created_at=date('Y-m-d H:i:s');
$created_by=$_SESSION['medelite_admin']['me_admin'];

$updated_at=$created_at;$updated_by=$created_by;
// $exname=$_SESSION['medelite_admin''me'];


	mysqli_query($conn,"DELETE from me_user_access where utype='".$utype."'");

	$sel = "SELECT * from me_admin_menu WHERE is_deleted='0' ";
	$qry = mysqli_query($conn,$sel);
	while($fet = mysqli_fetch_array($qry))
	{
		$mname=$fet['mname'];
		$mtitle=$fet['mtitle'];
		$mid=$fet['mid'];
		$is_access=0;
		if(isset($_REQUEST[$mname]))
		{
			$is_access=1;
		}
		mysqli_query($conn,"INSERT into me_user_access (utype,mid,mtitle,mname,is_access) values('".$utype."','".$mid."','".$mtitle."','".$mname."','".$is_access."')");
	}


		



	


		$_SESSION['msg'] = "done";

		



	$_SESSION['msg'] = "error";	

// }


header("location:../user-role-access.php?id=".$utype);



?>