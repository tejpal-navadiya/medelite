<?php
ob_start();
session_start();
require_once("../config_front.php");
include("../functions.php");
// define('API_root',$project_url);
include "api_action_list_data.php";
include "lib/vendor/autoload.php";
use GuzzleHttp\Client;

$redirect_url="../index.php";
$API_Call_Method="POST";$ret_msg="Invalid Request";$ret_msg_type="error";
if(isset($_REQUEST['action']))
{
	$_REQUEST['apitoken']=$_SESSION['me_apitoken'];
	$call_to_action=$_REQUEST['action'];
	$redirect_url_success=$_REQUEST['redirect_url_success'];
	$redirect_url_error=$_REQUEST['redirect_url_error'];
	// print_r($action_API_list);
	if(isset($action_API_list[($call_to_action)]))
	{
	// print_r($action_API_list);
		if($call_to_action=="update_require_document")
		{
			$upload_file_list=array("driver_license_passport","social_security_card","birth_certificate","proof_name_change","medical_diploma","internship_certificate","transcripts_scores","license_dea_cs","cme_ce_certificates","board_certificate","military_status_document","original_signature","cv","malpractice_support_document","affirmative_response","malpractice_insurance","npdb_report","passport_photo");
			for ($fci=0; $fci < count($upload_file_list); $fci++) 
			{ 
				$current_file=$upload_file_list[$fci];
				if(isset($_FILES[$current_file]['name'][0]) && $_FILES[$current_file]['name'][0]!="")
				{
					$requestData[] = [
										'Content-type' => 'multipart/form-data',
										'name' => $current_file,
										'contents' => fopen($_FILES[$current_file]['tmp_name'][0], 'r'),
										'filename' => $_FILES[$current_file]['name'][0],
									];    
				}
			}
			$requestData[] = [ 'name' => 'apitoken', 'contents' => $_SESSION['me_apitoken'] ];
			$requestData[] = [ 'name' => 'form_id', 'contents' => $_POST['form_id'] ];

			$cur_API_URL=$action_API_list[($call_to_action)];
			$client = new Client(['headers' => ['apitoken' => $_SESSION['me_apitoken']]]);
			$options = [
				'multipart' => $requestData,
			];
			$response = $client->post($cur_API_URL, $options);
			$APIReturnDataJSON = $response->getBody()->getContents();

			// $response = json_decode($response,true);
			$APIReturnDataArr=json_decode($APIReturnDataJSON, true);
			// print_r($APIReturnDataArr);

			if(isset($APIReturnDataArr['code']) && $APIReturnDataArr['code']=="1")
			{
				$redirect_url=$redirect_url_success;
				$ret_msg_type="success";
				$return_data=$APIReturnDataArr['data'];
				// $current_status_user=$return_data['status'];
				
				// print_r($return_data);
			}else
			{
				$redirect_url=$redirect_url_error;
				$ret_msg_type="error";
			}
			$ret_msg=$APIReturnDataArr['message'];
			
		}
		if($call_to_action=="add_provider_form")
		{

			$cur_API_URL=$action_API_list[($call_to_action)];
			$APIReturnDataJSON=CallAPI($API_Call_Method, $cur_API_URL, $_REQUEST);
			$APIReturnDataArr=json_decode($APIReturnDataJSON, true);
			
			if(isset($APIReturnDataArr['code']) && $APIReturnDataArr['code']=="1")
			{
				$redirect_url=$redirect_url_success;
				$ret_msg_type="success";
				$return_data=$APIReturnDataArr['data'];
				$current_status_user=$return_data['status'];
				// print_r($return_data);	
				if(isset($return_data['form_id']))
				{
					$redirect_url="../index.php?pid=add_boarding_form&tab=education-training&id=".$return_data['form_id'];
					$_SESSION['me_custom_error']['msg_type']=$ret_msg_type;
					$_SESSION['me_custom_error']['err_msg']="Form Created Successfully";
					// $_SESSION['me_custom_error']['err_msg']=$ret_msg;
					header("Location:../index.php?pid=add_boarding_form&tab=education-training&id=".$return_data['form_id']);
					exit;
				}
				// header("Location:".$redirect_url);
				// echo $redirect_url;

				// print_r($user_data);
			}else
			{
				$redirect_url=$redirect_url_error;
				$ret_msg_type="error";
			}
			$ret_msg=$APIReturnDataArr['message'];
			
			// print_r($APIReturnDataArr);
		}
		if($call_to_action=="update_provider_form")
		{

			$cur_API_URL=$action_API_list[($call_to_action)];
			$APIReturnDataJSON=CallAPI($API_Call_Method, $cur_API_URL, $_REQUEST);
			$APIReturnDataArr=json_decode($APIReturnDataJSON, true);
			
			if(isset($APIReturnDataArr['code']) && $APIReturnDataArr['code']=="1")
			{
				$redirect_url=$redirect_url_success;
				$ret_msg_type="success";
				$return_data=$APIReturnDataArr['data'];
				$current_status_user=$return_data['status'];
				// print_r($return_data);	
				// if(isset($return_data['form_id']))
				// {
				// 	$redirect_url="../index.php?pid=add_boarding_form&tab=education-training&id=".$return_data['form_id'];
				// }
				
				// print_r($user_data);
			}else
			{
				$redirect_url=$redirect_url_error;
				$ret_msg_type="error";
			}
			$ret_msg=$APIReturnDataArr['message'];
			
			// print_r($APIReturnDataArr);
		}
		else
		{
			
			if($call_to_action=="update_education_training")
			{
				if(!isset($_REQUEST['degree'])){$_REQUEST['degree']=array();}
				$_REQUEST['institute_type']=json_encode($_REQUEST['institute_type']);
				$_REQUEST['start_date']=json_encode($_REQUEST['start_date']);
				$_REQUEST['end_date']=json_encode($_REQUEST['end_date']);
				$_REQUEST['institute_name']=json_encode($_REQUEST['institute_name']);
				$_REQUEST['address_line_1']=json_encode($_REQUEST['address_line_1']);
				$_REQUEST['address_line_2']=json_encode($_REQUEST['address_line_2']);
				$_REQUEST['address_city']=json_encode($_REQUEST['address_city']);
				$_REQUEST['address_state']=json_encode($_REQUEST['address_state']);
				$_REQUEST['address_country']=json_encode($_REQUEST['address_country']);
				$_REQUEST['address_zipcode']=json_encode($_REQUEST['address_zipcode']);
				$_REQUEST['degree']=json_encode($_REQUEST['degree']);
				$_REQUEST['major']=json_encode($_REQUEST['major']);
				$_REQUEST['program_completed']=json_encode($_REQUEST['program_completed']);
				$_REQUEST['graduation_date']=json_encode($_REQUEST['graduation_date']);
				unset($_REQUEST['address_zip_code']);
			}
			if($call_to_action=="update_exam_history")
			{
				

				$_REQUEST['exam_type']=json_encode($_REQUEST['exam_type']);
				$_REQUEST['no_of_attempts']=json_encode($_REQUEST['no_of_attempts']);
				$_REQUEST['score']=json_encode($_REQUEST['score']);
				$_REQUEST['first_try_date']=json_encode($_REQUEST['first_try_date']);				
				$_REQUEST['is_passed']=json_encode($_REQUEST['is_passed']);
				$_REQUEST['examination']=json_encode($_REQUEST['examination']);
				$_REQUEST['exam_date']=json_encode($_REQUEST['exam_date']);
				$_REQUEST['location']=json_encode($_REQUEST['location']);
				$_REQUEST['notes']=json_encode($_REQUEST['notes']);
				
			}
			if($call_to_action=="update_board_certification")
			{
				
				if(!isset($_REQUEST['is_primary'])){$_REQUEST['is_primary']=array();}
				if(!isset($_REQUEST['is_board_eligible'])){$_REQUEST['is_board_eligible']=array();}
				if(!isset($_REQUEST['is_meeting_moc'])){$_REQUEST['is_meeting_moc']=array();}
				if(!isset($_REQUEST['is_indefinite'])){$_REQUEST['is_indefinite']=array();}
				if(!isset($_REQUEST['is_member_medical_board'])){$_REQUEST['is_member_medical_board']=array();}
				
				$_REQUEST['is_primary']=json_encode($_REQUEST['is_primary']);
				$_REQUEST['is_board_eligible']=json_encode($_REQUEST['is_board_eligible']);
				$_REQUEST['is_meeting_moc']=json_encode($_REQUEST['is_meeting_moc']);
				$_REQUEST['is_indefinite']=json_encode($_REQUEST['is_indefinite']);
				$_REQUEST['is_member_medical_board']=json_encode($_REQUEST['is_member_medical_board']);
				$_REQUEST['board_name']=json_encode($_REQUEST['board_name']);
				$_REQUEST['specialty']=json_encode($_REQUEST['specialty']);
				$_REQUEST['certificate_no']=json_encode($_REQUEST['certificate_no']);
				$_REQUEST['issue_date']=json_encode($_REQUEST['issue_date']);
				$_REQUEST['expiry_date']=json_encode($_REQUEST['expiry_date']);
				$_REQUEST['certificate_no']=json_encode($_REQUEST['certificate_no']);
				
				$_REQUEST['focus']=json_encode($_REQUEST['focus']);
				$_REQUEST['certificate_status']=json_encode($_REQUEST['certificate_status']);
				$_REQUEST['exam_passed']=json_encode($_REQUEST['exam_passed']);
				$_REQUEST['board_link']=json_encode($_REQUEST['board_link']);
				$_REQUEST['documents']=json_encode($_REQUEST['documents']);
				$_REQUEST['notes']=json_encode($_REQUEST['notes']);
				$_REQUEST['certificate_duration']=json_encode($_REQUEST['certificate_duration']);
				$_REQUEST['recertification_date']=json_encode($_REQUEST['recertification_date']);
				$_REQUEST['moc_occ_status']=json_encode($_REQUEST['moc_occ_status']);
				$_REQUEST['meeting_moc_occ']=json_encode($_REQUEST['meeting_moc_occ']);
				$_REQUEST['moc_occ_verifiaction_date']=json_encode($_REQUEST['moc_occ_verifiaction_date']);
				$_REQUEST['annual_reverifiaction_date']=json_encode($_REQUEST['annual_reverifiaction_date']);
			}

			if($call_to_action=="update_practice_employer")
			{
				$_REQUEST['practice_type']=json_encode($_REQUEST['practice_type']);
				$_REQUEST['start_date']=json_encode($_REQUEST['start_date']);
				$_REQUEST['end_date']=json_encode($_REQUEST['end_date']);
				$_REQUEST['practice_name']=json_encode($_REQUEST['practice_name']);
				$_REQUEST['address_line_1']=json_encode($_REQUEST['address_line_1']);
				$_REQUEST['address_line_2']=json_encode($_REQUEST['address_line_2']);
				$_REQUEST['address_city']=json_encode($_REQUEST['address_city']);
				$_REQUEST['address_state']=json_encode($_REQUEST['address_state']);
				$_REQUEST['address_country']=json_encode($_REQUEST['address_country']);
				$_REQUEST['address_zipcode']=json_encode($_REQUEST['address_zipcode']);
				$_REQUEST['reason_deaprture']=json_encode($_REQUEST['reason_deaprture']);
				$_REQUEST['hr_contact_name']=json_encode($_REQUEST['hr_contact_name']);
				$_REQUEST['hr_contract_start_date']=json_encode($_REQUEST['hr_contract_start_date']);
				$_REQUEST['hr_title']=json_encode($_REQUEST['hr_title']);
				$_REQUEST['hr_email']=json_encode($_REQUEST['hr_email']);
				$_REQUEST['hr_phone']=json_encode($_REQUEST['hr_phone']);
				
			}
			if($call_to_action=="update_hospital_facility")
			{
				if(!isset($_REQUEST['is_primary_affiliation'])){$_REQUEST['is_primary_affiliation']=array();}
				if(!isset($_REQUEST['is_currently_affiliated'])){$_REQUEST['is_currently_affiliated']=array();}

				$_REQUEST['start_date']=json_encode($_REQUEST['start_date']);
				$_REQUEST['end_date']=json_encode($_REQUEST['end_date']);
				$_REQUEST['hospital_affiliation']=json_encode($_REQUEST['hospital_affiliation']);
				$_REQUEST['address_line_1']=json_encode($_REQUEST['address_line_1']);
				$_REQUEST['address_line_2']=json_encode($_REQUEST['address_line_2']);
				$_REQUEST['address_city']=json_encode($_REQUEST['address_city']);
				$_REQUEST['address_state']=json_encode($_REQUEST['address_state']);
				$_REQUEST['address_country']=json_encode($_REQUEST['address_country']);
				$_REQUEST['address_zipcode']=json_encode($_REQUEST['address_zipcode']);
				$_REQUEST['staff_category']=json_encode($_REQUEST['staff_category']);
				$_REQUEST['is_primary_affiliation']=json_encode($_REQUEST['is_primary_affiliation']);
				$_REQUEST['is_currently_affiliated']=json_encode($_REQUEST['is_currently_affiliated']);
				
			}

			if($call_to_action=="update_state_selection")
			{
				

				$_REQUEST['state_id']=json_encode($_REQUEST['state_id']);
				
				
			}
			if($call_to_action=="update_questions")
			{
				

				$_REQUEST['question_id']=json_encode($_REQUEST['question_id']);
				$_REQUEST['answer']=json_encode($_REQUEST['answer']);
				
				
			}
			if($call_to_action=="update_state_board")
			{
				

				$_REQUEST['website']=json_encode($_REQUEST['website']);
				$_REQUEST['user_name']=json_encode($_REQUEST['user_name']);
				$_REQUEST['password']=json_encode($_REQUEST['password']);
				// $_REQUEST['favorite_color']=($_REQUEST['favorite_color']);
				// $_REQUEST['favorite_pet_name']=($_REQUEST['favorite_pet_name']);
				// $_REQUEST['significant_meet']=($_REQUEST['significant_meet']);
				// $_REQUEST['vacation_destination']=($_REQUEST['vacation_destination']);
				// $_REQUEST['favorite_teacher']=($_REQUEST['favorite_teacher']);
				// $_REQUEST['father_middle_name']=($_REQUEST['father_middle_name']);
				// $_REQUEST['mother_middle_name']=($_REQUEST['mother_middle_name']);
				// $_REQUEST['born_hospital']=($_REQUEST['born_hospital']);
				// $_REQUEST['mother_born_city']=($_REQUEST['mother_born_city']);
				// $_REQUEST['last_name_bf_gf']=($_REQUEST['last_name_bf_gf']);
				// $_REQUEST['city_first_job']=($_REQUEST['city_first_job']);
				// $_REQUEST['street_name_grew_up']=($_REQUEST['street_name_grew_up']);
				// $_REQUEST['highschool_mascot']=($_REQUEST['highschool_mascot']);
				// $_REQUEST['make_model_first_car']=($_REQUEST['make_model_first_car']);
				// $_REQUEST['company_name_first_job']=($_REQUEST['company_name_first_job']);
				
			}
			if($call_to_action=="update_licensure")
			{
				$_REQUEST['license_type']=json_encode($_REQUEST['license_type']);
				$_REQUEST['issue_date']=json_encode($_REQUEST['issue_date']);
				$_REQUEST['expiry_date']=json_encode($_REQUEST['expiry_date']);
				$_REQUEST['license_state']=json_encode($_REQUEST['license_state']);
				$_REQUEST['license_no']=json_encode($_REQUEST['license_no']);
				$_REQUEST['primary_license']=json_encode($_REQUEST['primary_license']);
				$_REQUEST['compact_license']=json_encode($_REQUEST['compact_license']);
				$_REQUEST['license_status']=json_encode($_REQUEST['license_status']);

				
				
			}
			if($call_to_action=="update_personal_reference")
			{
				$_REQUEST['title']=json_encode($_REQUEST['title']);
				$_REQUEST['first_name']=json_encode($_REQUEST['first_name']);
				// $_REQUEST['middle_name']=json_encode($_REQUEST['middle_name']);
				$_REQUEST['address_line_1']=json_encode($_REQUEST['address_line_1']);
				$_REQUEST['address_line_2']=json_encode($_REQUEST['address_line_2']);
				$_REQUEST['address_city']=json_encode($_REQUEST['address_city']);
				$_REQUEST['address_state']=json_encode($_REQUEST['address_state']);
				$_REQUEST['address_country']=json_encode($_REQUEST['address_country']);
				$_REQUEST['address_zipcode']=json_encode($_REQUEST['address_zipcode']);
				$_REQUEST['last_name']=json_encode($_REQUEST['last_name']);
				$_REQUEST['company_name']=json_encode($_REQUEST['company_name']);
				$_REQUEST['email']=json_encode($_REQUEST['email']);
				$_REQUEST['phone']=json_encode($_REQUEST['phone']);

								
			}

			if($call_to_action=="update_role_access")
			{
				$_REQUEST['role_access']=json_encode($_REQUEST['role_access']);				
			}
			
			$cur_API_URL=$action_API_list[($call_to_action)];
			
			$APIReturnDataJSON=CallAPI($API_Call_Method, $cur_API_URL, $_REQUEST);
			$APIReturnDataArr=(array) json_decode($APIReturnDataJSON);
			if(isset($APIReturnDataArr['code']) && $APIReturnDataArr['code']=="1")
			{
				$redirect_url=$redirect_url_success;
				$ret_msg_type="success";
			}else
			{
				$redirect_url=$redirect_url_error;
				$ret_msg_type="error";
			}
			$ret_msg=$APIReturnDataArr['message'];
			// print_r($APIReturnDataJSON);
		}
		
		
	}
	
} 
$_SESSION['me_custom_error']['msg_type']=$ret_msg_type;
$_SESSION['me_custom_error']['err_msg']=$ret_msg;
// print_r($_SESSION);
// echo $redirect_url;
header("Location:".$redirect_url);
?>