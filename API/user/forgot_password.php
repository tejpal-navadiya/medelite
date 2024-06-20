<?php 
	include('../../config/config.php');
	include('../../helper/functions.php');
	load_config("1","1","1","1","1");

	use Rakit\Validation\Validator;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$validator = new Validator;
		$validation = $validator->make($_POST + $_FILES, [
		    'email' => 'required|email',
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$email = $_POST["email"];
		$token = bin2hex(random_bytes(10));

		$checkExistQry = "SELECT * FROM acr_admin_users WHERE email=?";
		$stmt = prepared_select($conn, $checkExistQry, [$email]);
		if(!$stmt->num_rows){
			$message = "Email not exist.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}

		$remove_old = $conn->prepare("DELETE FROM acr_password_resets WHERE email = ?");
		$remove_old->bind_param("s", $email);
		$remove_old->execute();

		$pw_reset = $conn->prepare("INSERT INTO acr_password_resets (email, token) VALUES (?, ?)");
		$pw_reset->bind_param("ss", $email, $token);
		$pw_reset->execute();
		if($pw_reset->insert_id)
		{
			if(isset($_REQUEST['type']) && $_REQUEST['type']=="user")
			{
				forgotPasswordMail($email, $token,"1");
			}else
			{
				forgotPasswordMail($email, $token);
			}
			
			$message = "Forgot password mail sent successfully.";
			$code = 1;
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