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
				$exam_type=$_REQUEST['exam_type'];
				$first_try_date=$_REQUEST['first_try_date'];
				$score=$_REQUEST['score'];
				$no_of_attempts=$_REQUEST['no_of_attempts'];
				$is_passed=$_REQUEST['is_passed'];

				$examination=$_REQUEST['examination'];
				$exam_date=$_REQUEST['exam_date'];
				$location=$_REQUEST['location'];
				$notes=$_REQUEST['notes'];

				

				$exam_type=(array) json_decode($exam_type,true);
				$first_try_date=(array) json_decode($first_try_date,true);
				$score=(array) json_decode($score,true);
				$no_of_attempts=(array) json_decode($no_of_attempts,true);
				$is_passed=(array) json_decode($is_passed,true);
				$examination=(array) json_decode($examination,true);
				$exam_date=(array) json_decode($exam_date,true);
				$location=(array) json_decode($location,true);
				$notes=(array) json_decode($notes,true);


				mysqli_query($conn,"DELETE from me_onboarding_exam_history WHERE form_id='$form_id' ");
				

				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				for ($i=0; $i < count($exam_type); $i++) 
				{ 
					if(isset($exam_type[$i])){$cur_exam_type=$exam_type[$i];}else{$cur_exam_type="";}
					if(isset($first_try_date[$i])){$cur_first_try_date=$first_try_date[$i];}else{$cur_first_try_date="";}
					if(isset($score[$i])){$cur_score=$score[$i];}else{$cur_score="";}
					if(isset($no_of_attempts[$i])){$cur_no_of_attempts=$no_of_attempts[$i];}else{$cur_no_of_attempts="";}
					if(isset($is_passed[$i])){$cur_is_passed=$is_passed[$i];}else{$cur_is_passed="";}
					if(isset($examination[$i])){$cur_examination=$examination[$i];}else{$cur_examination="";}
					if(isset($exam_date[$i])){$cur_exam_date=$exam_date[$i];}else{$cur_exam_date="";}
					if(isset($location[$i])){$cur_location=$location[$i];}else{$cur_location="";}
					if(isset($notes[$i])){$cur_notes=$notes[$i];}else{$cur_notes="";}

					$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_exam_history (firm_id, form_id, exam_type,first_try_date,score,no_of_attempts,is_passed,examination,exam_date,location,notes, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_exam_type','$cur_first_try_date','$cur_score','$cur_no_of_attempts','$cur_is_passed','$cur_examination','$cur_exam_date','$cur_location','$cur_notes','$created_by','$created_at')")or die(mysqli_error($conn));
				}
				

				$update_details=1;
				if($update_details)
				{

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