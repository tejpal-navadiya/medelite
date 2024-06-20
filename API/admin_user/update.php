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
				$validation = $validator->make($_POST + $_FILES, [
				    'user_id' => 'required',
				    'name' => 'required',
				]);
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}

				$name = $_POST['name'];
				$last_name = $_POST['last_name'];
				// $initials = $_POST['initials'];
				$address = $_POST['address'];
				$city = $_POST['city'];
				$state = $_POST['state'];
				$country = $_POST['country'];
				$zip = $_POST['zip'];
				$primary_phone = $_POST['primary_phone'];
				// $time_zone = $_POST['time_zone'];
				// $locale = $_POST['locale'];
				// $billing_rate = $_POST['billing_rate'];
				// $billing_rate_visiblity = $_POST['billing_rate_visiblity'];
				// $subscriber_type = $_POST['subscriber_type'];
				// $date_format = $_POST['date_format'];
				$user_id = $_POST['user_id'];
				$optional_update="";
				if(isset($_POST['access_role']) && $_POST['access_role']!="")
				{
					$access_role=$_POST['access_role'];
					$optional_update.=", access_role='$access_role' ";
				}
				if(isset($_POST['address']) && $_POST['address']!=""){$address=$_POST['address'];$optional_update.=", address='$address' ";	}
				if(isset($_POST['city']) && $_POST['city']!=""){$city=$_POST['city'];$optional_update.=", city='$city' ";	}
				if(isset($_POST['state']) && $_POST['state']!=""){$state=$_POST['state'];$optional_update.=", state='$state' ";	}
				if(isset($_POST['country']) && $_POST['country']!=""){$country=$_POST['country'];$optional_update.=", country='$country' ";	}
				if(isset($_POST['zip']) && $_POST['zip']!=""){$zip=$_POST['zip'];$optional_update.=", zip='$zip' ";	}
				if(isset($_POST['primary_phone']) && $_POST['primary_phone']!=""){$primary_phone=$_POST['primary_phone'];$optional_update.=", primary_phone='$primary_phone' ";	}
				if(isset($_POST['password']) && $_POST['password']!=""){$password=$_POST['password'];$optional_update.=", password='$password' ";	}

				$update_user_qry = "UPDATE me_users SET name=?, last_name=? $optional_update WHERE id=? ";
				$is_updated = prepared_query($conn, $update_user_qry, [$name, $last_name, $user_id])->affected_rows;
				// echo '<pre>'; print_r($is_updated);die((__FILE__).'-->'.(__FUNCTION__).'--Line('. (__LINE__).')');
				// ->affected_rows
				$code = 1;
				$message = "Updated successfully.";
				$data=$_POST;
				apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
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