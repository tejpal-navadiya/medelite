<?php
	include('../../config.php');
	include('../../helper/functions.php');

	use Rakit\Validation\Validator;
	use Carbon\Carbon;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$validator = new Validator;
		$validation = $validator->make($_POST + $_FILES, [
		    'user_id' => 'required',
		    'device_token' => 'required'
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$user_id = $_REQUEST['user_id'];

		$device_token = $_REQUEST['device_token'];

		$checkExistQry = "SELECT * FROM me_users WHERE id='$user_id'";
		
		$user_data_result = mysqli_query($conn, $checkExistQry);
		
		if(mysqli_num_rows($user_data_result)<=0){
			$message = "Invalid Credentials.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}

		$user_data = $user_data_result->fetch_assoc();
		
		$update_token=mysqli_query($conn,"UPDATE me_users set pc_device_token='$device_token' WHERE id='$user_id' ");
		if($update_token)
		{
			$message = "Login successfully.";
			$code = 1;
			apiResponse($code, $message, "", "", $user_data, $status_code, $errors); die();
		}
		else
		{
			$message = "Something went wrong";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}	 
		
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}	

?>