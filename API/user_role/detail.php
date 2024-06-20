<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include('../../config.php');
include('../../helper/functions.php');
use Rakit\Validation\Validator;
use Carbon\Carbon;

$code = 0;
$data = new stdClass();
$status_code = 200;
$errors = [];
$message = ""; // Initialize the message variable

try {
    $headers = apache_request_headers();
    $apitoken = null;
    if (isset($headers['Apitoken'])) {
        $apitoken = $headers['Apitoken'];
    } elseif (isset($headers['apitoken'])) {
        $apitoken = $headers['apitoken'];
    }

    function ConvertDecimalHours($time) {
        $hms = explode(":", $time);
        return ($hms[0] + ($hms[1] / 60) + ($hms[2] / 3600));
    }

    if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
		$apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
		$token_id = checkToken($conn, $apitoken);
		// $firm_id = getFirmFromUserId($conn, $token_id);
		$default_date_format=getDateFormatFromUserId($conn, $token_id);
		if($apitoken && $token_id){
			$validator = new Validator;
			$validation = $validator->make($_REQUEST, [
				'id' => 'required'
			]);
			$validation->validate();
			if ($validation->fails()) {
				$getErrors = $validation->errors();
				$errors = $getErrors->firstOfAll();
				// $data = array();
                // $data=$_REQUEST
                apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
			}

            $ac_data_qry = "SELECT * FROM me_user_type WHERE id=? LIMIT 1";
            $ac_data_result = prepared_select($conn, $ac_data_qry, [$_REQUEST['id']]);
            if ($ac_data_result->num_rows) {
                $data = $ac_data_result->fetch_assoc();
                $name = $data['name'];
                $code = 1;
                $message = "Data retrieved successfully.";
            } else {
                $message = "Data does not exist.";
            }
        } else {
            $status_code = 401;
            $message = "Login expired or invalid token.";
        }
    } else {
        $status_code = 401;
        $message = "No API token provided.";
    }
    apiResponse($code, $message, "", "", $data, $status_code);
} catch (Exception $e) {
    $message = "Something went wrong";
    apiResponse($code, $message, "", "", $data, $status_code, $errors);
    die();
}
?>
