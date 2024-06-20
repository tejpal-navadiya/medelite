<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

	// include('../../config/config.php');
	// include('../../helper/functions.php');
	// load_config("1","1","1","1","1");
	
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
				    // 'user_id' => 'required'
				]);
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}

				$user_data_qry = "SELECT * from me_users WHERE id=?";
				$user_data_result = prepared_select($conn, $user_data_qry, [$_REQUEST['id']]);
				$data = $user_data_result->fetch_assoc();
				if($data['profile_pic']){
					$data['profile_pic'] = $project_url."uploads/user/profile/".$data['profile_pic'];
				}else{
					$data['profile_pic'] = $project_url."uploads/noimage.png";
				}
				// $org_id=$data['org_id'];
					$city=$data['city'];
					$state=$data['state'];
					
					
					$city_name="";
					$sel_city_details=mysqli_query($conn,"SELECT * from me_city WHERE id='$city' ");
					if(mysqli_num_rows($sel_city_details)>0)
					{
						$fetch_city=mysqli_fetch_assoc($sel_city_details);
						$city_name=$fetch_city['name'];
					}

					$state_name="";
					$sel_state_details=mysqli_query($conn,"SELECT * from me_states WHERE id='$state' ");
					if(mysqli_num_rows($sel_state_details)>0)
					{
						$fetch_state=mysqli_fetch_assoc($sel_state_details);
						$state_name=$fetch_state['name'];
					}
					
					$data['state_name']=$state_name;
					$data['city_name']=$city_name;
					// $data=$_REQUEST;
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