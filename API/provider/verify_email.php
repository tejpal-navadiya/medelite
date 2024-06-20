<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	// include('../user_type.php');
	
	use Rakit\Validation\Validator;
	use Carbon\Carbon;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$validator = new Validator;
		$validation = $validator->make($_POST + $_FILES, [
		    'token' => 'required',
		    'password' => 'required',
    		'confirm_password' => 'required|same:password',
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$email_verifiy_token = $_POST["token"];
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$email_verified_at = Carbon::now();

		$checkExistQry = "SELECT * FROM me_provider WHERE email_verifiy_token=?";
		$user_data_result = prepared_select($conn, $checkExistQry, [$email_verifiy_token]);
		
		if(!$user_data_result->num_rows){
			$message = "Invalid or expired token.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		$user_data = $user_data_result->fetch_assoc();
			
		

			$verify_email_qry = "UPDATE me_provider SET password='$password', status='1', email_verified_at='$email_verified_at' WHERE email_verifiy_token='$email_verifiy_token' ";
			$is_verified = mysqli_query($conn, $verify_email_qry) or($c_err=mysqli_error($conn));
		
		

		if($is_verified)
		{
			$primary_user=$user_data['id'];
			$user_type='1';
			$get_user_data_qry = "SELECT * FROM me_provider WHERE id=?";
			$get_user_data_result = prepared_select($conn, $get_user_data_qry, [$primary_user]);
			$data = $get_user_data_result->fetch_assoc();

			// $apitoken = bin2hex(random_bytes(30));
			// $created_at = Carbon::now();
			// $expired_at = Carbon::now()->addDays(5);

			// $generate_token = $conn->prepare("INSERT INTO apitokens (user_id, user_type, apitoken, created_at, expired_at) VALUES (?, ?, ?, ?, ?)");
			// $generate_token->bind_param("iisss", $primary_user, $user_type, $apitoken, $created_at, $expired_at);
			// $generate_token->execute();

			// $data['apitoken'] = $apitoken;

			$code = 1;
			$message = "Email verfied successfully.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}else{
			$message = "Token Expired.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>