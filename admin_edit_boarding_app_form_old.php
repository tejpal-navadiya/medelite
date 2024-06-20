<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once("config.php");
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
                                <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                            </div>        
                        </div>
                    </div>
                    <div class="card">
                            <div class="card-header">
                                <div class="row">
                                        <div class="col-sm-6">
                                            <!-- <label for="firstname" class="control-label">Practice /Employer /Facility Type<span class="text-danger">*</span> </label> -->
                                                    <div class="form-group">
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
                                                    </div>
                                            </div>
                                           
                                        </div>
                                </div>
                        </div>
                    <div class="card-body">
                    <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/controller_action_api_call.php">
                    <?php 
                        if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
                        {
                            // print_r($OnBordingDetails);
                            ?>
                            <input type="hidden" name="action" value="update_provider_form"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=provider-demographic&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=education-training&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }else
                        {
                            ?>
                            <input type="hidden" name="action" value="add_provider_form"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=education-training"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=provider-demographic"/>
                            <?php
                        }
                    ?>
                    
                    <div class="row" style="padding: 15px;">
                    <?php
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="id" value="'.$_REQUEST['id'].'">';
                        } ?>
                        <div class="col-sm-12"><label for="firstname" class="control-label">Name <span class="text-danger">*</span></label></div>
                        
                        <div class="col-sm-6 col-md-4">
                            
                            <div class="form-group">
                                <input type="text" maxlength="150" data-is_validate="1" name="title" id="title" class="form-control" placeholder="Title" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['title'])){echo $OnBordingDetails['title'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" name="first_name" data-is_validate="1" id="first_name"  class="form-control" placeholder="First Name" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['first_name'])){echo $OnBordingDetails['first_name'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" name="middle_name" id="middle_name" data-is_validate="1" class="form-control" placeholder="Middle Name" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['middle_name'])){echo $OnBordingDetails['middle_name'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" data-is_validate="1" name="last_name" id="last_name"  class="form-control" placeholder="Last Name" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['last_name'])){echo $OnBordingDetails['last_name'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" data-is_validate="1" name="suffix" id="suffix"  class="form-control" placeholder="suffix" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['suffix'])){echo $OnBordingDetails['suffix'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Provider Type<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <!-- <input type="text" name="provider_type" data-is_validate="1" id="provider_type"  class="form-control" placeholder="Provider Type" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['provider_type'])){echo $OnBordingDetails['provider_type'];} ?>"  > -->

                                <select data-placeholder="Select Provider" data-is_validate="0" name="provider_type" id="provider_type"  class="select2 form-control" >

                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Maiden/Other Alias </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="maiden_other_alias" id="maiden_other_alias"  class="form-control" placeholder="Maiden/Other Alias" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['maiden_other_alias'])){echo $OnBordingDetails['maiden_other_alias'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Personal Email<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="email" maxlength="100" data-is_validate="1" name="personal_email" id="personal_email"  class="form-control" placeholder="Personal Email" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_email'])){echo $OnBordingDetails['personal_email'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Mobile Phone<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="tel" maxlength="10" data-is_validate="1" name="personal_mobile_no" id="personal_mobile_no"  class="form-control" placeholder="Mobile Phone" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_mobile_no'])){echo $OnBordingDetails['personal_mobile_no'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        
                        <div class="col-sm-12"><label for="firstname" class="control-label">Home Address <span class="text-danger">*</span></label></div>
                        
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <input type="text" maxlength="150" data-is_validate="1" name="personal_address_line_1" id="personal_ddress_line_1" class="form-control" placeholder="Address Line 1" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_line_1'])){echo $OnBordingDetails['personal_address_line_1'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" maxlength="100" name="personal_address_line_2" id="personal_address_line_2"  class="form-control" placeholder="Address Line 2" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_line_2'])){echo $OnBordingDetails['personal_address_line_2'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" data-is_validate="1" name="personal_address_city" id="personal_address_city"  class="form-control" placeholder="City" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_city'])){echo $OnBordingDetails['personal_address_city'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                               
                                <select data-placeholder="select state" data-is_validate="1" name="personal_address_state" id="personal_address_state"  class="form-control state_dropdown" placeholder="State" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_state_sel'])){echo base64_encode($OnBordingDetails['personal_address_state_sel']);} ?>" >
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" data-is_validate="1" name="personal_address_zipcode" id="personal_address_zipcode"  class="form-control" placeholder="Zip Code" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_zipcode'])){echo $OnBordingDetails['personal_address_zipcode'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Business Email<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="email" maxlength="100" data-is_validate="1" name="business_email" id="business_email"  class="form-control" placeholder="Business Email" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_email'])){echo $OnBordingDetails['business_email'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Business Phone<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="tel" maxlength="10" data-is_validate="1" name="business_phone" id="business_phone"  class="form-control" placeholder="Business Phone" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_phone'])){echo $OnBordingDetails['business_phone'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        
                        <div class="col-sm-12"><label for="firstname" class="control-label">Business/Public Use Address <span class="text-danger">*</span></label></div>
                        
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <input type="text" data-is_validate="1" maxlength="150" name="business_address_line_1" id="business_address_line_1" class="form-control" placeholder="Address Line 1" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_line_1'])){echo $OnBordingDetails['business_address_line_1'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" maxlength="100" name="business_address_line_2" id="business_address_line_2"  class="form-control" placeholder="Address Line 2" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_line_2'])){echo $OnBordingDetails['business_address_line_2'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" data-is_validate="1" name="business_address_city" id="business_address_city"  class="form-control" placeholder="City" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_city'])){echo $OnBordingDetails['business_address_city'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <!-- <input type="text" maxlength="100" name="state" id="state"  class="form-control" placeholder="State" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['state'])){echo $OnBordingDetails['state'];} ?>" > -->
                                <select data-placeholder="select state" data-is_validate="1" name="business_address_state" id="business_address_state"  class="form-control state_dropdown" placeholder="State" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_state_sel'])){echo base64_encode($OnBordingDetails['business_address_state_sel']);} ?>" >
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" data-is_validate="1" name="business_address_zipcode" id="business_address_zipcode"  class="form-control" placeholder="Zip Code" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_zipcode'])){echo $OnBordingDetails['business_address_zipcode'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>

                        
                        <div class="col-md-12">
                            <h4>Birth/Fingerprinting Information</h4>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Gender<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="gender" class="form-control" id="gender">
                                    <option value="Male" <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['gender']) && $OnBordingDetails['gender']=="Male"){echo "selected";} ?>>Male</option>
                                    <option value="Female" <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['gender']) && $OnBordingDetails['gender']=="Female"){echo "selected";} ?>>Female</option>
                                    <option value="Other" <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['gender']) && $OnBordingDetails['gender']=="Other"){echo "selected";} ?>>Other</option>
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">DOB<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="dob" id="dob" data-is_validate="1"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['dob'])){echo $OnBordingDetails['dob'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Birth City<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="birth_city" data-is_validate="1" id="birth_city"  class="form-control" placeholder="Birth City" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['birth_city'])){echo $OnBordingDetails['birth_city'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Birth State<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                
                                <select name="birth_state" data-is_validate="1" class="form-control state_dropdown" id="birth_state" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['birth_state_sel'])){echo base64_encode($OnBordingDetails['birth_state_sel']);} ?>">
                                    <option value="">Select State</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Birth Country<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="birth_country" data-is_validate="1" class="form-control country_dropdown" id="birth_country" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['birth_country_sel'])){echo base64_encode($OnBordingDetails['birth_country_sel']);} ?>">
                                    <option value="">Select Country</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Country of Citizenship<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="country_of_citizenship" data-is_validate="1" class="form-control country_dropdown" id="country_of_citizenship" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['country_of_citizenship_sel'])){echo base64_encode($OnBordingDetails['country_of_citizenship_sel']);} ?>">
                                    <option value="">Select Country</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Ethnicity<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="ethnicity" class="form-control select2" id="ethnicity">
                                    <option value="">Select Ethnicity</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Hair Color<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="hair_color" class="form-control select2" data-is_validate="1" id="hair_color">
                                    <option value="">Select Hair Color</option>
                                    <?php 
                                        for ($i=0; $i < count($hair_color_list); $i++) 
                                        { 
                                            $selected_hair_color="";
                                            $sel_id=$i+1;
                                            if(isset($_REQUEST['id']) && isset($OnBordingDetails['hair_color']) && $OnBordingDetails['hair_color']==$sel_id)
                                            {
                                                $selected_hair_color="selected";
                                            }
                                            echo "<option value='".($i+1)."' ".$selected_hair_color.">".$hair_color_list[$i]."</option>";
                                        }
                                    ?>
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Eye Color<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="eye_color" class="form-control select2" id="eye_color" data-is_validate="1">
                                    <option value="">Select Eye Color</option>
                                    <?php 
                                        for ($i=0; $i < count($eye_color_list); $i++) 
                                        { 
                                            $selected_eye_color="";
                                            $sel_id=$i+1;
                                            if(isset($_REQUEST['id']) && isset($OnBordingDetails['eye_color']) && $OnBordingDetails['eye_color']==$sel_id)
                                            {
                                                $selected_eye_color="selected";
                                            }
                                            echo "<option value='".($i+1)."' ".$selected_eye_color.">".$eye_color_list[$i]."</option>";

                                            // echo "<option value='".($i+1)."'>".$eye_color_list[$i]."</option>";
                                        }
                                    ?>
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Height(ft)<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="height_feet" class="form-control select2" id="height_feet" data-is_validate="1">
                                    <option value="">Select Height</option>
                                    <?php 
                                        for ($i=1; $i < 10; $i++) 
                                        { 
                                            $selected_height_feet="";
                                            $sel_id=$i;
                                            if(isset($_REQUEST['id']) && isset($OnBordingDetails['height_feet']) && $OnBordingDetails['height_feet']==$sel_id)
                                            {
                                                $selected_height_feet="selected";
                                            }
                                            // echo "<option value='".($i+1)."' ".$selected_height_feet.">".$hair_color_list[$i]."</option>";

                                            echo "<option value='".$i."' ".$selected_height_feet.">".($i)."</option>";
                                        }
                                    ?>
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Height(in)<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="height_in" class="form-control select2" id="height_in" data-is_validate="1">
                                    <option value="">Select Height</option>
                                    <?php 
                                        for ($i=1; $i < 13; $i++) 
                                        { 
                                            $selected_height_in="";
                                            $sel_id=$i;
                                            if(isset($_REQUEST['id']) && isset($OnBordingDetails['height_in']) && $OnBordingDetails['height_in']==$sel_id)
                                            {
                                                $selected_height_in="selected";
                                            }

                                            echo "<option value='".$i."' ".$selected_height_in.">".($i)."</option>";
                                            // echo "<option value='".$i."'>".($i)."</option>";
                                        }
                                    ?>
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Weight (lbs)<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="weight_lbs" id="weight_lbs"  class="form-control" placeholder="Weight (lbs)" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['weight_lbs'])){echo $OnBordingDetails['weight_lbs'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4>Identification</h4>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Drivers License<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="driver_licence" id="driver_licence"  class="form-control" placeholder="Drivers License" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['driver_licence'])){echo $OnBordingDetails['driver_licence'];} ?>"  data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">State Issued<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <!-- <input type="text" name="state_issued" class="form-control" id="state_issued" /> -->
                                <select data-placeholder="select state" name="state_issued" id="state_issued"  class="form-control state_dropdown" placeholder="State" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['state_issued_sel'])){echo base64_encode($OnBordingDetails['state_issued_sel']);} ?>"  data-is_validate="1">
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">FCVS Id<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="fcvs_id" id="fcvs_id"  class="form-control" placeholder="FCVS Id" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['fcvs_id'])){echo $OnBordingDetails['fcvs_id'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Issue Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="issue_date" id="issue_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['issue_date'])){echo $OnBordingDetails['issue_date'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Expiry Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="expiry_date" id="expiry_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['expiry_date'])){echo $OnBordingDetails['expiry_date'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">CAQH Number<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="caqh_no" id="caqh_no"  class="form-control" placeholder="CAQH Number" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['caqh_no'])){echo $OnBordingDetails['caqh_no'];} ?>"  data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">NPI #<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="npi_no" id="npi_no"  class="form-control" placeholder="NPI #" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['npi_no'])){echo $OnBordingDetails['npi_no'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">SSN<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="ssn_no" id="ssn_no"  class="form-control" placeholder="SSN" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['ssn_no'])){echo $OnBordingDetails['ssn_no'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">TIN<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="tin_no" id="tin_no"  class="form-control" placeholder="TIN" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['tin_no'])){echo $OnBordingDetails['tin_no'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4>Military Service</h4>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">Are You Currently Serving Military or have you server military previously? </label>
                            <div class="form-group">
                                <input type="radio"  name="is_military_person" id="is_military_person_yes" value="1"   <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['is_military_person']) && $OnBordingDetails['is_military_person']==1){echo "checked";} ?>> <label for="is_military_person_yes">Yes</label>

                                <input type="radio"  name="is_military_person" id="is_military_person_no" value="0"   <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['is_military_person']) && $OnBordingDetails['is_military_person']==0){echo "checked";} ?>> <label for="is_military_person_no">No</label>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">Are you married to, or in a domestic partnership or other legal union, with an active-duty member of the U.S. military officially assigned to duty? </label>
                            <div class="form-group">
                                <input type="radio"  name="is_partner_military_person" id="is_partner_military_person_yes" value="1"   <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['is_partner_military_person']) && $OnBordingDetails['is_partner_military_person']==1){echo "checked";} ?>> <label for="is_partner_military_person_yes">Yes</label>

                                <input type="radio"  name="is_partner_military_person" id="is_partner_military_person_no" value="0"   <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['is_partner_military_person']) && $OnBordingDetails['is_partner_military_person']==0){echo "checked";} ?>> <label for="is_partner_military_person_no">No</label>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Branch<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" name="branch" class="form-control" id="branch" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['branch'])){echo $OnBordingDetails['branch'];} ?>"/>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Service Begin Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="service_start_date" id="service_start_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['service_start_date'])){echo $OnBordingDetails['service_start_date'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Service End Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="service_end_date" id="service_end_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['service_end_date'])){echo $OnBordingDetails['service_end_date'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Rank At Discharge<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="discharge_rank" id="discharge_rank"  class="form-control" placeholder="Rank At Discharge" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['discharge_rank'])){echo $OnBordingDetails['discharge_rank'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Type of Discharge<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" name="discharge_type" id="discharge_type"  class="form-control" placeholder="Type of Discharge" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['discharge_type'])){echo $OnBordingDetails['discharge_type'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">If other than honorable, please explain<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="255" name="other_honor_detail" id="other_honor_detail"  class="form-control" placeholder="If other than hounorable, please explain" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['other_honor_detail'])){echo $OnBordingDetails['other_honor_detail'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
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
                    <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/controller_action_api_call.php">
                    <?php 
                        if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
                        {
                            // print_r($OnBordingDetails);
                            ?>
                            <input type="hidden" name="action" value="update_provider_form"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=provider-demographic&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=education-training&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }else
                        {
                            ?>
                            <input type="hidden" name="action" value="add_provider_form"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=education-training"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=provider-demographic"/>
                            <?php
                        }
                    ?>
                    
                    <div class="row" style="padding: 15px;">
                    <?php
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="id" value="'.$_REQUEST['id'].'">';
                        } ?>
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
                                  
                                    $sql = "SELECT * FROM me_onboarding_education_training";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output data for each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["institution_type"] . "</td>";
                                            echo "<td>" . $row["institute_name"] . "</td>";
                                            echo "<td>" . $row["program_completed"] . "</td>";
                                            echo "<td>" . $row["degree"] . "</td>";
                                            echo "<td>" . $row["start_date"] . "</td>";
                                            echo "<td>" . $row["end_date"] . "</td>";
                                            echo "<td>" . $row["graduation_date"] . "</td>";
                                            echo "<td><button class='edit-btn'>Edit</button> <button class='delete-btn'>Delete</button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No data available</td></tr>";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>


                <?php 
                    $cnt=$cnt_i+1;
                ?>
                <div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">
                    <?php 
                    if($cnt==1)
                    {
                        ?>
                        <div class="col-sm-12"><h5><u>Institution <?php echo $cnt; ?></u></h5></div>
                        <?php
                    }else
                    {
                    ?>
                    <div class="col-sm-8 col-md-9"><h5><u>Institution <?php echo $cnt; ?></u></h5></div>
                    <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
                    <?php } ?>    
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Institution Type<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <select name="institute_type[]" class="form-control" id="institute_type<?php echo $cnt; ?>">
                                <option value="">Select Type</option>
                                
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Start Date<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text" maxlength="100" name="start_date[]" id="start_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['start_date'])){ echo $cur_detail['start_date'];} ?>">
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">End Date<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text" maxlength="100" name="end_date[]" id="end_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['end_date'])){ echo $cur_detail['end_date'];} ?>">
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="firstname" class="control-label">Institution Name<span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input type="text" name="institute_name[]" id="institute_name<?php echo $cnt; ?>"  class="form-control" placeholder="Institution Name" value="<?php if(isset($cur_detail['institute_name'])){ echo $cur_detail['institute_name'];} ?>"  >
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-sm-12"><label for="firstname" class="control-label">Institute Address <span class="text-danger">*</span></label></div>
                    
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <input type="text" maxlength="150" name="address_line_1[]" id="address_line_1-<?php echo $cnt; ?>" class="form-control" placeholder="Address Line 1" value="<?php if(isset($cur_detail['address_line_1'])){ echo $cur_detail['address_line_1'];} ?>">
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-<?php echo $cnt; ?>"  class="form-control" placeholder="Address Line 2" value="<?php if(isset($cur_detail['address_line_2'])){ echo $cur_detail['address_line_2'];} ?>" >
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <input type="text" maxlength="100" name="address_city[]" id="address_city<?php echo $cnt; ?>"  class="form-control" placeholder="City" value="<?php if(isset($cur_detail['address_city'])){ echo $cur_detail['address_city'];} ?>" >
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <select data-placeholder="Select State" name="address_state[]" id="address_state<?php echo $cnt; ?>"  class="form-control state_dropdown" placeholder="State"  data-val_sel="<?php if(isset($cur_detail['address_state_name_sel'])){ echo base64_encode($cur_detail['address_state_name_sel']);} ?>"></select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <input type="text" maxlength="100" name="address_zipcode[]" id="address_zipcode<?php echo $cnt; ?>"  class="form-control" placeholder="Zip Code" value="<?php if(isset($cur_detail['address_zipcode'])){ echo $cur_detail['address_zipcode'];} ?>" >
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
                        <div class="form-group">
                            <select name="address_country[]" class="form-control  country_dropdown" id="address_country<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['address_country_name_sel'])){ echo base64_encode($cur_detail['address_country_name_sel']);} ?>">
                                <option value="">Select Country</option>
                                
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>

                    
                    
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">Degree<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <select name="degree[]" class="form-control" id="degree<?php echo $cnt; ?>">
                                
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="firstname" class="control-label">Major </label>
                        <div class="form-group">
                            <input type="text" maxlength="100" name="major[]" id="major<?php echo $cnt; ?>"  class="form-control" placeholder="major" value="<?php if(isset($cur_detail['major'])){ echo $cur_detail['major'];} ?>">
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Program Completed?<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <select name="program_completed[]" class="form-control" id="program_completed<?php echo $cnt; ?>">
                                <option value="">Completed</option>
                                
                            </select>
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <label for="firstname" class="control-label">Grad Date<span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text" maxlength="100" name="graduation_date[]" id="graduation_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['graduation_date'])){ echo $cur_detail['graduation_date'];} ?>">
                            <span class="help" id="msg2"></span>
                        </div>
                    </div>
                </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save & Next</button>
                        </div>
                    </div>
                </form>
             </div>
        </div>
     </div>
