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
				$institute_type=$_REQUEST['institute_type'];
				$start_date=$_REQUEST['start_date'];
				$end_date=$_REQUEST['end_date'];
				$institute_name=$_REQUEST['institute_name'];
				$address_line_1=$_REQUEST['address_line_1'];
				$address_line_2=$_REQUEST['address_line_2'];
				$address_city=$_REQUEST['address_city'];
				$address_state=$_REQUEST['address_state'];
				$address_country=$_REQUEST['address_country'];
				$address_zipcode=$_REQUEST['address_zipcode'];
				$degree=$_REQUEST['degree'];
				$major=$_REQUEST['major'];
				$program_completed=$_REQUEST['program_completed'];
				$graduation_date=$_REQUEST['graduation_date'];

				$institute_type=(array) json_decode($institute_type,true);
				$start_date=(array) json_decode($start_date,true);
				$end_date=(array) json_decode($end_date,true);
				$institute_name=(array) json_decode($institute_name,true);
				$address_line_1=(array) json_decode($address_line_1,true);
				$address_line_2=(array) json_decode($address_line_2,true);
				$address_city=(array) json_decode($address_city,true);
				$address_state=(array) json_decode($address_state,true);
				$address_country=(array) json_decode($address_country,true);
				$address_zipcode=(array) json_decode($address_zipcode,true);
				$degree=(array) json_decode($degree,true);
				$major=(array) json_decode($major,true);
				$program_completed=(array) json_decode($program_completed,true);
				$graduation_date=(array) json_decode($graduation_date,true);


				mysqli_query($conn,"DELETE from me_onboarding_education_training WHERE form_id='$form_id' ");
				

				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				for ($i=0; $i < count($institute_name); $i++) 
				{ 
					if(isset($institute_type[$i])){$cur_institute_type=$institute_type[$i];}else{$cur_institute_type="";}
					if(isset($start_date[$i])){$cur_start_date=$start_date[$i];}else{$cur_start_date="";}
					if(isset($end_date[$i])){$cur_end_date=$end_date[$i];}else{$cur_end_date="";}
					if(isset($institute_name[$i])){$cur_institute_name=$institute_name[$i];}else{$cur_institute_name="";}
					if(isset($address_line_1[$i])){$cur_address_line_1=$address_line_1[$i];}else{$cur_address_line_1="";}
					if(isset($address_line_2[$i])){$cur_address_line_2=$address_line_2[$i];}else{$cur_address_line_2="";}
					if(isset($address_city[$i])){$cur_address_city=$address_city[$i];}else{$cur_address_city="";}
					if(isset($address_state[$i])){$cur_address_state=$address_state[$i];}else{$cur_address_state="";}
					if(isset($address_country[$i])){$cur_address_country=$address_country[$i];}else{$cur_address_country="";}
					if(isset($address_zipcode[$i])){$cur_address_zipcode=$address_zipcode[$i];}else{$cur_address_zipcode="";}
					if(isset($degree[$i])){$cur_degree=$degree[$i];}else{$cur_degree="";}
					if(isset($major[$i])){$cur_major=$major[$i];}else{$cur_major="";}
					if(isset($program_completed[$i])){$cur_program_completed=$program_completed[$i];}else{$cur_program_completed="";}
					if(isset($graduation_date[$i])){$cur_graduation_date=$graduation_date[$i];}else{$cur_graduation_date="";}
					$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_education_training (firm_id, form_id, institute_type,start_date,end_date,institute_name,address_line_1,address_line_2,address_city,address_state,address_country,address_zipcode,degree,major,program_completed,graduation_date, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_institute_type','$cur_start_date','$cur_end_date','$cur_institute_name','$cur_address_line_1','$cur_address_line_2','$cur_address_city','$cur_address_state','$cur_address_country','$cur_address_zipcode','$cur_degree','$cur_major','$cur_program_completed','$cur_graduation_date','$created_by','$created_at')")or die(mysqli_error($conn));
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