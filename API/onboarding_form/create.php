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

					'first_name' => 'required',

				]);

				

				$validation->validate();

				if ($validation->fails()) {

				    $getErrors = $validation->errors();

				    $errors = $getErrors->firstOfAll();

				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();

				}



				if(isset($_REQUEST['title'])){$title=$_REQUEST['title'];}else{$title="";}
				if(isset($_REQUEST['suffix'])){$suffix=$_REQUEST['suffix'];}else{$suffix="";}
				
				if(isset($_REQUEST['first_name'])){$first_name=$_REQUEST['first_name'];}else{$first_name="";}
				if(isset($_REQUEST['middle_name'])){$middle_name=$_REQUEST['middle_name'];}else{$middle_name="";}
				if(isset($_REQUEST['last_name'])){$last_name=$_REQUEST['last_name'];}else{$last_name="";}
				if(isset($_REQUEST['provider_type'])){$provider_type=$_REQUEST['provider_type'];}else{$provider_type="";}
				if(isset($_REQUEST['maiden_other_alias'])){$maiden_other_alias=$_REQUEST['maiden_other_alias'];}else{$maiden_other_alias="";}
				if(isset($_REQUEST['personal_email'])){$personal_email=$_REQUEST['personal_email'];}else{$personal_email="";}
				if(isset($_REQUEST['personal_mobile_no'])){$personal_mobile_no=$_REQUEST['personal_mobile_no'];}else{$personal_mobile_no="";}
				if(isset($_REQUEST['personal_address_line_1'])){$personal_address_line_1=$_REQUEST['personal_address_line_1'];}else{$personal_address_line_1="";}
				if(isset($_REQUEST['personal_address_line_2'])){$personal_address_line_2=$_REQUEST['personal_address_line_2'];}else{$personal_address_line_2="";}
				if(isset($_REQUEST['personal_address_city'])){$personal_address_city=$_REQUEST['personal_address_city'];}else{$personal_address_city="";}
				if(isset($_REQUEST['personal_address_state'])){$personal_address_state=$_REQUEST['personal_address_state'];}else{$personal_address_state="";}
				if(isset($_REQUEST['personal_address_country'])){$personal_address_country=$_REQUEST['personal_address_country'];}else{$personal_address_country="";}
				if(isset($_REQUEST['personal_address_zipcode'])){$personal_address_zipcode=$_REQUEST['personal_address_zipcode'];}else{$personal_address_zipcode="";}
				if(isset($_REQUEST['business_email'])){$business_email=$_REQUEST['business_email'];}else{$business_email="";}
				if(isset($_REQUEST['business_phone'])){$business_phone=$_REQUEST['business_phone'];}else{$business_phone="";}
				if(isset($_REQUEST['business_address_line_1'])){$business_address_line_1=$_REQUEST['business_address_line_1'];}else{$business_address_line_1="";}
				if(isset($_REQUEST['business_address_line_2'])){$business_address_line_2=$_REQUEST['business_address_line_2'];}else{$business_address_line_2="";}
				if(isset($_REQUEST['business_address_city'])){$business_address_city=$_REQUEST['business_address_city'];}else{$business_address_city="";}
				if(isset($_REQUEST['business_address_state'])){$business_address_state=$_REQUEST['business_address_state'];}else{$business_address_state="";}
				if(isset($_REQUEST['business_address_country'])){$business_address_country=$_REQUEST['business_address_country'];}else{$business_address_country="";}
				if(isset($_REQUEST['business_address_zipcode'])){$business_address_zipcode=$_REQUEST['business_address_zipcode'];}else{$business_address_zipcode="";}
				if(isset($_REQUEST['gender'])){$gender=$_REQUEST['gender'];}else{$gender="";}
				if(isset($_REQUEST['dob'])){$dob=$_REQUEST['dob'];}else{$dob="";}
				if(isset($_REQUEST['birth_city'])){$birth_city=$_REQUEST['birth_city'];}else{$birth_city="";}
				if(isset($_REQUEST['birth_state'])){$birth_state=$_REQUEST['birth_state'];}else{$birth_state="";}
				if(isset($_REQUEST['birth_country'])){$birth_country=$_REQUEST['birth_country'];}else{$birth_country="";}
				if(isset($_REQUEST['country_of_citizenship'])){$country_of_citizenship=$_REQUEST['country_of_citizenship'];}else{$country_of_citizenship="";}
				if(isset($_REQUEST['ethnicity'])){$ethnicity=$_REQUEST['ethnicity'];}else{$ethnicity="";}
				if(isset($_REQUEST['hair_color'])){$hair_color=$_REQUEST['hair_color'];}else{$hair_color="";}
				if(isset($_REQUEST['eye_color'])){$eye_color=$_REQUEST['eye_color'];}else{$eye_color="";}
				if(isset($_REQUEST['height_feet'])){$height_feet=$_REQUEST['height_feet'];}else{$height_feet="";}
				if(isset($_REQUEST['height_in'])){$height_in=$_REQUEST['height_in'];}else{$height_in="";}
				if(isset($_REQUEST['weight_lbs'])){$weight_lbs=$_REQUEST['weight_lbs'];}else{$weight_lbs="";}
				if(isset($_REQUEST['is_us_citizen'])){$is_us_citizen	=$_REQUEST['is_us_citizen	'];}else{$is_us_citizen	="";}
				if(isset($_REQUEST['driver_licence'])){$driver_licence=$_REQUEST['driver_licence'];}else{$driver_licence="";}
				if(isset($_REQUEST['state_issued'])){$state_issued=$_REQUEST['state_issued'];}else{$state_issued="";}
				if(isset($_REQUEST['fcvs_id'])){$fcvs_id=$_REQUEST['fcvs_id'];}else{$fcvs_id="";}
				if(isset($_REQUEST['issue_date'])){$issue_date=$_REQUEST['issue_date'];}else{$issue_date="";}
				if(isset($_REQUEST['expiry_date'])){$expiry_date=$_REQUEST['expiry_date'];}else{$expiry_date="";}
				if(isset($_REQUEST['caqh_no'])){$caqh_no=$_REQUEST['caqh_no'];}else{$caqh_no="";}
				if(isset($_REQUEST['npi_no'])){$npi_no=$_REQUEST['npi_no'];}else{$npi_no="";}
				if(isset($_REQUEST['ssn_no'])){$ssn_no=$_REQUEST['ssn_no'];}else{$ssn_no="";}
				if(isset($_REQUEST['tin_no'])){$tin_no=$_REQUEST['tin_no'];}else{$tin_no="";}
				if(isset($_REQUEST['is_military_person'])){$is_military_person=$_REQUEST['is_military_person'];}else{$is_military_person="";}
				if(isset($_REQUEST['is_partner_military_person'])){$is_partner_military_person=$_REQUEST['is_partner_military_person'];}else{$is_partner_military_person="";}
				if(isset($_REQUEST['branch'])){$branch=$_REQUEST['branch'];}else{$branch="";}
				if(isset($_REQUEST['service_start_date'])){$service_start_date=$_REQUEST['service_start_date'];}else{$service_start_date="";}
				if(isset($_REQUEST['service_end_date'])){$service_end_date=$_REQUEST['service_end_date'];}else{$service_end_date="";}
				if(isset($_REQUEST['discharge_rank'])){$discharge_rank=$_REQUEST['discharge_rank'];}else{$discharge_rank="";}
				if(isset($_REQUEST['discharge_type'])){$discharge_type=$_REQUEST['discharge_type'];}else{$discharge_type="";}
				if(isset($_REQUEST['other_honor_detail'])){$other_honor_detail=$_REQUEST['other_honor_detail'];}else{$other_honor_detail="";}
				if(isset($_REQUEST['institute_gap_confirmation'])){$institute_gap_confirmation=$_REQUEST['institute_gap_confirmation'];}else{$institute_gap_confirmation="";}




				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;

				$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_personal_details (firm_id, title,first_name,middle_name,last_name,provider_type,maiden_other_alias,personal_email,personal_mobile_no,personal_address_line_1,personal_address_line_2,personal_address_city,personal_address_state,personal_address_country,personal_address_zipcode,business_email,business_phone,business_address_line_1,business_address_line_2,business_address_city,business_address_state,business_address_country,business_address_zipcode,gender,dob,birth_city,birth_state,birth_country,country_of_citizenship,ethnicity,hair_color,eye_color,height_feet,height_in,weight_lbs,is_us_citizen	,driver_licence,state_issued,fcvs_id,issue_date,expiry_date,caqh_no,npi_no,ssn_no,tin_no,is_military_person,is_partner_military_person,branch,service_start_date,service_end_date,discharge_rank,discharge_type,other_honor_detail,institute_gap_confirmation, created_by, created_at, suffix) VALUES ('$firm_id','$title','$first_name','$middle_name','$last_name','$provider_type','$maiden_other_alias','$personal_email','$personal_mobile_no','$personal_address_line_1','$personal_address_line_2','$personal_address_city','$personal_address_state','$personal_address_country','$personal_address_zipcode','$business_email','$business_phone','$business_address_line_1','$business_address_line_2','$business_address_city','$business_address_state','$business_address_country','$business_address_zipcode','$gender','$dob','$birth_city','$birth_state','$birth_country','$country_of_citizenship','$ethnicity','$hair_color','$eye_color','$height_feet','$height_in','$weight_lbs','$is_us_citizen	','$driver_licence','$state_issued','$fcvs_id','$issue_date','$expiry_date','$caqh_no','$npi_no','$ssn_no','$tin_no','$is_military_person','$is_partner_military_person','$branch','$service_start_date','$service_end_date','$discharge_rank','$discharge_type','$other_honor_detail','$institute_gap_confirmation','$created_by','$created_at','$suffix')")or die(mysqli_error($conn));

		
				if($add_activity)
				{

					$form_id=mysqli_insert_id($conn);

					if(isset($_REQUEST['provider_id']) && $_REQUEST['provider_id']>0)
					{
						$provider_id=$_REQUEST['provider_id'];
						$add_initial_application=mysqli_query($conn,"INSERT INTO me_onboarding_application (provider_name,form_id) VALUES('$provider_id','$form_id') ");
					}
					$data=array();
					$data['form_id']=$form_id;

					$code = 1;

					$message = "Provider Demographic Details added successfully.";

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