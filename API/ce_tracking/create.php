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
        $firm_id = getFirmFromUserId($conn, $token_id);
        
        if ($apitoken && $token_id) {
            $validator = new Validator;
            $validation = $validator->make($_POST + $_FILES, []);
            $validation->validate();

            if ($validation->fails()) {
                $getErrors = $validation->errors();
                $errors = $getErrors->firstOfAll();
                apiResponse($code, $message, "", "", $data, $status_code, $errors);
                die();
            }
            
            // Define variables and retrieve form data
            $applay_to_all_state = $_REQUEST['applay_to_all_state'];
            $state_specific = $_REQUEST['state_specific'];
            $select_ce_course_catelog = $_REQUEST['select_ce_course_catelog'];
            $state_one = $_REQUEST['state_one'];
            $completed_date = $_REQUEST['completed_date'];
            $select_course = $_REQUEST['select_course'];
            $provider_approving_body = $_REQUEST['provider_approving_body'];
            $ce_course_transcript_description = $_REQUEST['ce_course_transcript_description'];
            $ce_hrs_first = $_REQUEST['ce_hrs_first'];
            $pharmacology_hrs = $_REQUEST['pharmacology_hrs'];
            $total_ce_hrs = $_REQUEST['total_ce_hrs'];
            $add_course_content = $_REQUEST['add_course_content'];
            $ce_hrs_two = $_REQUEST['ce_hrs_two'];
            $attachment = $_REQUEST['attachment'];
            // $note = $_REQUEST['note'];
            $shaprate_ce_hrs = $_REQUEST['shaprate_ce_hrs'];
            $state_content_requirement = $_REQUEST['state_content_requirement'];
            $state_two = $_REQUEST['state_two'];
            $course_content_two = $_REQUEST['course_content_two'];
            $ce_hrs_three = $_REQUEST['ce_hrs_three'];
            $update_ce_course = $_REQUEST['update_ce_course'];
            $add_course_catelog = $_REQUEST['add_course_catelog'];
            
            // Insert data into the database
            $add_activity = mysqli_query($conn, "INSERT INTO ce_tracking (applay_to_all_state, state_specific, select_ce_course_catelog, state_one, completed_date, select_course, provider_approving_body, ce_course_transcript_description, ce_hrs_first,  ce_hrs_two, attachment, shaprate_ce_hrs, state_content_requirement, state_two, course_content_two, ce_hrs_three, update_ce_course, add_course_catelog,add_course_content,total_ce_hrs,pharmacology_hrs,created_at) VALUES ('$applay_to_all_state', '$state_specific', '$select_ce_course_catelog', '$state_one', '$completed_date', '$select_course', '$provider_approving_body', '$ce_course_transcript_description', '$ce_hrs_first',  '$ce_hrs_two', '$attachment', '$shaprate_ce_hrs', '$state_content_requirement', '$state_two', '$course_content_two', '$ce_hrs_three', '$update_ce_course', '$add_course_catelog','$add_course_content','$total_ce_hrs','$pharmacology_hrs','$created_at')") or die(mysqli_error($conn));
            // print_r($add_activity);
            if ($add_activity) {
                $activity_id = mysqli_insert_id($conn);
                $code = 1;
                $message = "CeTracking added successfully.";
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
    apiResponse($code, $message, "", "", $data, $status_code);
} catch (Exception $e) {
    $message = "Something went wrong";
    apiResponse($code, $message, "", "", $data, $status_code, $errors);
    die();
}
?>