</div>  
</div>      
</section>

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
                    <table id="example13" class="data-table table table-bordered table-hover">
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
                                 
                                </tbody>
                            </table>
                    <div class="card-body">
                    <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/controller_action_api_call.php">
                    <?php 
                        if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
                        {
                            // print_r($OnBordingDetails);
                            ?>
                            <input type="hidden" name="action" value="update_provider_form"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=provider-demographic&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=education-training&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }else
                        {
                            ?>
                            <input type="hidden" name="action" value="add_provider_form"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=education-training"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=provider-demographic"/>
                            <?php
                        }
                    ?>
                    
                    <div class="row" style="padding: 15px;">
                    <?php
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="id" value="'.$_REQUEST['id'].'">';
                        } ?>
                       <?php 
                                $cnt=$cnt_i+1;
                            ?>
                            <div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">                        
                                <?php 
                                if($cnt==1)
                                {
                                    ?>
                                    <div class="col-sm-12"><h5><u>Exam <?php echo $cnt; ?></u></h5></div>
                                    <?php
                                }else
                                {
                                ?>
                                <div class="col-sm-8 col-md-9"><h5><u>Exam <?php echo $cnt; ?></u></h5></div>
                                <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
                                <?php } ?>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Exam Type </label>
                                    <div class="form-group">
                                        <select name="exam_type[]" class="form-control select2" id="exam_type<?php echo $cnt; ?>">
                                            <option value="">Select Type</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Examination </label>
                                    <div class="form-group">
                                        <select name="examination[]" class="form-control" id="examination<?php echo $cnt; ?>">
                                            <option value="">Select Level</option>
                                            <?php 
                                                for ($i=1; $i < 6; $i++) 
                                                {
                                                    $sel_level="";
                                                    if(isset($cur_detail['examination']) && $cur_detail['examination']==$i){ $sel_level= "selected";} 

                                                    echo '<option value="'.$i.'" '.$sel_level.'>Level '.$i.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label"># of Attempts<span class="text-danger">*</span> </label>
                                    <div class="form-group">
                                        <select name="no_of_attempts[]" class="form-control" data-is_validate="1" id="no_of_attempts<?php echo $cnt; ?>">
                                            <option value="">Select Attemps</option>
                                            <?php 
                                                for ($i=1; $i < 6; $i++) 
                                                {
                                                    $sel_attemps="";
                                                    if(isset($cur_detail['no_of_attempts']) && $cur_detail['no_of_attempts']==$i){ $sel_attemps= "selected";} 
                                                    echo '<option '.$sel_attemps.'>'.$i.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Score<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="number" name="score[]" id="score<?php echo $cnt; ?>" data-is_validate="1"  class="form-control " placeholder="Score" value="<?php if(isset($cur_detail['score'])){ echo $cur_detail['score'];} ?>"  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">First try Date<span class="text-danger">*</span> </label>
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="first_try_date[]" data-is_validate="1" id="first_try_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['first_try_date'])){ echo $cur_detail['first_try_date'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Exam Date<span class="text-danger">*</span> </label>
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="exam_date[]" data-is_validate="1" id="exam_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['exam_date'])){ echo $cur_detail['exam_date'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Exam Passed?<span class="text-danger">*</span> </label>
                                    <div class="form-group">
                                        <select name="is_passed[]" class="form-control" id="is_passed<?php echo $cnt; ?>" data-is_validate="1">
                                            <option value="Yes" <?php if(isset($cur_detail['is_passed']) && $cur_detail['is_passed']=="Yes"){ echo "selected";} ?>>Yes</option>
                                            <option value="No" <?php if(isset($cur_detail['is_passed']) && $cur_detail['is_passed']=="No"){ echo "selected";} ?>>No</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <label for="firstname" class="control-label">Location</label>
                                    <div class="form-group">
                                        <input type="text" name="location[]" id="location<?php echo $cnt; ?>"  class="form-control " placeholder="Location" value="<?php if(isset($cur_detail['location'])){ echo $cur_detail['location'];} ?>"  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="firstname" class="control-label">Notes</label>
                                    <div class="form-group">
                                        <input type="text" name="notes[]" id="notes<?php echo $cnt; ?>"  class="form-control " placeholder="Notes" value="<?php if(isset($cur_detail['notes'])){ echo $cur_detail['notes'];} ?>"  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save & Next</button>
                        </div>
                    </div>
                </form>
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
                            </tbody>
                    </table>
                            <?php 
                                $cnt=$cnt_i+1;
                            ?>
                            <style>
                                .fileuploader
                                {
                                    margin: 0!important;
                                }
                            </style>
                        <div class="row col-sm-12" id="content_item1">                          
                            <?php 
                            if($cnt==1)
                            {
                                ?>
                                <div class="col-sm-12"><h5><u>Board Certification <?php echo $cnt; ?></u></h5></div>
                                <?php
                            }else
                            {
                            ?>
                            <div class="col-sm-8 col-md-9"><h5><u>Board Certification <?php echo $cnt; ?></u></h5></div>
                            <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
                            <?php } ?> 
                            
                            <div class="col-sm-12">
                                <label>American Medical Association(AMA)/American Osteopathic Association(AOA) Are you a Member? </label>
                                <div class="form-group">
                                    <input type="radio" value="1" id="is_member_medical_board_yes<?php echo $cnt; ?>" name="is_member_medical_board[]" <?php if(isset($cur_detail['is_member_medical_board']) && $cur_detail['is_member_medical_board']=="1"){ echo "selected";} ?> />Yes
                                    <input type="radio" value="0" id="is_member_medical_board_no<?php echo $cnt; ?>" name="is_member_medical_board[]" <?php if(isset($cur_detail['is_member_medical_board']) && $cur_detail['is_member_medical_board']=="0"){ echo "selected";} ?> />No
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label for="firstname" class="control-label">Primary?<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="radio" value="1" id="is_primary_yes<?php echo $cnt; ?>" name="is_primary[]" <?php if(isset($cur_detail['is_primary']) && $cur_detail['is_primary']=="1"){ echo "selected";} ?> />Yes
                                    <input type="radio" value="0" id="is_primary_no<?php echo $cnt; ?>" name="is_primary[]" <?php if(isset($cur_detail['is_primary']) && $cur_detail['is_primary']=="0"){ echo "selected";} ?> />No
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label for="firstname" class="control-label">Board Eligible<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="radio" value="1" id="is_board_eligible_yes<?php echo $cnt; ?>" name="is_board_eligible[]" <?php if(isset($cur_detail['is_board_eligible']) && $cur_detail['is_board_eligible']=="1"){ echo "selected";} ?> />Yes
                                    <input type="radio" value="0" id="is_board_eligible_no<?php echo $cnt; ?>" name="is_board_eligible[]" <?php if(isset($cur_detail['is_board_eligible']) && $cur_detail['is_board_eligible']=="0"){ echo "selected";} ?> />No
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3" >
                                <label for="firstname" style="display:none;" class="control-label">Indefinite<span class="text-danger">*</span> </label>
                                <div class="form-group" style="display:none;">
                                    <input type="radio" value="1" id="is_indefinite_yes<?php echo $cnt; ?>" name="is_indefinite[]" <?php if(isset($cur_detail['is_indefinite']) && $cur_detail['is_indefinite']=="1"){ echo "selected";} ?> />Yes
                                    <input type="radio" value="0" id="is_indefinite_no<?php echo $cnt; ?>" name="is_indefinite[]" <?php if(isset($cur_detail['is_indefinite']) && $cur_detail['is_indefinite']=="0"){ echo "selected";} ?> />No
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label for="firstname" class="control-label" style="display:none;">Meeting MOC<span class="text-danger">*</span> </label>
                                <div class="form-group" style="display:none;">
                                    <input type="radio" value="1" id="is_meeting_moc_yes<?php echo $cnt; ?>" name="is_meeting_moc[]" <?php if(isset($cur_detail['is_meeting_moc']) && $cur_detail['is_meeting_moc']=="1"){ echo "selected";} ?> />Yes
                                    <input type="radio" value="0" id="is_meeting_moc_no<?php echo $cnt; ?>" name="is_meeting_moc[]" <?php if(isset($cur_detail['is_meeting_moc']) && $cur_detail['is_meeting_moc']=="0"){ echo "selected";} ?> />No
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="firstname" class="control-label">Board Name<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="board_name[]" class="form-control select2" id="board_name<?php echo $cnt; ?>"  data-is_validate="1">
                                        <option value="">Select Board Name</option>
                                        <?php 
                                            for ($i=0; $i < count($medical_board_list); $i++) 
                                            { 
                                                echo "<option value='".($i+1)."'>".$medical_board_list[$i]."</option>";
                                            }
                                        ?>
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Speciality/Subspeciality<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="specialty[]" class="form-control select2" id="specialty<?php echo $cnt; ?>" data-is_validate="1">
                                        <option value="">Select Option</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Certificate #<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="certificate_no[]" id="certificate_no<?php echo $cnt; ?>"  class="form-control" data-is_validate="1" placeholder="Certificate #" value="<?php if(isset($cur_detail['certificate_no'])){ echo $cur_detail['certificate_no'];} ?>"  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Focus </label>
                                <div class="form-group">
                                    <select name="focus[]" class="form-control select2" id="focus<?php echo $cnt; ?>">
                                        <option value="">Select Option</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Cert Status </label>
                                <div class="form-group">
                                    <select name="status[]" class="form-control select2" id="status<?php echo $cnt; ?>">
                                        <option value="">Select Option</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Exam Passed?</label>
                                <div class="form-group">
                                    <select name="exam_passed[]" class="form-control select2" id="exam_passed<?php echo $cnt; ?>">
                                        <option value="">Select Option</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Board Link</label>
                                <div class="form-group">
                                    <input type="text" name="board_link[]" id="board_link<?php echo $cnt; ?>"  class="form-control" placeholder="Board Link" value="<?php if(isset($cur_detail['board_link'])){ echo $cur_detail['board_link'];} ?>"  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Upload Documents</label>
                                <div class="form-group">
                                    <input type="file" name="documents[]" id="documents<?php echo $cnt; ?>"  class="form-control multi-upload-file" placeholder="" value=""  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="firstname" class="control-label">Notes</label>
                                <div class="form-group">
                                    <input type="text" name="notes[]" id="notes<?php echo $cnt; ?>"  class="form-control" placeholder="Notes" value="<?php if(isset($cur_detail['notes'])){ echo $cur_detail['notes'];} ?>"  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Certification Date</h4>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Certificate Duration</label>
                                <div class="form-group">
                                    <input type="text" name="certificate_duration[]" id="certificate_duration<?php echo $cnt; ?>"  class="form-control" placeholder="Certificate Duration" value="<?php if(isset($cur_detail['certificate_duration'])){ echo $cur_detail['certificate_duration'];} ?>"  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Issue Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="issue_date[]" data-is_validate="1" id="issue_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['issue_date'])){ echo $cur_detail['issue_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Expiration Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="expiry_date[]" data-is_validate="1" id="expiry_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['expiry_date'])){ echo $cur_detail['expiry_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Recertification Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="recertification_date[]" data-is_validate="1" id="recertification_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['recertification_date'])){ echo $cur_detail['recertification_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Maintenance of Certification</h4>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">MOC/OCC Status</label>
                                <div class="form-group">
                                    <select name="moc_status[]" class="form-control select2" id="moc_status<?php echo $cnt; ?>">
                                        <option value="">Select Option</option>
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Meeting MOC/OCC</label>
                                <div class="form-group">
                                    <select name="meeting_moc[]" class="form-control select2" id="meeting_moc<?php echo $cnt; ?>">
                                        <option value="">Select Option</option>
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">MOC/OCC Verification Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="moc_verification_date[]" data-is_validate="1" id="moc_verification_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['moc_verification_date'])){ echo $cur_detail['moc_verification_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Annual Reverification Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="annual_reverification_date[]" data-is_validate="1" id="annual_revertification_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['annual_reverification_date'])){ echo $cur_detail['recertification_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                        </div>
                    <div class="col-sm-12 text-center">
                        <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save & Next</button>
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
                    <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/controller_action_api_call.php">
                  
                    <div class="row" style="padding: 15px;">
                    <?php
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="id" value="'.$_REQUEST['id'].'">';
                        } ?>
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
                                    
                                </tbody>
                            </table>


                            <?php 
                            $cnt=$cnt_i+1;
                        ?>
                        <div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">                            
                        <?php 
                            if($cnt==1)
                            {
                                ?>
                                <div class="col-sm-12"><h5><u>Practice / Employer <?php echo $cnt; ?></u></h5></div>
                                <?php
                            }else
                            {
                            ?>
                            <div class="col-sm-8 col-md-9"><h5><u>Practice / Employer <?php echo $cnt; ?></u></h5></div>
                            <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
                            <?php } ?>
                            
                            
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Practice /Employer /Facility Type<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="practice_type[]" class="form-control" id="practice_type<?php echo $cnt; ?>" data-is_validate="1">
                                        <option value="">Select Type</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Practice/Employer<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="practice_name[]" id="practice_name<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="Practice/Employer" value="<?php if(isset($cur_detail['practice_name'])){ echo $cur_detail['practice_name'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">Start Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="start_date[]" id="start_date<?php echo $cnt; ?>"  data-is_validate="1" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['start_date'])){ echo $cur_detail['start_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstname" class="control-label">End Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="end_date[]" id="end_date<?php echo $cnt; ?>"  data-is_validate="1" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['end_date'])){ echo $cur_detail['end_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            
                            <div class="col-sm-12"><label for="firstname" class="control-label">Practice / Employer Address <span class="text-danger">*</span></label></div>
                            
                            <div class="col-sm-6">
                                
                                <div class="form-group">
                                    <input type="text" maxlength="150" name="address_line_1[]" id="address_line_1-<?php echo $cnt; ?>" data-is_validate="1" class="form-control" placeholder="Address Line 1" value="<?php if(isset($cur_detail['address_line_1'])){ echo $cur_detail['address_line_1'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-<?php echo $cnt; ?>"  class="form-control" placeholder="Address Line 2" value="<?php if(isset($cur_detail['address_line_2'])){ echo $cur_detail['address_line_2'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="address_city[]" id="address_city<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="City" value="<?php if(isset($cur_detail['address_city'])){ echo $cur_detail['address_city'];} ?>" >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <!-- <input type="text" maxlength="100" name="address_state[]" id="address_state<?php echo $cnt; ?>"  class="form-control" placeholder="State" value="<?php if(isset($cur_detail['address_state'])){ echo $cur_detail['address_state'];} ?>" > -->
                                    <select data-placeholder="Select State" name="address_state[]" class="form-control  state_dropdown" data-is_validate="1" id="address_state<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['address_state_name_sel'])){ echo base64_encode($cur_detail['address_state_name_sel']);} ?>">
                                        <!-- <option value=""></option> -->
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="address_zipcode[]" id="address_zipcode<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="Zip Code" value="<?php if(isset($cur_detail['address_zipcode'])){ echo $cur_detail['address_zipcode'];} ?>" >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
                                <div class="form-group">
                                    <select name="address_country[]" class="form-control  country_dropdown" id="address_country<?php echo $cnt; ?>" data-is_validate="1" data-val_sel="<?php if(isset($cur_detail['address_country_name_sel'])){ echo base64_encode($cur_detail['address_country_name_sel']);} ?>">
                                        <option value="">Select Country</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="firstname" class="control-label">Reason for departure (If Not Current)</label>
                                <div class="form-group">
                                    <input type="text" name="reason_deaprture[]" id="reason_deaprture<?php echo $cnt; ?>"  class="form-control" placeholder="Reason for departure" value="<?php if(isset($cur_detail['reason_deaprture'])){ echo $cur_detail['reason_deaprture'];} ?>"  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-12"><h5><u>HR Contact / Supervisor</u></h5></div>
                            <div class="col-sm-12"><label for="firstname" class="control-label">Name <span class="text-danger">*</span></label></div>
                            
                            <div class="col-sm-6 col-md-4">
                                
                                <div class="form-group">
                                    <input type="text" maxlength="150" name="hr_title[]" id="hr_title<?php echo $cnt; ?>" data-is_validate="1" class="form-control" placeholder="Title" value="<?php if(isset($cur_detail['hr_title'])){ echo $cur_detail['hr_title'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="hr_contact_name[]" id="hr_contact_name<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="Contact Name" value="<?php if(isset($cur_detail['hr_contact_name'])){ echo $cur_detail['hr_contact_name'];} ?>" >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="hr_contract_start_date[]" id="hr_contract_start_date<?php echo $cnt; ?>" data-is_validate="1"  class="form-control datepicker" placeholder="Contract Start Date" value="<?php if(isset($cur_detail['hr_contract_start_date'])){ echo $cur_detail['hr_contract_start_date'];} ?>" >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <input type="email" maxlength="100" name="hr_email[]" id="hr_email<?php echo $cnt; ?>"  class="form-control" data-is_validate="1" placeholder="Email" value="<?php if(isset($cur_detail['hr_email'])){ echo $cur_detail['hr_email'];} ?>" >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <input type="tel" maxlength="10" name="hr_phone[]" id="hr_phone<?php echo $cnt; ?>"  class="form-control" placeholder="Phone" value="<?php if(isset($cur_detail['hr_phone'])){ echo $cur_detail['hr_phone'];} ?>" >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save & Next</button>
                        </div>
                    </div>
                </form>
                </form>
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
                                   
                                </tbody>
                            </table>
                    <div class="card-body">
                    <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/controller_action_api_call.php">
                    <?php 
                            $cnt=$cnt_i+1;
                        ?>
                        <div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">                        
                            <?php 
                            if($cnt==1)
                            {
                                ?>
                                <div class="col-sm-12"><h5><u>Hospital Affiliation <?php echo $cnt; ?></u></h5></div>
                                <?php
                            }else
                            {
                            ?>
                            <div class="col-sm-8 col-md-9"><h5><u>Hospital Affiliation <?php echo $cnt; ?></u></h5></div>
                            <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
                            <?php } ?>                    
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Hospital Affiliation<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="hospital_affiliation[]" data-is_validate="1" id="hospital_affiliation<?php echo $cnt; ?>"  class="form-control" placeholder="Hospital Affiliation" value="<?php if(isset($cur_detail['hospital_affiliation'])){ echo $cur_detail['hospital_affiliation'];} ?>"  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Start Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="start_date[]" data-is_validate="1" id="start_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['start_date'])){ echo $cur_detail['start_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">End Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="end_date[]" data-is_validate="1" id="end_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['end_date'])){ echo $cur_detail['end_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            
                            <div class="col-sm-12"><label for="firstname" class="control-label">Hospital Affiliation Address <span class="text-danger">*</span></label></div>
                            
                            <div class="col-sm-6">
                                
                                <div class="form-group">
                                    <input type="text" maxlength="150" name="address_line_1[]" data-is_validate="1" id="address_line_1-<?php echo $cnt; ?>" class="form-control" placeholder="Address Line 1" value="<?php if(isset($cur_detail['address_line_1'])){ echo $cur_detail['address_line_1'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-<?php echo $cnt; ?>"  class="form-control" placeholder="Address Line 2" value="<?php if(isset($cur_detail['address_line_2'])){ echo $cur_detail['address_line_2'];} ?>" >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="address_city[]" data-is_validate="1" id="address_city<?php echo $cnt; ?>"  class="form-control" placeholder="City" value="<?php if(isset($cur_detail['address_city'])){ echo $cur_detail['address_city'];} ?>" >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <!-- <input type="text" maxlength="100" name="address_state[]" id="address_state<?php echo $cnt; ?>"  class="form-control" placeholder="State" value="<?php if(isset($cur_detail['address_state'])){ echo $cur_detail['address_state'];} ?>" > -->
                                    <select data-placeholder="Select State" name="address_state[]" data-is_validate="1" class="form-control  state_dropdown" id="address_state<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['address_state_name_sel'])){ echo base64_encode($cur_detail['address_state_name_sel']);} ?>">
                                        <!-- <option value=""></option> -->
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <input type="text" maxlength="100" name="address_zipcode[]" data-is_validate="1" id="address_zipcode<?php echo $cnt; ?>"  class="form-control" placeholder="Zip Code" value="<?php if(isset($cur_detail['address_zipcode'])){ echo $cur_detail['address_zipcode'];} ?>" >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6  col-md-3">
                                <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
                                <div class="form-group">
                                    <select name="address_country[]" class="form-control country_dropdown" data-is_validate="1" id="address_country<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['address_country_name_sel'])){ echo base64_encode($cur_detail['address_country_name_sel']);} ?>">
                                        <option value="">Select Country</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>

                            
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Staff Category<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="staff_category[]" id="staff_category<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="Staff Category" value="<?php if(isset($cur_detail['staff_category'])){ echo $cur_detail['staff_category'];} ?>"  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                
                                <div class="form-group">
                                    <input type="checkbox" style="margin-top: 20px;margin-left: 10px;" value="1" name="is_primary_affiliation[<?php echo ($cnt-1); ?>]" id="is_primary_affiliation<?php echo $cnt; ?>"  class=""  <?php if(isset($cur_detail['is_primary_affiliation']) && $cur_detail['is_primary_affiliation']==1){ echo "checked";} ?>  >
                                    <label for="is_primary_affiliation<?php echo $cnt; ?>" class="control-label">Primary Affiliation</label>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                
                                <div class="form-group">
                                    <input type="checkbox" style="margin-top: 20px;margin-left: 10px;" value="1" name="is_currently_affiliated[<?php echo ($cnt-1); ?>]" id="is_currently_affiliated<?php echo $cnt; ?>"  class=""  <?php if(isset($cur_detail['is_currently_affiliated']) && $cur_detail['is_currently_affiliated']==1){ echo "checked";} ?>  >
                                    <label for="is_primary_affiliation<?php echo $cnt; ?>" class="control-label">Currently Affiliated?</label>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save & Next</button>
                        </div>
                    </div>
                </form>
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
                                   
                                </tbody>
                            </table>
                    <div class="card-body">
                    <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/controller_action_api_call.php">
                    <?php 
                                $cnt=$cnt_i+1;
                            ?>
                            <div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">
                                <?php 
                                if($cnt==1)
                                {
                                    ?>
                                    <div class="col-sm-12"><h5><u>Reference <?php echo $cnt; ?></u></h5></div>
                                    <?php
                                }else
                                {
                                ?>
                                <div class="col-sm-8 col-md-9"><h5><u>Reference <?php echo $cnt; ?></u></h5></div>
                                <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
                                <?php } ?>    
                                
                                <div class="col-sm-12"><label for="firstname" class="control-label">Name <span class="text-danger">*</span></label></div>
                                <div class="col-sm-6 col-md-4">
                                    
                                    <div class="form-group">
                                        <input type="text" maxlength="150" name="title[]" id="title<?php echo $cnt; ?>" class="form-control" placeholder="Title" value="<?php if(isset($cur_detail['title'])){ echo $cur_detail['title'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="first_name[]" id="first_name<?php echo $cnt; ?>"  class="form-control" placeholder="First Name" value="<?php if(isset($cur_detail['first_name'])){ echo $cur_detail['first_name'];} ?>" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="last_name[]" id="last_name<?php echo $cnt; ?>"  class="form-control" placeholder="Last Name" value="<?php if(isset($cur_detail['last_name'])){ echo $cur_detail['last_name'];} ?>" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Company<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" name="company_name[]" id="company_name<?php echo $cnt; ?>"  class="form-control" placeholder="Company" value="<?php if(isset($cur_detail['company_name'])){ echo $cur_detail['company_name'];} ?>"  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Email<span class="text-danger">*</span> </label>
                                    <div class="form-group">
                                        <input type="email" maxlength="100" name="email[]" id="email<?php echo $cnt; ?>"  class="form-control" placeholder="Email" value="<?php if(isset($cur_detail['email'])){ echo $cur_detail['email'];} ?>" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Phone<span class="text-danger">*</span> </label>
                                    <div class="form-group">
                                        <input type="tel" maxlength="100" name="phone[]" id="phone<?php echo $cnt; ?>"  class="form-control" placeholder="Phone" value="<?php if(isset($cur_detail['phone'])){ echo $cur_detail['phone'];} ?>" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-12"><label for="firstname" class="control-label">Home Address <span class="text-danger">*</span></label></div>
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <input type="text" maxlength="150" name="address_line_1[]" id="address_line_1-<?php echo $cnt; ?>" class="form-control" placeholder="Address Line 1" value="<?php if(isset($cur_detail['address_line_1'])){ echo $cur_detail['address_line_1'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-<?php echo $cnt; ?>"  class="form-control" placeholder="Address Line 2" value="<?php if(isset($cur_detail['address_line_2'])){ echo $cur_detail['address_line_2'];} ?>" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="address_city[]" id="address_city<?php echo $cnt; ?>"  class="form-control" placeholder="City" value="<?php if(isset($cur_detail['address_city'])){ echo $cur_detail['address_city'];} ?>" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <select data-placeholder="Select State" name="address_state[]" id="address_state<?php echo $cnt; ?>"  class="form-control state_dropdown" placeholder="State"  data-val_sel="<?php if(isset($cur_detail['address_state_name_sel'])){ echo base64_encode($cur_detail['address_state_name_sel']);} ?>"></select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="address_zipcode[]" id="address_zipcode<?php echo $cnt; ?>"  class="form-control" placeholder="Zip Code" value="<?php if(isset($cur_detail['address_zipcode'])){ echo $cur_detail['address_zipcode'];} ?>" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
                                    <div class="form-group">
                                        <select name="address_country[]" class="form-control  country_dropdown" id="address_country<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['address_country_name_sel'])){ echo base64_encode($cur_detail['address_country_name_sel']);} ?>">
                                            <option value="">Select Country</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save & Next</button>
                        </div>
                    </div>
                </form>
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
                    <table id="example18" class="data-table table table-bordered table-hover">
                            <thead>
                                <tr>
                                   
                                    <th>Provider Name</th>
                                    <th>State</th>
                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                    <div class="card-body">
                    <style>
                .custom-state-option-wrapper
                {
                    border: 1px solid;
                    border-radius: 5px;
                    padding: 6px 10px 0px 10px;
                    max-width: 31%!important;
                    margin: 5px;
                }
                .custom-state-option-wrapper input
                {
                    float: right;
                    margin-top: 5px;
                }
                @media (max-width:767px) 
                {
                    .custom-state-option-wrapper
                    {
                        max-width: 47%!important;
                    }
                }
            </style>
            <!-- <div class="row">
                <div class="col-md-12"> -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Hospital / Facility Affiliation Details</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm">Save & Next</button>
                                </div>        

                            </div>
                        </div>

                        <div class="card-body">
                        <?php include("message.php"); ?>
                        
                            <form  class="form-horizontal validate-form" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php">
                                <?php
                                    if(isset($_REQUEST['id']))
                                    {
                                        echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                                    } 
                                    include "message.php";
                                    // print_r($states_detail);
                                ?>
                                <input type="hidden" name="action" value="update_state_selection"/>
                                <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=state-selection&id=<?php echo $_REQUEST['id']; ?>"/>
                                <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=licensure&id=<?php echo $_REQUEST['id']; ?>"/>
                                
                                <h4>State Selection</h4>
                                <p>Check off all the state(s) requesting for licensure</p>
                                <div  class="row col-sm-12" >
                                
                                    <?php 
                                        for ($i=0; $i < count($StateList); $i++) 
                                        { 
                                            $cid= $StateList[$i]['id'];
                                            $cname= $StateList[$i]['text'];
                                            ?>
                                            <div class="col-md-4 col-sm-6 custom-state-option-wrapper">
                                                <label for="state_id<?php echo $cid; ?>"><?php echo $cname; ?></label>
                                                <input type="checkbox" name="state_id[]" <?php if(isset($states_detail) &&is_array($states_detail) && in_array($cid,$states_detail)){echo "checked";} ?> value="<?php echo $cid; ?>" id="state_id<?php echo $cid; ?>" />
                                            </div> 
                                            <?php
                                        }
                                    ?>
                                </div>    
                                <div class="row">
                                    
                                    
                                    <div class="col-sm-12 text-center" style="margin-top:15px;">
                                        <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=professional-references" id="" class="btn btn-default">back</a>
                                        <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save & Next</button>
                                    </div>


                                </div>
                            </form>

                        </div>
                        
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
                                   
                                </tbody>
                            </table>
                    <div class="card-body">
                    <style>
                .custom-state-option-wrapper
                {
                    border: 1px solid;
                    border-radius: 5px;
                    padding: 6px 10px 0px 10px;
                    max-width: 31%!important;
                    margin: 5px;
                }
                .custom-state-option-wrapper input
                {
                    float: right;
                    margin-top: 5px;
                }
                @media (max-width:767px) 
                {
                    .custom-state-option-wrapper
                    {
                        max-width: 47%!important;
                    }
                }
            </style>
            <!-- <div class="row">
                <div class="col-md-12"> -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Hospital / Facility Affiliation Details</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm">Save & Next</button>
                                </div>        

                            </div>
                        </div>

                        <div class="card-body">
                        <?php include("message.php"); ?>
                        
                            <form  class="form-horizontal validate-form" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php">
                            <?php 
                                $cnt=$cnt_i+1;
                             ?>
                           <div class="row col-sm-12" id="content_item1">
                            <div class="col-sm-8 col-md-9"><h5><u>Licensure <?php echo $cnt; ?></u></h5></div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Licence Type<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="license_type[]" class="form-control select2" data-is_validate="1" id="license_type<?php echo $cnt; ?>">
                                        <option value="">Select Type</option>
                                        <option value="State Licenses" <?php if(isset($cur_detail['license_type']) && $cur_detail['license_type']=="State Licenses"){ echo "selected";} ?>>State Licenses</option>
                                        <option value="DEA Licenses" <?php if(isset($cur_detail['license_type']) && $cur_detail['license_type']=="DEA Licenses"){ echo "selected";} ?>>DEA Licenses</option>
                                        <option value="State Controlled Substance Licenses" <?php if(isset($cur_detail['license_type']) && $cur_detail['license_type']=="State Controlled Substance Licenses"){ echo "selected";} ?>>State Controlled Substance Licenses</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">State<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="license_state[]" class="form-control state_dropdown" data-is_validate="1" id="license_state<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['license_state_name_sel'])){ echo base64_encode($cur_detail['license_state_name_sel']);} ?>">
                                        <option value="">Select State</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Licence Number<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="license_no[]" id="license_no<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="License Number" value="<?php if(isset($cur_detail['license_no'])){ echo $cur_detail['license_no'];} ?>"  >
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Issue Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text"  name="issue_date[]" id="issue_date<?php echo $cnt; ?>" data-is_validate="1"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['issue_date'])){ echo $cur_detail['issue_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Expiry Date<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <input type="text"  name="expiry_date[]" id="expiry_date<?php echo $cnt; ?>" data-is_validate="1"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['expiry_date'])){ echo $cur_detail['expiry_date'];} ?>">
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Primary<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="primary_license[]" class="form-control" id="primary_license<?php echo $cnt; ?>">
                                        <option value="Yes" <?php if(isset($cur_detail['primary_license']) && $cur_detail['primary_license']=="Yes"){ echo "selected";} ?>>Yes</option>
                                        <option value="No" <?php if(isset($cur_detail['primary_license']) && $cur_detail['primary_license']=="No"){ echo "selected";} ?>>No</option>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Compact<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="compact_license[]" class="form-control" id="compact_license<?php echo $cnt; ?>">
                                        <option value="Yes" <?php if(isset($cur_detail['compact_license']) && $cur_detail['compact_license']=="Yes"){ echo "selected";} ?>>Yes</option>
                                        <option value="No" <?php if(isset($cur_detail['compact_license']) && $cur_detail['compact_license']=="No"){ echo "selected";} ?>>No</option>
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="firstname" class="control-label">Status<span class="text-danger">*</span> </label>
                                <div class="form-group">
                                    <select name="license_status[]" class="form-control select2" data-is_validate="1" id="license_status<?php echo $cnt; ?>">
                                        <option value="">select status</option>
                                        <?php
                                            for ($i=0; $i < count($license_status_list); $i++) 
                                            { 
                                                $cur_status_id=$i+1;
                                                $selected_status="";
                                                if(isset($cur_detail['license_status']) && $cur_detail['license_status']==$cur_status_id)
                                                {
                                                    $selected_status="selected";
                                                }
                                                echo '<option value="'.$cur_status_id.'" '.$selected_status.'>'.$license_status_list[$i].'</option>';
                                            } 
                                        ?>
                                        
                                    </select>
                                    <span class="help" id="msg2"></span>
                                </div>
                            </div>
                        </div>
                </form>
  <!-- </div> -->
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
                    <table id="example18" class="data-table table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Website</th>
                                   
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <?php 
                                $cnt=$cnt_i+1;
                            ?>
                            <div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">
                                <?php 
                                if($cnt==1)
                                {
                                    ?>
                                    <div class="col-sm-12"><h5><u>State Board <?php echo $cnt; ?></u></h5></div>
                                    <?php
                                }else
                                {
                                ?>
                                <div class="col-sm-8 col-md-9"><h5><u>State Board <?php echo $cnt; ?></u></h5></div>
                                <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
                                <?php } ?>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname"  class="control-label">Website </label>
                                    <div class="form-group">
                                        <select name="website[]" id="website<?php echo $cnt; ?>" class="form-control" >
                                            <option value="AMA" <?php if(isset($cur_detail['website']) && $cur_detail['website']=="AMA"){ echo "selected";} ?>>AMA</option>
                                        </select>
                                        <!-- <input type="text" name="website[]" id="website<?php echo $cnt; ?>"  class="form-control" placeholder="Website" value=""  > -->
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Username</label>
                                    <div class="form-group">
                                        <input type="text" name="user_name[]" id="user_name<?php echo $cnt; ?>"  class="form-control" placeholder="Username" value="<?php if(isset($cur_detail['user_name'])){ echo $cur_detail['user_name'];} ?>"  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="firstname" class="control-label">Password</label>
                                    <div class="form-group">
                                        <input type="text" name="password[]" id="password<?php echo $cnt; ?>"  class="form-control" placeholder="Password" value="<?php if(isset($cur_detail['password'])){ echo $cur_detail['password'];} ?>"  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>    
                                
                            </div>
                            <!-- </div> -->
                                    </div>
                                </div>
                                </div>  
                                </div>      
                                </section>


<!-- end state board online portal -->



<!-- Required Suporting Documents -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title">Required Suporting Documents</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                            </div>        

                        </div>
                    </div>
                    <style>
                        .fileuploader
                        {
                            margin: 0px!important;
                        }
                        
                    </style>
                    <?php 
                        // print_r($supporting_documents_detail);
                    ?>
                    <!-- <div class="row">
                        <div class="col-md-12"> -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Required Supporting Document</h3>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm">Save & Next</button>
                                        </div>        

                                    </div>
                                </div>

                                <div class="card-body">
                                <?php include("message.php"); ?>
                                
                                    <form  class="form-horizontal validate-form" enctype="multipart/form-data" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php">
                                        <div class="row" style="padding: 15px;">
                                        <div class="col-md-12"><h4>Required Supporting Documents</h4></div>
                                        
                                        <?php
                                            if(isset($_REQUEST['id']))
                                            {
                                                echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                                            } 
                                            include "message.php";
                                        ?>
                                        <input type="hidden" name="action" value="update_require_document"/>
                                        <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=require-supporting-doc&id=<?php echo $_REQUEST['id']; ?>"/>
                                        <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=additional-question&id=<?php echo $_REQUEST['id']; ?>"/>
                                            
                                            
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Driver's License/Passport<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="file" name="driver_license_passport" id="driver_license_passport"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['driver_license_passport']) && $supporting_documents_detail['driver_license_passport']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['driver_license_passport'];
                                                    $id_file="driver_license_passport";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Social Security Card<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="file" name="social_security_card" id="social_security_card"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['social_security_card']) && $supporting_documents_detail['social_security_card']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['social_security_card'];
                                                    $id_file="social_security_card";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Birth Certificate</label>
                                                <div class="form-group">
                                                    <input type="file" name="birth_certificate" id="birth_certificate"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['birth_certificate']) && $supporting_documents_detail['birth_certificate']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['birth_certificate'];
                                                    $id_file="birth_certificate";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Proof of name change</label>
                                                <div class="form-group">
                                                    <input type="file" name="proof_name_change" id="proof_name_change"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    <?php if(isset($supporting_documents_detail['proof_name_change']) && $supporting_documents_detail['proof_name_change']!="")
                                                    {
                                                        $file_name=$supporting_documents_detail['proof_name_change'];
                                                        $id_file="proof_name_change";
                                                        echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                    } ?>
                                                    <span class="text-danger" >(ex. marriage certificate, divorce)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Medical School Diploma<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="file" name="medical_diploma" id="medical_diploma"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['medical_diploma']) && $supporting_documents_detail['medical_diploma']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['medical_diploma'];
                                                    $id_file="medical_diploma";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >(i.e., MD, DO) (translated if not in English)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Internship / Residency / Fellowship Certificates</label>
                                                <div class="form-group">
                                                    <input type="file" name="internship_certificate" id="internship_certificate"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['internship_certificate']) && $supporting_documents_detail['internship_certificate']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['internship_certificate'];
                                                    $id_file="internship_certificate";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >(translated if not in English)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">USMLE / NBOME / Complex transcripts & scores<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="file" name="transcripts_scores" id="transcripts_scores"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['transcripts_scores']) && $supporting_documents_detail['transcripts_scores']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['transcripts_scores'];
                                                    $id_file="transcripts_scores";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">License(s) including DEA and/or CS<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="file" name="license_dea_cs" id="license_dea_cs"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['license_dea_cs']) && $supporting_documents_detail['license_dea_cs']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['license_dea_cs'];
                                                    $id_file="license_dea_cs";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">CME/CE Certificates and/or transcripts<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="file" name="cme_ce_certificate" id="cme_ce_certificate"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['cme_ce_certificate']) && $supporting_documents_detail['cme_ce_certificate']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['cme_ce_certificate'];
                                                    $id_file="cme_ce_certificate";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >(from past 24 months)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Board Certification<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="file" name="board_certificate" id="board_certificate"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['board_certificate']) && $supporting_documents_detail['board_certificate']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['board_certificate'];
                                                    $id_file="board_certificate";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >(i.e., ABFM, ABIM, AOBFM, AOBIM)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Documentation of you current military status</label>
                                                <div class="form-group">
                                                    <input type="file" name="military_status_document" id="military_status_document"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['military_status_document']) && $supporting_documents_detail['military_status_document']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['military_status_document'];
                                                    $id_file="military_status_document";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >(if active duty) or discharge papers (DD Form 214) (if applicable)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Original Signature</label>
                                                <div class="form-group">
                                                    <input type="file" name="original_signature" id="original_signature"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['original_signature']) && $supporting_documents_detail['original_signature']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['original_signature'];
                                                    $id_file="original_signature";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >(Optional: for digital signature)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">CV</label>
                                                <div class="form-group">
                                                    <input type="file" name="cv" id="cv"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['cv']) && $supporting_documents_detail['cv']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['cv'];
                                                    $id_file="cv";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >(include any gaps in history more than 30 days such as maternity, sabbatical, vacation leave)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label" style="font-size:15px!important;">Malpractice supporting documentation (If applicable)</label>
                                                <div class="form-group">
                                                    <input type="file" name="malpractice_support_document" id="malpractice_support_document"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['malpractice_support_document']) && $supporting_documents_detail['malpractice_support_document']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['malpractice_support_document'];
                                                    $id_file="malpractice_support_document";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >(translated if not in English)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12">
                                                <label for="firstname" class="control-label">Affermative Responses</label>
                                                <div class="form-group">
                                                    <input type="file" name="affirmative_response" id="affirmative_response"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['affirmative_response']) && $supporting_documents_detail['affirmative_response']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['affirmative_response'];
                                                    $id_file="affirmative_response";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >Supporting documentation related to affirmative response to attestation question and/or criminal conviction (if applicable)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="firstname" class="control-label">Proof of malpractice insurance from previous employer(s) 10 years history of claim reports</label>
                                                <div class="form-group">
                                                    <input type="file" name="malpractice_insurance" id="malpractice_insurance"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['malpractice_insurance']) && $supporting_documents_detail['malpractice_insurance']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['malpractice_insurance'];
                                                    $id_file="malpractice_insurance";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >(translated if not in English)</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="firstname" class="control-label">NPDB self query report</label>
                                                <div class="form-group">
                                                    <input type="file" name="npdb_report" id="npdb_report"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['npdb_report']) && $supporting_documents_detail['npdb_report']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['npdb_report'];
                                                    $id_file="npdb_report";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >Ordering NPDB self query: https://www.npdb.hrsa.gov/ext/selfquery/SQHome.jsp Using the link above, please click “start a new order” and follow the steps given to complete the order. This should take 10-15 minutes. Once you’ve entered all of the information, please order an electronic copy that you will be able to save after the process is complete. Before the order can be finalized, you must answer 4 personal questions to access your NPDB report. The other option is to notarize a form that they provide.</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname" class="control-label">Passport Photo<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="file" name="passport_photo" id="passport_photo"  class="form-control single-upload-file" placeholder="" value=""  >
                                                    
                                                <?php if(isset($supporting_documents_detail['passport_photo']) && $supporting_documents_detail['passport_photo']!="")
                                                {
                                                    $file_name=$supporting_documents_detail['passport_photo'];
                                                    $id_file="passport_photo";
                                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                                } ?>
                                                    <span class="text-danger" >Passport Photo (2 x 2 of full face and shoulders taken within the past six months.) Passport headshot: We recommend downloading an application on your smartphone that allows you to take a picture from your phone. Here are a few applications:</span>
                                                    <span class="help" id="msg2"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 text-center" style="margin-top:15px;">
                                                <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id']; ?>&tab=state-board-setup" id="" class="btn btn-default">back</a>
                                                
                                                <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save & Next</button>
                                            </div>


                                        </div>
                                    </form>

                                </div>
                                
                            </div>

                    <!-- </div> -->
        </div>
    </div>   
