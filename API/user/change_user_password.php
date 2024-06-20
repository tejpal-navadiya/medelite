<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include('../../config/config.php');
include('../../helper/functions.php');
load_config("1","1","1","1","1");

use Rakit\Validation\Validator;
use Carbon\Carbon;

$code = 0;
$data = new stdClass();
$status_code = 200;
$errors = [];

try {
    $headers = apache_request_headers();
    if(isset($headers['Apitoken']) || isset($headers['apitoken'])){
        $apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
        $token_id = checkToken($conn, $apitoken);
        if($apitoken && $token_id){
            $user_id= $token_id;

        
            if (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
                $validator = new Validator;
                $validation = $validator->make($_POST, [
                    'current_password' => 'required',
                    'new_password' => 'required|min:8', 
                    'confirm_password' => 'required|same:new_password',
                ]);

                    $validation->validate();
                    if ($validation->fails()) {
                        $getErrors = $validation->errors();
                        $errors = $getErrors->firstOfAll();
                        apiResponse($code, $message, "", "", $data, $status_code, $errors);
                        die();
                    }

                    $currentPassword = $_POST['current_password'];

                    // Fetch user data based on credentials
                    $password = mysqli_real_escape_string($conn, $currentPassword);
                    $checkExistQry = "SELECT * FROM acr_admin_users WHERE id='$user_id'";
                    $user_data_result = mysqli_query($conn, $checkExistQry) or die(mysqli_error($conn));

                    if ($user_data_result && mysqli_num_rows($user_data_result) > 0) {
                        $user_data = $user_data_result->fetch_assoc();
                        $userId = $user_data['id'];
                    
                        // Check current password match database
                        if (password_verify($currentPassword, $user_data['password'])) {
                            // Update the password in the database
                            $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                            $updatePasswordQuery = "UPDATE acr_admin_users SET password='$newPassword' WHERE id=$userId";
                            mysqli_query($conn, $updatePasswordQuery) or die(mysqli_error($conn));

                            $message = "Password changed successfully.";
                            $code = 1;
                            apiResponse($code, $message, "", "", $data, $status_code, $errors);
                            die();
                        
                        } else {
                            $message = "Current password is incorrect.";
                            apiResponse($code, $message, "", "", $data, $status_code, $errors);
                            die();
                        }
                    } else {
                        $message = "Invalid Credentials";
                        apiResponse($code, $message, "", "", $data, $status_code, $errors);
                        die();
                    }
                } else {
                    $message = "Invalid request.";
                    apiResponse($code, $message, "", "", $data, $status_code, $errors);
                    die();
                }
    // print_r($user_data);
                }else{
                    $status_code = 401;
                    $message = "Login expired or invalid token.";
                }	
                }else{
                $status_code = 401;
                $message = "Login expired or invalid token.";
                }
} catch (Exception $e) {
    $message = "Something went wrong";
    apiResponse($code, $message, "", "", $data, $status_code, $errors);
    die();
}
?>
