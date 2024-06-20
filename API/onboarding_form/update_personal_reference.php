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
				
				$title=$_REQUEST['title'];
				$first_name=$_REQUEST['first_name'];
				// $middle_name=$_REQUEST['middle_name'];
				$address_line_1=$_REQUEST['address_line_1'];
				$address_line_2=$_REQUEST['address_line_2'];
				$address_city=$_REQUEST['address_city'];
				$address_state=$_REQUEST['address_state'];
				$address_country=$_REQUEST['address_country'];
				$address_zipcode=$_REQUEST['address_zipcode'];
				$last_name=$_REQUEST['last_name'];
				$company_name=$_REQUEST['company_name'];
				$email=$_REQUEST['email'];
				$phone=$_REQUEST['phone'];
				

				
				$title=(array) json_decode($title,true);
				$first_name=(array) json_decode($first_name,true);
				// $middle_name=(array) json_decode($middle_name,true);
				$address_line_1=(array) json_decode($address_line_1,true);
				$address_line_2=(array) json_decode($address_line_2,true);
				$address_city=(array) json_decode($address_city,true);
				$address_state=(array) json_decode($address_state,true);
				$address_country=(array) json_decode($address_country,true);
				$address_zipcode=(array) json_decode($address_zipcode,true);
				$last_name=(array) json_decode($last_name,true);
				$company_name=(array) json_decode($company_name,true);
				$email=(array) json_decode($email,true);
				$phone=(array) json_decode($phone,true);
				

				mysqli_query($conn,"DELETE from me_onboarding_personal_reference WHERE form_id='$form_id' ");
				

				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;	$data=array();

				for ($i=0; $i < count($first_name); $i++) 
				{ 
					
					if(isset($title[$i])){$cur_title=$title[$i];}else{$cur_title="";}
					if(isset($first_name[$i])){$cur_first_name=$first_name[$i];}else{$cur_first_name="";}
					if(isset($middle_name[$i])){$cur_middle_name=$middle_name[$i];}else{$cur_middle_name="";}
					if(isset($address_line_1[$i])){$cur_address_line_1=$address_line_1[$i];}else{$cur_address_line_1="";}
					if(isset($address_line_2[$i])){$cur_address_line_2=$address_line_2[$i];}else{$cur_address_line_2="";}
					if(isset($address_city[$i])){$cur_address_city=$address_city[$i];}else{$cur_address_city="";}
					if(isset($address_state[$i])){$cur_address_state=$address_state[$i];}else{$cur_address_state="";}
					if(isset($address_country[$i])){$cur_address_country=$address_country[$i];}else{$cur_address_country="";}
					if(isset($address_zipcode[$i])){$cur_address_zipcode=$address_zipcode[$i];}else{$cur_address_zipcode="";}
					if(isset($last_name[$i])){$cur_last_name=$last_name[$i];}else{$cur_last_name="";}
					if(isset($company_name[$i])){$cur_company_name=$company_name[$i];}else{$cur_company_name="";}
					if(isset($email[$i])){$cur_email=$email[$i];}else{$cur_email="";}
					if(isset($phone[$i])){$cur_phone=$phone[$i];}else{$cur_phone="";}
					
					$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_personal_reference (firm_id, form_id,title,first_name,middle_name,address_line_1,address_line_2,address_city,address_state,address_country,address_zipcode,last_name,company_name,email,phone, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_title','$cur_first_name','$cur_middle_name','$cur_address_line_1','$cur_address_line_2','$cur_address_city','$cur_address_state','$cur_address_country','$cur_address_zipcode','$cur_last_name','$cur_company_name','$cur_email','$cur_phone','$created_by','$created_at')")or $cErr==(mysqli_error($conn));
					$data[]=$cErr;
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