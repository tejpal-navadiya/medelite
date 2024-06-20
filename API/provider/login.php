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
		$validator = new Validator;
		$validation = $validator->make($_POST + $_FILES, [
		    'email' => 'required',
		    'password' => 'required'
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$email = $_POST["email"];
		$password = $_POST["password"];

		$checkExistQry = "SELECT * FROM me_provider  WHERE provider_email='$email'  ORDER BY id DESC";
		// AND me_provider.is_deleted='0' AND me_provider.status='1'		
		// $checkExistQry = "SELECT id, role, firm_id, jobtitle_id, name, email, phone, firm_size, initials, address, city, state, country, zip, primary_phone, time_zone, locale, billing_rate, billing_rate_visiblity, subscriber_type, profile_pic, password FROM me_provider WHERE email=?";
					
		$user_data_result = mysqli_query($conn, $checkExistQry)or die(mysqli_error($conn));
		
		if(mysqli_num_rows($user_data_result)<=0){
			$message = "Invalid Credentials.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}

		$user_data = $user_data_result->fetch_assoc();

		$utype=$user_data['urole_id'];
		$firm_id = 0;
		
		if (password_verify($password, $user_data['password'])) 
		{
			if($user_data['is_deleted']=="1" || $user_data['status']!="1")
			{
				if($user_data['is_deleted']=="1")
				{
					$message = "Account Deleted, Kindly contact Admin.";
					apiResponse($code, $message, "", "", $data, $status_code, $errors); die();	
				}else
				{
					$message = "Account Deactivated, Kindly contact Admin.";
					apiResponse($code, $message, "", "", $data, $status_code, $errors); die();	
				}
			}else
			{

			
				$apitoken = bin2hex(random_bytes(30));
				$created_at = Carbon::now();
				$expired_at = Carbon::now()->addDays(5);
				$user_type='1';

				$generate_token = $conn->prepare("INSERT INTO me_apitokens (user_id, user_type, apitoken, created_at, expired_at) VALUES (?, ?, ?, ?, ?)");
				$generate_token->bind_param("iisss", $user_data['id'], $user_type, $apitoken, $created_at, $expired_at);
				$generate_token->execute();

				if($generate_token->affected_rows){
					$user_data['apitoken'] = $apitoken;
					unset($user_data['password']);
					$message = "Login successfully.";
					$code = 1;
					apiResponse($code, $message, "", "", $user_data, $status_code, $errors); die();
				}else{
					$message = "Something went wrong";
					apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}
			}

		}else
		{
			$data=array();
			$data=$_POST;
			$message = "Invalid Credentials.";
			apiResponse($code, $message, "", "", $_POST, $status_code, $errors); die();		
		}
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>