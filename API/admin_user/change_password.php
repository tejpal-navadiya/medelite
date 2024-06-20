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
		    'user_id' => 'required',
		    'old_password' => 'required|min:6',
		    'password' => 'required|min:6',
    		'confirm_password' => 'required|same:password',
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$user_id = $_POST['user_id'];
		$old_password =$_POST["old_password"];

		$checkExistQry = "SELECT * FROM me_users WHERE id=? ";
		$reset_result = prepared_select($conn, $checkExistQry, [$user_id]);
		if(!$reset_result->num_rows){
			$message = "Invalid Old Password. ";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		$reset_row = $reset_result->fetch_assoc();
        if (!password_verify($old_password, $reset_row['password'])) 
        {
            $message = "Invalid Old Password. ";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
        }
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

		$update_user_qry = "UPDATE me_users SET password=? WHERE id=? ";
		$is_updated = prepared_query($conn, $update_user_qry, [$password, $user_id])->affected_rows;

		if($is_updated){
			
			$code = 1;
			$message = "Password Changed successfully.";
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