<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	// include('../task.php');

	use Rakit\Validation\Validator;
	use Carbon\Carbon;
	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$headers = apache_request_headers();
		

		function ConvertDecimalHours($time)
		{
			$hms = explode(":", $time);
			return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
		}
		if(isset($headers['Apitoken']) || isset($headers['apitoken']) || isset($_REQUEST['apitoken']))
		{
			$headers['apitoken']=$_REQUEST['apitoken'];
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			$firm_id = getFirmFromUserId($conn, $token_id);
			// $default_date_format=getDateFormatFromUserId($conn, $token_id);
			if($apitoken)
			{
				$validator = new Validator;
				$validation = $validator->make($_REQUEST, [
				    'id' => 'required'
				]);
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}
				
				$ac_data_qry = "SELECT * FROM me_onboarding_personal_details WHERE id=?  limit 1";
				$ac_data_result = prepared_select($conn, $ac_data_qry, [$_REQUEST['id']]);
				if($ac_data_result->num_rows)
				{
					$data = $ac_data_result->fetch_assoc();
					
					$personal_address_state_id=$data['personal_address_state'];
					if($personal_address_state_id>0 && $personal_address_state_id!="")
					{
						$state_name=getTableFieldName($conn, "me_states"," id='$personal_address_state_id' ","name");
						$personal_address_state_name_sel=array("id"=>$personal_address_state_id,"name"=>$state_name);
						$data['personal_address_state_sel']=json_encode($personal_address_state_name_sel);
					}
					$business_address_state_id=$data['business_address_state'];
					if($business_address_state_id>0 && $business_address_state_id!="")
					{
						$state_name=getTableFieldName($conn, "me_states"," id='$business_address_state_id' ","name");
						$business_address_state_name_sel=array("id"=>$business_address_state_id,"name"=>$state_name);
						$data['business_address_state_sel']=json_encode($business_address_state_name_sel);
					}
					$birth_state_id=$data['birth_state'];
					if($birth_state_id>0 && $birth_state_id!="")
					{
						$state_name=getTableFieldName($conn, "me_states"," id='$birth_state_id' ","name");
						$birth_state_name_sel=array("id"=>$birth_state_id,"name"=>$state_name);
						$data['birth_state_sel']=json_encode($birth_state_name_sel);
					}
					$birth_country_id=$data['birth_country'];
					if($birth_country_id>0 && $birth_country_id!="")
					{
						$country_name=getTableFieldName($conn, "me_countries"," id='$birth_country_id' ","name");
						$birth_country_name_sel=array("id"=>$birth_country_id,"name"=>$country_name);
						$data['birth_country_sel']=json_encode($birth_country_name_sel);
					}
					$country_of_citizenship_id=$data['country_of_citizenship'];
					if($country_of_citizenship_id>0 && $country_of_citizenship_id!="")
					{
						$country_name=getTableFieldName($conn, "me_countries"," id='$country_of_citizenship_id' ","name");
						$country_of_citizenship_name_sel=array("id"=>$country_of_citizenship_id,"name"=>$country_name);
						$data['country_of_citizenship_sel']=json_encode($country_of_citizenship_name_sel);
					}
					$state_issued_id=$data['state_issued'];
					if($state_issued_id>0 && $state_issued_id!="")
					{
						$state_name=getTableFieldName($conn, "me_states"," id='$state_issued_id' ","name");
						$state_issued_name_sel=array("id"=>$state_issued_id,"name"=>$state_name);
						$data['state_issued_sel']=json_encode($state_issued_name_sel);
					}
						$sel_education_training=mysqli_query($conn,"SELECT * from me_onboarding_education_training WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_education_training_detail=mysqli_fetch_assoc($sel_education_training))
						{
							$country_id=$fet_education_training_detail['address_country'];
							$state_id=$fet_education_training_detail['address_state'];
							if($country_id>0 && $country_id!="")
							{
								$country_name=getTableFieldName($conn, "me_countries"," id='$country_id' ","name");
								// if($country_name!=0)
								// {
									$address_country_name_sel=array("id"=>$country_id,"name"=>$country_name);
									$fet_education_training_detail['address_country_name_sel']=json_encode($address_country_name_sel);
								// }
							}
							if($state_id>0 && $state_id!="")
							{
								$state_name=getTableFieldName($conn, "me_states"," id='$state_id' ","name");
								// if($state_name!=0)
								// {
									$address_state_name_sel=array("id"=>$state_id,"name"=>$state_name);
									$fet_education_training_detail['address_state_name_sel']=json_encode($address_state_name_sel);
								// }
							}
							$education_training_detail[]=$fet_education_training_detail;
						}
						$data['education_training_detail']=$education_training_detail;

						$sel_board_certification=mysqli_query($conn,"SELECT * from me_onboarding_board_certification WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_board_certification_detail=mysqli_fetch_assoc($sel_board_certification))
						{
							$board_certification_detail[]=$fet_board_certification_detail;
						}
						$data['board_certification_detail']=$board_certification_detail;
						
						$sel_exam_history=mysqli_query($conn,"SELECT * from me_onboarding_exam_history WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_exam_history_detail=mysqli_fetch_assoc($sel_exam_history))
						{
							$exam_history_detail[]=$fet_exam_history_detail;
						}
						$data['exam_history_detail']=$exam_history_detail;

						$sel_hospital_facility_affiliations=mysqli_query($conn,"SELECT * from me_onboarding_hospital_facility_affiliations WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_hospital_facility_affiliations=mysqli_fetch_assoc($sel_hospital_facility_affiliations))
						{
							$country_id=$fet_hospital_facility_affiliations['address_country'];
							$state_id=$fet_hospital_facility_affiliations['address_state'];
							if($country_id>0 && $country_id!="")
							{
								$country_name=getTableFieldName($conn, "me_countries"," id='$country_id' ","name");
								// if($country_name!=0)
								// {
									$address_country_name_sel=array("id"=>$country_id,"name"=>$country_name);
									$fet_hospital_facility_affiliations['address_country_name_sel']=json_encode($address_country_name_sel);
								// }
							}
							if($state_id>0 && $state_id!="")
							{
								$state_name=getTableFieldName($conn, "me_states"," id='$state_id' ","name");
								// if($state_name!=0)
								// {
									$address_state_name_sel=array("id"=>$state_id,"name"=>$state_name);
									$fet_hospital_facility_affiliations['address_state_name_sel']=json_encode($address_state_name_sel);
								// }
							}
							$hospital_facility_affiliations_details[]=$fet_hospital_facility_affiliations;
						}
						$data['hospital_facility_affiliations_details']=$hospital_facility_affiliations_details;

						$sel_onboarding_licensure=mysqli_query($conn,"SELECT * from me_onboarding_licensure WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_onboarding_licensure_detail=mysqli_fetch_assoc($sel_onboarding_licensure))
						{
							
							$state_id=$fet_onboarding_licensure_detail['license_state'];
							
							if($state_id>0 && $state_id!="")
							{
								$state_name=getTableFieldName($conn, "me_states"," id='$state_id' ","name");
								// if($state_name!=0)
								// {
									$license_state_name_sel=array("id"=>$state_id,"name"=>$state_name);
									$fet_onboarding_licensure_detail['license_state_name_sel']=json_encode($license_state_name_sel);
								// }
							}
							$onboarding_licensure_detail[]=$fet_onboarding_licensure_detail;
						}
						$data['onboarding_licensure_detail']=$onboarding_licensure_detail;

						$sel_personal_reference=mysqli_query($conn,"SELECT * from me_onboarding_personal_reference WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_personal_reference_detail=mysqli_fetch_assoc($sel_personal_reference))
						{
							$country_id=$fet_personal_reference_detail['address_country'];
							$state_id=$fet_personal_reference_detail['address_state'];
							if($country_id>0 && $country_id!="")
							{
								$country_name=getTableFieldName($conn, "me_countries"," id='$country_id' ","name");
								// if($country_name!=0)
								// {
									$address_country_name_sel=array("id"=>$country_id,"name"=>$country_name);
									$fet_personal_reference_detail['address_country_name_sel']=json_encode($address_country_name_sel);
								// }
							}
							if($state_id>0 && $state_id!="")
							{
								$state_name=getTableFieldName($conn, "me_states"," id='$state_id' ","name");
								// if($state_name!=0)
								// {
									$address_state_name_sel=array("id"=>$state_id,"name"=>$state_name);
									$fet_personal_reference_detail['address_state_name_sel']=json_encode($address_state_name_sel);
								// }
							}

							$personal_reference_detail[]=$fet_personal_reference_detail;

						}
						$data['personal_reference_detail']=$personal_reference_detail;

						$sel_practice_employer_history=mysqli_query($conn,"SELECT * from me_onboarding_practice_employer_history WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_practice_employer_history_detail=mysqli_fetch_assoc($sel_practice_employer_history))
						{
							$country_id=$fet_practice_employer_history_detail['address_country'];
							$state_id=$fet_practice_employer_history_detail['address_state'];
							if($country_id>0 && $country_id!="")
							{
								$country_name=getTableFieldName($conn, "me_countries"," id='$country_id' ","name");
								// if($country_name!=0)
								// {
									$address_country_name_sel=array("id"=>$country_id,"name"=>$country_name);
									$fet_practice_employer_history_detail['address_country_name_sel']=json_encode($address_country_name_sel);
								// }
							}
							if($state_id>0 && $state_id!="")
							{
								$state_name=getTableFieldName($conn, "me_states"," id='$state_id' ","name");
								// if($state_name!=0)
								// {
									$address_state_name_sel=array("id"=>$state_id,"name"=>$state_name);
									$fet_practice_employer_history_detail['address_state_name_sel']=json_encode($address_state_name_sel);
								// }
							}
							$practice_employer_history_detail[]=$fet_practice_employer_history_detail;
						}
						$data['practice_employer_history_detail']=$practice_employer_history_detail;

						$sel_questions=mysqli_query($conn,"SELECT * from me_onboarding_questions WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_questions_detail=mysqli_fetch_assoc($sel_questions))
						{
							$questions_detail[]=$fet_questions_detail;
						}
						$data['questions_detail']=$questions_detail;

						$sel_supporting_documents=mysqli_query($conn,"SELECT * from me_onboarding_supporting_documents WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_supporting_documents_detail=mysqli_fetch_assoc($sel_supporting_documents))
						{
							$file_base_url=$main_url."uploads/";
							if(isset($fet_supporting_documents_detail['driver_license_passport']) && $fet_supporting_documents_detail['driver_license_passport']!=""){$fet_supporting_documents_detail['driver_license_passport']=$file_base_url.$fet_supporting_documents_detail['driver_license_passport'];}
							if(isset($fet_supporting_documents_detail['social_security_card']) && $fet_supporting_documents_detail['social_security_card']!=""){$fet_supporting_documents_detail['social_security_card']=$file_base_url.$fet_supporting_documents_detail['social_security_card'];}
							if(isset($fet_supporting_documents_detail['birth_certificate']) && $fet_supporting_documents_detail['birth_certificate']!=""){$fet_supporting_documents_detail['birth_certificate']=$file_base_url.$fet_supporting_documents_detail['birth_certificate'];}
							if(isset($fet_supporting_documents_detail['proof_name_change']) && $fet_supporting_documents_detail['proof_name_change']!=""){$fet_supporting_documents_detail['proof_name_change']=$file_base_url.$fet_supporting_documents_detail['proof_name_change'];}
							if(isset($fet_supporting_documents_detail['medical_diploma']) && $fet_supporting_documents_detail['medical_diploma']!=""){$fet_supporting_documents_detail['medical_diploma']=$file_base_url.$fet_supporting_documents_detail['medical_diploma'];}
							if(isset($fet_supporting_documents_detail['internship_certificate']) && $fet_supporting_documents_detail['internship_certificate']!=""){$fet_supporting_documents_detail['internship_certificate']=$file_base_url.$fet_supporting_documents_detail['internship_certificate'];}
							if(isset($fet_supporting_documents_detail['transcripts_scores']) && $fet_supporting_documents_detail['transcripts_scores']!=""){$fet_supporting_documents_detail['transcripts_scores']=$file_base_url.$fet_supporting_documents_detail['transcripts_scores'];}
							if(isset($fet_supporting_documents_detail['license_dea_cs']) && $fet_supporting_documents_detail['license_dea_cs']!=""){$fet_supporting_documents_detail['license_dea_cs']=$file_base_url.$fet_supporting_documents_detail['license_dea_cs'];}
							if(isset($fet_supporting_documents_detail['cme_ce_certificates']) && $fet_supporting_documents_detail['cme_ce_certificates']!=""){$fet_supporting_documents_detail['cme_ce_certificates']=$file_base_url.$fet_supporting_documents_detail['cme_ce_certificates'];}
							if(isset($fet_supporting_documents_detail['board_certificate']) && $fet_supporting_documents_detail['board_certificate']!=""){$fet_supporting_documents_detail['board_certificate']=$file_base_url.$fet_supporting_documents_detail['board_certificate'];}
							if(isset($fet_supporting_documents_detail['military_status_document']) && $fet_supporting_documents_detail['military_status_document']!=""){$fet_supporting_documents_detail['military_status_document']=$file_base_url.$fet_supporting_documents_detail['military_status_document'];}
							if(isset($fet_supporting_documents_detail['original_signature']) && $fet_supporting_documents_detail['original_signature']!=""){$fet_supporting_documents_detail['original_signature']=$file_base_url.$fet_supporting_documents_detail['original_signature'];}
							if(isset($fet_supporting_documents_detail['cv']) && $fet_supporting_documents_detail['cv']!=""){$fet_supporting_documents_detail['cv']=$file_base_url.$fet_supporting_documents_detail['cv'];}
							if(isset($fet_supporting_documents_detail['malpractice_support_document']) && $fet_supporting_documents_detail['malpractice_support_document']!=""){$fet_supporting_documents_detail['malpractice_support_document']=$file_base_url.$fet_supporting_documents_detail['malpractice_support_document'];}
							if(isset($fet_supporting_documents_detail['affirmative_response']) && $fet_supporting_documents_detail['affirmative_response']!=""){$fet_supporting_documents_detail['affirmative_response']=$file_base_url.$fet_supporting_documents_detail['affirmative_response'];}
							if(isset($fet_supporting_documents_detail['malpractice_insurance']) && $fet_supporting_documents_detail['malpractice_insurance']!=""){$fet_supporting_documents_detail['malpractice_insurance']=$file_base_url.$fet_supporting_documents_detail['malpractice_insurance'];}
							if(isset($fet_supporting_documents_detail['npdb_report']) && $fet_supporting_documents_detail['npdb_report']!=""){$fet_supporting_documents_detail['npdb_report']=$file_base_url.$fet_supporting_documents_detail['npdb_report'];}
							if(isset($fet_supporting_documents_detail['passport_photo']) && $fet_supporting_documents_detail['passport_photo']!=""){$fet_supporting_documents_detail['passport_photo']=$file_base_url.$fet_supporting_documents_detail['passport_photo'];}
							$supporting_documents_detail=$fet_supporting_documents_detail;
						}
						$data['supporting_documents_detail']=$supporting_documents_detail;

						$sel_questions=mysqli_query($conn,"SELECT * from me_onboarding_states WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_questions_detail=mysqli_fetch_assoc($sel_questions))
						{
							$questions_detail[]=$fet_questions_detail['state_id'];
						}
						$data['states_detail']=$questions_detail;

						$sel_state_board_setup=mysqli_query($conn,"SELECT * from me_onboarding_state_board_setup WHERE form_id='".$_REQUEST['id']."' ");					
						while($fet_state_board_setup_detail=mysqli_fetch_assoc($sel_state_board_setup))
						{
							$state_board_setup_detail[]=$fet_state_board_setup_detail;
						}
						$data['state_board_setup_detail']=$state_board_setup_detail;

					$code = 1;
					$message = "Data get successfully.";
				}else{
					$message = "Data not exist.";
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