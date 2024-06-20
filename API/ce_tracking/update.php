<?php 

	include('../../config.php');

	include('../../helper/functions.php');

	include('../task.php');



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

			// $ = getFirmFromUserId($conn, $token_id);

			if($apitoken && $token_id ){

				$validator = new Validator;

				$validation = $validator->make($_POST + $_FILES, [
					// 'ce_broker' => 'required',
				]);

				

				$validation->validate();

				if ($validation->fails()) {

				    $getErrors = $validation->errors();

				    $errors = $getErrors->firstOfAll();

				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();

				}



				$id = $_POST['id'];

				$ac_data_qry = "SELECT id FROM ce_tracking WHERE id='$id' limit 1";
				// $ac_data_qry = "SELECT id FROM ce_tracking WHERE id=?  limit 1";

				$ac_data_result = prepared_select($conn, $ac_data_qry, [$id]);

				if($ac_data_result->num_rows){
					$applay_to_all_state = $_REQUEST['applay_to_all_state'];
					$state_specific = $_REQUEST['state_specific'];
					$select_ce_course_catelog = $_REQUEST['select_ce_course_catelog'];
					$state_one = $_REQUEST['state_one'];
					$completed_date = $_REQUEST['completed_date'];
					$select_course = $_REQUEST['select_course'];
					$provider_approving_body = $_REQUEST['provider_approving_body'];
					$ce_course_transcript_description = $_REQUEST['ce_course_transcript_description'];
					$ce_hrs_first = $_REQUEST['ce_hrs_first'];
					$pharmacology_hrs = $_REQUEST['pharmacology_hrs'];
					$total_ce_hrs = $_REQUEST['total_ce_hrs'];
					$add_course_content = $_REQUEST['add_course_content'];
					$ce_hrs_two = $_REQUEST['ce_hrs_two'];
					$attachment = $_REQUEST['attachment'];
					// $note = $_REQUEST['note'];
					$shaprate_ce_hrs = $_REQUEST['shaprate_ce_hrs'];
					$state_content_requirement = $_REQUEST['state_content_requirement'];
					$state_two = $_REQUEST['state_two'];
					$course_content_two = $_REQUEST['course_content_two'];
					$ce_hrs_three = $_REQUEST['ce_hrs_three'];
					$update_ce_course = $_REQUEST['update_ce_course'];
					$add_course_catelog = $_REQUEST['add_course_catelog'];

					// $state=$_REQUEST['state'];
					// // $description=$_REQUEST['description'];
					// // $board_name=$_REQUEST['board_name'];
					// $ce_completion_status=$_REQUEST['ce_completion_status'];
					// $license_start_date=$_REQUEST['license_start_date'];
					// $license_end_date=$_REQUEST['license_end_date'];
					// $first_renewal=$_REQUEST['first_renewal'];
					// $ce_broker=$_REQUEST['ce_broker'];
					// $issue_date=$_REQUEST['issue_date'];
					// $expiration_date=$_REQUEST['expiration_date'];
					// $last_updated_date=$_REQUEST['last_updated_date'];

					// $updated_by = $token_id;
					$updated_at=date('Y-m-d H:i:s');


					// $update_pa_qry = "UPDATE ce_tracking SET
					//                      state='$state', 
					//                     ce_completion_status='$ce_completion_status', 
					// 					license_start_date='$license_start_date',
					// 				    license_end_date='$license_end_date',				
					// 					ce_broker='$ce_broker',
					// 					issue_date='$issue_date',
					// 					expiration_date='$expiration_date',
					// 					last_updated_date='$last_updated_date'
					// 					 WHERE id='$id'";


					$update_pa_qry = "UPDATE ce_tracking SET
					                     applay_to_all_state='$applay_to_all_state', 
					                    state_specific='$state_specific', 
										select_ce_course_catelog='$select_ce_course_catelog',
									    state_one='$state_one',				
										completed_date='$completed_date',
										select_course='$select_course',
										provider_approving_body='$provider_approving_body',
										ce_course_transcript_description='$ce_course_transcript_description',
										ce_hrs_first='$ce_hrs_first', 
										pharmacology_hrs='$pharmacology_hrs',
										total_ce_hrs='$total_ce_hrs',
										add_course_content='$add_course_content',
					                    ce_hrs_two='$ce_hrs_two', 
										attachment='$attachment',
									    shaprate_ce_hrs='$shaprate_ce_hrs',				
										state_content_requirement='$state_content_requirement',
										state_two='$state_two',
										ce_hrs_three='$ce_hrs_three',
										update_ce_course='$update_ce_course',
										add_course_catelog='$add_course_catelog'
										WHERE id='$id'";



					$is_updated = mysqli_query($conn,$update_pa_qry) or $data=mysqli_error($conn);

					if($is_updated)
					{
						$data=array();
						$data['post']=$_POST;
						$code = 1;
						$message = "CeTracking updated successfully.";
					}else
					{
						$message = "Something went wrong.";
					}

				   }else{

					$message = "CeTracking not found.";

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