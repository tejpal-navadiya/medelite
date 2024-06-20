<?php 


// error_reporting(E_ALL);
// ini_set('display_errors', '1');


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
		
			$default_date_format="m/d/Y";
			
				try{
				   $pdoconn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8","$username","$password");
				   $pdoconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				}catch(PDOException $e){
				   die('Unable to connect with the database '.$e);
				}
				
				## Read value
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value
				$filterValue = $_POST['filter_type']; // filter value

				## Search 
				$searchArray = array();
				$searchQuery = " ";
				if($searchValue != ''){
				   $searchQuery = " AND ((name LIKE :name)) ";
				    $searchArray = array( 
				        'name'=>"%$searchValue%", 
				       
				    );
				}

				$filterQuery = "";
				// if($filterValue != ''){
				// 	$filterQuery = " AND subscriber_type = '$filterValue' ";
				// }

				## Total number of records without filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_provider_type WHERE  is_deleted='0'   ".$filterQuery);
				$stmt->execute();
				$records = $stmt->fetch();
				$totalRecords = $records['allcount'];

				## Total number of records with filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_provider_type WHERE  is_deleted='0'   ".$searchQuery." ".$filterQuery);
				$stmt->execute($searchArray);
				$records = $stmt->fetch();
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				// $stmt = $pdoconn->prepare("SELECT contacts.*, contact_phones.phone, contact_emails.email, contact_addresses.street, contact_addresses.city, contact_addresses.state, contact_addresses.zip FROM contacts LEFT JOIN contact_phones on contacts.id = contact_phones.contact_id LEFT JOIN contact_emails on contacts.id = contact_emails.contact_id LEFT JOIN contact_addresses on contacts.id = contact_addresses.contact_id WHERE contacts.is_deleted=0  AND contacts.org_id=".$org_id." AND contact_phones.is_primary=1 AND contact_phones.is_deleted=0 AND contact_emails.is_primary=1 AND contact_emails.is_deleted=0 ".$filterQuery." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

				$stmt = $pdoconn->prepare("SELECT * FROM me_provider_type  WHERE  is_deleted='0'   ".$filterQuery." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

				// , contact_phones.phone, contact_emails.email, contact_addresses.street, contact_addresses.city, contact_addresses.state, contact_addresses.zip
				// LEFT JOIN contact_phones on contacts.id = contact_phones.contact_id LEFT JOIN contact_emails on contacts.id = contact_emails.contact_id LEFT JOIN contact_addresses on contacts.id = contact_addresses.contact_id
				// AND contact_phones.is_primary=1 AND contact_phones.is_deleted=0 AND contact_emails.is_primary=1 AND contact_emails.is_deleted=0

				// Bind values
				foreach($searchArray as $key=>$search){
				    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
				}

				$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
				$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
				$stmt->execute();
				$contacts = $stmt->fetchAll();

				$data = array();
				foreach($contacts as $row){
					$row_id = $row['id'];
					
				   	$data[] = $row;
				}

				$response = array(
				    "draw" => intval($draw),
				    "iTotalRecords" => $totalRecords,
				    "iTotalDisplayRecords" => $totalRecordwithFilter,
				    "aaData" => $data
				);

				echo json_encode($response); die();
	        
	    apiResponse($code, $message, $page_no, $total_page, $data, $status_code);
	} catch(Exception $e) {
	   $message = "Something went wrong".$e;
	   apiResponse($code, $message, $page_no, $total_page, $data, $status_code, $errors); die();
	}
?>