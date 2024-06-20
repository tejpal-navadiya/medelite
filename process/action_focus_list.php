
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ob_start();
include('../config.php');



$name=mysqli_real_escape_string($conn,$_REQUEST['name']);

$is_deleted="0";
$created_at=date('Y-m-d H:i:s');
$created_by=$_SESSION['medelite']['me_admin'];

$updated_at=$created_at;$updated_by=$created_by;
// $exname=$_SESSION['mrdelite']['car_'];

$upload_path = "../uploads/";

$date_added=date('Y-m-d H:i:s');

if(isset($_REQUEST['id']))

{

	$id = $_REQUEST['id'];
	$update = "UPDATE  me_Focus set name='$name' where id='".$id."'";

	$query = mysqli_query($conn,$update)or die(mysqli_error($conn));

	if($query)
	{
		$_SESSION['msg'] = "done";
	} else {

		$_SESSION['msg'] = "error";
	}

} else {

		$insert = "insert into  me_Focus (name,is_deleted,created_at,updated_at) values('$name','$is_deleted','$created_at','$updated_at')";

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

header("location:../index.php?pid=focus");

?>
