<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include('../../config.php');

include('../../helper/functions.php');
use Rakit\Validation\Validator;

$code = 0;
$data = new stdClass();
$status_code = 200;
$errors = [];

try {
    $headers = apache_request_headers();
    if (isset($headers['Apitoken']) || isset($headers['apitoken'])) {
        $apitoken = $headers['Apitoken'] ?: $headers['apitoken'];
        $token_id = checkToken($conn, $apitoken);
        // $firm_id = getFirmFromUserId($conn, $token_id);

        if ($apitoken && $token_id) {
            $validator = new Validator;
            $validation = $validator->make($_POST, [
                'name' => 'required'
            ]);

            $validation->validate();

            if ($validation->fails()) {
                $getErrors = $validation->errors();
                $errors = $getErrors->firstOfAll();
                apiResponse($code, "Validation failed", "", "", $data, $status_code, $errors);
                die();
            }

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $is_deleted = "0";
            $created_at = date('Y-m-d H:i:s');
            $created_by = (int)$token_id;

            $insert = "INSERT INTO me_user_type (name, is_deleted, created_at, created_by) VALUES ('$name', '$is_deleted', '$created_at', '$created_by')";
            $query = mysqli_query($conn, $insert) or die(mysqli_error($conn));
            if ($query) {
                $id = mysqli_insert_id($conn);
                $_SESSION['msg'] = "done";
                $message = "User role added successfully.";
                $code = 1;
            } else {
                $_SESSION['msg'] = "error";
                $message = "Error adding user role.";
            }
        } else {
            $status_code = 401;
            $message = "Login expired or invalid token.";
        }
    } else {
        $status_code = 401;
        $message = "Login expired or invalid token.";
    }

    apiResponse($code, $message, "", "", $data, $status_code);
} catch (Exception $e) {
    $message = "Something went wrong";
    apiResponse($code, $message, "", "", $data, $status_code, $errors);
    die();
}
?>
