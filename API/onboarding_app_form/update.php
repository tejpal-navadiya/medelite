




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

    $apitoken = null;
    if (isset($headers['Apitoken'])) {
        $apitoken = $headers['Apitoken'];
    } elseif (isset($headers['apitoken'])) {
        $apitoken = $headers['apitoken'];
    } elseif (isset($_REQUEST['apitoken'])) {
        $apitoken = $_REQUEST['apitoken'];
    }

    if ($apitoken) {
        $token_id = checkToken($conn, $apitoken);
        $firm_id = getFirmFromUserId($conn, $token_id);

        if ($token_id && $firm_id) {
            $validator = new Validator;
            $validation = $validator->make($_POST + $_FILES, [
                'provider_name' => 'required',
            ]);

            $validation->validate();
            if ($validation->fails()) {
                $getErrors = $validation->errors();
                $errors = $getErrors->firstOfAll();
                apiResponse($code, $message, "", "", $data, $status_code, $errors);
                die();
            }
				$id = $_POST['id'];

				$ac_data_qry = "SELECT id FROM me_onboarding_application WHERE id=?";

				$ac_data_result = prepared_select($conn, $ac_data_qry, [$id]);

				if($ac_data_result->num_rows){

					$application_type = $_POST['application_type'];
					$organization = $_POST['organization'];
					$provider_name = $_POST['provider_name'];
					$submission_date = $_POST['submission_date'];
					$application_status = $_POST['application_status'];
					$follow_up_time = $_POST['follow_up_time'];
					$follow_up_date = $_POST['follow_up_date'];
					$application_method = $_POST['application_method'];
					$specialist_reviewed = $_POST['specialist_reviewed'];
					$web_contact_info = $_POST['web_contact_info'];
			

					$updated_by = $token_id;
					$updated_at=date('Y-m-d H:i:s');


					// $update_pa_qry = "UPDATE me_provider SET title=?, case_id=?, date=?, description=?, updated_by=?, updated_at=? WHERE id=? ";

					// $is_updated = prepared_query($conn,$update_pa_qry,[$title, $case_id, $date, $description, $updated_by,$updated_at, $id],"sissisi")->errno;
					$is_updated = mysqli_query($conn,"UPDATE me_onboarding_application SET application_type='$application_type',provider_name='$provider_name',organization='$organization',submission_date='$submission_date',application_status='$application_status',follow_up_time='$follow_up_time',follow_up_date='$follow_up_date',application_method='$application_method',specialist_reviewed='$specialist_reviewed',web_contact_info='$web_contact_info', updated_by='$updated_by', updated_at='$updated_at' WHERE id='$id'");

					if($is_updated){

						$data=array();
						$data['post']=$_POST;

						$code = 1;

						$message = "Details updated successfully.";

					}else{

						$message = "Something went wrong.";

						
						

					}

				}else{

					$message = "Details not found.";

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





























