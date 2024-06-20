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
		$headers = apache_request_headers();
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			if($apitoken && $token_id){
				$validator = new Validator;
				$validation = $validator->make($_REQUEST, [
				    'user_id' => 'required'
				]);
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}
				$user_id=$_REQUEST['user_id'];
				$user_data_qry = "SELECT me_users.id, me_users.role, me_users.firm_id, me_users.jobtitle_id, me_users.name, me_users.last_name, me_users.email, me_users.phone, me_users.firm_size, me_users.initials, me_users.address, me_users.city, me_users.state, me_users.country, me_users.zip, me_users.primary_phone, me_users.time_zone, me_users.locale, me_users.billing_rate, me_users.billing_rate_visiblity, me_users.subscriber_type, me_users.profile_pic, me_users.password, me_users.access_role, me_users.date_format, c.name as country_name, c.currency_symbol as currency_symbol, ut.name as user_type_name 
					FROM me_users
					LEFT JOIN countries c on c.id = me_users.country 
					LEFT JOIN user_type ut on ut.id = me_users.access_role 
					WHERE me_users.id='$user_id'";
				$user_data_result = mysqli_query($conn, $user_data_qry)or die(mysqli_error($conn));
				$data = mysqli_fetch_assoc($user_data_result);
				if($data['profile_pic']){
					$data['profile_pic'] = $project_url."uploads/user/profile/".$data['profile_pic'];
				}else{
					$data['profile_pic'] = $project_url."uploads/noimage.png";
				}
				$message = "Data get successfully.";
				$code = 1;
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