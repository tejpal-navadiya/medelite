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
		$headers = apache_request_headers();
		
			
				$validator = new Validator;
				$validation = $validator->make($_REQUEST, [
				    'country_id' => 'required'
				]);
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}

				$user_data_qry = "SELECT * FROM sol_countries WHERE id=?";
				$user_data_result = prepared_select($conn, $user_data_qry, [$_REQUEST['country_id']]);
				$data = $user_data_result->fetch_assoc();
				
				$message = "Data get successfully.";
				$code = 1;
	        	
		
	    apiResponse($code, $message, "", "", $data, $status_code);
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>