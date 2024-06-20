<?php 
	include('../../config.php');
	include('../../helper/functions.php');

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
		    'mname' => 'required',	    
		    'mtitle' => 'required',	    
		]);
		$validation->validate();
		if ($validation->fails()) {
		    $getErrors = $validation->errors();
		    $errors = $getErrors->firstOfAll();
		    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}
		
		$mname = $_POST["mname"];
		$mtitle = $_POST["mtitle"];
		$pmenu=$_POST['pmenu'];
		if(!isset($_POST['pmenu']) || (isset($_POST['pmenu']) && $_POST['pmenu']==""))
		{
			$_POST['pmenu']=0;
		}
		$checkExistQry = "SELECT * FROM admin_menu WHERE mname=? ";
		$stmt = prepared_select($conn, $checkExistQry, [$mname]);
		if($stmt->num_rows){
			$message = "Menu already exist.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}

		$registerUser = $conn->prepare("INSERT INTO admin_menu (mname,mtitle,pmenu) VALUES (?,?,?)");
		$registerUser->bind_param("ssi", $mname,$mtitle,$pmenu);
		$registerUser->execute();
		if($registerUser->insert_id){
			
			$message = "Menu added successfully.";
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