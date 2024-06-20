<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once("config.php");

if (isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['action'])) {
    $record_id = intval($_GET['id']);
    $form_id= intval($_GET['form_id']);
    // Ensure $record_id is an integer
    $action = $_GET['action'];

    switch ($action) {
        case 'delete':
            $sql_delete = "DELETE FROM me_onboarding_education_training WHERE id = ?";
            if ($stmt_delete = $conn->prepare($sql_delete)) {
                $stmt_delete->bind_param("i", $record_id);
                if ($stmt_delete->execute()) {
                    $stmt_delete->close();
                    header("Location: index.php?pid=admin_edit_boarding_app_form&id=" . intval($record_id));
                    exit();
                } else {
                    echo "<div>Error executing the delete query: " . $conn->error . "</div>";
                }
                $stmt_delete->close();
            } else {
                echo "<div>Error preparing the delete query: " . $conn->error . "</div>";
            }
            break;
   

        case 'deleteexam':
            $sql_delete_exam = "DELETE FROM me_onboarding_exam_history WHERE id = ?";
            if ($stmt_delete_exam = $conn->prepare($sql_delete_exam)) {
                $stmt_delete_exam->bind_param("i", $record_id);
                if ($stmt_delete_exam->execute()) {
                    $stmt_delete_exam->close();
                    header("Location: index.php?pid=admin_edit_boarding_app_form&id=" . intval($record_id));
                    exit();
                } else {
                    echo "<div>Error executing the delete query: " . $conn->error . "</div>";
                }
                $stmt_delete_exam->close();
            } else {
                echo "<div>Error preparing the delete query: " . $conn->error . "</div>";
            }
            break;

        case 'deletemp':
            $sql_delete_emp = "DELETE FROM me_onboarding_practice_employer_history WHERE id = ?";
            if ($stmt_delete_emp = $conn->prepare($sql_delete_emp)) {
                $stmt_delete_emp->bind_param("i", $record_id);
                if ($stmt_delete_emp->execute()) {
                    $stmt_delete_emp->close();
                    header("Location: index.php?pid=admin_edit_boarding_app_form&id=" . intval($record_id));
                    exit();
                } else {
                    echo "<div>Error executing the delete query: " . $conn->error . "</div>";
                }
                $stmt_delete_emp->close();
            } else {
                echo "<div>Error preparing the delete query: " . $conn->error . "</div>";
            }
            break;

        case 'deletehospital':
            $sql_delete_hospital = "DELETE FROM me_onboarding_hospital_facility_affiliations WHERE id = ?";
            if ($stmt_delete_hospital = $conn->prepare($sql_delete_hospital)) {
                $stmt_delete_hospital->bind_param("i", $record_id);
                if ($stmt_delete_hospital->execute()) {
                    $stmt_delete_hospital->close();
                    header("Location: index.php?pid=admin_edit_boarding_app_form&id=" . intval($record_id));
                    exit();
                } else {
                    echo "<div>Error executing the delete query: " . $conn->error . "</div>";
                }
                $stmt_delete_hospital->close();
            } else {
                echo "<div>Error preparing the delete query: " . $conn->error . "</div>";
            }
            break;

        case 'deleteProfessional':
            $sql_delete_Professional = "DELETE FROM me_onboarding_personal_reference WHERE id = ?";
            if ($stmt_delete_Professional = $conn->prepare($sql_delete_Professional)) {
                $stmt_delete_Professional->bind_param("i", $record_id);
                if ($stmt_delete_Professional->execute()) {
                    $stmt_delete_Professional->close();
                    header("Location: index.php?pid=admin_edit_boarding_app_form");
                    exit();
                } else {
                    echo "<div>Error executing the delete query: " . $conn->error . "</div>";
                }
                $stmt_delete_Professional->close();
            } else {
                echo "<div>Error preparing the delete query: " . $conn->error . "</div>";
            }
            break;

        case 'deletestate':
            $sql_delete_state = "DELETE FROM me_onboarding_state_board_setup WHERE id = ?";
            if ($stmt_delete_state = $conn->prepare($sql_delete_state)) {
                $stmt_delete_state->bind_param("i", $record_id);
                if ($stmt_delete_state->execute()) {
                    $stmt_delete_state->close();
                    header("Location: index.php?pid=admin_edit_boarding_app_form&id=" . intval($record_id));
                    exit();
                } else {
                    echo "<div>Error executing the delete query: " . $conn->error . "</div>";
                }
                $stmt_delete_state->close();
            } else {
                echo "<div>Error preparing the delete query: " . $conn->error . "</div>";
            }
            break;

        case 'deletelicense':
            $sql_delete_license = "DELETE FROM me_onboarding_licensure WHERE id = ?";
            if ($stmt_delete_license = $conn->prepare($sql_delete_license)) {
                $stmt_delete_license->bind_param("i", $record_id);
                if ($stmt_delete_license->execute()) {
                    $stmt_delete_license->close();
                    header("Location: index.php?pid=admin_edit_boarding_app_form&id=" . intval($record_id));
                    exit();
                } else {
                    echo "<div>Error executing the delete query: " . $conn->error . "</div>";
                }
                $stmt_delete_license->close();
            } else {
                echo "<div>Error preparing the delete query: " . $conn->error . "</div>";
            }
            break;

        case 'deletestateboard':
            $sql_delete_stateboard = "DELETE FROM me_onboarding_state_board_setup WHERE id = ?";
            if ($stmt_delete_stateboard = $conn->prepare($sql_delete_stateboard)) {
                $stmt_delete_stateboard->bind_param("i", $record_id);
                if ($stmt_delete_stateboard->execute()) {
                    $stmt_delete_stateboard->close();
                    header("Location: index.php?pid=admin_edit_boarding_app_form&id=" . intval($record_id));
                    exit();
                } else {
                    echo "<div>Error executing the delete query: " . $conn->error . "</div>";
                }
                $stmt_delete_stateboard->close();
            } else {
                echo "<div>Error preparing the delete query: " . $conn->error . "</div>";
            }
            break;

            case 'deletebc':
                $sql_deletebc = "DELETE FROM me_onboarding_board_certification WHERE id = ?";
                if ($stmt_deletebc = $conn->prepare($sql_deletebc)) {
                    $stmt_deletebc->bind_param("i", $record_id);
                    if ($stmt_deletebc->execute()) {
                        $stmt_deletebc->close();
                        header("Location: index.php?pid=admin_edit_boarding_app_form&id=" . intval($record_id));
                        exit();
                    } else {
                        echo "<div>Error executing the delete query: " . $conn->error . "</div>";
                    }
                    $stmt_deletebc->close();
                } else {
                    echo "<div>Error preparing the delete query: " . $conn->error . "</div>";
                }
                break;

        default:
            echo "<div>Invalid action specified.</div>";
            break;
    }
}

