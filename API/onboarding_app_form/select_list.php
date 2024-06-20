<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	include('../contacts.php');

	use Rakit\Validation\Validator;
	use Carbon\Carbon;

	$code = 0;
	$data = array();
	$status_code = 200;
	$errors = [];
	$page_no = 1;
	$total_page = 0;

	try{
		$headers = apache_request_headers();
		if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
			$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
			$token_id = checkToken($conn, $apitoken);
			$firm_id = getFirmFromUserId($conn, $token_id);
			if($apitoken && $token_id && $firm_id){
				if(isset($_POST['page_no'])){
				    $page_no = filter_var($_POST['page_no'], FILTER_VALIDATE_INT,[
				        'options' => [
				            'default' => 1,
				            'min_range' => 1
				        ]
				    ]);
				}else{
				    $page_no = 1;
				}
				$page_limit = $_POST['page_limit'] ?: 10;
				$page_offset = $page_limit * ($page_no - 1);

				$type_qry = "";
				if($_POST['type']){
					$typeValue = $_POST['type'];
					$type_qry = " AND type = '".$typeValue."'";
				}

				$search_qry = "";
				if($_POST['search']){
					$searchValue = $_POST['search'];
					$search_qry = " AND (name LIKE '%".$searchValue."%' OR middle_name LIKE '%".$searchValue."%' OR last_name LIKE '%".$searchValue."%')";
				}

				if($_POST['page_limit'] == "0"){
					$contact_data_qry = $conn->prepare("SELECT id, name, last_name FROM me_contacts WHERE firm_id=? ".$type_qry." ".$search_qry." AND is_deleted !=1");
					$contact_data_qry->bind_param("i", $firm_id);	
				}else{
					$contact_data_qry = $conn->prepare("SELECT id, name, last_name FROM me_contacts WHERE firm_id=? ".$type_qry." ".$search_qry." AND is_deleted !=1 limit ?,?");
					$contact_data_qry->bind_param("iii", $firm_id, $page_offset, $page_limit);	
				}
				
				$contact_data_qry->execute();
				$contact_data_result = $contact_data_qry->get_result();
				$contacts = $contact_data_result->fetch_all(MYSQLI_ASSOC);

				$total_data_qry = $conn->prepare("SELECT id FROM me_contacts WHERE firm_id=? ".$type_qry." ".$search_qry." AND is_deleted !=1");
				$total_data_qry->bind_param("i", $firm_id);
				$total_data_qry->execute();
				$total_data_result = $total_data_qry->get_result();

				$total_rows = $total_data_result->num_rows;
				if($_POST['page_limit'] == "0"){
					$total_page = 1;
				}else{
					$total_page = ceil($total_rows / $page_limit);	
				}

		    	$data = array();
				foreach($contacts as $row){
				   	$data[] = array(
				   		"id" => $row['id'],
				      	"text" => $row['name']."".($row['last_name'] ? ' '.$row['last_name']:''),
				   	);
				}

		    	$code = 1;
		    	$message = "Data listed successfully.";
	        }else{
	        	$status_code = 401;
				$message = "Login expired or invalid token.";
			}	
		}else{
			$status_code = 401;
			$message = "Login expired or invalid token.";
		}
	    apiResponse($code, $message, $page_no, $total_page, $data, $status_code);
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, $page_no, $total_page, $data, $status_code, $errors); die();
	}
?>