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
		
		$email_verifiy_token = $_POST["token"];
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$email_verified_at = Carbon::now();

		$checkExistQry = "SELECT * FROM acr_admin_users WHERE email_verifiy_token=?";
		$user_data_result = prepared_select($conn, $checkExistQry, [$email_verifiy_token]);
		
		if(!$user_data_result->num_rows){
			$message = "Invalid or expired token.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		$user_data = $user_data_result->fetch_assoc();
		// if(!isset($user_data['access_role'])){
		// 	$message = "Invalid or expired token.";
		// 	apiResponse($code, $message, "", "", $data, $status_code, $errors); die();	
		// }
		
		$primary_user = (int) $user_data['id'];
		$org_id=$user_data['org_id'];
		$country = (int) $default_country ?: 1;
		$date_format = $default_date_format ?: "m-d-Y";
		$time_format = $default_time_format ?: "H:i:s";
		$c_err="";
		$access_role=1;
		if($user_data['role']!="user")
		{
			
			
			

			$verify_email_qry = "UPDATE acr_admin_users SET status='1', password='$password', email_verified_at='$email_verified_at', org_id='$org_id', access_role='$access_role' WHERE email_verifiy_token='$email_verifiy_token' ";
			$is_verified = mysqli_query($conn, $verify_email_qry) or($c_err=mysqli_error($conn));
		}else
		{
			
			
			
			
			$verify_email_qry = "UPDATE acr_admin_users SET status='1', password='$password', email_verified_at='$email_verified_at'  WHERE email_verifiy_token='$email_verifiy_token' ";
			$is_verified = mysqli_query($conn, $verify_email_qry) or($c_err=mysqli_error($conn));
		}
		$errors[]=$c_err;
		

		if($is_verified)
		{

			$get_user_data_qry = "SELECT * FROM acr_admin_users WHERE id=?";
			$get_user_data_result = prepared_select($conn, $get_user_data_qry, [$primary_user]);
			$data = $get_user_data_result->fetch_assoc();

			$apitoken = bin2hex(random_bytes(30));
			$created_at = Carbon::now();
			$expired_at = Carbon::now()->addDays(5);

			$generate_token = $conn->prepare("INSERT INTO acr_api_tokens (user_id, apitoken, created_at, expired_at) VALUES (?, ?, ?, ?)");
			$generate_token->bind_param("isss", $primary_user, $apitoken, $created_at, $expired_at);
			$generate_token->execute();

			$data['apitoken'] = $apitoken;

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