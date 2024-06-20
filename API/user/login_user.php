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

	try {
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

		$checkExistQry = "SELECT * from acr_admin_users WHERE email='$email' ORDER BY id DESC";
					
		$user_data_result = mysqli_query($conn, $checkExistQry)or die(mysqli_error($conn));
		
		if(mysqli_num_rows($user_data_result) <= 0){
			$message = "Invalid Credentials or account verification is pending.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}

		$user_data = $user_data_result->fetch_assoc();
		$name = $user_data['name'];
		if($user_data['is_deleted'] == "1") {
			$message = "Account Deleted, Kindly contact Admin.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();	
		} else {
			if($user_data['status'] != "1") {
				if($user_data['password'] == "") {
					$message = "Account isn't verified.";
					$code = 2;
					apiResponse($code, $message, "", "", $user_data, $status_code, $errors); die();
				} else {
					$message = "Account Deactivated, Kindly contact Admin.";
					apiResponse($code, $message, "", "", $data, $status_code, $errors); die();	
				}
			} else {
				if (password_verify($password, $user_data['password'])) {
					// Call the function to insert login details into acr_log table
					
					insertLoginDetails($conn,$name, $user_data,$project_url);
				} else {
					$message = "Invalid Credentials.";
					apiResponse($code, $message, "", "", $data, $status_code, $errors); die();		
				}
			}
		}
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}

	// Function to insert login details into acr_log table
	function insertLoginDetails($conn,$name, $user_data,$project_url) {
		session_start();
		$_SESSION["employeeId"] = $user_data['id'];
		$_SESSION['alert_displayed'] = "false";

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ipAddress = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ipAddress = $_SERVER['REMOTE_ADDR'];
		}
		// Get browser details
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$browser_type=$_SERVER['HTTP_SEC_CH_UA'];
		$device_type=$_SERVER['HTTP_SEC_CH_UA_PLATFORM'];
		$mobile_browser=$_SERVER['HTTP_SEC_CH_UA_MOBILE'];
		
		$userAgent = mysqli_real_escape_string($conn, $userAgent);
		$browser_type = mysqli_real_escape_string($conn, $browser_type);
		$device_type = mysqli_real_escape_string($conn, $device_type);
		$mobile_browser = mysqli_real_escape_string($conn, $mobile_browser);
		$mobile_browser = str_replace("?","",$mobile_browser);

		// Insert login details into acr_log table
		$staticMessage = "is logged in";
		$message = "$name $staticMessage";

		$date = date('Y-m-d h:i:s');
		mysqli_query($conn, "INSERT into acr_log(user_id,ip_address,date,message,browser_details,browser_type,device_type,mobile_browser) VALUES('$user_data[id]','$ipAddress','$date','$message','$userAgent','$browser_type','$device_type','$mobile_browser')");
		
		$apitoken = bin2hex(random_bytes(30));
		$created_at = Carbon::now();
		$expired_at = Carbon::now()->addDays(5);

		$generate_token = $conn->prepare("INSERT INTO acr_api_tokens (user_id, apitoken, created_at, expired_at) VALUES (?, ?, ?, ?)");
		$generate_token->bind_param("isss", $user_data['id'], $apitoken, $created_at, $expired_at);
		$generate_token->execute();
		$errors=array();
		if($generate_token->affected_rows) {
			$org_id = $user_data['org_id'];
			$user_data['apitoken'] = $apitoken;
			unset($user_data['password']);

			if(isset($user_data['profile_img']) && $user_data['profile_img']!=""){
				$user_data['profile_img'] = $project_url."uploads/user/".$user_data['profile_img'];
			}else{
				$user_data['profile_img'] = $project_url."uploads/noimage.png";
			}

			$message = "Login successfully.";
			$code = 1;
			apiResponse($code, $message, "", "", $user_data, $code, $errors); die();
		} else {
			$code = 0;
			$message = "Something went wrong";
			apiResponse($code, $message, "", "", array(), $code, $errors); die();
		}
	}
?>
