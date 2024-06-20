<?php 

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
                apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
            }

            // Retrieve data from POST request
            $state = $_REQUEST['state'];
            $provider_id = $_REQUEST['provider_id'];
            $license_type = $_REQUEST['license_type'];
            $license_number = $_REQUEST['license_number'];
            $issue_date = $_REQUEST['issue_date'];
            $exp_date = $_REQUEST['exp_date'];
            $last_updated = $_REQUEST['last_updated'];
            $suppervising_physician = $_REQUEST['suppervising_physician'];
            $practitioners_in_cpa = $_REQUEST['practitioners_in_cpa'];
            $renewal_id_pin = $_REQUEST['renewal_id_pin'];
            $primary_check = $_REQUEST['primary_check'];
            $compact = $_REQUEST['compact'];
            $collaborative_relationship = $_REQUEST['collaborative_relationship'];
            $enrolled_in_pmp = $_REQUEST['enrolled_in_pmp'];
            $created_at = date('Y-m-d H:i:s');
            $created_by = (int)$token_id;

            // Insert data into me_licenses_list table
            $add_activity = mysqli_query($conn, "INSERT INTO me_licenses_list 
            (state, provider_id, license_type, license_number, issue_date, exp_date, last_updated, suppervising_physician, practitioners_in_cpa, renewal_id_pin, primary_check, compact, collaborative_relationship, enrolled_in_pmp, created_at, created_by) 
            VALUES 
            ('$state','$provider_id','$license_type','$license_number', '$issue_date', '$exp_date', '$last_updated', '$suppervising_physician', '$practitioners_in_cpa', '$renewal_id_pin', '$primary_check', '$compact', '$collaborative_relationship', '$enrolled_in_pmp', '$created_at', $created_by)");

            if ($add_activity) {
                // Get the last inserted ID
                $activity_id = mysqli_insert_id($conn);

                // Insert data into me_license_note table
             
                $note = $_REQUEST['note']; // 
                $followup_type =$_REQUEST['followup_type']; 
                $note_last_updated = $_REQUEST['note_last_updated'];
				$note_exp_date = $_REQUEST['note_exp_date']; // 
                $note_issue_date = $_REQUEST['note_issue_date']; 
				$note_date = $_REQUEST['note_date'];
				$created_at = date('Y-m-d H:i:s');
				$created_by = (int)$token_id;
                $add_note = mysqli_query($conn,"INSERT INTO me_licenses_note 
                (firm_id, note, note_date, note_issue_date, followup_type, note_exp_date, note_last_updated,created_at, created_by) 
                VALUES 
                ('$activity_id', '$note', '$note_date','$note_issue_date', '$followup_type', '$note_exp_date', '$note_last_updated', '$created_at', $created_by)");

				if ($add_note) {

									
					// Insert data into me_licenses_supporting_docs table
					// $supporting_note = ''; 
					$supporting_doc_date =$_REQUEST['doc_date'];
					$document_type =$_REQUEST['document_type'];
					$supporting_doc_exp_date =$_REQUEST['doc_exp_date']; 
					$supporting_doc_last_updated =$_REQUEST['doc_last_updated']; 
                    $supporting_receipt_amount =$_REQUEST['receipt_amount']; 

					$add_supporting_note = mysqli_query($conn, "INSERT INTO me_licenses_supporting_docs 
					(id,doc_date,document_type,doc_exp_date,doc_last_updated,receipt_amount,created_at,created_by) 
					VALUES 
					('$activity_id','$supporting_doc_date','$document_type','$supporting_doc_exp_date','$supporting_doc_last_updated','$supporting_receipt_amount','$created_at', $created_by)");

					if ($add_supporting_note) {
						$code = 1;
						$message = "License added successfully.";
					} else {
						$message = "Error adding supporting note.";
					}
				} else {
					$message = "Error adding note.";
				}
				} else {
				$message = "Error adding license.";
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
} catch(Exception $e) {
    $message = "Something went wrong";
    apiResponse($code, $message, "", "", $data, $status_code, $errors); die();
}

?>
