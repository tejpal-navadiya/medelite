<?php 

	include('../../config.php');

	include('../../helper/functions.php');

	// include('../task.php');



	use Rakit\Validation\Validator;



	$code = 0;

	$data = new stdClass();

	$status_code = 200;

	$errors = [];



	try{

		$headers = apache_request_headers();

		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){

			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];

			$token_id = checkToken($conn, $apitoken);

			$firm_id = getFirmFromUserId($conn, $token_id);

			if($apitoken && $token_id && $firm_id){

				$validator = new Validator;

				$validation = $validator->make($_POST + $_FILES, [

					'teams' => 'required',

				]);

				

				$validation->validate();

				if ($validation->fails()) {

				    $getErrors = $validation->errors();

				    $errors = $getErrors->firstOfAll();

				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();

				}



				$teams = $_POST['teams'];
				$tages = $_POST['tages'];
				$provider_name = $_POST['provider_name'];
				$provider_title = $_POST['provider_title'];
				$provider_email = $_POST['provider_email'];
				$speciality = $_POST['speciality'];





				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				$add_activity = mysqli_query($conn,"INSERT INTO me_provider (firm_id, tages, teams, provider_name, provider_title, provider_email, speciality, created_by, created_at) VALUES ('$firm_id','$tages','$teams','$provider_name','$provider_title','$provider_email','$speciality','$created_by','$created_at')")or die(mysqli_error($conn));

		
				if($add_activity)

				{

					$activity_id=mysqli_insert_id($conn);



					




					$code = 1;

					$message = "Provider added successfully.";

				}else{

					$message = "Something went wrong.";

				}

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