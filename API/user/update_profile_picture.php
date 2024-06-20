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
		$headers = apache_request_headers();
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			$org_id = getFirmFromUserId($conn, $token_id);
			if($apitoken && $token_id){
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
					$target_dir = "../../uploads/user/";
				    $file_name = bin2hex(random_bytes(10)).'.'.pathinfo($_FILES["photo"]['name'], PATHINFO_EXTENSION);
		            $target_file_path = $target_dir . $file_name;
		             
		            if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file_path)){
	                    $photo = $file_name;
	                }
				}

				$update_user_qry = "UPDATE acr_users SET profile_img=? WHERE id=? ";
				$is_updated = prepared_query(
												$conn,
												$update_user_qry,
												[$photo, $token_id])->errno;
				if($is_updated == "0")
				{
					$data=array();
					$data['profile_pic'] = $project_url."uploads/user/".$photo;
					$data['input']=$_FILES;
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