// end...........




if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
           {
                $API_REQ_DATA=array();
                $API_REQ_DATA['id']=$_REQUEST['id'];
                $API_REQ_DATA['apitoken']=$_SESSION['me_apitoken'];
                $API_REQ_URL=$api_url."onboarding_form/detail.php";
                $OnBordingDetailsJSON=CallAPI("GET", $API_REQ_URL, $API_REQ_DATA);
                $OnBordingDetailsArray=array();
                $OnBordingDetails=array();
                $OnBordingDetailsArray=json_decode($OnBordingDetailsJSON,true);
                $OnBordingDetails= $OnBordingDetailsArray["data"];

                $education_training_detail=$OnBordingDetails['education_training_detail'];
                $exam_history_detail=$OnBordingDetails['exam_history_detail'];
                $board_certification_detail=$OnBordingDetails['board_certification_detail'];
                $practice_employer_detail=$OnBordingDetails['practice_employer_history_detail'];
                $hospital_affiliations_detail=$OnBordingDetails['hospital_facility_affiliations_details'];
                $states_detail=$OnBordingDetails['states_detail'];
                $questions_detail=$OnBordingDetails['questions_detail'];
                $licensure_detail=$OnBordingDetails['onboarding_licensure_detail'];
                $supporting_documents_detail=$OnBordingDetails['supporting_documents_detail'];
                $personal_reference_detail=$OnBordingDetails['personal_reference_detail'];
                $state_board_setup_detail=$OnBordingDetails['state_board_setup_detail'];
                
               //    Get States list
                    $API_REQ_DATA=array();
                    $API_REQ_DATA['page_limit']=0;
                    $API_REQ_DATA['apitoken']=$_SESSION['me_apitoken'];
                    $API_REQ_URL=$api_url."states/select_list.php";
                    $StateListJSON=CallAPI("POST", $API_REQ_URL, $API_REQ_DATA);
                    
                    $StateListArray=json_decode($StateListJSON,true);
                    $StateList=$StateListArray["data"];

           } 
