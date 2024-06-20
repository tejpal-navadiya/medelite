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
				
				$website=$_REQUEST['website'];
				$user_name=$_REQUEST['user_name'];
				$password=$_REQUEST['password'];
				$favorite_color=$_REQUEST['favorite_color'];
				$favorite_pet_name=$_REQUEST['favorite_pet_name'];
				$significant_meet=$_REQUEST['significant_meet'];
				$vacation_destination=$_REQUEST['vacation_destination'];
				$favorite_teacher=$_REQUEST['favorite_teacher'];
				$father_middle_name=$_REQUEST['father_middle_name'];
				$mother_middle_name=$_REQUEST['mother_middle_name'];
				$born_hospital=$_REQUEST['born_hospital'];
				$mother_born_city=$_REQUEST['mother_born_city'];

				$last_name_bf_gf=$_REQUEST['last_name_bf_gf'];
				$city_first_job=$_REQUEST['city_first_job'];
				$street_name_grew_up=$_REQUEST['street_name_grew_up'];
				$highschool_mascot=$_REQUEST['highschool_mascot'];
				$make_model_first_car=$_REQUEST['make_model_first_car'];
				$company_name_first_job=$_REQUEST['company_name_first_job'];

				

				
				$website=(array) json_decode($website,true);
				$user_name=(array) json_decode($user_name,true);
				$password=(array) json_decode($password,true);
				// $favorite_color=(array) json_decode($favorite_color,true);
				// $favorite_pet_name=(array) json_decode($favorite_pet_name,true);
				// $significant_meet=(array) json_decode($significant_meet,true);
				// $vacation_destination=(array) json_decode($vacation_destination,true);
				// $favorite_teacher=(array) json_decode($favorite_teacher,true);
				// $father_middle_name=(array) json_decode($father_middle_name,true);
				// $mother_middle_name=(array) json_decode($mother_middle_name,true);
				// $born_hospital=(array) json_decode($born_hospital,true);
				// $mother_born_city=(array) json_decode($mother_born_city,true);
				
				// $last_name_bf_gf=(array) json_decode($last_name_bf_gf,true);
				// $city_first_job=(array) json_decode($city_first_job,true);
				// $street_name_grew_up=(array) json_decode($street_name_grew_up,true);
				// $highschool_mascot=(array) json_decode($highschool_mascot,true);
				// $make_model_first_car=(array) json_decode($make_model_first_car,true);
				// $company_name_first_job=(array) json_decode($company_name_first_job,true);

				mysqli_query($conn,"DELETE from me_onboarding_state_board_setup WHERE form_id='$form_id' ");
				

				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;
				$data=array();
				for ($i=0; $i < count($password); $i++) 
				{ 
					
					if(isset($website[$i])){$cur_website=$website[$i];}else{$cur_website="";}
					if(isset($user_name[$i])){$cur_user_name=$user_name[$i];}else{$cur_user_name="";}
					if(isset($password[$i])){$cur_password=$password[$i];}else{$cur_password="";}
					// if(isset($favorite_color[$i])){$cur_favorite_color=$favorite_color[$i];}else{$cur_favorite_color="";}
					// if(isset($favorite_pet_name[$i])){$cur_favorite_pet_name=$favorite_pet_name[$i];}else{$cur_favorite_pet_name="";}
					// if(isset($significant_meet[$i])){$cur_significant_meet=$significant_meet[$i];}else{$cur_significant_meet="";}
					// if(isset($vacation_destination[$i])){$cur_vacation_destination=$vacation_destination[$i];}else{$cur_vacation_destination="";}
					// if(isset($favorite_teacher[$i])){$cur_favorite_teacher=$favorite_teacher[$i];}else{$cur_favorite_teacher="";}
					// if(isset($father_middle_name[$i])){$cur_father_middle_name=$father_middle_name[$i];}else{$cur_father_middle_name="";}
					// if(isset($mother_middle_name[$i])){$cur_mother_middle_name=$mother_middle_name[$i];}else{$cur_mother_middle_name="";}
					// if(isset($born_hospital[$i])){$cur_born_hospital=$born_hospital[$i];}else{$cur_born_hospital="0";}
					// if(isset($mother_born_city[$i])){$cur_mother_born_city=$mother_born_city[$i];}else{$cur_mother_born_city="0";}
					
					// if(isset($last_name_bf_gf[$i])){$cur_last_name_bf_gf=$last_name_bf_gf[$i];}else{$cur_last_name_bf_gf="";}
					// if(isset($city_first_job[$i])){$cur_city_first_job=$city_first_job[$i];}else{$cur_city_first_job="";}
					// if(isset($street_name_grew_up[$i])){$cur_street_name_grew_up=$street_name_grew_up[$i];}else{$cur_street_name_grew_up="";}
					// if(isset($highschool_mascot[$i])){$cur_highschool_mascot=$highschool_mascot[$i];}else{$cur_highschool_mascot="";}
					// if(isset($make_model_first_car[$i])){$cur_make_model_first_car=$make_model_first_car[$i];}else{$cur_make_model_first_car="";}
					// if(isset($company_name_first_job[$i])){$cur_company_name_first_job=$company_name_first_job[$i];}else{$cur_company_name_first_job="";}
					// $data[]=	
					$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_state_board_setup (firm_id, form_id,website,user_name,password,favorite_color,favorite_pet_name,significant_meet,vacation_destination,favorite_teacher,father_middle_name,mother_middle_name,born_hospital,mother_born_city,last_name_bf_gf,city_first_job,street_name_grew_up,highschool_mascot,make_model_first_car,company_name_first_job, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_website','$cur_user_name','$cur_password','$favorite_color','$favorite_pet_name','$significant_meet','$vacation_destination','$favorite_teacher','$father_middle_name','$mother_middle_name','$born_hospital','$mother_born_city','$last_name_bf_gf','$city_first_job','$street_name_grew_up','$highschool_mascot','$make_model_first_car','$company_name_first_job','$created_by','$created_at')")or die(mysqli_error($conn));
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