<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	// include('../task.php');

	use Rakit\Validation\Validator;
	use Carbon\Carbon;
	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$headers = apache_request_headers();
		

		function ConvertDecimalHours($time)
		{
			$hms = explode(":", $time);
			return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
		}
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			$firm_id = getFirmFromUserId($conn, $token_id);
			// $default_date_format=getDateFormatFromUserId($conn, $token_id);
			if($apitoken && $token_id){
				$validator = new Validator;
				$validation = $validator->make($_GET, [
				    'id' => 'required'
				]);
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}
				
				$ac_data_qry = "SELECT 
                    l.*, 
                    n.note, 
                    n.note_date, 
                    n.note_issue_date, 
                    n.followup_type, 
                    n.note_exp_date, 
                    n.note_last_updated, 
                    d.doc_date, 
                    d.document_type, 
                    d.doc_exp_date, 
                    d.doc_last_updated ,
					d.receipt_amount ,
					l.primary_check

                FROM 
                    me_licenses_list l

                LEFT JOIN 
                    me_licenses_note n ON l.id = n.id
                LEFT JOIN 
                    me_licenses_supporting_docs d ON l.id = d.id
                WHERE 
                    l.id=? 
                LIMIT 1";
// print_r($ac_data_qry);
// exit;
				$ac_data_result = prepared_select($conn, $ac_data_qry, [$_GET['id']]);
				if($ac_data_result->num_rows)
				{
					$data = $ac_data_result->fetch_assoc();
					
					

					$code = 1;
					$message = "Data get successfully.";
				}else{
					$message = "Data not exist.";
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