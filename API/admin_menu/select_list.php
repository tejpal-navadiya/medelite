<?php 
	include('../../config.php');
	include('../../helper/functions.php');

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
			// $firm_id = getFirmFromUserId($conn, $token_id);
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

				$search_qry = " AND is_deleted='0' ";
				if($_POST['search']){
					$searchValue = $_POST['search'];
					$search_qry = " AND (mtitle LIKE '%".$searchValue."%')";
				}

				$pa_data_qry = $conn->prepare("SELECT mid, mtitle FROM admin_menu WHERE mid>'0' ".$search_qry."  limit ?,?");
				$pa_data_qry->bind_param("ii", $page_offset, $page_limit);
				$pa_data_qry->execute();
				$pa_data_result = $pa_data_qry->get_result();
				$practice_areas = $pa_data_result->fetch_all(MYSQLI_ASSOC);

				$total_pa_qry = $conn->prepare("SELECT mid FROM admin_menu WHERE mid>'0' ".$search_qry." ");
				// $total_pa_qry->bind_param("i", 0);
				$total_pa_qry->execute();
				$total_pa_result = $total_pa_qry->get_result();

				$total_rows = $total_pa_result->num_rows;
		    	$total_page = ceil($total_rows / $page_limit);

		    	$data = array();
				foreach($practice_areas as $row){
				   	$data[] = array(
				   		"id" => $row['mid'],
				      	"text" => $row['mtitle'],
				   	);
				}

				// $user_data_qry = "SELECT id, name FROM users WHERE firm_id=?";
				// $user_data_result = prepared_select($conn, $user_data_qry, [$firm_id]);
				// $user_data = $user_data_result->fetch_assoc();

				// $data = array(
				// 	array('id' => $token_id, 'text' => $user_data['name'])
				// );


				// $total_rows = 1;
		    	// $total_page = 1;

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