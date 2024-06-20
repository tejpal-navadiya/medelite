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
				try{
				   $pdoconn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8","$username","$password");
				   $pdoconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				}catch(PDOException $e){
				   die('Unable to connect with the database');
				}
				
				## Read value
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
				$filterValue = $_POST['filter_type']; // filter value

				## Search 
				$searchArray = array();
				$searchQuery = " ";
				if($searchValue != ''){
				   $searchQuery = " AND (
				        application_type LIKE :application_type 
				       ) ";
				    $searchArray = array( 
				       
				        'application_type'=>"%$searchValue%",
				       
				    );
				}

				$filterQuery = " ";
				if($filterValue != ''){
					$filterQuery = " AND type = '$filterValue' ";
				}

				## Total number of records without filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_onboarding_application WHERE firm_id=".$firm_id." ".$filterQuery);
				$stmt->execute();
				$records = $stmt->fetch();
				$totalRecords = $records['allcount'];

				## Total number of records with filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_onboarding_application WHERE firm_id=".$firm_id." ".$searchQuery." ".$filterQuery);
				$stmt->execute($searchArray);
				$records = $stmt->fetch();
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$stmt = $pdoconn->prepare("SELECT * FROM me_onboarding_application WHERE firm_id=".$firm_id." ".$filterQuery." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

				// Bind values
				foreach($searchArray as $key=>$search){
				    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
				}

				$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
				$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
				$stmt->execute();
				$applications = $stmt->fetchAll();

				$data = array();
				foreach($applications as $row){
					$data[] = array(
				   		"id" => $row['id'],
				      	"firm_id" => $row['firm_id'],
				      	"application_type" => $row['application_type'],
				      	"provider_name" => $row['provider_name'],
				      	"organization" => $row['organization'],
				      	"submission_date" => $row['submission_date'],
				      	// "phone" => $row['phone'],
				      	// "email" => $row['email'],
				      	// "address" => $row['address'],
				      	// "status" => $row['status'],
				   	);
				}

				$response = array(
				    "draw" => intval($draw),
				    "iTotalRecords" => $totalRecords,
				    "iTotalDisplayRecords" => $totalRecordwithFilter,
				    "aaData" => $data
				);

				echo json_encode($response); die();
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