?>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Provider Demographic</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card">
                            <div class="card-header">
                                <div class="row"> -->
                        <!-- <div class="col-sm-6"> -->
                        <!-- <label for="firstname" class="control-label">Practice /Employer /Facility Type<span class="text-danger">*</span> </label> -->
                        <!-- <div class="form-group">
                                                    <select name="provider_name" class="form-control" id="provider_name">
                                                                    <option value="">Provider Name</option>
                                                                    <?php
                                                                    $sql = "SELECT id, provider_name FROM me_provider where is_deleted='0'";
                                                                    $result = $conn->query($sql);
                                                                    if ($result->num_rows > 0) {
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo '<option value="' . $row["id"] . '">' . $row["provider_name"] . '</option>';
                                                                        }
                                                                    } else {
                                                                        echo '<option value="">No providers found</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                        <span class="help" id="msg2"></span>
                                                    </div> -->
                        <!-- </div> -->

                        <!-- </div>
                                </div>
                        </div> -->
                        <div class="card-body">

                            <?php
                $is_admin_form = 1;
                include("content_provider_demographic_tab.php");
                ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <!--institution  -->


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Education & Training </h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                                </div>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-12 text-center">
                                <button type="button" id="add_more_item" data-toggle='modal' data-target='#editModal' class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Institute</button>
                            </div>
                            <table id="example12" class="data-table table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Institution Type</th>
                                        <th>Institution Name</th>
                                        <th>Program</th>
                                        <th>Degree</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Grade Date</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $record_id = intval($_GET['id']);
                                          
                                                    $sql_get_form_id = "SELECT form_id FROM me_onboarding_education_training WHERE id = ?";
                                                    if ($stmt_get_form_id = $conn->prepare($sql_get_form_id)) {
                                                        $stmt_get_form_id->bind_param("i", $record_id);
                                                        $stmt_get_form_id->execute();
                                                        $stmt_get_form_id->bind_result($form_id);
                                                        $stmt_get_form_id->fetch();
                                                        $stmt_get_form_id->close();
                                                    } else {
                                                        echo "<div>Error preparing the SQL query to retrieve form_id: " . $conn->error . "</div>";
                                                    }

                                                    if ($form_id) {
                                                        // Fetch and display records
                                                        $sql = "SELECT * FROM me_onboarding_education_training WHERE form_id = ?";

                                                        if ($stmt = $conn->prepare($sql)) {
                                                            $stmt->bind_param("i", $form_id);
                                                            $stmt->execute();
                                                            $education = $stmt->get_result();
                                                            if ($education->num_rows > 0) {
                                                                while ($erow = $education->fetch_assoc()) {
                                                                    echo "<tr>";
                                                                    echo "<td>" . $erow["institute_type"] . "</td>";
                                                                    echo "<td>" . $erow["institute_name"] . "</td>";
                                                                    echo "<td>" . $erow["program_completed"] . "</td>";
                                                                    echo "<td>" . $erow["degree"] . "</td>";
                                                                    echo "<td>" . $erow["start_date"] . "</td>";
                                                                    echo "<td>" . $erow["end_date"] . "</td>";
                                                                    echo "<td>" . $erow["graduation_date"] . "</td>";
                                                                    echo "<td>
                                                                        <a href='#' data-id='" . $erow['form_id'] . "' class='btn btn-outline-primary btn-sm edit-btn' data-toggle='modal' data-target='#editModal'
                                                                        data-institute-type='" . $erow['institute_type'] . "'
                                                                        data-institute-name='" . $erow['institute_name'] . "'
                                                                        data-program-completed='" . $erow['program_completed'] . "'
                                                                        data-degree='" . $erow['degree'] . "'
                                                                        data-start-date='" . $erow['start_date'] . "'
                                                                        data-end-date='" . $erow['end_date'] . "'
                                                                        data-graduation-date='" . $erow['graduation_date'] . "'
                                                                        ><i class='fas fa-edit'></i></a>
                                                                            <a href='index.php?pid=admin_edit_boarding_app_form&id={$erow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-bell'></i></a>

                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$erow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-sync-alt'></i></a>
                                                               
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$erow['id']}&action=delete' class='btn btn-sm btn-outline-primary'><i class='fas fa-times'></i></a></td>";
                                                                    echo "</tr>";
                                                                }
                                                            } else {
                                                                echo "<tr><td colspan='8'>No data available</td></tr>";
                                                            }
                                                            $stmt->close();
                                                        } else {
                                                            echo "<tr><td colspan='8'>Error executing the SQL query: " . $conn->error . "</td></tr>";
                                                        }
                                                    } else {
                                                        // echo "<div>Error: form_id could not be retrieved</div>";
                                                    }
                                                }
                                                    ?>



                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal<?php echo $erow['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Education & Training</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                    include 'add_education_training_tab.php';

                                                 ?>
                                                    </div>
                                                </div>
                                            </div>
                                </tbody>
                            </table>


                            </div>
                        </div>
                    </div>
              </section>


    <!-- edit popup -->
    <!-- Modal -->

    <!-- end popup -->

    <!-- exam history -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Exam History</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12 text-center">

                                <button type="button" data-toggle='modal' data-target='#editexamModal' class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Exam History</button>
                            </div>
                            <table id="exam" class="data-table table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Exam Type</th>
                                        <th>Location</th>
                                        <th>Score</th>
                                        <th>#Of Attempts</th>
                                        <th>First Try Date</th>
                                        <th>Exam Date</th>
                                        <th>Passed ?</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (isset($_GET['id'])) {
                                        $form_id = intval($_GET['id']); 
                                        $sql = "SELECT * FROM me_onboarding_exam_history WHERE form_id = ?";
                                        if ($stmt = $conn->prepare($sql)) {
                                            $stmt->bind_param("i", $form_id);
                                            $stmt->execute();

                                            $examresult = $stmt->get_result();

                                            if ($examresult->num_rows > 0) {
                                               
                                                while ($exrow = $examresult->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $exrow["exam_type"] . "</td>";
                                                    echo "<td>" . $exrow["location"] . "</td>";
                                                    echo "<td>" . $exrow["score"] . "</td>";
                                                    echo "<td>" . $exrow["no_of_attempts"] . "</td>";
                                                    echo "<td>" . $exrow["first_try_date"] . "</td>";
                                                    echo "<td>" . $exrow["exam_date"] . "</td>";
                                                    echo "<td>" . $exrow["is_passed"] . "</td>";
                                                    echo "<td>
                                                          <a href='#' data-id='" . $exrow['form_id'] . "' class='btn btn-outline-primary btn-sm edit-btn' data-toggle='modal' data-target='#editexamModal'" . $exrow['id'] . "''
                                                                ><i class='fas fa-edit'></i></a>
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$exrow['id']}&action=deleteexam' class='btn btn-sm btn-outline-primary'><i class='fas fa-times'></i></a></td>";
                                                            echo "</tr>";
                                                }
                                                echo "</table>";
                                            } else {
                                                echo "<tr><td colspan='8'>No exam history data available</td></tr>";
                                            }
                                            $stmt->close();
                                        } else {
                                            echo "<tr><td colspan='8'>Error executing the SQL query: " . $conn->error . "</td></tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>form_id not provided</td></tr>";
                                    }
                                    ?>
                                        <!-- model -->
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Exam History Details</h3>
                                                    </div>
                                                    <!-- <div class="col-sm-6 text-right">
                                                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm">
                                                            <?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?>
                                                        </button>
                                                    </div> -->

                                                </div>
                                            </div>

                                            <div class="modal fade" id="editexamModal<?php echo $erow['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Exam History Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                          <?php
                                                    include 'add_education_training_tab.php';

                                                 ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <!-- </div>

                                                </div> -->


                                        <!-- end model -->
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- end history -->

    <!-- Board Certification -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Board Certification</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-12 text-center">
                                <button type="button" data-toggle='modal' data-target='#editboardModal' class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Board Certification</button>
                            </div>
                            <table id="example14" class="data-table table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Board Name</th>
                                        <th>Speciality-Subspeciality</th>
                                        <th>Certificate</th>
                                        <th>Cert.status</th>
                                        <th>Issue Date</th>
                                        <th>Expiration Date</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                if (isset($_GET['id'])) {
                                    $form_id = intval($_GET['id']); // Ensure $form_id is an integer

                                  

                                    // Prepare select statement to fetch board certification records
                                    $sql = "SELECT * FROM me_onboarding_board_certification WHERE form_id = ?";
                                    if ($stmt = $conn->prepare($sql)) {
                                        $stmt->bind_param("i", $form_id);
                                        $stmt->execute();

                                        $boardresult = $stmt->get_result();

                                        if ($boardresult->num_rows > 0) {
                                            // echo "<table>";
                                            // echo "<tr><th>Board Name</th><th>Specialty</th><th>Certificate No</th><th>Status</th><th>Issue Date</th><th>Expiry Date</th><th>Actions</th></tr>";
                                            while ($brow = $boardresult->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $brow["board_name"] . "</td>";
                                                echo "<td>" . $brow["specialty"] . "</td>";
                                                echo "<td>" . $brow["certificate_no"] . "</td>";
                                                echo "<td>" . $brow["status"] . "</td>";
                                                echo "<td>" . $brow["issue_date"] . "</td>";
                                                echo "<td>" . $brow["expiry_date"] . "</td>";
                                                echo "<td>
                                                        <a href='#' data-id='" . $brow['form_id'] . "' class='btn btn-outline-primary btn-sm edit-btn' data-toggle='modal' data-target='#editboardModal'" . $brow['id'] . "''><i class='fas fa-edit'></i></a>
                                                               <a href='index.php?pid=admin_edit_boarding_app_form&id={$brow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-bell'></i></a>

                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$brow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-sync-alt'></i></a>
                                                               
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$brow['id']}&action=deletebc' class='btn btn-sm btn-outline-primary'><i class='fas fa-times'></i></a></td>";
                                                echo "</tr>";
                                            }
                                            echo "</table>";
                                        } else {
                                            echo "<tr><td colspan='7'>No board certification data available</td></tr>";
                                        }
                                        $stmt->close();
                                    } else {
                                        echo "<tr><td colspan='7'>Error executing the SQL query: " . $conn->error . "</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>form_id not provided</td></tr>";
                                }
                                ?>
                                        <div class="modal fade" id="editboardModal<?php echo $brow['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Board Certification</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                    include 'add_board_certificate_tab.php';

                                                 ?>
                                                    </div>
                                                </div>
                                            </div>
                                </tbody>
                            </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- end board certification -->
    <!-- Prectice And Employer History -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Prectice & Employer History</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                                </div>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-12 text-center">
                                <button type="button" data-toggle='modal' data-target='#editPrecticeModal' class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Prectice & Employer</button>
                            </div>
                            <table id="example15" class="data-table table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Facility Type</th>
                                        <th>Practice Employer</th>
                                        <th>State</th>
                                        <!-- <th>Degree</th> -->
                                        <th>Start Date</th>
                                        <th>End Date</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (isset($_GET['id'])) {
                                            $form_id = intval($_GET['id']); // Ensure $form_id is an integer

                                         
                                            $sql = "SELECT * FROM me_onboarding_practice_employer_history WHERE form_id = ?";
                                            if ($stmt = $conn->prepare($sql)) {
                                                $stmt->bind_param("i", $form_id);
                                                $stmt->execute();

                                                $precticeresult = $stmt->get_result();

                                                if ($precticeresult->num_rows > 0) {
                                                    // echo "<table>";
                                                    // echo "<tr><th>Practice Type</th><th>Practice Name</th><th>Address State</th><th>Start Date</th><th>End Date</th><th>Actions</th></tr>";
                                                    while ($prow = $precticeresult->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $prow["practice_type"] . "</td>";
                                                        echo "<td>" . $prow["practice_name"] . "</td>";
                                                        echo "<td>" . $prow["address_state"] . "</td>";
                                                        echo "<td>" . $prow["start_date"] . "</td>";
                                                        echo "<td>" . $prow["end_date"] . "</td>";
                                                        echo "<td>
                                                                <a href='#' data-id='" . $prow['form_id'] . "' class='btn btn-outline-primary btn-sm edit-btn' data-toggle='modal' data-target='#editPrecticeModal'" . $prow['id'] . "''><i class='fas fa-edit'></i></a>
                                                                 
                                                                 <a href='index.php?pid=admin_edit_boarding_app_form&id={$prow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-bell'></i></a>

                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$prow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-sync-alt'></i></a>
                                                               
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$prow['id']}&action=deletemp' class='btn btn-sm btn-outline-primary'><i class='fas fa-times'></i></a></td>";
                                                        echo "</tr>";
                                                    }
                                                    echo "</table>";
                                                } else {
                                                    echo "<tr><td colspan='6'>No practice employer history data available</td></tr>";
                                                }
                                                $stmt->close();
                                            } else {
                                                echo "<tr><td colspan='6'>Error executing the SQL query: " . $conn->error . "</td></tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>form_id not provided</td></tr>";
                                        }
                                        ?>

                                        <div class="modal fade" id="editPrecticeModal<?php echo $erow['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Prectice & Employer History</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                    include 'content_practice_employer_tab.php';
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End  Prectice And Employer History-->
    <!-- Hospital Facility -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Hospital/Facility Affiliations</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="button" data-toggle='modal' data-target='#edithospitalModal' class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Hospital Affiliations</button>
                        </div>
                        <table id="example16" class="data-table table table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Hospital Affiliations</th>
                                    <th>Affliations Type</th>
                                    <th>State</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        if (isset($_GET['id'])) {
                                            $form_id = intval($_GET['id']); // Ensure $form_id is an integer

                                          
                                            $sql = "SELECT * FROM me_onboarding_hospital_facility_affiliations WHERE form_id = ?";
                                            if ($stmt = $conn->prepare($sql)) {
                                                $stmt->bind_param("i", $form_id);
                                                $stmt->execute();

                                                $hospitalresult = $stmt->get_result();

                                                if ($hospitalresult->num_rows > 0) {
                                                    // echo "<table>";
                                                    // echo "<tr><th>Hospital Affiliation</th><th>Staff Category</th><th>Address State</th><th>Start Date</th><th>End Date</th><th>Actions</th></tr>";
                                                    while ($hospitalrow = $hospitalresult->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $hospitalrow["hospital_affiliation"] . "</td>";
                                                        echo "<td>" . $hospitalrow["staff_category"] . "</td>";
                                                        echo "<td>" . $hospitalrow["address_state"] . "</td>";
                                                        echo "<td>" . $hospitalrow["start_date"] . "</td>";
                                                        echo "<td>" . $hospitalrow["end_date"] . "</td>";
                                                        echo "<td>
                                                                <a href='#' data-id='" . $hospitalrow['form_id'] . "' class='btn btn-outline-primary btn-sm edit-btn' data-toggle='modal' data-target='#edithospitalModal'" . $hospitalrow['id'] . "''><i class='fas fa-edit'></i></a>
                                                               
                                                               <a href='index.php?pid=admin_edit_boarding_app_form&id={$hospitalrow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-bell'></i></a>

                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$hospitalrow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-sync-alt'></i></a>
                                                               
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$hospitalrow['id']}&action=deletehospital' class='btn btn-sm btn-outline-primary'><i class='fas fa-times'></i></a></td>";
                                                        echo "</tr>";
                                                    }
                                                    echo "</table>";
                                                } else {
                                                    echo "<tr><td colspan='6'>No hospital facility affiliations data available</td></tr>";
                                                }
                                                $stmt->close();
                                            } else {
                                                echo "<tr><td colspan='6'>Error executing the SQL query: " . $conn->error . "</td></tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>form_id not provided</td></tr>";
                                        }
                                        ?>
                                    <div class="modal fade" id="edithospitalModal<?php echo $erow['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Prectice & Employer History</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    include 'content_hospital_facility_affiliation_tab.php';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
    </section>

    <!-- end Hospital Facility -->

    <!-- Professional referance -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Professional referance</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="button" data-toggle='modal' data-target='#editProfessionalModal' class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Professional referance</button>
                        </div>
                        <table id="example17" class="data-table table table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Provider Name</th>
                                    <th>Company</th>
                                    <th>Title</th>
                                    <th>Email </th>
                                    <th>Phone</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_GET['id'])) {
                                        $form_id = intval($_GET['id']); // Ensure $form_id is an integer

                                    
                                        $sql = "SELECT * FROM me_onboarding_personal_reference WHERE form_id = ?";
                                        if ($stmt = $conn->prepare($sql)) {
                                            $stmt->bind_param("i", $form_id);
                                            $stmt->execute();

                                            $Professionalresult = $stmt->get_result();

                                            if ($Professionalresult->num_rows > 0) {
                                                // echo "<table>";
                                                // echo "<tr><th>First Name</th><th>Company Name</th><th>Title</th><th>Email</th><th>Phone</th><th>Actions</th></tr>";
                                                while ($Professionalrow = $Professionalresult->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $Professionalrow["first_name"] . "</td>";
                                                    echo "<td>" . $Professionalrow["company_name"] . "</td>";
                                                    echo "<td>" . $Professionalrow["title"] . "</td>";
                                                    echo "<td>" . $Professionalrow["email"] . "</td>";
                                                    echo "<td>" . $Professionalrow["phone"] . "</td>";
                                                    echo "<td>
                                                              <a href='#' data-id='" . $Professionalrow['form_id'] . "' class='btn btn-outline-primary btn-sm edit-btn' data-toggle='modal' data-target='#editProfessionalModal'" . $Professionalrow['id'] . "''><i class='fas fa-edit'></i></a>
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$Professionalrow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-bell'></i></a>

                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$Professionalrow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-sync-alt'></i></a>
                                                               
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$Professionalrow['id']}&action=deleteProfessional' class='btn btn-sm btn-outline-primary'><i class='fas fa-times'></i></a></td>";
                                                              
                                                    echo "</tr>";
                                                }
                                                echo "</table>";
                                            } else {
                                                echo "<tr><td colspan='6'>No personal reference data available</td></tr>";
                                            }
                                            $stmt->close();
                                        } else {
                                            echo "<tr><td colspan='6'>Error executing the SQL query: " . $conn->error . "</td></tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>form_id not provided</td></tr>";
                                    }
                                    ?>
                                    <div class="modal fade" id="editProfessionalModal<?php echo $erow['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Prectice & Employer History</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    include 'content_professional_reference_tab.php';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
    </section>
    <!-- end  Professional referance-->


    <!-- State Selection -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">State Selection</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="button" data-toggle='modal' data-target='#editStateModal' class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add State Selection</button>
                        </div>
                        <table id="example18" class="data-table table table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Provider Name</th>
                                    <th>State</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_GET['id'])) {
                                        $form_id = intval($_GET['id']); // Ensure $form_id is an integer

                                       

                                        // Prepare select statement to fetch personal reference records
                                        $sql = "SELECT * FROM me_onboarding_state_board_setup WHERE form_id = ?";
                                        if ($stmt = $conn->prepare($sql)) {
                                            $stmt->bind_param("i", $form_id);
                                            $stmt->execute();

                                            $stateresult = $stmt->get_result();

                                            if ($stateresult->num_rows > 0) {
                                                // echo "<table>";
                                                // echo "<tr><th>First Name</th><th>Company Name</th><th>Title</th><th>Email</th><th>Phone</th><th>Actions</th></tr>";
                                                while ($staterow = $stateresult->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $staterow["user_name"] . "</td>";
                                                    echo "<td>" . $staterow["city_first_job"] . "</td>";
                                                   
                                                    echo "<td>
                                                            <a href='#' data-id='" . $staterow['form_id'] . "' class='btn btn-outline-primary btn-sm edit-btn' data-toggle='modal' data-target='#editStateModal'" . $staterow['id'] . "''><i class='fas fa-edit'></i></a>
                                                            <a href='index.php?pid=admin_edit_boarding_app_form&id={$staterow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-bell'></i></a>

                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$staterow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-sync-alt'></i></a>
                                                               
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$staterow['id']}&action=deletestate' class='btn btn-sm btn-outline-primary'><i class='fas fa-times'></i></a></td>";
                                                    echo "</tr>";
                                                }
                                                echo "</table>";
                                            } else {
                                                echo "<tr><td colspan='6'>No personal reference data available</td></tr>";
                                            }
                                            $stmt->close();
                                        } else {
                                            echo "<tr><td colspan='6'>Error executing the SQL query: " . $conn->error . "</td></tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>form_id not provided</td></tr>";
                                    }
                                    ?>
                                    <div class="modal fade" id="editStateModal<?php echo $staterow['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">State Selection</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    include 'content_state_selection_tab.php';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </tbody>
                        </table>


                    </div>

                    <!-- </div>

            </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- end state selection -->




    <!-- licensure state license -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">Licensure: License Dea ,Cda(if applicable)</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="button" data-toggle='modal' data-target='#editlicensureModal' class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Licensure</button>
                        </div>
                        <table id="example18" class="data-table table table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>License Type</th>
                                    <th>License Name</th>
                                    <th>State</th>
                                    <th>Status </th>
                                    <th>Primary</th>
                                    <th>Issue Date</th>
                                    <th>Exp Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_GET['id'])) {
                                        $form_id = intval($_GET['id']); // Ensure $form_id is an integer

                                        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['record_id'])) {
                                            $record_id = intval($_GET['record_id']); // Ensure $record_id is an integer

                                            $sql_delete = "DELETE FROM me_onboarding_licensure WHERE id = ?";
                                            if ($stmt_delete = $conn->prepare($sql_delete)) {
                                                $stmt_delete->bind_param("i", $record_id);
                                                if ($stmt_delete->execute()) {
                                                    echo "<div>Record deleted successfully</div>";
                                                } else {
                                                    echo "<div>Error deleting record: " . $conn->error . "</div>";
                                                }
                                                $stmt_delete->close();
                                            } else {
                                                echo "<div>Error preparing the SQL delete query</div>";
                                            }
                                        }

                                        $sql = "SELECT * FROM me_onboarding_licensure WHERE form_id = ?";
                                        if ($stmt = $conn->prepare($sql)) {
                                            $stmt->bind_param("i", $form_id);
                                            $stmt->execute();

                                            $licenseresult = $stmt->get_result();

                                            if ($licenseresult->num_rows > 0) {
                                               
                                                while ($lrow = $licenseresult->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $lrow["license_type"] . "</td>";
                                                    echo "<td>" . $lrow["license_no"] . "</td>";
                                                    echo "<td>" . $lrow["license_state"] . "</td>";
                                                    echo "<td>" . $lrow["status"] . "</td>";
                                                    echo "<td>" . $lrow["primary_license"] . "</td>";
                                                    echo "<td>" . $lrow["issue_date"] . "</td>";
                                                    echo "<td>" . $lrow["expiry_date"] . "</td>";
                                                    echo "<td>
                                                            <a href='#' data-id='" . $lrow['form_id'] . "' class='btn btn-outline-primary btn-sm edit-btn' data-toggle='modal' data-target='#editlicensureModal'" . $lrow['id'] . "''><i class='fas fa-edit'></i></a>
                                                          <a href='index.php?pid=admin_edit_boarding_app_form&id={$lrow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-bell'></i></a>

                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$lrow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-sync-alt'></i></a>
                                                               
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$lrow['id']}&action=deletelicense' class='btn btn-sm btn-outline-primary'><i class='fas fa-times'></i></a></td>";
                                                    echo "</tr>";
                                                }
                                                echo "</table>";
                                            } else {
                                                echo "<tr><td colspan='7'>No licensure data available</td></tr>";
                                            }
                                            $stmt->close();
                                        } else {
                                            echo "<tr><td colspan='7'>Error executing the SQL query: " . $conn->error . "</td></tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>form_id not provided</td></tr>";
                                    }
                                    ?>
                                    <div class="modal fade" id="editlicensureModal<?php echo $lrow['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Licensure: License Dea ,Cda(if applicable)</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    include 'content_licensure_tab.php';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- state board online portal  -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">State Board Online Portal</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="button" data-toggle='modal' data-target='#editStateBoardModal' class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add State Board</button>
                        </div>
                        <table id="example18" class="data-table table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Website</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_GET['id'])) {
                                        $form_id = intval($_GET['id']); // Ensure $form_id is an integer

                                        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['record_id'])) {
                                            $record_id = intval($_GET['record_id']); // Ensure $record_id is an integer

                                            $sql_delete = "DELETE FROM me_onboarding_state_board_setup WHERE id = ?";
                                            if ($stmt_delete = $conn->prepare($sql_delete)) {
                                                $stmt_delete->bind_param("i", $record_id);
                                                if ($stmt_delete->execute()) {
                                                    echo "<div>Record deleted successfully</div>";
                                                } else {
                                                    echo "<div>Error deleting record: " . $conn->error . "</div>";
                                                }
                                                $stmt_delete->close();
                                            } else {
                                                echo "<div>Error preparing the SQL delete query</div>";
                                            }
                                        }

                                        $sql = "SELECT * FROM me_onboarding_state_board_setup WHERE form_id = ?";
                                        if ($stmt = $conn->prepare($sql)) {
                                            $stmt->bind_param("i", $form_id);
                                            $stmt->execute();

                                            $statebresult = $stmt->get_result();

                                            if ($statebresult->num_rows > 0) {
                                            
                                                while ($sbrow = $statebresult->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $sbrow["user_name"] . "</td>";
                                                    echo "<td>" . $sbrow["website"] . "</td>";
                                                    echo "<td>
                                                            <a href='#' data-id='" . $sbrow['form_id'] . "' class='btn btn-outline-primary btn-sm edit-btn' data-toggle='modal' data-target='#editStateBoardModal'" . $sbrow['id'] . "''><i class='fas fa-edit'></i></a>
                                                            <a href='index.php?pid=admin_edit_boarding_app_form&id={$sbrow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-bell'></i></a>

                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$sbrow['id']}' class='btn btn-sm btn-outline-primary'><i class='fas fa-sync-alt'></i></a>
                                                               
                                                                <a href='index.php?pid=admin_edit_boarding_app_form&id={$sbrow['id']}&action=deletestateboard' class='btn btn-sm btn-outline-primary'><i class='fas fa-times'></i></a></td>";

                                                    echo "</tr>";
                                                }
                                                echo "</table>";
                                            } else {
                                                echo "<tr><td colspan='3'>No state board setup data available</td></tr>";
                                            }
                                            $stmt->close();
                                        } else {
                                            echo "<tr><td colspan='3'>Error executing the SQL query: " . $conn->error . "</td></tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>form_id not provided</td></tr>";
                                    }
                                    ?>
                                    <div class="modal fade" id="editStateBoardModal<?php echo $sbrow['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Licensure: License Dea ,Cda(if applicable)</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    include 'content_state_board_setup_tab.php';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- end state board online portal -->



    <!-- Required Suporting Documents -->

    <section class="content">
        <div class="container-fluid">
            <?php
 $is_admin_form = 1;
    include("content_require_supporting_tab.php");
    ?>
        </div>
    </section>


    <!-- end Required Suporting Documents-->

    <!-- Additional Questions -->
    <section class="content">
        <div class="container-fluid">
            <?php
     $is_admin_form = 1;
       include("content_additional_question_tab.php");
    ?>
        </div>
    </section>
    <!-- end additional questions  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function(e) {
              e.preventDefault();
              var id = $(this).data('id');
              
              // Fetch the existing data based on id (you might need an AJAX call here)
              $.ajax({
                url: 'get_education_data.php', // Your script to get the data
                type: 'GET',
                data: { id: id },
                success: function(response) {
                  // Assuming the response is a JSON object with the data
                  var data = JSON.parse(response);
                  
                  // Populate the modal fields with the existing data
                  $('#institute_type').val(data.institute_type);
                  $('#institute_name').val(data.institute_name);
                  $('#program_completed').val(data.program_completed);
                  $('#degree').val(data.degree);
                  $('#start_date').val(data.start_date);
                  $('#end_date').val(data.end_date);
                  $('#graduation_date').val(data.graduation_date);
                  
                  // Open the modal
                  $('#editModal').modal('show');
                }
              });
            });
        
            $('#editForm').on('submit', function(e) {
              e.preventDefault();
              
              // Submit the updated data
              $.ajax({
                url: 'update_education_data.php', // Your script to update the data
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                  // Handle the response (e.g., close the modal and refresh the table)
                  $('#editModal').modal('hide');
                  location.reload(); // Reload the page to reflect the changes
                }
              });
            });
          });
    </script>