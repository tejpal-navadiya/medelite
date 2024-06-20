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
			if($apitoken && $token_id){
				$validator = new Validator;
				$validation = $validator->make($_POST + $_FILES, [
				    'user_id' => 'required',
				    'name' => 'required',
				]);
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}

				$name = $_POST['name'];
				
				$address = $_POST['address'];
				$city = $_POST['city'];
				$state = $_POST['state'];
				
				$zip_code = $_POST['zip_code'];
				$phone_number = $_POST['phone_number'];
				
				$user_id = $_POST['user_id'];
				if(isset($_POST['address']) && $_POST['address']!=""){$optional_update.=", address='".$_POST['address']."' ";}
				if(isset($_POST['city']) && $_POST['city']!=""){$optional_update.=", city='".$_POST['city']."' ";}
				if(isset($_POST['state']) && $_POST['state']!=""){$optional_update.=", state='".$_POST['state']."' ";}
				if(isset($_POST['country']) && $_POST['country']!=""){$optional_update.=", country='".$_POST['country']."' ";}
				if(isset($_POST['zip_code']) && $_POST['zip_code']!=""){$optional_update.=", zip_code='".$_POST['zip_code']."' ";}
				if(isset($_POST['phone_number']) && $_POST['phone_number']!=""){$optional_update.=", phone_number='".$_POST['phone_number']."' ";}

				$update_user_qry = "UPDATE acr_admin_users SET name=? $optional_update WHERE id=? ";
				$is_updated = prepared_query($conn, $update_user_qry, [$name, $user_id])->affected_rows;
				// echo '<pre>'; print_r($is_updated);die((__FILE__).'-->'.(__FUNCTION__).'--Line('. (__LINE__).')');
				// ->affected_rows
				$code = 1;
				$message = "Profile Updated successfully.";
				$data=$_POST;
				apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
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