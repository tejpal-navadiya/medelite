<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	include('../debtor.php');

	use Rakit\Validation\Validator;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$firm_id="0";
		$headers = apache_request_headers();
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			// $firm_id = getFirmFromUserId($conn, $token_id);
		}
		// if(isset($_POST['user_id']) && $_POST['user_id']!="")
		// {
		// 	$firm_id = getFirmFromUserId($conn, $_POST['user_id']);
		// }
		$validator = new Validator;
		$validation = $validator->make($_POST + $_FILES, [
		    'name' => 'required',	    
		    'email' => 'required',	    
				    
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$name = $_POST['name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		// $password = $_POST['password'];
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$access_role = $_POST['access_role'];
		
		
		$checkExistQry = "SELECT * FROM me_users WHERE email=? ";
		$stmt = prepared_select($conn, $checkExistQry, [$email]);
		if($stmt->num_rows){
			$message = "Admin email already exist with another account.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		$addQuery = "INSERT INTO me_users (name, last_name, email, password, access_role) VALUES (?,?,?,?,?)";

		$registerUser = $conn->prepare($addQuery);
		$registerUser->bind_param("sssss", $name, $last_name, $email, $password, $access_role);
		$registerUser->execute();
		
		if($registerUser->insert_id){
			$message = "Admin added successfully.";
			$code = 1;
   			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}else{
			$errors[] = $registerUser->error;	
			$message = "Something went wrong";
   			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>