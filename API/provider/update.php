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

		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){

			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];

			$token_id = checkToken($conn, $apitoken);

			$firm_id = getFirmFromUserId($conn, $token_id);

			if($apitoken && $token_id && $firm_id){

				$validator = new Validator;

				$validation = $validator->make($_POST + $_FILES, [
					'provider_name' => 'required',
				]);

				

				$validation->validate();

				if ($validation->fails()) {

				    $getErrors = $validation->errors();

				    $errors = $getErrors->firstOfAll();

				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();

				}



				$id = $_POST['id'];

				$ac_data_qry = "SELECT id FROM me_provider WHERE id=? AND firm_id=? limit 1";

				$ac_data_result = prepared_select($conn, $ac_data_qry, [$id, $firm_id]);

				if($ac_data_result->num_rows){

					$teams = $_POST['teams'];
					$tages = $_POST['tages'];
					$provider_name = $_POST['provider_name'];
					$provider_title = $_POST['provider_title'];
					$provider_email = $_POST['provider_email'];
					$speciality = $_POST['speciality'];

			

					$updated_by = $token_id;
					$updated_at=date('Y-m-d H:i:s');


					// $update_pa_qry = "UPDATE me_provider SET title=?, case_id=?, date=?, description=?, updated_by=?, updated_at=? WHERE id=? ";

					// $is_updated = prepared_query($conn,$update_pa_qry,[$title, $case_id, $date, $description, $updated_by,$updated_at, $id],"sissisi")->errno;
					$is_updated = mysqli_query($conn,"UPDATE me_provider SET teams='$teams', tages='$tages', provider_name='$provider_name', provider_title='$provider_title', provider_email='$provider_email', speciality='$speciality', updated_by='$updated_by', updated_at='$updated_at' WHERE id='$id' ");

					if($is_updated){

						$data=array();
						$data['post']=$_POST;

						$code = 1;

						$message = "Provider updated successfully.";

					}else{

						$message = "Something went wrong.";

						
						

					}

				}else{

					$message = "Task not found.";

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