<!-- <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Client</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?pid=home">Home</a></li>
                    <li class="breadcrumb-item active">Client</li>
                </ol>
            </div>
        </div>
    </div>
</div> -->

<style>
    .select2 .select2-selection--single
    {
        height: 40px!important;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <?php 
         if (isset($_REQUEST['id'])) 
         {
            require_once("config.php");
            $id = $_REQUEST['id'];
           $status_query = "SELECT status FROM me_onboarding_application WHERE form_id = '$id'";
            $status_result = mysqli_query($conn, $status_query);
            if ($status_result) {
                $status_row = mysqli_fetch_assoc($status_result);
                // print_r($status_row);
                if ($status_row['status'] == 1) {
                    $is_readonly = true;
                } else {
                    $is_readonly = false;
                }
            }
        } else {
            $is_readonly = false;
        }
    // print_r($status_result);
            $selected_tab="provider-demographic";
            if(isset($_REQUEST['tab']) && $_REQUEST['tab']!=""){$selected_tab=$_REQUEST['tab'];}

            // include 'functions.php';
            // print_r($_SESSION);
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
                
                

                // echo "<script>console.log(".json_encode($OnBordingDetailsArray).")</script>";
           } 
        //    Get States list
        $API_REQ_DATA=array();
        $API_REQ_DATA['page_limit']=0;
        $API_REQ_DATA['apitoken']=$_SESSION['me_apitoken'];
        $API_REQ_URL=$api_url."states/select_list.php";
        $StateListJSON=CallAPI("POST", $API_REQ_URL, $API_REQ_DATA);
        
        $StateListArray=json_decode($StateListJSON,true);
        $StateList=$StateListArray["data"];
        // print_r($StateListArray);

        $license_status_list=array("Active","Active - Renewal In Process","Active/Probation","Active/Restricted","Annulled","Application - Pending","Application - Submitted","Application Fee Pending","Cancelled","Closed","Closed ","Closed/Abandoned","Closed/Advanced","Closed/Deceased","Closed/Denied","Deactivated","Deficient","Denied","Emeritus","Expired","Expired Inactive","In Review","In Review/Additional Information ","In Review/Exam Eligible ","Inactive","Inactive/Expired ","Inactive/Lapsed","Inactive/Revocation","Inactive/Surrendered ","Inactive/Suspended ","License Issued","Non Disciplinary Suspension","Pending Board Review","Pending Verifications","Probation","Revoked","Submitted","Suspended","Terminated","Unencumbered (Full Unrestricted License)","Voluntarily Surrender","Withdrawn");
        $medical_board_list=array("AK - Alaska Division of Occupational Licensing","AL - Alabama State Medical Board","AR - Arkansas State Medical Board","AZ - Arizona Board of Osteopathic Examiners","AZ - Arizona Medical Board","CA - Medical Board of California","CA - Osteopathic Medical Board of California","CO - Colorado Medical Board","CT - Connecticut Medical Examining Board","DC - District of Columbia Medical Board","DE - Delaware State Medical Board","FL - Florida State Medical Board","FL - Florida Board of Osteopathic Medicine","GA - Georgia Composite Medical Board","HI - Hawaii Medical Examining Board","HI - Hawaii Medical Examining Board (DOs)","IA - Iowa Board of Medical Examiners","ID - Idaho State Medical Board","IL- Illinois Department of Professional Regulation","IN - Indiana Medical Board","IN - Indiana Medical Board (DOs)","KS - Kansas State Board of Healing Arts","KY - Kentucky Board of Medical Licensure","LA - Louisiana State Medical Board","MA - Massachusetts Board of Registration in Medicine","MA - Massachusetts Board of Registration in Medicine (DOs)","MD - Maryland Board of Physicians","ME - Maine Board of Licensure in Medicine","ME - Maine Board of Osteopathic Physicians","MI - Michigan Board of Medicine","MN - Minnesota State Medical Board","MO - Missouri Board of Registration for the Healing Arts","MS - Mississippi Medical Board","MT - Montana Board of Medical Examiners","NC - North Carolina Board of Medical Examiners","ND - North Dakota Medical Board","NE - Nebraska Health and Human Services Licensure","NH - New Hampshire Board of Medical Examiners","NJ - New Jersey State Medical Board","NM - New Mexico Medical Examining Board","NM - New Mexico Medical Examining Board (DOs)","NV - Nevada Medical Examining Board","NV - Nevada State Osteopathic Medical Board","NY - New York State Medical Licensing","OH - Ohio Medical Examining Board","OK - Oklahoma Board of Medical Licensure","OK - Oklahoma Board of Medical Licensure (DOs)","OR - Oregon Board of Medical Examiners","PA - Pennsylvania Medical Board","PA - Pennsylvania Medical Board (DOs)","RI - Rhode Island Board of Medical Licensure","SC - South Carolina State Medical Board","SD - South Dakota Board of Medical Examiners","TN - Tennessee Board of Osteopathic Examination","TN - Tennessee Medical Examining Board","TX - Texas Board of Medical Examiners","UT - Utah Osteopathic Licensing","UT - Utah Physician Licensing","VA - Virginia Board of Medical Examiners","VA - Virginia Board of Medical Examiners (DOs)","VT - Vermont Medical Examining Board","VT - Vermont Osteopathic Physicians Board","WA - Washington Board of Osteopathic Medicine and Surgery","WA - Washington State Medical Commission","WI - Wisconsin Medical Licensing","WV - West Virginia Board of Medical Examiners","WY - Wyoming Board of Medical Examiners");   
        $eye_color_list=array("amber", "blue", "brown", "gray", "green", "hazel", "red");   
        $hair_color_list=array("Black" ,"Dark brown","Medium brown","Natural brown","Light brown","Chestnut brown","Light chestnut brown","Auburn","Red","Orange red","Copper","Titian","Strawberry blond","Light blond","Golden blond","Medium blond","Grey","White");   
        $readonly = $is_readonly ? 'readonly' : '';
