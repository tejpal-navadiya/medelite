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
// $cur_institute_type=mysqli_real_escape_string($conn,$_REQUEST['institute_type']);

$cur_exam_type=mysqli_real_escape_string($conn,$_REQUEST['exam_type']);
$cur_first_try_date=mysqli_real_escape_string($conn,$_REQUEST['first_try_date']);
$cur_score=mysqli_real_escape_string($conn,$_REQUEST['score']);
$cur_no_of_attempts=mysqli_real_escape_string($conn,$_REQUEST['no_of_attempts']);
$cur_is_passed=mysqli_real_escape_string($conn,$_REQUEST['is_passed']);
$cur_examination=mysqli_real_escape_string($conn,$_REQUEST['examination']);
$cur_exam_date=mysqli_real_escape_string($conn,$_REQUEST['exam_date']);
$cur_location=mysqli_real_escape_string($conn,$_REQUEST['location']);
$cur_notes=mysqli_real_escape_string($conn,$_REQUEST['notes']);

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

                            $update = "UPDATE me_onboarding_exam_history 
                                    SET 
                                    exam_type = '$cur_exam_type',
                                    first_try_date = '$cur_first_try_date',
                                    score = '$cur_score',
                                    no_of_attempts = '$cur_no_of_attempts',
                                    is_passed = '$cur_is_passed',
                                    examination = '$cur_examination',
                                    exam_date = '$cur_exam_date',
                                    location = '$cur_location',
                                    notes = '$cur_notes'
                                WHERE id = '$id'";


                            $query = mysqli_query($conn,$update)or die(mysqli_error($conn));

                            if($query)
                            {
                                $_SESSION['msg'] = "done";
                            } else {

                                $_SESSION['msg'] = "error";

                            }

                        } else {

                            

                                $insert = "INSERT INTO me_onboarding_exam_history (firm_id, form_id, exam_type,first_try_date,score,no_of_attempts,is_passed,examination,exam_date,location,notes, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_exam_type','$cur_first_try_date','$cur_score','$cur_no_of_attempts','$cur_is_passed','$cur_examination','$cur_exam_date','$cur_location','$cur_notes','$created_by','$created_at')";

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


header("location:../index.php?pid=boarding_form_list");


?>