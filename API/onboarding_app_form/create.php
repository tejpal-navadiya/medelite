<?php 

include('../../config.php');
include('../../helper/functions.php');
// include('../task.php');

use Rakit\Validation\Validator;

$code = 0;
$data = new stdClass();
$status_code = 200;
$errors = [];
$message = '';

try {
    $headers = apache_request_headers();
    // Debug: Print headers
    error_log('Headers: ' . print_r($headers, true));
    
    $apitoken = isset($headers['Apitoken']) ? $headers['Apitoken'] : (isset($headers['apitoken']) ? $headers['apitoken'] : $_REQUEST['apitoken']);
    // Debug: Print token
    error_log('API Token: ' . $apitoken);

    if ($apitoken) {
        $token_id = checkToken($conn, $apitoken);
        // Debug: Print token_id
        error_log('Token ID: ' . $token_id);

        if ($token_id) {
            $firm_id = getFirmFromUserId($conn, $token_id);
            // Debug: Print firm_id
            error_log('Firm ID: ' . $firm_id);

            if ($firm_id) {
                $validator = new Validator;
                $validation = $validator->make($_POST + $_FILES, [
                    'provider_name' => 'required',
                ]);

                $validation->validate();

                if ($validation->fails()) {
                    $getErrors = $validation->errors();
                    $errors = $getErrors->firstOfAll();
                    apiResponse($code, $message, "", "", $data, $status_code, $errors);
                    die();
                }

                $application_type = $_REQUEST['application_type'] ?? '';
                $provider_name = $_REQUEST['provider_name'] ?? '';
                $organization = $_REQUEST['organization'] ?? '';
                $submission_date = $_REQUEST['submission_date'] ?? '';
                $application_status = $_REQUEST['application_status'] ?? '';
                $followup_time = $_REQUEST['followup_time'] ?? '';
                $followup_date = $_REQUEST['followup_date'] ?? '';
                $application_method = $_REQUEST['application_method'] ?? '';
                $specialist_reviewed = $_REQUEST['specialist_reviewed'] ?? '';
                $web_contact_info = $_REQUEST['web_contact_info'] ?? '';
                $created_at = date('Y-m-d H:i:s');
                $created_by = (int)$token_id;

                $add_activity = mysqli_query($conn, "INSERT INTO me_onboarding_application 
                (firm_id, application_type, provider_name, organization, submission_date, application_status, follow_up_time, follow_up_date, application_method, specialist_reviewed, web_contact_info, created_by, created_at) 
                VALUES ('$firm_id', '$application_type', '$provider_name', '$organization', '$submission_date', '$application_status', '$followup_time', '$followup_date', '$application_method', '$specialist_reviewed', '$web_contact_info', '$created_by', '$created_at')") or die(mysqli_error($conn));

                if ($add_activity) {
                    $form_id = mysqli_insert_id($conn);
                    $data = ['form_id' => $form_id];
                    $code = 1;
                    $message = "Onboarding application form added successfully.";
                } else {
                    $message = "Something went wrong.";
                }
            } else {
                $status_code = 401;
                $message = "Login expired or invalid token.";
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
