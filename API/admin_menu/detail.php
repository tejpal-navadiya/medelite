<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	include('../tasks.php');

	use Rakit\Validation\Validator;
	use Carbon\Carbon;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$headers = apache_request_headers();
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			// $firm_id = getFirmFromUserId($conn, $token_id);
			if($apitoken && $token_id && $firm_id){
				$validator = new Validator;
				$validation = $validator->make($_GET, [
				    'id' => 'required'
				]);
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}

				$task_data_qry = "SELECT * FROM admin_menu WHERE mid=? AND is_deleted=? limit 1";
				$task_data_result = prepared_select($conn, $task_data_qry, [$_GET['id'], 0]);
				if($task_data_result->num_rows){
					$data = $task_data_result->fetch_assoc();
					

					$code = 1;
					$message = "Data get successfully.";
				}else{
					$message = "Data not exist.";
				}
	        }else{
	        	$status_code = 401;
				$message = "Login expired or invalid token.";
			}	
		}else{
			$status_code = 401;
			$message = "Login expired or invalid token.";
		}
	    apiResponse($code, $message, "", "", $data, $status_code);
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>