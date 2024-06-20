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
		if($_POST['search']){
			$searchValue = $_POST['search'];
			$search_qry = " AND (name LIKE '%".$searchValue."%')";
		}

		if($_POST['page_limit'] == "0"){
			$country_data_qry = $conn->prepare("SELECT id, name, code FROM me_countries WHERE id>0 AND is_deleted='0' ".$search_qry);
		}else{
			$country_data_qry = $conn->prepare("SELECT id, name, code FROM me_countries WHERE id>0 AND is_deleted='0' ".$search_qry." limit ?,?");
			$country_data_qry->bind_param("ii", $page_offset, $page_limit);
		}
		$country_data_qry->execute();
		$country_data_result = $country_data_qry->get_result();
		$me_countries = $country_data_result->fetch_all(MYSQLI_ASSOC);

		$total_country_qry = $conn->prepare("SELECT id FROM me_countries WHERE id>0 AND is_deleted='0' ".$search_qry);
		$total_country_qry->execute();
		$total_country_result = $total_country_qry->get_result();

		$total_rows = $total_country_result->num_rows;
		if($_POST['page_limit'] == "0"){
    		$total_page = 1;
    	}else{
    		$total_page = ceil($total_rows / $page_limit);
    	}

    	$data = array();
		foreach($me_countries as $row){
		   	$data[] = array(
		   		"id" => $row['id'],
		      	"text" => $row['name'],
		      	"code" => $row['code'],
		   	);
		}

    	$code = 1;
    	$message = "Data listed successfully.";
	    apiResponse($code, $message, $page_no, $total_page, $data, $status_code);
	} catch(Exception $e) {
	   $message = "Something went wrong";
	   apiResponse($code, $message, $page_no, $total_page, $data, $status_code, $errors); die();
	}
?>