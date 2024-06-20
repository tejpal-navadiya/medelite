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

					'board_name' => 'required',

				]);

				

				$validation->validate();

				if ($validation->fails()) {

				    $getErrors = $validation->errors();

				    $errors = $getErrors->firstOfAll();

				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();

				}



				$directry_type=$_REQUEST['directry_type'];
				$board_name=$_REQUEST['board_name'];
				$attention_to=$_REQUEST['attention_to'];
				$address_line_1=$_REQUEST['address_line_1'];
				$address_line_2=$_REQUEST['address_line_2'];
				$state=$_REQUEST['state'];
				$city=$_REQUEST['city'];
				$country=$_REQUEST['country'];
				$zip_code=$_REQUEST['zip_code'];
				$p_address_line_1=$_REQUEST['p_address_line_1'];
				$p_address_line_2=$_REQUEST['p_address_line_2'];
				$p_country=$_REQUEST['p_country'];
				$p_state=$_REQUEST['p_state'];
				$p_city=$_REQUEST['p_city'];
				$p_zip_code=$_REQUEST['p_zip_code'];
				$fax=$_REQUEST['fax'];
				$website=$_REQUEST['website'];
				$online_portal=$_REQUEST['online_portal'];
				$notes=$_REQUEST['notes'];
				$tel_number_1=$_REQUEST['tel_number_1'];
				$tel_number_2=$_REQUEST['tel_number_2'];
				$board_email_licence=$_REQUEST['board_email_licence'];
				$board_email_verification=$_REQUEST['board_email_verification'];
				$board_email=$_REQUEST['board_email'];
				$application_processing_time=$_REQUEST['application_processing_time'];
				$initial_application_base_fee=$_REQUEST['initial_application_base_fee'];
				$initial_application_base_fee2=$_REQUEST['initial_application_base_fee2'];
				$application_processing_fee=$_REQUEST['application_processing_fee'];
				$full_biennuim_fee=$_REQUEST['full_biennuim_fee'];
				$half_biennuim_fee=$_REQUEST['half_biennuim_fee'];
				$exam_fee=$_REQUEST['exam_fee'];
				$fp_cbc_fee=$_REQUEST['fp_cbc_fee'];
				$additional_fee=$_REQUEST['additional_fee'];
				$issuance_fee=$_REQUEST['issuance_fee'];
				$total_fee=$_REQUEST['total_fee'];



				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				$add_activity = mysqli_query($conn,"INSERT INTO me_directories (firm_id, directry_type,board_name,attention_to,address_line_1,address_line_2,state,city,country,zip_code,p_address_line_1,p_address_line_2,p_country,p_state,p_city,p_zip_code,fax,website,online_portal,notes,tel_number_1,tel_number_2,board_email_licence,board_email_verification, created_by, created_at,board_email,application_processing_time,initial_application_base_fee,initial_application_base_fee2,application_processing_fee,full_biennuim_fee,half_biennuim_fee,exam_fee,fp_cbc_fee,additional_fee,issuance_fee,total_fee) VALUES ('$firm_id','$directry_type','$board_name','$attention_to','$address_line_1','$address_line_2','$state','$city','$country','$zip_code','$p_address_line_1','$p_address_line_2','$p_country','$p_state','$p_city','$p_zip_code','$fax','$website','$online_portal','$notes','$tel_number_1','$tel_number_2','$board_email_licence','$board_email_verification','$created_by','$created_at','$board_email','$application_processing_time','$initial_application_base_fee','$initial_application_base_fee2','$application_processing_fee','$full_biennuim_fee','$half_biennuim_fee','$exam_fee','$fp_cbc_fee','$additional_fee','$issuance_fee','$total_fee')")or die(mysqli_error($conn));

		
				if($add_activity)
				{

					$activity_id=mysqli_insert_id($conn);



					$code = 1;

					$message = "Directory added successfully.";

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