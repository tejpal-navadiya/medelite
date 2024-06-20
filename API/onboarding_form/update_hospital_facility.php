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
				
				$start_date=$_REQUEST['start_date'];
				$end_date=$_REQUEST['end_date'];
				$hospital_affiliation=$_REQUEST['hospital_affiliation'];
				$address_line_1=$_REQUEST['address_line_1'];
				$address_line_2=$_REQUEST['address_line_2'];
				$address_city=$_REQUEST['address_city'];
				$address_state=$_REQUEST['address_state'];
				$address_country=$_REQUEST['address_country'];
				$address_zipcode=$_REQUEST['address_zipcode'];
				$staff_category=$_REQUEST['staff_category'];
				$is_primary_affiliation=$_REQUEST['is_primary_affiliation'];
				$is_currently_affiliated=$_REQUEST['is_currently_affiliated'];
				

				
				$start_date=(array) json_decode($start_date,true);
				$end_date=(array) json_decode($end_date,true);
				$hospital_affiliation=(array) json_decode($hospital_affiliation,true);
				$address_line_1=(array) json_decode($address_line_1,true);
				$address_line_2=(array) json_decode($address_line_2,true);
				$address_city=(array) json_decode($address_city,true);
				$address_state=(array) json_decode($address_state,true);
				$address_country=(array) json_decode($address_country,true);
				$address_zipcode=(array) json_decode($address_zipcode,true);
				$staff_category=(array) json_decode($staff_category,true);
				$is_primary_affiliation=(array) json_decode($is_primary_affiliation,true);
				$is_currently_affiliated=(array) json_decode($is_currently_affiliated,true);
				

				mysqli_query($conn,"DELETE from me_onboarding_hospital_facility_affiliations WHERE form_id='$form_id' ");
				

				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				for ($i=0; $i < count($hospital_affiliation); $i++) 
				{ 
					
					if(isset($start_date[$i])){$cur_start_date=$start_date[$i];}else{$cur_start_date="";}
					if(isset($end_date[$i])){$cur_end_date=$end_date[$i];}else{$cur_end_date="";}
					if(isset($hospital_affiliation[$i])){$cur_hospital_affiliation=$hospital_affiliation[$i];}else{$cur_hospital_affiliation="";}
					if(isset($address_line_1[$i])){$cur_address_line_1=$address_line_1[$i];}else{$cur_address_line_1="";}
					if(isset($address_line_2[$i])){$cur_address_line_2=$address_line_2[$i];}else{$cur_address_line_2="";}
					if(isset($address_city[$i])){$cur_address_city=$address_city[$i];}else{$cur_address_city="";}
					if(isset($address_state[$i])){$cur_address_state=$address_state[$i];}else{$cur_address_state="";}
					if(isset($address_country[$i])){$cur_address_country=$address_country[$i];}else{$cur_address_country="";}
					if(isset($address_zipcode[$i])){$cur_address_zipcode=$address_zipcode[$i];}else{$cur_address_zipcode="";}
					if(isset($staff_category[$i])){$cur_staff_category=$staff_category[$i];}else{$cur_staff_category="";}
					if(isset($is_primary_affiliation[$i])){$cur_is_primary_affiliation=$is_primary_affiliation[$i];}else{$cur_is_primary_affiliation="0";}
					if(isset($is_currently_affiliated[$i])){$cur_is_currently_affiliated=$is_currently_affiliated[$i];}else{$cur_is_currently_affiliated="0";}
					
					$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_hospital_facility_affiliations (firm_id, form_id,start_date,end_date,hospital_affiliation,address_line_1,address_line_2,address_city,address_state,address_country,address_zipcode,staff_category,is_primary_affiliation,is_currently_affiliated, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_start_date','$cur_end_date','$cur_hospital_affiliation','$cur_address_line_1','$cur_address_line_2','$cur_address_city','$cur_address_state','$cur_address_country','$cur_address_zipcode','$cur_staff_category','$cur_is_primary_affiliation','$cur_is_currently_affiliated','$created_by','$created_at')")or die(mysqli_error($conn));
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