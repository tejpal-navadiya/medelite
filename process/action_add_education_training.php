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

$cur_institute_type=mysqli_real_escape_string($conn,$_REQUEST['institute_type']);
$cur_start_date=mysqli_real_escape_string($conn,$_REQUEST['start_date']);
$cur_end_date=mysqli_real_escape_string($conn,$_REQUEST['end_date']);
$cur_institute_name=mysqli_real_escape_string($conn,$_REQUEST['institute_name']);
$cur_address_line_1=mysqli_real_escape_string($conn,$_REQUEST['address_line_1']);
$cur_address_line_2=mysqli_real_escape_string($conn,$_REQUEST['address_line_2']);
$cur_address_city=mysqli_real_escape_string($conn,$_REQUEST['address_city']);
$cur_address_state=mysqli_real_escape_string($conn,$_REQUEST['address_state']);
$cur_address_country=mysqli_real_escape_string($conn,$_REQUEST['address_country']);
$cur_address_zipcode=mysqli_real_escape_string($conn,$_REQUEST['address_zipcode']);
// $cur_degree=mysqli_real_escape_string($conn,$_REQUEST['degree']);
$cur_major=mysqli_real_escape_string($conn,$_REQUEST['major']);
$cur_program_completed=mysqli_real_escape_string($conn,$_REQUEST['program_completed']);
$cur_graduation_date=mysqli_real_escape_string($conn,$_REQUEST['graduation_date']);
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

                            $update = "UPDATE me_onboarding_education_training 
                                    SET 
                                    institute_type = '$cur_institute_type',
                                    start_date = '$cur_start_date',
                                    end_date = '$cur_end_date',
                                    institute_name = '$cur_institute_name',
                                    address_line_1 = '$cur_address_line_1',
                                    address_line_2 = '$cur_address_line_2',
                                    address_city = '$cur_address_city',
                                    address_state = '$cur_address_state',
                                    address_country = '$cur_address_country',
                                    address_zipcode = '$cur_address_zipcode',
                                    degree = '$cur_degree',
                                    major = '$cur_major',
                                    program_completed = '$cur_program_completed',
                                    graduation_date = '$cur_graduation_date',
                                    updated_by = '$updated_by',
                                    updated_at = '$updated_at'
                                WHERE id = '$id'";


                            $query = mysqli_query($conn,$update)or die(mysqli_error($conn));

                            if($query)
                            {
                                $_SESSION['msg'] = "done";
                            } else {

                                $_SESSION['msg'] = "error";

                            }

                        } else {

                            

                                $insert = "INSERT INTO me_onboarding_education_training (firm_id, form_id, institute_type,start_date,end_date,institute_name,address_line_1,address_line_2,address_city,address_state,address_country,address_zipcode,degree,major,program_completed,graduation_date, created_by, created_at) VALUES ('$firm_id','$form_id','$cur_institute_type','$cur_start_date','$cur_end_date','$cur_institute_name','$cur_address_line_1','$cur_address_line_2','$cur_address_city','$cur_address_state','$cur_address_country','$cur_address_zipcode','$cur_degree','$cur_major','$cur_program_completed','$cur_graduation_date','$created_by','$created_at')";

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