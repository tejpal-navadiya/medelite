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
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			$firm_id = getFirmFromUserId($conn, $token_id);
			if($apitoken && $token_id && $firm_id){
				$validator = new Validator;
				$validation = $validator->make($_FILES, [
					'photo' => 'uploaded_file:0,3M,png,jpeg,jpg',
				]);
				
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}
				
				if($_FILES["photo"]["error"] > 0){
					$photo = "";
				}else{
					$target_dir = "../../uploads/user/profile/";
				    $file_name = bin2hex(random_bytes(10)).'.'.pathinfo($_FILES["photo"]['name'], PATHINFO_EXTENSION);
		            $target_file_path = $target_dir . $file_name;
		             
		            if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file_path)){
	                    $photo = $file_name;
	                }
				}

				$update_user_qry = "UPDATE me_users SET profile_pic=? WHERE id=? ";
				$is_updated = prepared_query(
												$conn,
												$update_user_qry,
												[$photo, $token_id])->errno;
				if($is_updated == "0"){
					$code = 1;
					$message = "Profile pic updated successfully.";
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