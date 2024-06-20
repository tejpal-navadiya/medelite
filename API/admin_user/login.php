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

		$checkExistQry = "SELECT me_users.*, ut.name as access_roll_name FROM me_users LEFT JOIN me_user_type ut on ut.id = me_users.access_role WHERE me_users.email='$email'  ORDER BY me_users.id DESC";
		// AND me_users.is_deleted='0' AND me_users.status='1'		
		// $checkExistQry = "SELECT id, role, firm_id, jobtitle_id, name, email, phone, firm_size, initials, address, city, state, country, zip, primary_phone, time_zone, locale, billing_rate, billing_rate_visiblity, subscriber_type, profile_pic, password FROM me_users WHERE email=?";
					
		$user_data_result = mysqli_query($conn, $checkExistQry)or die(mysqli_error($conn));
		
		if(mysqli_num_rows($user_data_result)<=0){
			$message = "Invalid Credentials.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
		}

		$user_data = $user_data_result->fetch_assoc();

		$utype=$user_data['urole_id'];
		$firm_id = 0;
		// $access_data_qry = $conn->prepare("SELECT * FROM user_access WHERE firm_id=? AND utype='".$utype."' ".$search_qry."  ");
		// $access_data_qry->bind_param("i", $firm_id);
		// $access_data_qry->execute();
		// $pa_data_result = $access_data_qry->get_result();
		// $user_access_list = $pa_data_result->fetch_all(MYSQLI_ASSOC);

		// $access_data = array();
		// foreach($user_access_list as $row)
		// {

		// 	$pmenu_name="-";
		// 	if($row['mid']!=0)
		// 	{
		// 		$pmenu=$row['mid'];
		// 		$stmt_pmenu = $conn->prepare("SELECT * FROM admin_menu  WHERE  mid=? ");
		// 		$stmt_pmenu->bind_param("i", $pmenu);
				
		// 		$stmt_pmenu->execute();
				
		// 		$pmenu_result = $stmt_pmenu->get_result();
		// 		$pmenu_detail = $pmenu_result->fetch_all(MYSQLI_ASSOC);
		// 		// $pmenu_detail = $stmt_pmenu->fetchAll();
		// 		foreach($pmenu_detail as $prow)
		// 		{
		// 			$pmenu_name=$prow['pmenu'];
		// 		}
		// 	}
		// 	$row['pmenu']=$pmenu_name;

		// 	$access_data[] = $row;
		// }
		// $user_data['access_data'] = $access_data;

		
		// UpdateAllFirmMenuIfNotExist($conn, $firm_id,$token_id);
		// UpdateAllAccessIfNotExist($conn,$utype, $token_id,"0");
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

				$generate_token = $conn->prepare("INSERT INTO me_apitokens (user_id, apitoken, created_at, expired_at) VALUES (?, ?, ?, ?)");
				$generate_token->bind_param("isss", $user_data['id'], $apitoken, $created_at, $expired_at);
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
			// $data=$user_data;
			$message = "Invalid Credentials.";
			apiResponse($code, $message, "", "", $data, $status_code, $errors); die();		
		}
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>