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
				$practice_type=$_REQUEST['practice_type'];
				$start_date=$_REQUEST['start_date'];
				$end_date=$_REQUEST['end_date'];
				$practice_name=$_REQUEST['practice_name'];
				$address_line_1=$_REQUEST['address_line_1'];
				$address_line_2=$_REQUEST['address_line_2'];
				$address_city=$_REQUEST['address_city'];
				$address_state=$_REQUEST['address_state'];
				$address_country=$_REQUEST['address_country'];
				$address_zipcode=$_REQUEST['address_zipcode'];
				$reason_deaprture=$_REQUEST['reason_deaprture'];
				$hr_contact_name=$_REQUEST['hr_contact_name'];
				$hr_contract_start_date=$_REQUEST['hr_contract_start_date'];
				$hr_title=$_REQUEST['hr_title'];

				$hr_email=$_REQUEST['hr_email'];
				$hr_phone=$_REQUEST['hr_phone'];
				

				$practice_type=(array) json_decode($practice_type,true);
				$start_date=(array) json_decode($start_date,true);
				$end_date=(array) json_decode($end_date,true);
				$practice_name=(array) json_decode($practice_name,true);
				$address_line_1=(array) json_decode($address_line_1,true);
				$address_line_2=(array) json_decode($address_line_2,true);
				$address_city=(array) json_decode($address_city,true);
				$address_state=(array) json_decode($address_state,true);
				$address_country=(array) json_decode($address_country,true);
				$address_zipcode=(array) json_decode($address_zipcode,true);
				$reason_deaprture=(array) json_decode($reason_deaprture,true);
				$hr_contact_name=(array) json_decode($hr_contact_name,true);
				$hr_contract_start_date=(array) json_decode($hr_contract_start_date,true);
				$hr_title=(array) json_decode($hr_title,true);
				$hr_email=(array) json_decode($hr_email,true);
				$hr_phone=(array) json_decode($hr_phone,true);



				mysqli_query($conn,"DELETE from me_onboarding_practice_employer_history WHERE form_id='$form_id' ");
				

				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				for ($i=0; $i < count($practice_name); $i++) 
				{ 
					if(isset($practice_type[$i])){$cur_practice_type=$practice_type[$i];}else{$cur_practice_type="";}
					if(isset($start_date[$i])){$cur_start_date=$start_date[$i];}else{$cur_start_date="";}
					if(isset($end_date[$i])){$cur_end_date=$end_date[$i];}else{$cur_end_date="";}
					if(isset($practice_name[$i])){$cur_practice_name=$practice_name[$i];}else{$cur_practice_name="";}
					if(isset($address_line_1[$i])){$cur_address_line_1=$address_line_1[$i];}else{$cur_address_line_1="";}
					if(isset($address_line_2[$i])){$cur_address_line_2=$address_line_2[$i];}else{$cur_address_line_2="";}
					if(isset($address_city[$i])){$cur_address_city=$address_city[$i];}else{$cur_address_city="";}
					if(isset($address_state[$i])){$cur_address_state=$address_state[$i];}else{$cur_address_state="";}
					if(isset($address_country[$i])){$cur_address_country=$address_country[$i];}else{$cur_address_country="";}
					if(isset($address_zipcode[$i])){$cur_address_zipcode=$address_zipcode[$i];}else{$cur_address_zipcode="";}
					if(isset($reason_deaprture[$i])){$cur_reason_deaprture=$reason_deaprture[$i];}else{$cur_reason_deaprture="";}
					if(isset($hr_contact_name[$i])){$cur_hr_contact_name=$hr_contact_name[$i];}else{$cur_hr_contact_name="";}
					if(isset($hr_contract_start_date[$i])){$cur_hr_contract_start_date=$hr_contract_start_date[$i];}else{$cur_hr_contract_start_date="";}
					if(isset($hr_title[$i])){$cur_hr_title=$hr_title[$i];}else{$cur_hr_title="";}
					if(isset($hr_email[$i])){$cur_hr_email=$hr_email[$i];}else{$cur_hr_email="";}
					if(isset($hr_phone[$i])){$cur_hr_phone=$hr_phone[$i];}else{$cur_hr_phone="";}
					$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_practice_employer_history (firm_id, form_id, practice_type,start_date,end_date,practice_name,address_line_1,address_line_2,address_city,address_state,address_country,address_zipcode,reason_deaprture,hr_contact_name,hr_contract_start_date,hr_title,hr_email,hr_phone, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_practice_type','$cur_start_date','$cur_end_date','$cur_practice_name','$cur_address_line_1','$cur_address_line_2','$cur_address_city','$cur_address_state','$cur_address_country','$cur_address_zipcode','$cur_reason_deaprture','$cur_hr_contact_name','$cur_hr_contract_start_date','$cur_hr_title','$cur_hr_email','$cur_hr_phone','$created_by','$created_at')")or die(mysqli_error($conn));
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