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

			if($apitoken){

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



				$form_id = $_POST['form_id'];

				// $ac_data_qry = "SELECT id FROM me_onboarding_supporting_documents WHERE id=? AND firm_id=? limit 1";
				$ac_data_qry = "SELECT * FROM me_onboarding_supporting_documents WHERE form_id='$form_id'  limit 1";
				$ac_data_result = mysqli_query($conn, $ac_data_qry);
				if(mysqli_num_rows($ac_data_result)<=0)
				{
					$created_by = $token_id;
					$created_at=date('Y-m-d H:i:s');
					mysqli_query($conn,"INSERT INTO me_onboarding_supporting_documents (firm_id,form_id,created_at,created_by) VALUES ('$firm_id','$form_id','$created_at','$created_by')");
				}
				// $result=1;
				// if($result)
				// {
					$driver_license_passport="";
					if($_FILES["driver_license_passport"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["driver_license_passport"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["driver_license_passport"]["tmp_name"], $target_file_path)){
							$driver_license_passport = $file_name;
						}
					}
					$social_security_card="";
					if($_FILES["social_security_card"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["social_security_card"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["social_security_card"]["tmp_name"], $target_file_path)){
							$social_security_card = $file_name;
						}
					}
					$birth_certificate="";
					if($_FILES["birth_certificate"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["birth_certificate"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["birth_certificate"]["tmp_name"], $target_file_path)){
							$birth_certificate = $file_name;
						}
					}
					$proof_name_change="";
					if($_FILES["proof_name_change"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["proof_name_change"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["proof_name_change"]["tmp_name"], $target_file_path)){
							$proof_name_change = $file_name;
						}
					}
					$medical_diploma="";
					if($_FILES["medical_diploma"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["medical_diploma"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["medical_diploma"]["tmp_name"], $target_file_path)){
							$medical_diploma = $file_name;
						}
					}
					$internship_certificate="";
					if($_FILES["internship_certificate"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["internship_certificate"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["internship_certificate"]["tmp_name"], $target_file_path)){
							$internship_certificate = $file_name;
						}
					}
					$transcripts_scores="";
					if($_FILES["transcripts_scores"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["transcripts_scores"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["transcripts_scores"]["tmp_name"], $target_file_path)){
							$transcripts_scores = $file_name;
						}
					}
					$license_dea_cs="";
					if($_FILES["license_dea_cs"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["license_dea_cs"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["license_dea_cs"]["tmp_name"], $target_file_path)){
							$license_dea_cs = $file_name;
						}
					}
					$cme_ce_certificates="";
					if($_FILES["cme_ce_certificates"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["cme_ce_certificates"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["cme_ce_certificates"]["tmp_name"], $target_file_path)){
							$cme_ce_certificates = $file_name;
						}
					}
					$board_certificate="";
					if($_FILES["board_certificate"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["board_certificate"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["board_certificate"]["tmp_name"], $target_file_path)){
							$board_certificate = $file_name;
						}
					}
					$military_status_document="";
					if($_FILES["military_status_document"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["military_status_document"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["military_status_document"]["tmp_name"], $target_file_path)){
							$military_status_document = $file_name;
						}
					}	
					$original_signature="";
					if($_FILES["original_signature"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["original_signature"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["original_signature"]["tmp_name"], $target_file_path)){
							$original_signature = $file_name;
						}
					}
					$cv="";
					if($_FILES["cv"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["cv"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file_path)){
							$cv = $file_name;
						}
					}
					$malpractice_support_document="";
					if($_FILES["malpractice_support_document"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["malpractice_support_document"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["malpractice_support_document"]["tmp_name"], $target_file_path)){
							$malpractice_support_document = $file_name;
						}
					}
					$affirmative_response="";
					if($_FILES["affirmative_response"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["affirmative_response"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["affirmative_response"]["tmp_name"], $target_file_path)){
							$affirmative_response = $file_name;
						}
					}
					$malpractice_insurance="";
					if($_FILES["malpractice_insurance"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["malpractice_insurance"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["malpractice_insurance"]["tmp_name"], $target_file_path)){
							$malpractice_insurance = $file_name;
						}
					}
					$npdb_report="";
					if($_FILES["npdb_report"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["npdb_report"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["npdb_report"]["tmp_name"], $target_file_path)){
							$npdb_report = $file_name;
						}
					}
					$passport_photo="";
					if($_FILES["passport_photo"])
					{
						$target_dir = "../../uploads/";
						$file_name = uniqid().'.'.pathinfo($_FILES["passport_photo"]['name'], PATHINFO_EXTENSION);
						$target_file_path = $target_dir . $file_name;  
						if(move_uploaded_file($_FILES["passport_photo"]["tmp_name"], $target_file_path)){
							$passport_photo = $file_name;
						}
					}

					$updated_by = $token_id;
					$updated_at=date('Y-m-d H:i:s');

					// mysqli_query($conn,"DELETE from me_onboarding_supporting_documents WHERE form_id='$form_id' ");
					$additional_que="";
					if(isset($driver_license_passport) && $driver_license_passport!=""){$additional_que.=",driver_license_passport='".($driver_license_passport)."'";}
					if(isset($social_security_card) && $social_security_card!=""){$additional_que.=",social_security_card='".($social_security_card)."'";}
					if(isset($birth_certificate) && $birth_certificate!=""){$additional_que.=",birth_certificate='".($birth_certificate)."'";}
					if(isset($proof_name_change) && $proof_name_change!=""){$additional_que.=",proof_name_change='".($proof_name_change)."'";}
					if(isset($medical_diploma) && $medical_diploma!=""){$additional_que.=",medical_diploma='".($medical_diploma)."'";}
					if(isset($internship_certificate) && $internship_certificate!=""){$additional_que.=",internship_certificate='".($internship_certificate)."'";}
					if(isset($transcripts_scores) && $transcripts_scores!=""){$additional_que.=",transcripts_scores='".($transcripts_scores)."'";}
					if(isset($license_dea_cs) && $license_dea_cs!=""){$additional_que.=",license_dea_cs='".($license_dea_cs)."'";}
					if(isset($cme_ce_certificates) && $cme_ce_certificates!=""){$additional_que.=",cme_ce_certificates='".($cme_ce_certificates)."'";}
					if(isset($board_certificate) && $board_certificate!=""){$additional_que.=",board_certificate='".($board_certificate)."'";}
					if(isset($military_status_document) && $military_status_document!=""){$additional_que.=",military_status_document='".($military_status_document)."'";}
					if(isset($original_signature) && $original_signature!=""){$additional_que.=",original_signature='".($original_signature)."'";}
					if(isset($cv) && $cv!=""){$additional_que.=",cv='".($cv)."'";}
					if(isset($malpractice_support_document) && $malpractice_support_document!=""){$additional_que.=",malpractice_support_document='".($malpractice_support_document)."'";}
					if(isset($affirmative_response) && $affirmative_response!=""){$additional_que.=",affirmative_response='".($affirmative_response)."'";}
					if(isset($malpractice_insurance) && $malpractice_insurance!=""){$additional_que.=",malpractice_insurance='".($malpractice_insurance)."'";}
					if(isset($npdb_report) && $npdb_report!=""){$additional_que.=",npdb_report='".($npdb_report)."'";}
					if(isset($passport_photo) && $passport_photo!=""){$additional_que.=",passport_photo='".($passport_photo)."'";}
					// $document_files=array();
					// $document_files['driver_license_passport']=$driver_license_passport;
					// $document_files['social_security_card']=$social_security_card;
					// $document_files['birth_certificate']=$birth_certificate;
					// $document_files['proof_name_change']=$proof_name_change;
					// $document_files['medical_diploma']=$medical_diploma;
					// $document_files['internship_certificate']=$internship_certificate;
					// $document_files['transcripts_scores']=$transcripts_scores;
					// $document_files['license_dea_cs']=$license_dea_cs;
					// $document_files['cme_ce_certificates']=$cme_ce_certificates;
					// $document_files['board_certificate']=$board_certificate;
					// $document_files['military_status_document']=$military_status_document;
					// $document_files['original_signature']=$original_signature;
					// $document_files['cv']=$cv;
					// $document_files['malpractice_support_document']=$malpractice_support_document;
					// $document_files['affirmative_response']=$affirmative_response;
					// $document_files['malpractice_insurance']=$malpractice_insurance;
					// $document_files['npdb_report']=$npdb_report;
					// $document_files['passport_photo']=$passport_photo;

					$document_files_json=json_encode($document_files);
					$data=$update_pa_qry = "UPDATE me_onboarding_supporting_documents SET updated_at='$updated_at',updated_by='$updated_by' $additional_que  WHERE form_id='$form_id'";

					$is_updated = mysqli_query($conn,$update_pa_qry)
					// ;
					or $data=mysqli_error($conn);

					if($is_updated)
					{
						$data=array();
						$data['post']=$_POST;
						// $data=$additional_que;
						$code = 1;
						$message = "Details updated successfully.";
					}else
					{
						$message = "Something went wrong.";
					}

				// }else{

				// 	$message = "Details not found.";

				// }

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