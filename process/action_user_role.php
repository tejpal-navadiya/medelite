<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ob_start();
include('../config.php');



$name=mysqli_real_escape_string($conn,$_REQUEST['name']);
// $surname=mysqli_real_escape_string($conn,$_REQUEST['surname']);
// $address=mysqli_real_escape_string($conn,$_REQUEST['address']);
// $country=mysqli_real_escape_string($conn,$_REQUEST['country']);
// $city=mysqli_real_escape_string($conn,$_REQUEST['city']);
// $postal_code=mysqli_real_escape_string($conn,$_REQUEST['postal_code']);
// $email=mysqli_real_escape_string($conn,$_REQUEST['email']);
// $telephone=mysqli_real_escape_string($conn,$_REQUEST['telephone']);
// $status=mysqli_real_escape_string($conn,$_REQUEST['status']);
$is_deleted="0";
$created_at=date('Y-m-d H:i:s');
$created_by=$_SESSION['medelite']['me_admin'];

$updated_at=$created_at;$updated_by=$created_by;
// $exname=$_SESSION['mrdelite']['car_'];



$upload_path = "../uploads/";



// $is_ok_update="1";

$date_added=date('Y-m-d H:i:s');

if(isset($_REQUEST['id']))

{

	$id = $_REQUEST['id'];

	

	$update = "UPDATE  me_user_type set name='$name' where id='".$id."'";

	$query = mysqli_query($conn,$update)or die(mysqli_error($conn));

	if($query)
	{
		$_SESSION['msg'] = "done";
	} else {

		$_SESSION['msg'] = "error";

	}

} else {

	

		$insert = "insert into  me_user_type (name,is_deleted,created_at,created_by) values('$name','$is_deleted','$created_at','$created_by')";

		$query = mysqli_query($conn,$insert)or die(mysqli_error($conn));

		$id = mysqli_insert_id($conn);

		

}

	

if(isset($query))
{

	if($query)
	{

		$_SESSION['msg'] = "done";

		

	} else {

		$_SESSION['msg'] = "error";

	}

}else
{

	$_SESSION['msg'] = "error";	

}


header("location:../index.php?pid=user_role");



?>