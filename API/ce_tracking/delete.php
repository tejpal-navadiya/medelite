<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	include('../ce_tracking.php');

	use Rakit\Validation\Validator;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try {
		$headers = apache_request_headers();
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			if($apitoken && $token_id){
				$validator = new Validator;
				$validation = $validator->make($_POST + $_FILES, [
				    'ids' => 'required|json',
				]);
				
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}				
				deleteCetracking($conn, $_POST['ids']); // Removed $token_id parameter
				$data=$_REQUEST;
				$code = 1;
				$message = "Cetracking(s) deleted successfully.";
	        } else {
	        	$status_code = 401;
				$message = "Login expired or invalid token.";
			}	
		} else {
			$status_code = 401;
			$message = "Login expired or invalid token.";
		}
	    apiResponse($code, $message, "", "", $data, $status_code);
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>