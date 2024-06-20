<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	include('../task.php');

	use Rakit\Validation\Validator;
	use Carbon\Carbon;
	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$headers = apache_request_headers();
		

		function ConvertDecimalHours($time)
		{
			$hms = explode(":", $time);
			return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
		}
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			$firm_id = getFirmFromUserId($conn, $token_id);
			// $default_date_format=getDateFormatFromUserId($conn, $token_id);
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
				
				$ac_data_qry = "SELECT * FROM me_directories WHERE id=? AND firm_id=? limit 1";
				$ac_data_result = prepared_select($conn, $ac_data_qry, [$_GET['id'], $firm_id]);
				if($ac_data_result->num_rows)
				{
					$data = $ac_data_result->fetch_assoc();
					
					

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