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

		$checkExistQry = "SELECT * from acr_admin_users WHERE email='$email' AND role='master_admin' ORDER BY id DESC";
					
		$user_data_result = mysqli_query($conn, $checkExistQry)or die(mysqli_error($conn));
		
		if(mysqli_num_rows($user_data_result)<=0){
			$message = "Invalid Credentials or account verification is pending.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}

		$user_data = $user_data_result->fetch_assoc();
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

				$generate_token = $conn->prepare("INSERT INTO acr_api_tokens (user_id, apitoken, created_at, expired_at) VALUES (?, ?, ?, ?)");
				$generate_token->bind_param("isss", $user_data['id'], $apitoken, $created_at, $expired_at);
				$generate_token->execute();

				if($generate_token->affected_rows)
				{
					$org_id=$user_data['org_id'];
					$user_data['apitoken'] = $apitoken;
					unset($user_data['password']);
					
					if($user_data['profile_pic']){
						$user_data['profile_pic'] = $project_url."uploads/user/".$user_data['profile_pic'];
					}else{
						$user_data['profile_pic'] = $project_url."uploads/noimage.png";
					}

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
			// $data=$user_data;
			$message = "Invalid Credentials.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();		
			
		}
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>