<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
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

				$form_id=$_REQUEST['form_id'];
				$is_primary=$_REQUEST['is_primary'];
				$is_board_eligible=$_REQUEST['is_board_eligible'];
				$is_meeting_moc=$_REQUEST['is_meeting_moc'];
				$is_indefinite=$_REQUEST['is_indefinite'];
				$is_member_medical_board=$_REQUEST['is_member_medical_board'];
				$board_name=$_REQUEST['board_name'];
				$specialty=$_REQUEST['specialty'];
				$certificate_no=$_REQUEST['certificate_no'];
				$issue_date=$_REQUEST['issue_date'];
				$expiry_date=$_REQUEST['expiry_date'];
				
				// $certificate_no=$_REQUEST['certificate_no'];
				// if(is_array($certificate_no)){
				// 	$certificate_no=json_encode($certificate_no);
				// }
				$focus=$_REQUEST['focus'];
				$certificate_status=$_REQUEST['certificate_status'];
				$exam_passed=$_REQUEST['exam_passed'];
				$board_link=$_REQUEST['board_link'];
				$documents=$_REQUEST['documents'];
				$notes=$_REQUEST['notes'];
				$certificate_duration=$_REQUEST['certificate_duration'];
				$recertification_date=$_REQUEST['recertification_date'];
				$moc_occ_status=$_REQUEST['moc_occ_status'];
				$meeting_moc_occ=$_REQUEST['meeting_moc_occ'];
				$moc_occ_verifiaction_date=$_REQUEST['moc_occ_verifiaction_date'];
				$annual_reverifiaction_date=$_REQUEST['annual_reverifiaction_date'];

				$is_primary=(array) json_decode($is_primary,true);
				$is_board_eligible=(array) json_decode($is_board_eligible,true);
				$is_meeting_moc=(array) json_decode($is_meeting_moc,true);
				$is_indefinite=(array) json_decode($is_indefinite,true);
				$is_member_medical_board=(array) json_decode($is_member_medical_board,true);
				$board_name=(array) json_decode($board_name,true);
				$specialty=(array) json_decode($specialty,true);
				$certificate_no=(array) json_decode($certificate_no,true);
				$issue_date=(array) json_decode($issue_date,true);
				$expiry_date=(array) json_decode($expiry_date,true);
				
				// $certificate_no=(array) json_decode($certificate_no,true);
				$focus=(array) json_decode($focus,true);
				$certificate_status=(array) json_decode($certificate_status,true);
				$exam_passed=(array) json_decode($exam_passed,true);
				$board_link=(array) json_decode($board_link,true);
				$documents=(array) json_decode($documents,true);
				$notes=(array) json_decode($notes,true);
				$certificate_duration=(array) json_decode($certificate_duration,true);
				$recertification_date=(array) json_decode($recertification_date,true);
				$moc_occ_status=(array) json_decode($moc_occ_status,true);
				$meeting_moc_occ=(array) json_decode($meeting_moc_occ,true);
				$moc_occ_verifiaction_date=(array) json_decode($moc_occ_verifiaction_date,true);
				$annual_reverifiaction_date=(array) json_decode($annual_reverifiaction_date,true);

				mysqli_query($conn,"DELETE from me_onboarding_board_certification WHERE form_id='$form_id' ");
				

				$created_at=date('Y-m-d H:i:s');

				$created_by = (int) $token_id;
				// print_r($_REQUEST);
				for ($i=0; $i < count($board_name); $i++) 
				{ 
					if(isset($is_primary[$i])){$cur_is_primary=$is_primary[$i];}else{$cur_is_primary="";}
					if(isset($is_board_eligible[$i])){$cur_is_board_eligible=$is_board_eligible[$i];}else{$cur_is_board_eligible="";}
					if(isset($is_meeting_moc[$i])){$cur_is_meeting_moc=$is_meeting_moc[$i];}else{$cur_is_meeting_moc="";}
					if(isset($is_indefinite[$i])){$cur_is_indefinite=$is_indefinite[$i];}else{$cur_is_indefinite="";}
					if(isset($is_member_medical_board[$i])){$cur_is_member_medical_board=$is_member_medical_board[$i];}else{$cur_is_member_medical_board="";}
					if(isset($board_name[$i])){$cur_board_name=$board_name[$i];}else{$cur_board_name="";}
					if(isset($specialty[$i])){$cur_specialty=$specialty[$i];}else{$cur_specialty="";}
					if(isset($certificate_no[$i])){$cur_certificate_no=$certificate_no[$i];}else{$cur_certificate_no="";}
					if(isset($issue_date[$i])){$cur_issue_date=$issue_date[$i];}else{$cur_issue_date="";}
					if(isset($expiry_date[$i])){$cur_expiry_date=$expiry_date[$i];}else{$cur_expiry_date="";}
					
					// if(isset($certificate_no[$i])){$cur_certificate_no=$certificate_no[$i];}else{$cur_certificate_no="";}
					if(isset($focus[$i])){$cur_focus=$focus[$i];}else{$cur_focus="";}
					if(isset($certificate_status[$i])){$cur_certificate_status=$certificate_status[$i];}else{$cur_certificate_status="";}
					if(isset($exam_passed[$i])){$cur_exam_passed=$exam_passed[$i];}else{$cur_exam_passed="";}
					if(isset($board_link[$i])){$cur_board_link=$board_link[$i];}else{$cur_board_link="";}
					if(isset($documents[$i])){$cur_documents=$documents[$i];}else{$cur_documents="";}
					if(isset($notes[$i])){$cur_notes=$notes[$i];}else{$cur_notes="";}
					if(isset($certificate_duration[$i])){$cur_certificate_duration=$certificate_duration[$i];}else{$cur_certificate_duration="";}
					if(isset($recertification_date[$i])){$cur_recertification_date=$recertification_date[$i];}else{$cur_recertification_date="";}
					if(isset($moc_occ_status[$i])){$cur_moc_occ_status=$moc_occ_status[$i];}else{$cur_moc_occ_status="";}
					if(isset($meeting_moc_occ[$i])){$cur_meeting_moc_occ=$meeting_moc_occ[$i];}else{$cur_meeting_moc_occ="";}
					if(isset($moc_occ_verifiaction_date[$i])){$cur_moc_occ_verifiaction_date=$moc_occ_verifiaction_date[$i];}else{$cur_moc_occ_verifiaction_date="";}
					if(isset($annual_reverifiaction_date[$i])){$cur_annual_reverifiaction_date=$annual_reverifiaction_date[$i];}else{$cur_annual_reverifiaction_date="";}

					$add_activity = mysqli_query($conn,"INSERT INTO me_onboarding_board_certification (firm_id, form_id, is_primary,is_board_eligible,is_meeting_moc,is_indefinite,is_member_medical_board,board_name,specialty,issue_date,expiry_date,certificate_no,focus,certificate_status,exam_passed,board_link,documents,notes,certificate_duration,recertification_date,moc_occ_status,meeting_moc_occ,moc_occ_verifiaction_date,annual_reverifiaction_date, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_is_primary','$cur_is_board_eligible','$cur_is_meeting_moc','$cur_is_indefinite','$cur_is_member_medical_board','$cur_board_name','$cur_specialty','$cur_issue_date','$cur_expiry_date','$cur_certificate_no','$cur_focus','$cur_certificate_status','$cur_exam_passed','$cur_board_link','$cur_documents','$cur_notes','$cur_certificate_duration','$cur_recertification_date','$cur_moc_occ_status','$cur_meeting_moc_occ','$cur_moc_occ_verifiaction_date','$cur_annual_reverifiaction_date','$created_by','$created_at')")or die(mysqli_error($conn));
				
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