<?php 

	include('../../config.php');

	include('../../helper/functions.php');

	include('../task.php');



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

			//$firm_id = getFirmFromUserId($conn, $token_id);

			if($apitoken && $token_id){

				$validator = new Validator;

				$validation = $validator->make($_POST + $_FILES, [
					'state' => 'required',
				]);

				

				$validation->validate();

				if ($validation->fails()) {

				    $getErrors = $validation->errors();

				    $errors = $getErrors->firstOfAll();

				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();

				}



				$id = $_POST['id'];

				// $ac_data_qry = "SELECT id FROM verifictaion_request  WHERE id=? AND firm_id=? limit 1";
				$ac_data_qry = "SELECT id FROM verifictaion_request  WHERE id=? limit 1";

				$ac_data_result = prepared_select($conn, $ac_data_qry, [$id]);

				if($ac_data_result->num_rows){

					
					if(isset($_REQUEST['form'])){$form=$_REQUEST['form'];}else{$form="";}
					if(isset($_REQUEST['link'])){$link=$_REQUEST['link'];}else{$link="";}
					if(isset($_REQUEST['fee'])){$fee=$_REQUEST['fee'];}else{$fee="";}
					if(isset($_REQUEST['note'])){$note=$_REQUEST['note'];}else{$note="";}
					if(isset($_REQUEST['request_type'])){$request_type=$_REQUEST['request_type'];}else{$request_type="";}
					if(isset($_REQUEST['request_method'])){$request_method=$_REQUEST['request_method'];}else{$request_method="";}
					if(isset($_REQUEST['email'])){$email=$_REQUEST['email'];}else{$email="";}
					if(isset($_REQUEST['provider_name'])){$provider_name=$_REQUEST['provider_name'];}else{$provider_name="";}
					if(isset($_REQUEST['documents'])){$documents=$_REQUEST['documents'];}else{$documents="";}
					if(isset($_REQUEST['state'])){$state=$_REQUEST['state'];}else{$state="";}
					if(isset($_REQUEST['date_created'])){$date_created=$_REQUEST['date_created'];}else{$date_created="";}
					if(isset($_REQUEST['date_completed'])){$date_completed=$_REQUEST['date_completed'];}else{$date_completed="";}
				
					
			

					//$updated_by = $token_id;
					$updated_at=date('Y-m-d H:i:s');


					$update_pa_qry = "UPDATE verifictaion_request SET form='$form', link='$link', fee='$fee', note='$note', email='$email', provider_name='$provider_name', documents='$documents', state='$state', request_type='$request_type', request_method='$request_method', date_created='$date_created', date_completed='$date_completed', WHERE id='$id'  ";

					$is_updated = mysqli_query($conn,$update_pa_qry);
					
					//print_r($update_pa_qry);
				
					if($is_updated)
					{
						$data=array();
						$data['post']=$_POST;
						$code = 1;
						$message = "Details updated successfully.";
					}else
					{
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