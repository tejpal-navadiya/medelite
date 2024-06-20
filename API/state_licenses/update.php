<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
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

            if (isset($_POST['id'])) {
                // Update existing record
                $id = $_POST['id'];

                $state = isset($_REQUEST['state']) ? $_REQUEST['state'] : '';
                $provider_id = isset($_REQUEST['provider_id']) ? $_REQUEST['provider_id'] : '';
                $license_type = isset($_REQUEST['license_type']) ? $_REQUEST['license_type'] : '';
                $license_number = isset($_REQUEST['license_number']) ? $_REQUEST['license_number'] : '';
                $issue_date = isset($_REQUEST['issue_date']) ? $_REQUEST['issue_date'] : '';
                $exp_date = isset($_REQUEST['exp_date']) ? $_REQUEST['exp_date'] : '';
                $last_updated = isset($_REQUEST['last_updated']) ? $_REQUEST['last_updated'] : '';
                $suppervising_physician = isset($_REQUEST['suppervising_physician']) ? $_REQUEST['suppervising_physician'] : '';
                $practitioners_in_cpa = isset($_REQUEST['practitioners_in_cpa']) ? $_REQUEST['practitioners_in_cpa'] : '';
                $renewal_id_pin = isset($_REQUEST['renewal_id_pin']) ? $_REQUEST['renewal_id_pin'] : '';
                $primary_check = isset($_REQUEST['primary_check']) ? $_REQUEST['primary_check'] : '';
                $compact = isset($_REQUEST['compact']) ? $_REQUEST['compact'] : '';
                $collaborative_relationship = isset($_REQUEST['collaborative_relationship']) ? $_REQUEST['collaborative_relationship'] : '';
                $enrolled_in_pmp = isset($_REQUEST['enrolled_in_pmp']) ? $_REQUEST['enrolled_in_pmp'] : '';
                $updated_at = date('Y-m-d H:i:s');

                // Update query
                $update_query = "UPDATE me_licenses_list SET 
                                state='$state', 
                                provider_id='$provider_id', 
                                license_type='$license_type',
                                license_number='$license_number',				
                                issue_date='$issue_date',
                                exp_date='$exp_date',
                                last_updated='$last_updated',
                                suppervising_physician='$suppervising_physician',
                                practitioners_in_cpa='$practitioners_in_cpa', 
                                renewal_id_pin='$renewal_id_pin',
                                primary_check='$primary_check',				
                                compact='$compact',
                                collaborative_relationship='$collaborative_relationship',
                                enrolled_in_pmp='$enrolled_in_pmp',
                                updated_at='$updated_at'
                                WHERE id='$id'";

                // Execute update query
                $is_updated = mysqli_query($conn, $update_query);

                if ($is_updated) {
                    $note = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
                    $followup_type = isset($_REQUEST['followup_type']) ? $_REQUEST['followup_type'] : '';
                    $note_last_updated = isset($_REQUEST['note_last_updated']) ? $_REQUEST['note_last_updated'] : '';
                    $note_exp_date = isset($_REQUEST['note_exp_date']) ? $_REQUEST['note_exp_date'] : '';
                    $note_issue_date = isset($_REQUEST['note_issue_date']) ? $_REQUEST['note_issue_date'] : '';
                    $note_date = isset($_REQUEST['note_date']) ? $_REQUEST['note_date'] : '';
                    $created_by = (int)$token_id;

                    // Update query
                    $update_note_query = "UPDATE me_license_note SET 
                                        note='$note', 
                                        note_date='$note_date',
                                        note_issue_date='$note_issue_date',
                                        followup_type='$followup_type',
                                        note_exp_date='$note_exp_date',
                                        note_last_updated='$note_last_updated',
                                        created_by='$created_by'
                                        WHERE id='$id'";

                    // Execute update query
                    $is_note_updated = mysqli_query($conn, $update_note_query);

                    if ($is_note_updated) {
                        $supporting_doc_date = isset($_REQUEST['doc_date']) ? $_REQUEST['doc_date'] : '';
                        $document_type = isset($_REQUEST['document_type']) ? $_REQUEST['document_type'] : '';
                        $supporting_doc_exp_date = isset($_REQUEST['doc_exp_date']) ? $_REQUEST['doc_exp_date'] : '';
                        $supporting_doc_last_updated = isset($_REQUEST['doc_last_updated']) ? $_REQUEST['doc_last_updated'] : '';
                        $supporting_receipt_amount = isset($_REQUEST['receipt_amount']) ? $_REQUEST['receipt_amount'] : '';

                        // Update query
                        $update_supporting_doc_query = "UPDATE me_licenses_supporting_docs SET 
                                                        doc_date='$supporting_doc_date',
                                                        document_type='$document_type',
                                                        doc_exp_date='$supporting_doc_exp_date',
                                                        doc_last_updated='$supporting_doc_last_updated',
                                                        receipt_amount='$supporting_receipt_amount'
                                                        WHERE id='$id'";

                        // Execute update query
                        $is_supporting_doc_updated = mysqli_query($conn, $update_supporting_doc_query);

                        if ($is_supporting_doc_updated) {
                            $code = 1;
                            $message = "License updated successfully.";
                        } else {
                            $message = "Error updating supporting document.";
                        }
                    } else {
                        $message = "Error updating note.";
                    }
                } else {
                    $message = "Error updating license.";
                }
            } else {
                $message = "ID is not set.";
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
