<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	
	use Rakit\Validation\Validator;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$headers = apache_request_headers();
		if(isset($headers['Apitoken']) || isset($headers['apitoken']) || isset($_REQUEST['apitoken']))
		{
			$headers['apitoken']=$_REQUEST['apitoken'];
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			$firm_id = getFirmFromUserId($conn, $token_id);
			$data=array();
			$data['token_id']=$token_id;
			$data['firm_id']=$firm_id;
			if($apitoken && $token_id && $firm_id){
				try{
					$pdoconn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8","$username","$password");
					$pdoconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				 }catch(PDOException $e){
					die('Unable to connect with the database');
				 }

				$validator = new Validator;
				$validation = $validator->make($_POST + $_FILES, [
				    'user_type' => 'required',
				    
				]);
				
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}				
				UpdateUserRoleAccess($conn, $firm_id,$_POST, $token_id);
				
				$code = 1;
				$message = "Role Access updated successfully.";
	        }else{
	        	$status_code = 401;
				$message = "Login expired or invalid token.";
			}	
		}else{
			$status_code = 401;
			$message = "Login expired or invalid token.";
		}
	    apiResponse($code, $message, "", "", $data, $status_code);
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>