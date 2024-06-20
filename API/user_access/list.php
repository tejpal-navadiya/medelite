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
			$firm_id = getFirmFromUserId($conn, $token_id);
			if($apitoken && $token_id && $firm_id){
				try{
					$pdoconn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8","$username","$password");
					$pdoconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				 }catch(PDOException $e){
					die('Unable to connect with the database');
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
				$utype=$_POST['utype'];
				
				
				UpdateAllAccessIfNotExist($conn, $firm_id,$utype, $token_id);
				$page_limit = $_POST['page_limit'] ?: 10;
				$page_offset = $page_limit * ($page_no - 1);

				$search_qry = "";
				if($_POST['search']){
					$searchValue = $_POST['search'];
					$search_qry = " AND (mname LIKE '%".$searchValue."%')";
				}

				$access_data_qry = $conn->prepare("SELECT * FROM me_user_access WHERE firm_id=? AND utype='".$utype."' ".$search_qry."  ");
				$access_data_qry->bind_param("i", $firm_id);
				
				// $access_data_qry = $conn->prepare("SELECT * FROM user_access WHERE firm_id=? ".$search_qry."  limit ?,?");
				// $access_data_qry->bind_param("iii", $firm_id, $page_offset, $page_limit);

				$access_data_qry->execute();
				$pa_data_result = $access_data_qry->get_result();
				$user_access_list = $pa_data_result->fetch_all(MYSQLI_ASSOC);

				$total_pa_qry = $conn->prepare("SELECT id FROM me_user_access WHERE firm_id=? AND utype='".$utype."' ".$search_qry." ");
				$total_pa_qry->bind_param("i", $firm_id);
				$total_pa_qry->execute();
				$total_pa_result = $total_pa_qry->get_result();

				$total_rows = $total_pa_result->num_rows;
		    	$total_page = ceil($total_rows / $page_limit);

		    	$data = array();
				foreach($user_access_list as $row){

					$pmenu_name="-";
					if($row['mid']!=0)
					{
						$pmenu=$row['mid'];
						$stmt_pmenu = $conn->prepare("SELECT * FROM me_admin_menu  WHERE  mid=? ");
						$stmt_pmenu->bind_param("i", $pmenu);
						
						$stmt_pmenu->execute();
						
						$pmenu_result = $stmt_pmenu->get_result();
						$pmenu_detail = $pmenu_result->fetch_all(MYSQLI_ASSOC);
						// $pmenu_detail = $stmt_pmenu->fetchAll();
						foreach($pmenu_detail as $prow)
						{
							$pmenu_name=$prow['pmenu'];
						}
					}
					$row['pmenu']=$pmenu_name;

				   	$data[] = $row;
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