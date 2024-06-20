<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	include('../task.php');

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
			$default_date_format=getDateFormatFromUserId($conn, $token_id);
			if($apitoken && $token_id && $firm_id){
				try{
				   $pdoconn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8","$username","$password");
				   $pdoconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				}catch(PDOException $e){
				   $message = "Something went wrong";
					apiResponse($code, $message, $page_no, $total_page, $data, $status_code, $errors); die();
				}

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

				## Read value
				$rowperpage = $_POST['page_limit'] ?: 10;
				$row = $rowperpage * ($page_no - 1);
				$columnName = $_POST['order_by'] ?: 'me_tasks.id';
				$columnSortOrder = $_POST['order'] ?: 'desc'; // asc or desc
				$searchValue = $_POST['search']; // Search value
				$filterValue = $_POST['type']; // filter value

				## Search 
				$searchArray = array();
				$searchQuery = " ";
				if($searchValue != ''){
				   $searchQuery = " AND (me_tasks.description LIKE :description) ";
				    $searchArray = array( 
				        'description'=>"%$searchValue%", 
				    );
				}

				$filterQuery = " ";
				if($filterValue != ''){
					// $filterQuery .= " AND me_tasks.type = '$filterValue' ";
				}
				

				$sel_firm_detail=mysqli_query($conn,"SELECT * from firms WHERE id='$firm_id'  ");
					
				if(mysqli_num_rows($sel_firm_detail)>0)
				{
					$fet_firm_details=mysqli_fetch_assoc($sel_firm_detail);
					
				}

				## Total number of records without filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_tasks WHERE is_deleted=0 ".$filterQuery." AND firm_id=".$firm_id);
				$stmt->execute();
				$records = $stmt->fetch();
				$totalRecords = $records['allcount'];

				## Total number of records with filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_tasks WHERE is_deleted=0 ".$filterQuery." AND firm_id=".$firm_id." ".$searchQuery);
				$stmt->execute($searchArray);
				$records = $stmt->fetch();
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$stmt = $pdoconn->prepare("SELECT me_tasks.*, m.name as case_name
											FROM me_tasks
											LEFT JOIN me_case m on m.id = me_tasks.case_id 
											WHERE me_tasks.is_deleted='0' AND me_tasks.firm_id='".$firm_id."' ".$filterQuery." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

				// Bind values
				foreach($searchArray as $key=>$search){
				    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
				}

				$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
				$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
				$stmt->execute();
				$me_tasks = $stmt->fetchAll();

				$data = array();
				foreach($me_tasks as $row)
				{
					
					
										
				   	$data[] = $row;
				}
				
				$total_page = ceil($totalRecordwithFilter / $rowperpage);
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