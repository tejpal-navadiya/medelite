<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../config.php');
include('../../helper/functions.php');

	// include('../../config/config.php');
	// include('../../helper/functions.php');
	// load_config("1","1","1","1","1");

	use Rakit\Validation\Validator;

	$code = 0;
	$data = new stdClass();
	$status_code = 200;
	$errors = [];

	try{
		$headers = apache_request_headers();
		
			
		$created_at=date('Y-m-d H:i:s');
		
		$updated_at=$created_at;
		
				$validator = new Validator;
				$validation = $validator->make($_POST + $_FILES, [
				    'ids' => 'required|json',
				]);
				
				$validation->validate();
				if ($validation->fails()) {
				    $getErrors = $validation->errors();
				    $errors = $getErrors->firstOfAll();
				    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
				}				
				$ids=$_REQUEST['ids'];
				// deleteSites($conn, $org_id, $token_id, $_POST['ids']);
				$ids = json_decode($ids);
				foreach ($ids as $id) 
				{
					$lead_detail_qry = "SELECT * FROM me_degree WHERE id=?  limit 1";
					$lead_data_result = prepared_query($conn, $lead_detail_qry, [$id]);
					$lead_data = $lead_data_result->get_result()->fetch_assoc();
					if($lead_data){
						
						$remove_lead = "UPDATE me_degree SET is_deleted=?, updated_at=? WHERE id=? ";
						$is_deleted = prepared_query($conn, $remove_lead, [1, $updated_at, $id])->affected_rows;

						
					}
				}
				$data=array();
				$data=$ids;
				$code = 1;
				$message = "degree deleted successfully.";
	        
		
	    apiResponse($code, $message, "", "", $data, $status_code);
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
	}
?>