<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	include('../verification_request.php');

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
			$default_date_format=getDateFormatFromUserId($conn, $token_id);
			if($apitoken && $token_id ){
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

				/*Get User Detail & Create condition */

				// $login_user_data_stmt = $pdoconn->prepare("SELECT * FROM me_users WHERE id=".$token_id);
				// $login_user_data_stmt->execute();
				// $login_user_data = $login_user_data_stmt->fetch();
				$user_condition="";
				// if($login_user_data['role']=="user")
				// {
					// $user_condition=" AND ( verification_request.user_id='$token_id' OR verification_request.created_by='$token_id') ";
				// }

				/*Get User Detail & Create condition */

				## Search 
				$searchArray = array();
				$searchQuery = " ";
				// if($searchValue != ''){
				//    $searchQuery = " AND ((verification_request.description LIKE :description) OR (m.name LIKE :case_name) OR (m.description LIKE :case_description)";
				//     $searchArray = array( 
				//         'description'=>"%$searchValue%", 
				//         'case_name'=>"%$searchValue%", 
				//         'case_description'=>"%$searchValue%", 
				         
				//     );
				// }
				// if($searchValue != '')
				// {
				// 	$searchQuery .= " OR (m.name LIKE '%".$searchValue."%') OR (m.description LIKE '%".$searchValue."%') OR (u.name LIKE '%".$searchValue."%')";
				// }

				$filterQuery = " ";
				// if($filterValue != ''){
				// 	$filterQuery = " AND verification_request.type = '$filterValue' ";
				// }
				
				// if(isset($_REQUEST['id_case']) && $_REQUEST['id_case']!="")
				// {
				// 	$filterQuery .= " AND verification_request.case_id='".$_REQUEST['id_case']."' ";
				// }

				
				

				## Total number of records without filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM verification_request  
				WHERE is_deleted='0'  
				 ".$filterQuery);
				$stmt->execute();
				$records = $stmt->fetch();
				$totalRecords = $records['allcount'];

				## Total number of records with filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM verification_request
				WHERE is_deleted='0' ".$filterQuery." ".$searchQuery);
				// $stmt->execute($searchArray);
				foreach($searchArray as $key=>$search){
				    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
				}
				$stmt->execute();
				$records = $stmt->fetch();
				$totalRecordwithFilter = $records['allcount'];
				

				## Fetch records
				$stmt = $pdoconn->prepare("SELECT * FROM verification_request WHERE is_deleted='0'  ".$filterQuery." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
	
				// Bind values
				foreach($searchArray as $key=>$search){
				    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
				}

				$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
				$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
				$stmt->execute();
				$verification_request = $stmt->fetchAll();

				$data = array();
				
				foreach($verification_request as $row)
				{
					$provider=$row['provider_name'];
					
					$provider_name="provider_name";
					$sel_provider_details=mysqli_query($conn,"SELECT * from me_provider WHERE id='$provider' ");
					if(mysqli_num_rows($sel_provider_details)>0)
					{
						$fetch_provider=mysqli_fetch_assoc($sel_provider_details);
						$provider_name=$fetch_provider['provider_name'];
					}
					$row['provider_name']=$provider_name;
					// $state=$row['name'];
					
					$state=$row['id'];
					$state_name="name";
					$sel_state_details=mysqli_query($conn,"SELECT * from me_states WHERE id='$state' ");
					if(mysqli_num_rows($sel_state_details)>0)
					{
						$fetch_state=mysqli_fetch_assoc($sel_state_details);
						$state_name=$fetch_state['name'];
					}

					
					$row['name']=$state_name;


            
					
					$data[]=$row;					
				   	// $data[] = array(
				   		// "id" => $row['id'],
				      	// "firm_id" => $row['firm_id'],
				      	// "title" => $row['title'],
				      	// "case_id" => $row['case_id'],
				      	// "description" => $row['description'],
				      	// "user_id" => $row['user_id'],
				      	// "created_by" => $row['created_by'],
				      	 
						
				   	// );
					
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
	   $message = "Something went wrong ".$e;
	   apiResponse($code, $message, $page_no, $total_page, $data, $status_code, $errors); die();
	}
?>