<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	include('../tasks.php');

	use Rakit\Validation\Validator;
	use Carbon\Carbon;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$headers = apache_request_headers();
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			// $firm_id = getFirmFromUserId($conn, $token_id);
			if($apitoken && $token_id && $firm_id){
				$validator = new Validator;
				$validation = $validator->make($_POST + $_FILES, [
					'mid' => 'required',
					'mname' => 'required',
				]);
				
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}

				$id = $_POST['mid'];
				$user_type_data_qry = "SELECT mid, mname FROM admin_menu WHERE mid=? limit 1";
				$user_type_data_result = prepared_select($conn, $user_type_data_qry, [$id]);
				if($user_type_data_result->num_rows){
					$user_type_data = $user_type_data_result->fetch_assoc();

					$mname = $_POST['mname'];
					$mtitle = $_POST['mtitle'];
					$pmenu = $_POST['pmenu'];
					

					

					// print_r($_POST);

					$update_type_qry = "UPDATE admin_menu SET mname=?,mtitle=?,pmenu=? WHERE mid=? ";
					$is_updated = prepared_query(
													$conn,
													$update_type_qry,
													[$mname,$mtitle,$pmenu, $id])->errno;
					if($is_updated){
						$message = "Something went wrong.";
					}else{
						

						// $task_log_data_qry = "SELECT tasks.*, m.name as matter_name, cb.name as cb_name
						// 					FROM tasks
						// 					LEFT JOIN matters m on m.id = tasks.matter_id 
						// 					LEFT JOIN users cb on cb.id = tasks.created_by 
						// 					WHERE tasks.id=? limit 1";
						// $task_log_data_result = prepared_select($conn, $task_log_data_qry, [$id]);
						// if($task_log_data_result->num_rows){
						// 	$task_log_data = $task_log_data_result->fetch_assoc();

						// 	$log_user_qry = "SELECT id, name FROM users WHERE id=?";
						// 	$log_user_result = prepared_select($conn, $log_user_qry, [$updated_by]);
						// 	$log_user_data = $log_user_result->fetch_assoc();
						// 	$log_user_name = $log_user_data['name'] ?:"";
						// 	$log_description = $log_user_name." updated a task, ".$task_log_data['name'];
						// 	if($task_log_data['matter_name']){
						// 		$log_description .= ", for the matter '".$task_log_data['matter_name']."'";						
						// 	}
						// 	saveLog($conn, $firm_id, $updated_by, "updated", $id, "tasks", "", $log_description);
						// }


						$code = 1;
						$message = "Menu updated successfully.";
					}
				}else{
					$message = "Menu not found.";
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