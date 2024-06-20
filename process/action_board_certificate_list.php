<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ob_start();
include('../config.php');
include('../helper/functions.php');

// use Rakit\Validation\Validator;



	$code = 0;

	$data = new stdClass();

	$status_code = 200;

	$errors = [];




$is_deleted="0";
$created_at=date('Y-m-d H:i:s');
// $created_by=$_SESSION['medelite']['me_admin'];
$form_id=$_REQUEST['form_id'];
// $cur_is_meeting_moc=mysqli_real_escape_string($conn,$_REQUEST['is_meeting_moc']);

$cur_is_primary=mysqli_real_escape_string($conn,$_REQUEST['is_primary']);
$cur_is_board_eligible=mysqli_real_escape_string($conn,$_REQUEST['is_board_eligible']);
$cur_is_meeting_moc=mysqli_real_escape_string($conn,$_REQUEST['is_meeting_moc']);
// $cur_is_indefinite=mysqli_real_escape_string($conn,$_REQUEST['is_indefinite']);
$cur_is_member_medical_board=mysqli_real_escape_string($conn,$_REQUEST['is_member_medical_board']);
$cur_board_name=mysqli_real_escape_string($conn,$_REQUEST['board_name']);
$cur_specialty=mysqli_real_escape_string($conn,$_REQUEST['specialty']);
$cur_issue_date=mysqli_real_escape_string($conn,$_REQUEST['issue_date']);
$cur_certificate_duration=mysqli_real_escape_string($conn,$_REQUEST['certificate_duration']);
$cur_expiry_date=mysqli_real_escape_string($conn,$_REQUEST['expiry_date']);
$cur_certificate_no=mysqli_real_escape_string($conn,$_REQUEST['certificate_no']);
$cur_focus=mysqli_real_escape_string($conn,$_REQUEST['focus']);
$cur_exam_passed=mysqli_real_escape_string($conn,$_REQUEST['exam_passed']);
$cur_board_link=mysqli_real_escape_string($conn,$_REQUEST['board_link']);
$cur_documents=mysqli_real_escape_string($conn,$_REQUEST['documents']);
$cur_certificate_status=mysqli_real_escape_string($conn,$_REQUEST['certificate_status']);
$cur_recertification_date=mysqli_real_escape_string($conn,$_REQUEST['recertification_date']);

$cur_moc_occ_status=mysqli_real_escape_string($conn,$_REQUEST['moc_occ_status']);
$cur_meeting_moc_occ=mysqli_real_escape_string($conn,$_REQUEST['meeting_moc_occ']);
$cur_moc_occ_verifiaction_date=mysqli_real_escape_string($conn,$_REQUEST['moc_occ_verifiaction_date']);
$cur_annual_reverifiaction_date=mysqli_real_escape_string($conn,$_REQUEST['annual_reverifiaction_date']);
$updated_at=$created_at;
// $exname=$_SESSION['mrdelite']['car_'];
// print_r($_REQUEST);
// exit;

$upload_path = "../uploads/";



// $is_ok_update="1";

$date_added=date('Y-m-d H:i:s');

$headers = apache_request_headers();

		if(isset($headers['Apitoken']) || isset($headers['apitoken']) || isset($_REQUEST['apitoken']))
		{
			$headers['apitoken']=$_REQUEST['apitoken'];

			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];

			$token_id = checkToken($conn, $apitoken);

			$firm_id = getFirmFromUserId($conn, $token_id);
// print_r($firm_id);
// exit;
			if($apitoken ){

				$validator = new Validator;

				$validation = $validator->make($_POST + $_FILES, [

					'form_id' => 'required',

				]);

            }
        }

				// $validation->validate();

				// if ($validation->fails()) {

				//     $getErrors = $validation->errors();

				//     $errors = $getErrors->firstOfAll();

				//     apiResponse($code, $message, "", "", $data, $status_code, $errors); die();

				// }
                        if(isset($_REQUEST['id']))

                        {

                            $id = $_REQUEST['id'];

                            $update = "UPDATE me_onboarding_board_certification 
                                    SET 
                                    is_primary = '$cur_is_primary',
                                    is_board_eligible = '$cur_is_board_eligible',
                                    is_meeting_moc = '$cur_is_meeting_moc',
                                    is_member_medical_board = '$cur_is_member_medical_board',
                                    board_name = '$cur_board_name',
                                    specialty = '$cur_specialty',
                                    issue_date = '$cur_issue_date',
                                    certificate_duration = '$cur_certificate_duration',
									expiry_date = '$cur_expiry_date',
                                    certificate_no = '$cur_certificate_no',
                                    focus = '$cur_focus',
									exam_passed = '$cur_exam_passed',
                                    board_link = '$cur_board_link',
                                    documents = '$cur_documents',
                                    certificate_status = '$cur_certificate_status',
									recertification_date = '$cur_recertification_date',
                                    moc_occ_status = '$cur_moc_occ_status',
                                    meeting_moc_occ = '$cur_meeting_moc_occ',
									moc_occ_verifiaction_date = '$cur_moc_occ_verifiaction_date',
                                    annual_reverifiaction_date = '$cur_annual_reverifiaction_date',
                                WHERE id = '$id'";


                            $query = mysqli_query($conn,$update)or die(mysqli_error($conn));

                            if($query)
                            {
                                $_SESSION['msg'] = "done";
                            } else {

                                $_SESSION['msg'] = "error";

                            }

                        } else {

                            

                                $insert = "INSERT INTO me_onboarding_board_certification (firm_id, form_id, is_primary,is_board_eligible,is_meeting_moc,is_member_medical_board,board_name,specialty,issue_date,expiry_date,certificate_no,focus,certificate_status,exam_passed,board_link,documents,certificate_duration,recertification_date,moc_occ_status,meeting_moc_occ,moc_occ_verifiaction_date,annual_reverifiaction_date, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_is_primary','$cur_is_board_eligible','$cur_is_meeting_moc','$cur_is_member_medical_board','$cur_board_name','$cur_specialty','$cur_issue_date','$cur_expiry_date','$cur_certificate_no','$cur_focus','$cur_certificate_status','$cur_exam_passed','$cur_board_link','$cur_documents','$cur_certificate_duration','$cur_recertification_date','$cur_moc_occ_status','$cur_meeting_moc_occ','$cur_moc_occ_verifiaction_date','$cur_annual_reverifiaction_date','$created_by','$created_at')";

                                $query = mysqli_query($conn,$insert)or die(mysqli_error($conn));

                                $id = mysqli_insert_id($conn);

                                

                        }

                            

                        if(isset($query))
                        {

                            if($query)
                            {

                                $_SESSION['msg'] = "done";

                                

                            } else {

                                $_SESSION['msg'] = "error";

                            }

                        }else
                        {

                            $_SESSION['msg'] = "error";	

                        }


header("issue_date:../index.php?pid=boarding_form_list");


?>