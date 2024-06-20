<?php 
	include('../../config.php');
	include('../../helper/functions.php');

	use Rakit\Validation\Validator;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$validator = new Validator;
		$validation = $validator->make($_POST + $_FILES, [
		    'token' => 'required',
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$email_verifiy_token = $_POST["token"];

		$check_token_qry = "SELECT * FROM me_users WHERE email_verifiy_token='$email_verifiy_token' limit 1";
		$check_token_result = mysqli_query($conn, $check_token_qry);
		if(mysqli_num_rows($check_token_result)>0)
		{
			$code = 1;
			$user_details=mysqli_fetch_assoc($check_token_result);
			$message = "Token verified.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}else{
			$message = "Invalid token.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>