?>
        

        <div class="row">
            <div class="col-lg-3 col-md-5 col-sm-6">
                <div class="d-flex align-items-start">
                    <div class="custom-secondary-sidebar nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link <?php if($selected_tab=="provider-demographic"){echo 'active';} ?>" id="provider-demographic-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=provider-demographic"  role="tab">Provider Demographic</a>
                        
                        <a class="nav-link <?php if($selected_tab=="education-training"){echo 'active';} ?>" id="education-training-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=education-training"  >Education & Training</a>
                        
                        <a class="nav-link <?php if($selected_tab=="exam-history"){echo 'active';} ?>" id="exam-history-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=exam-history" >Exam History</a>
                        
                        <a class="nav-link <?php if($selected_tab=="board-certification"){echo 'active';} ?>" id="board-certification-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=board-certification" >Board Certification</a>
                        
                        <a class="nav-link <?php if($selected_tab=="practice-employer"){echo 'active';} ?>" id="practice-employer-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=practice-employer">Practice & Employer History</a>
                        
                        <a class="nav-link <?php if($selected_tab=="hospital-facility"){echo 'active';} ?>" id="hospital-facility-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=hospital-facility" >Hospital / Facility Affiliations</a>
                        
                        <a class="nav-link <?php if($selected_tab=="professional-references"){echo 'active';} ?>" id="professional-references-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=professional-references" >Professional References</a>
                        
                        <a class="nav-link <?php if($selected_tab=="state-selection"){echo 'active';} ?>" id="state-selection-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=state-selection"  >State Selection</a>
                        
                        <a class="nav-link <?php if($selected_tab=="licensure"){echo 'active';} ?>" id="licensure-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=licensure" >Licensure: State Licence, Dea, CDS (Id Applicable)</a>
                        
                        <a class="nav-link <?php if($selected_tab=="state-board-setup"){echo 'active';} ?>" id="state-board-setup-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=state-board-setup" >State board online portal setup</a>
                        
                        <a class="nav-link <?php if($selected_tab=="require-supporting-doc"){echo 'active';} ?>" id="require-supporting-doc-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=require-supporting-doc" >Required supporting documents</a>
                        
                        <a class="nav-link <?php if($selected_tab=="additional-question"){echo 'active';} ?>" id="additional-question-tab"  href="index.php?pid=<?php echo $_REQUEST['pid'];if(isset($_REQUEST['id'])){echo "&id=".$_REQUEST['id'];}?>&tab=additional-question"   >Additional Questions</a>
                        
                    </div>
                </div>  
            </div>  
            <div class="col-lg-9 col-md-7 col-sm-6">
                <div class="tab-content" id="v-pills-tabContent">
                    <?php if($selected_tab=="provider-demographic"){ ?>
                    <div class="tab-pane fade <?php if($selected_tab=="provider-demographic"){echo 'show active';} ?>" id="provider-demographic" role="tabpanel" aria-labelledby="provider-demographic-tab"><?php include "content_provider_demographic_tab.php"; ?></div>
                    <?php } ?>

                    <?php if($selected_tab=="education-training"){ ?>
                    <div class="tab-pane fade <?php if($selected_tab=="education-training"){echo 'show active';} ?>" id="education-training" role="tabpanel" aria-labelledby="education-training-tab"><?php include "content_education_training_tab.php"; ?></div>
                    <?php } ?>

                    <?php if($selected_tab=="exam-history"){ ?>
                    <div class="tab-pane fade <?php if($selected_tab=="exam-history"){echo 'show active';} ?>" id="exam-history" role="tabpanel" aria-labelledby="exam-history-tab"><?php include "content_exam_history_tab.php"; ?></div>
                    <?php } ?> 

                    <?php if($selected_tab=="board-certification"){ ?>
                    <div class="tab-pane fade <?php if($selected_tab=="board-certification"){echo 'show active';} ?>" id="board-certification" role="tabpanel" aria-labelledby="board-certification-tab"><?php include "content_board_certification_tab.php"; ?></div>
                    <?php } ?>

                    <?php if($selected_tab=="practice-employer"){ ?>
                    <div class="tab-pane fade <?php if($selected_tab=="practice-employer"){echo 'show active';} ?>" id="practice-employer" role="tabpanel" aria-labelledby="practice-employer-tab"><?php include "content_practice_employer_tab.php"; ?></div>
                    <?php } ?>

                    <?php if($selected_tab=="hospital-facility"){ ?>
                    <div class="tab-pane fade <?php if($selected_tab=="hospital-facility"){echo 'show active';} ?>" id="hospital-facility" role="tabpanel" aria-labelledby="hospital-facility-tab"><?php include "content_hospital_facility_affiliation_tab.php"; ?></div>
                    <?php } ?>
                    
                    <?php if($selected_tab=="professional-references"){?>
                    <div class="tab-pane fade <?php if($selected_tab=="professional-references"){echo 'show active';} ?>" id="professional-references" role="tabpanel" aria-labelledby="professional-references-tab"><?php include "content_professional_reference_tab.php"; ?></div>
                    <?php } ?>

                    <?php if($selected_tab=="state-selection"){ ?>
                    <div class="tab-pane fade <?php if($selected_tab=="state-selection"){echo 'show active';} ?>" id="state-selection" role="tabpanel" aria-labelledby="state-selection-tab"><?php include "content_state_selection_tab.php"; ?></div>
                    <?php } ?>

                    <?php if($selected_tab=="licensure"){ ?>
                    <div class="tab-pane fade <?php if($selected_tab=="licensure"){echo 'show active';} ?>" id="licensure" role="tabpanel" aria-labelledby="licensure-tab"><?php include "content_licensure_tab.php"; ?></div>
                    <?php } ?>

                    <?php if($selected_tab=="state-board-setup"){ ?>
                        <div class="tab-pane fade <?php if($selected_tab=="state-board-setup"){echo 'show active';} ?>" id="state-board-setup" role="tabpanel" aria-labelledby="state-board-setup-tab"><?php include "content_state_board_setup_tab.php"; ?></div>
                    <?php } ?> 
                    
                    <?php if($selected_tab=="require-supporting-doc"){ ?>
                    <div class="tab-pane fade <?php if($selected_tab=="require-supporting-doc"){echo 'show active';} ?>" id="require-supporting-doc" role="tabpanel" aria-labelledby="require-supporting-doc-tab"><?php include "content_require_supporting_tab.php"; ?></div>
                    <?php } ?>    

                    <?php if($selected_tab=="additional-question"){ ?>    
                    <div class="tab-pane fade <?php if($selected_tab=="additional-question"){echo 'show active';} ?>" id="additional-question" role="tabpanel" aria-labelledby="additional-question-tab"><?php include "content_additional_question_tab.php"; ?></div>
                    <?php } ?>   
                    
                </div>
                <!-- </div> -->
            </div>   
        </div>        

    </div>
</section>