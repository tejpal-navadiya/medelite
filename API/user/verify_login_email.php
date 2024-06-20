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
		$validation = $validator->make($_POST, [
		    'token' => 'required',
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$email_verifiy_token = $_POST["token"];

		$checkExistQry = "SELECT * FROM change_login_email_tokens WHERE verifiy_token=?";
		$user_data_result = prepared_select($conn, $checkExistQry, [$email_verifiy_token]);
		
		if(!$user_data_result->num_rows){
			$message = "Invalid or expired token.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		$user_data = $user_data_result->fetch_assoc();
		$old_email = $user_data['old_email'];
		$new_email = $user_data['new_email'];
		$password = $user_data['password'];

		$verify_email_qry = "UPDATE acr_admin_users SET password=?, email=? WHERE email=? ";
		$is_verified = prepared_query($conn, $verify_email_qry, [$password, $new_email, $old_email])->affected_rows;

		$delete_old_token = $conn->prepare("DELETE FROM `change_login_email_tokens` WHERE old_email=?");
		$delete_old_token->bind_param("s", $old_email);
		$delete_old_token->execute();

		if($is_verified){
			$code = 1;
			$message = "Email verfied successfully.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}else{
			$message = "Invalid or expired token.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>