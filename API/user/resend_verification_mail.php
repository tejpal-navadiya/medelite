<?php 
	include('../../config/config.php');
	include('../../helper/functions.php');
	load_config("1","1","1","1","1");

	use Rakit\Validation\Validator;
	use Carbon\Carbon;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$validator = new Validator;
		$validation = $validator->make($_POST + $_FILES, [
		    'email' => 'required',
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$email = $_POST["email"];

		$checkExistQry = "SELECT * from acr_admin_users WHERE email='$email' AND is_deleted='0' AND status='0'   ORDER BY id DESC";
					
		$user_data_result = mysqli_query($conn, $checkExistQry)or die(mysqli_error($conn));
		
		if(mysqli_num_rows($user_data_result)<=0){
			$message = "Invalid Email or Email is already verified.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}else
		{
			$user_data = $user_data_result->fetch_assoc();
			$user_id=$user_data['id'];
			registerMail($user_id);
			$message = "Verification Mail sent successfully.";
			$code = 1;
			apiResponse($code, $message, "", "", $user_data, $status_code, $errors); die();
		}

		
		
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>