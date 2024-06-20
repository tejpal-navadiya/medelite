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
				if(!isset($_POST['search']['value']))
				{
					$searchValue = $_POST['search']; // Search value
				}else
				{
					$searchValue = $_POST['search']['value']; // Search value
				}
				$filterValue = $_POST['filter_type']; // filter value

				## Search 
				$searchArray = array();
				$searchQuery = " ";
				if($searchValue != ''){
				   $searchQuery = " AND (name LIKE :name OR 
				        middle_name LIKE :middle_name OR 
				        last_name LIKE :last_name) ";
				    $searchArray = array( 
				        'name'=>"%$searchValue%", 
				        'middle_name'=>"%$searchValue%",
				        'last_name'=>"%$searchValue%",
				    );
				}

				$filterQuery = " ";
				if($filterValue != ''){
					$filterQuery = " AND type = '$filterValue' ";
				}

				## Total number of records without filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_contacts WHERE is_deleted=0 AND firm_id=".$firm_id." ".$filterQuery);
				$stmt->execute();
				$records = $stmt->fetch();
				$totalRecords = $records['allcount'];

				## Total number of records with filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_contacts WHERE is_deleted=0 AND firm_id=".$firm_id." ".$searchQuery." ".$filterQuery);
				$stmt->execute($searchArray);
				$records = $stmt->fetch();
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				// $stmt = $pdoconn->prepare("SELECT contacts.*, contact_phones.phone, contact_emails.email, contact_addresses.street, contact_addresses.city, contact_addresses.state, contact_addresses.zip FROM me_contacts LEFT JOIN contact_phones on contacts.id = contact_phones.contact_id LEFT JOIN contact_emails on contacts.id = contact_emails.contact_id LEFT JOIN contact_addresses on contacts.id = contact_addresses.contact_id WHERE contacts.is_deleted=0  AND contacts.firm_id=".$firm_id." AND contact_phones.is_primary=1 AND contact_phones.is_deleted=0 AND contact_emails.is_primary=1 AND contact_emails.is_deleted=0 ".$filterQuery." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

				$stmt = $pdoconn->prepare("SELECT * FROM me_contacts  WHERE is_deleted=0  AND firm_id=".$firm_id." ".$filterQuery." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
					$phone = "";
					$email = "";
					$street = "";
					$city = "";
					$state = "";
					$zip = "";
					$country_name = "";

					$contact_add_qry = "SELECT contact_addresses.*, c.name as country_name, s.name as state_name FROM contact_addresses LEFT JOIN countries c on c.id = contact_addresses.country_id LEFT JOIN states s on s.id = contact_addresses.state  WHERE contact_addresses.contact_id=? AND contact_addresses.is_deleted=0 limit 1";
					$contact_add_result = prepared_select($conn, $contact_add_qry, [$row_id]);
					if($contact_add_result->num_rows){
						$add_data = $contact_add_result->fetch_assoc();
						$street = $add_data['street'];
						$city = $add_data['city'];
						$state = $add_data['state_name'];
						$zip = $add_data['zip'];
						$country_name = $add_data['country_name'];
					}

					$contact_email_qry = "SELECT * FROM contact_emails WHERE contact_id=? AND is_deleted=0 AND is_primary='1' limit 1";
					$contact_email_result = prepared_select($conn, $contact_email_qry, [$row_id]);
					if($contact_email_result->num_rows){
						$email_data = $contact_email_result->fetch_assoc();
						$email = $email_data['email'];
					}

					$contact_phone_qry = "SELECT * FROM contact_phones WHERE contact_id=? AND is_deleted=0 AND is_primary='1' limit 1";
					$contact_phone_result = prepared_select($conn, $contact_phone_qry, [$row_id]);
					if($contact_phone_result->num_rows){
						$phone_data = $contact_phone_result->fetch_assoc();
						$phone = $phone_data['phone'];
					}

					$is_client = 0;
					$contact_matter_qry = "SELECT * FROM matters WHERE client_id=? AND is_deleted=0";
					$contact_matter_result = prepared_select($conn, $contact_matter_qry, [$row_id]);
					if($contact_matter_result->num_rows){
						$is_client = 1;
					}

					// $contact_web_qry = "SELECT * FROM contact_websites WHERE contact_id=? AND is_deleted=0 AND is_primary='1' limit 1";
					// $contact_web_result = prepared_select($conn, $contact_web_qry, [$row_id]);
					// if($contact_web_result->num_rows){
					// 	$web_data = $contact_web_result->fetch_assoc();
					// 	$web = $web_data['website'];
					// }

					$address = "";
					$address .= $street ? $street."," : "";
					$address .= $city ? $city."," : "";
					$address .= $state ? $state."," : "";
					$address .= $zip ? $zip."," : "";
					$address .= $country_name ? $country_name : "";

				   	$data[] = array(
				   		"id" => $row['id'],
				      	"firm_id" => $row['firm_id'],
				      	"type" => $row['type'],
				      	"name" => $row['name'],
				      	"middle_name" => $row['middle_name'],
				      	"last_name" => $row['last_name'],
				      	"phone" => $phone,
				      	"email" => $email,
				      	"address" => $address,
				      	"is_client" => $is_client,
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