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

			if($apitoken && $token_id){

				$validator = new Validator;

				$validation = $validator->make($_POST + $_FILES, [

					'state' => 'required',

				]);

				

				$validation->validate();

				if ($validation->fails()) {

				    $getErrors = $validation->errors();

				    $errors = $getErrors->firstOfAll();

				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();

				}



				$form = $_POST['form'];
				$link = $_POST['link'];
				$fee = $_POST['fee'];
				$provider_name = $_POST['provider_name'];
				$request_type = $_POST['request_type'];
				$request_method = $_POST['request_method'];
			    $note = $_POST['note'];
				$email = $_POST['email'];

				$documents = $_POST['documents'];
				$state = $_POST['state'];
				$date_created = $_POST['date_created'];
				$date_completed = $_POST['date_completed'];






				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				$add_activity = mysqli_query($conn,"INSERT INTO verification_request (form, link,fee,note, provider_name, request_type,request_method, email, documents, state,date_created,date_completed, created_at) VALUES ('$form','$link','$fee','$note','$provider_name','$request_type','$request_method','$email','$documents','$state','$date_created', '$date_completed','$created_at')")or die(mysqli_error($conn));

		
				if($add_activity)

				{

					$activity_id=mysqli_insert_id($conn);

					$code = 1;

					$message = "Request added successfully.";

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