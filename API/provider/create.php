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

					'provider_email' => 'required',

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


				$email_verifiy_token = bin2hex(random_bytes(10));


				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				$email_verifiy_token = bin2hex(random_bytes(10));

				$checkExistQry = "SELECT * FROM me_provider WHERE provider_email='$provider_email' AND is_deleted='0' ";
				$stmt = mysqli_query($conn, $checkExistQry);
				if(mysqli_num_rows($stmt)>0)
				{
					$user_details=mysqli_fetch_assoc($stmt);
					if($user_details['password']!="")
					{
						$message = "Email already exist.";
						apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
					}else
					{
						$registerUserId=$user_details['id'];
						$registerUser = mysqli_query($conn,"UPDATE me_provider SET provider_name='$provider_name', provider_email='$provider_email', tages='$tages', teams='$teams', email_verifiy_token='$email_verifiy_token', speciality='$speciality' WHERE id='$registerUserId' ")or die(mysqli_error($conn));
					
						if($registerUser)
						{
							$provider_id=$registerUserId;
							$mail_response=registerProviderMail($provider_id);
							$data=array();
							$data['mail_response']=$mail_response;
							$message = "Provider added successfully.";
							$code = 1;
							apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
						}else{
							$message = "Something went wrong";
							apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
						}
					}
					
				}else
				{	

					$add_provider = mysqli_query($conn,"INSERT INTO me_provider (firm_id, tages, teams, provider_name, provider_title, provider_email, speciality, email_verifiy_token, created_by, created_at) VALUES ('$firm_id','$tages','$teams','$provider_name','$provider_title','$provider_email','$speciality','$email_verifiy_token','$created_by','$created_at')")or die(mysqli_error($conn));

					if($add_provider)
					{
						$provider_id=mysqli_insert_id($conn);
						$mail_response=registerProviderMail($provider_id);
						$data=array();
						$data['mail_response']=$mail_response;
						$code = 1;
						$message = "Provider added successfully.";
					}else
					{
						$message = "Something went wrong.";
					}
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