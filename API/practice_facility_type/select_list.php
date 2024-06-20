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

		$search_qry = "";
		if(isset($_POST['search'])){
			$searchValue = $_POST['search'];
			$search_qry = " AND (name LIKE '%".$searchValue."%')";
		}

		if($_POST['page_limit'] == "0"){
			$state_data_qry = $conn->prepare("SELECT id, name FROM me_practice_facility_type WHERE id>0 AND is_deleted='0' ".$search_qry);
		}else{
			$state_data_qry = $conn->prepare("SELECT id, name FROM me_practice_facility_type WHERE id>0 AND is_deleted='0' ".$search_qry." limit ?,?");
			$state_data_qry->bind_param("ii", $page_offset, $page_limit);
		}
		$state_data_qry->execute();
		$state_data_result = $state_data_qry->get_result();
		$me_practice_facility_type = $state_data_result->fetch_all(MYSQLI_ASSOC);

		$total_state_qry = $conn->prepare("SELECT id FROM me_practice_facility_type WHERE id>0 AND is_deleted='0' ".$search_qry);
		$total_state_qry->execute();
		$total_state_result = $total_state_qry->get_result();

		$total_rows = $total_state_result->num_rows;
		if($_POST['page_limit'] == "0"){
    		$total_page = 1;
    	}else{
    		$total_page = ceil($total_rows / $page_limit);
    	}

    	$data = array();
		foreach($me_practice_facility_type as $row){
		   	$data[] = array(
		   		"id" => $row['id'],
		      	"text" => $row['name'],
		   	);
		}
		// print_r($data);
		
    	$code = 1;
    	$message = "Data listed successfully.";
	    apiResponse($code, $message, $page_no, $total_page, $data, $status_code);
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, $page_no, $total_page, $data, $status_code, $errors); die();
	}
?>