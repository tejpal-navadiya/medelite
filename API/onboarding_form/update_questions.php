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

		if(isset($headers['Apitoken']) || isset($headers['apitoken']) || isset($_REQUEST['apitoken']))
		{
			$headers['apitoken']=$_REQUEST['apitoken'];

			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];

			$token_id = checkToken($conn, $apitoken);

			$firm_id = getFirmFromUserId($conn, $token_id);

			if($apitoken ){

				$validator = new Validator;

				$validation = $validator->make($_POST + $_FILES, [

					'form_id' => 'required',

				]);

				

				$validation->validate();

				if ($validation->fails()) {

				    $getErrors = $validation->errors();

				    $errors = $getErrors->firstOfAll();

				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();

				}

				$form_id=$_REQUEST['form_id'];
				$question_id=$_REQUEST['question_id'];
				$answer=$_REQUEST['answer'];
				
				

				$question_id=(array) json_decode($question_id,true);
				$answer=(array) json_decode($answer,true);
				
				


				mysqli_query($conn,"DELETE from me_onboarding_questions WHERE form_id='$form_id' ");
				

				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				for ($i=0; $i < count($question_id); $i++) 
				{ 
					if(isset($question_id[$i])){$cur_question_id=$question_id[$i];}else{$cur_question_id="";}
					if(isset($answer[$cur_question_id])){$cur_answer=$answer[$cur_question_id];}else{$cur_answer="";}
					
					
					$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_questions (firm_id, form_id, question_id, answer, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_question_id','$cur_answer','$created_by','$created_at')")or die(mysqli_error($conn));
				}
				

				$update_details=1;
				if($update_details)
				{
					if(isset($_REQUEST['status']) && $_REQUEST['status']=="1")
					{
						$status=$_REQUEST['status'];
						mysqli_query($conn,"UPDATE me_onboarding_application SET status='$status' WHERE form_id='$form_id' ");
					}
					$activity_id=1;
					$code = 1;

					$message = "Details updated successfully.";

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