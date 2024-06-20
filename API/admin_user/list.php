<?php 
	include('../../config.php');
	include('../../helper/functions.php');
	include('../debtor.php');

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
			if($apitoken && $token_id){
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
				$searchValue = $_POST['search']['value']; // Search value
				$filterValue = $_POST['filter_type']; // filter value

				## Search 
				$searchArray = array();
				$searchQuery = " ";
				if($searchValue != ''){
				   $searchQuery = " AND ((name LIKE :first_name)  OR (last_name LIKE :last_name) OR (email LIKE :email)) ";
				    $searchArray = array( 
				        'first_name'=>"%$searchValue%", 
				        'last_name'=>"%$searchValue%", 
				        'email'=>"%$searchValue%", 
				    );
				}

				$filterQuery = " ";
				

				## Total number of records without filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_users WHERE is_deleted='0' ".$filterQuery);
				$stmt->execute();
				$records = $stmt->fetch();
				$totalRecords = $records['allcount'];

				## Total number of records with filtering
				$stmt = $pdoconn->prepare("SELECT COUNT(*) AS allcount FROM me_users WHERE is_deleted='0' ".$searchQuery." ".$filterQuery);
				$stmt->execute($searchArray);
				$records = $stmt->fetch();
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				

				$stmt = $pdoconn->prepare("SELECT * FROM me_users  WHERE  is_deleted='0' ".$filterQuery." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

				

				// Bind values
				foreach($searchArray as $key=>$search){
				    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
				}

				$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
				$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
				$stmt->execute();
				$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$data = array();
				foreach($contacts as $row){
					$row_id = $row['id'];
					$detail_navigation=base64_encode('detail@#debtor@#debtor_id@#'.$row_id);
					$update_navigation=base64_encode('edit@#me_users@#admin_user_id@#'.$row_id);
					$remove_val=base64_encode($row_id);
					
					$action_button="<div class='btn-group'><button  type='button' onclick='SetNavigation(this)' data-val='".$update_navigation."'   class='btn btn-sm btn-primary' ><i class='fa fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger' onclick='delete_task_btn(this)' data-val='".$remove_val."'><i class='fa fa-trash'></i></button></div>";
					$row['action_button'] = $action_button;

					$access_role_name = "";
					$language_name = "";
					$overseas_country_name = "";
					$title_name = "";
					
					if(isset($row['access_role']) && $row['access_role']!="")
					{
						$sel_ms_name = mysqli_query($conn, "SELECT * from user_type WHERE id='" . $row['access_role'] . "' ");
						if(mysqli_num_rows($sel_ms_name)>0)
						{
							$ms_name_details = mysqli_fetch_assoc($sel_ms_name);
							$access_role_name = $ms_name_details['name'];
						}
					}
					
					$row['access_role_name'] = $access_role_name;
					

				   	$data[] = $row;
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
	$errors[] = $e;
	   apiResponse($code, $message, $page_no, $total_page, $data, $status_code, $errors); die();
	}
?>