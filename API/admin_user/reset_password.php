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
		    'password' => 'required|min:6',
    		'confirm_password' => 'required|same:password',
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$token = $_POST['token'];

		$checkExistQry = "SELECT * FROM me_password_resets WHERE token=?";
		$reset_result = prepared_select($conn, $checkExistQry, [$token]);
		if(!$reset_result->num_rows){
			$message = "Invalid or expired token.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		$reset_row = $reset_result->fetch_assoc();
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

		$update_user_qry = "UPDATE me_users SET password=? WHERE email=? ";
		$is_updated = prepared_query($conn, $update_user_qry, [$password, $reset_row['email']])->affected_rows;

		if($is_updated){
			$remove_old = $conn->prepare("DELETE FROM me_password_resets WHERE email = ?");
			$remove_old->bind_param("s", $reset_row['email']);
			$remove_old->execute();

			$code = 1;
			$message = "Password reset successfully.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}else{
			$message = "Something went wrong";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>