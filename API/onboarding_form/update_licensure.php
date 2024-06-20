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
				$license_type=$_REQUEST['license_type'];
				$issue_date=$_REQUEST['issue_date'];
				$expiry_date=$_REQUEST['expiry_date'];
				$license_state=$_REQUEST['license_state'];
				$license_no=$_REQUEST['license_no'];
				$primary_license=$_REQUEST['primary_license'];
				$compact_license=$_REQUEST['compact_license'];
				$license_status=$_REQUEST['license_status'];
				
				

				$license_type=(array) json_decode($license_type,true);
				$issue_date=(array) json_decode($issue_date,true);
				$expiry_date=(array) json_decode($expiry_date,true);
				$license_state=(array) json_decode($license_state,true);
				$license_no=(array) json_decode($license_no,true);
				$primary_license=(array) json_decode($primary_license,true);
				$compact_license=(array) json_decode($compact_license,true);
				$license_status=(array) json_decode($license_status,true);
				
				

				mysqli_query($conn,"DELETE from me_onboarding_licensure WHERE form_id='$form_id' ");
				

				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				for ($i=0; $i < count($license_state); $i++) 
				{ 
					if(isset($license_type[$i])){$cur_license_type=$license_type[$i];}else{$cur_license_type="";}
					if(isset($issue_date[$i])){$cur_issue_date=$issue_date[$i];}else{$cur_issue_date="";}
					if(isset($expiry_date[$i])){$cur_expiry_date=$expiry_date[$i];}else{$cur_expiry_date="";}
					if(isset($license_state[$i])){$cur_license_state=$license_state[$i];}else{$cur_license_state="";}
					if(isset($license_no[$i])){$cur_license_no=$license_no[$i];}else{$cur_license_no="";}
					if(isset($primary_license[$i])){$cur_primary_license=$primary_license[$i];}else{$cur_primary_license="";}
					if(isset($compact_license[$i])){$cur_compact_license=$compact_license[$i];}else{$cur_compact_license="";}
					if(isset($license_status[$i])){$cur_license_status=$license_status[$i];}else{$cur_license_status="";}
					
					
					$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_licensure (firm_id, form_id, license_type,issue_date,expiry_date,license_state,license_no,primary_license,compact_license,license_status, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_license_type','$cur_issue_date','$cur_expiry_date','$cur_license_state','$cur_license_no','$cur_primary_license','$cur_compact_license','$cur_license_status','$created_by','$created_at')")or die(mysqli_error($conn));
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