</section>


<!-- end Required Suporting Documents-->

<!-- Additional Questions -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Additional Questions Details</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm">Save & Next</button>
                            </div>        

                        </div>
                    </div>

                    <div class="card-body">
                        <?php include("message.php"); ?>
                    
                        <form  class="form-horizontal validate-form" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php">
                            <div class="row" style="padding: 15px;">
                            
                            <div class="col-md-12"><h4>Additional Questions</h4></div>
                            <div class="col-md-12"><p>If you answer “Yes” to any question, please provide a detailed explanation.</p></div>

                            <input type="hidden" name="action" value="update_questions"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=additional-question&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=provider-demographic&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                                if(isset($_REQUEST['id']))
                                {
                                    echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                                } 
                                $question_list_arr=array();
                                $question_list_arr[1]="In the 10 years prior to this application have you had any physician injury or disease or mental illness or impairment, which could reasonably be expected to affect your ability to practice medicine or other health profession?";
                                $question_list_arr[2]="In the 10 years prior to this application have you been referred to or obtained treatment for a substance abuse disorder including alcohol abuse?";
                                $question_list_arr[3]="Have you EVER been arrested for, cited for, charged with, convicted of; or pled guilty to; or pled nolo contendere to, a violation of ANY municipal, state or federal statute? You must answer “Yes” even if records have been pardoned, expunged, plead down, released or sealed. (You do not have to report misdemeanor traffic offenses or traffic ordinance violations unless they involve alcohol or drugs).";
                                $question_list_arr[4]="Have you failed a professional licensure or certification examination (any step/part of FLEX, USMLE, NBME, NBOME, COMLEX-USA, SPEX/COMVEX-USA)?";
                                $question_list_arr[5]="Has your application for any professional license, certificate, or registration been denied by any state licensing board or federal authority?";
                                $question_list_arr[6]="Has your professional license, certificate, or registration been the subject of investigation or revoked, suspended, probated, restricted, reprimanded, limited, or subjected to any other disciplinary action by any state licensing board or federal authority?";
                                $question_list_arr[7]="Have you voluntarily surrendered any professional license, or agreed with any licensing authority not to seek re-licensure in order to avoid disciplinary action, investigation or inquiry?";
                                $question_list_arr[8]="Was your application for staff or clinical privileges at any hospital, clinic, or other health care institution denied?";
                                $question_list_arr[9]="Were you the subject of an inquiry or investigation by any hospital, clinic, or other health care institution which resulted in the suspension, restriction, probation or other limitation on your affiliation or staff or clinical privileges; including remediation and/or non-disciplinary sanctions?";
                                $question_list_arr[10]="Did you surrender or fail to renew staff or clinical privileges at any hospital, clinic, or other health care entity in lieu of investigation, while under investigation or while you were the subject of disciplinary proceedings?";
                                $question_list_arr[11]="Were you the subject of disciplinary action, placed on academic probation, or asked to undergo additional training or remediation during your professional training (as a student, intern, resident, fellow, or other trainee)?";
                                $question_list_arr[12]="Did you leave any professional training program as defined above before completion?";
                                $question_list_arr[13]="Did you leave any professional training program as defined above before completion?";
                                $question_list_arr[14]="Has your participation in any private, federal or state health insurance program been terminated, non-renewed, denied, suspended, restricted, placed on probation, or are you the subject of a current investigation or proceeding by such entities?";
                                $question_list_arr[15]="Have you surrendered your state or federal controlled substances permit or registration?";
                                $question_list_arr[16]="Has your membership in a professional society been revoked, suspended, or disciplined or have you resigned
                                membership while under investigation?";
                                $question_list_arr[17]="Have you EVER or do you have any malpractice claims, settlements, or judgements or medically related lawsuits
                                against you or pending, regardless of the outcome?";
                                $question_list_arr[18]="Has any court determined you are currently in violation of a court’s judgment or order for the support of dependent
                                children?";
                                $question_list_arr[19]="If you are seeking an expedited military permit, please respond to the following: Do you have a complaint, allegation, or investigation by anyone or any entity, currently pending against you, which is related to unprofessional conduct and/or an alleged crime? If so, please note, by law, the LSBME cannot issue or deny an applicant’s military permit until the complaint, allegation, or investigation is resolved, or the applicant otherwise satisfies the criteria for permanent licensure in Louisiana to the satisfaction of the LSBME.";
                                for ($i=1; $i <= count($question_list_arr); $i++) 
                                { 
                                    $di=$i;
                                    $name_param="answer[$di]";
                                    $id_yes_param="question_".$di."_yes";
                                    $id_no_param="question_".$di."_no";
                                    $cdi=$di-1;
                                    ?>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-8 col-lg-9">
                                                    <label>Question <?php echo $di; ?><span  class="text-danger">*</span></label>
                                                    <p><?php echo $question_list_arr[$i];  ?> </p>
                                                </div>
                                                <div class="col-md-4 col-lg-3 text-right">
                                                    <input type="hidden" value="<?php echo $di; ?>" name="question_id[]" />
                                                    <input type="radio" value="1" <?php if(isset($questions_detail[$cdi]) && is_array($questions_detail[$cdi]) && $questions_detail[$cdi]['answer']=="1"){echo "checked";} ?> id="<?php echo $id_yes_param; ?>" name="<?php echo $name_param; ?>" /><label for="<?php echo $id_yes_param; ?>">Yes</label>
                                                    <input type="radio" value="0" <?php if(isset($questions_detail[$cdi]) && is_array($questions_detail[$cdi])) { if($questions_detail[$cdi]['answer']=="0"){echo "checked";}}else{echo "checked";} ?> id="<?php echo $id_no_param; ?>" name="<?php echo $name_param; ?>" /><label for="<?php echo $id_no_param; ?>">No</label>
                                                </div>    
                                            </div>
                                        </div>
                                    <?php
                                }
                                ?>
                                

                                
                                <div class="col-sm-12 text-center" style="margin-top:20px;">
                                <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=require-supporting-doc" id="" class="btn btn-default">back</a>
                                    <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit</button>
                                </div>


                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end additional questions  -->