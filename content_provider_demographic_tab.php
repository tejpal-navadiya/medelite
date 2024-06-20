<!-- <div class="row">
    <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Provider Demographic Details</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                    <?php 
                        if($is_readonly)
                        {
                            ?>
                            <a href="index.php?pid=add_boarding_form&tab=education-training&id=<?php echo $_REQUEST['id'];?>"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Next</a>
                            <?php
                        }else
                        {
                            ?>
                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                        <?php } ?>
                    </div>        

                </div>
            </div>

            <div class="card-body">
            <?php include("message.php"); ?>
            
            
                <form  class="form-horizontal validate-form" data-err_msg_ele="help"   method="post" action="process/controller_action_api_call.php">
                    <?php 
                        if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
                        {
                            // print_r($OnBordingDetails);
                            if(isset($is_admin_form) && $is_admin_form == 1 )
                            {
                                ?>
                                <input type="hidden" name="action" value="update_provider_form"/>
                                <input type="hidden" name="redirect_url_error" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                                <input type="hidden" name="redirect_url_success" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                                <?php 
                            }else{

                            
                            ?>
                            <input type="hidden" name="action" value="update_provider_form"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=provider-demographic&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=education-training&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php 
                            }
                        }else
                        {
                            $provider_id=0;
                            if(isset($is_provider_user) && $is_provider_user==1)
                            {
                                $provider_id=$_SESSION['me_user_id'];
                            }    
                            ?>
                            <input type="hidden" name="action" value="add_provider_form"/>
                            <input type="hidden" name="provider_id" value="<?php echo $provider_id;?>"/>
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
                                <input type="text" maxlength="150" <?php echo $readonly;?> data-is_validate="1" name="title" id="title" class="form-control" placeholder="Title" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['title'])){echo $OnBordingDetails['title'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="first_name" data-is_validate="1" id="first_name"  class="form-control" placeholder="First Name" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['first_name'])){echo $OnBordingDetails['first_name'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="middle_name" id="middle_name" data-is_validate="1" class="form-control" placeholder="Middle Name" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['middle_name'])){echo $OnBordingDetails['middle_name'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> data-is_validate="1" name="last_name" id="last_name"  class="form-control" placeholder="Last Name" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['last_name'])){echo $OnBordingDetails['last_name'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> data-is_validate="1" name="suffix" id="suffix"  class="form-control" placeholder="suffix" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['suffix'])){echo $OnBordingDetails['suffix'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Provider Type<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <!-- <input type="text" name="provider_type" data-is_validate="1" id="provider_type"  class="form-control" placeholder="Provider Type" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['provider_type'])){echo $OnBordingDetails['provider_type'];} ?>"  > -->

                                <select data-placeholder="Select Provider" <?php echo $readonly;?> data-is_validate="0" name="provider_type" id="provider_type"  class="select2 form-control" >

                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Maiden/Other Alias </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="maiden_other_alias" id="maiden_other_alias"  class="form-control" placeholder="Maiden/Other Alias" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['maiden_other_alias'])){echo $OnBordingDetails['maiden_other_alias'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Personal Email<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="email" maxlength="100" <?php echo $readonly;?> data-is_validate="1" name="personal_email" id="personal_email"  class="form-control" placeholder="Personal Email" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_email'])){echo $OnBordingDetails['personal_email'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Mobile Phone<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="tel" maxlength="10" <?php echo $readonly;?> data-is_validate="1" name="personal_mobile_no" id="personal_mobile_no"  class="form-control" placeholder="Mobile Phone" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_mobile_no'])){echo $OnBordingDetails['personal_mobile_no'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        
                        <div class="col-sm-12"><label for="firstname" class="control-label">Home Address <span class="text-danger">*</span></label></div>
                        
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <input type="text" maxlength="150" <?php echo $readonly;?> data-is_validate="1" name="personal_address_line_1" id="personal_ddress_line_1" class="form-control" placeholder="Address Line 1" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_line_1'])){echo $OnBordingDetails['personal_address_line_1'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="personal_address_line_2" id="personal_address_line_2"  class="form-control" placeholder="Address Line 2" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_line_2'])){echo $OnBordingDetails['personal_address_line_2'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> data-is_validate="1" name="personal_address_city" id="personal_address_city"  class="form-control" placeholder="City" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_city'])){echo $OnBordingDetails['personal_address_city'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                               
                                <select data-placeholder="select state" <?php echo $readonly;?> data-is_validate="1" name="personal_address_state" id="personal_address_state"  class="form-control state_dropdown" placeholder="State" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_state_sel'])){echo base64_encode($OnBordingDetails['personal_address_state_sel']);} ?>" >
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> data-is_validate="1" name="personal_address_zipcode" id="personal_address_zipcode"  class="form-control" placeholder="Zip Code" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['personal_address_zipcode'])){echo $OnBordingDetails['personal_address_zipcode'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Business Email<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="email" maxlength="100" <?php echo $readonly;?> data-is_validate="1" name="business_email" id="business_email"  class="form-control" placeholder="Business Email" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_email'])){echo $OnBordingDetails['business_email'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Business Phone<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="tel" maxlength="10" <?php echo $readonly;?> data-is_validate="1" name="business_phone" id="business_phone"  class="form-control" placeholder="Business Phone" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_phone'])){echo $OnBordingDetails['business_phone'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        
                        <div class="col-sm-12"><label for="firstname" class="control-label">Business/Public Use Address <span class="text-danger">*</span></label></div>
                        
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <input type="text" data-is_validate="1" <?php echo $readonly;?> maxlength="150" name="business_address_line_1" id="business_address_line_1" class="form-control" placeholder="Address Line 1" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_line_1'])){echo $OnBordingDetails['business_address_line_1'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="business_address_line_2" id="business_address_line_2"  class="form-control" placeholder="Address Line 2" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_line_2'])){echo $OnBordingDetails['business_address_line_2'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> data-is_validate="1" name="business_address_city" id="business_address_city"  class="form-control" placeholder="City" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_city'])){echo $OnBordingDetails['business_address_city'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <!-- <input type="text" maxlength="100" name="state" id="state"  class="form-control" placeholder="State" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['state'])){echo $OnBordingDetails['state'];} ?>" > -->
                                <select data-placeholder="select state" <?php echo $readonly;?> data-is_validate="1" name="business_address_state" id="business_address_state"  class="form-control state_dropdown" placeholder="State" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_state_sel'])){echo base64_encode($OnBordingDetails['business_address_state_sel']);} ?>" >
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> data-is_validate="1" name="business_address_zipcode" id="business_address_zipcode"  class="form-control" placeholder="Zip Code" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['business_address_zipcode'])){echo $OnBordingDetails['business_address_zipcode'];} ?>" >
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>

                        
                        <div class="col-md-12">
                            <h4>Birth/Fingerprinting Information</h4>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Gender<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="gender" <?php echo $readonly;?> class="form-control" id="gender">
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
                                <input type="text" <?php echo $readonly;?> maxlength="100" name="dob" id="dob" data-is_validate="1"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['dob'])){echo $OnBordingDetails['dob'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Birth City<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" <?php echo $readonly;?> maxlength="100" name="birth_city" data-is_validate="1" id="birth_city"  class="form-control" placeholder="Birth City" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['birth_city'])){echo $OnBordingDetails['birth_city'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Birth State<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                
                                <select name="birth_state" <?php echo $readonly;?> data-is_validate="1" class="form-control state_dropdown" id="birth_state" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['birth_state_sel'])){echo base64_encode($OnBordingDetails['birth_state_sel']);} ?>">
                                    <option value="">Select State</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Birth Country<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="birth_country" <?php echo $readonly;?> data-is_validate="1" class="form-control country_dropdown" id="birth_country" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['birth_country_sel'])){echo base64_encode($OnBordingDetails['birth_country_sel']);} ?>">
                                    <option value="">Select Country</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Country of Citizenship<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="country_of_citizenship" <?php echo $readonly;?> data-is_validate="1" class="form-control country_dropdown" id="country_of_citizenship" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['country_of_citizenship_sel'])){echo base64_encode($OnBordingDetails['country_of_citizenship_sel']);} ?>">
                                    <option value="">Select Country</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Ethnicity<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="ethnicity" <?php echo $readonly;?> class="form-control select2" id="ethnicity">
                                    <option value="">Select Ethnicity</option>
                                    
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Hair Color<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select name="hair_color" <?php echo $readonly;?> class="form-control select2" data-is_validate="1" id="hair_color">
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
                                <select name="eye_color" <?php echo $readonly;?> class="form-control select2" id="eye_color" data-is_validate="1">
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
                                <select name="height_feet" <?php echo $readonly;?> class="form-control select2" id="height_feet" data-is_validate="1">
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
                                <select name="height_in" <?php echo $readonly;?> class="form-control select2" id="height_in" data-is_validate="1">
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
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="weight_lbs" id="weight_lbs"  class="form-control" placeholder="Weight (lbs)" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['weight_lbs'])){echo $OnBordingDetails['weight_lbs'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4>Identification</h4>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Drivers License<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="driver_licence" id="driver_licence"  class="form-control" placeholder="Drivers License" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['driver_licence'])){echo $OnBordingDetails['driver_licence'];} ?>"  data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">State Issued<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <!-- <input type="text" name="state_issued" class="form-control" id="state_issued" /> -->
                                <select data-placeholder="select state" <?php echo $readonly;?> name="state_issued" id="state_issued"  class="form-control state_dropdown" placeholder="State" data-val_sel="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['state_issued_sel'])){echo base64_encode($OnBordingDetails['state_issued_sel']);} ?>"  data-is_validate="1">
                                </select>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">FCVS Id<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="fcvs_id" id="fcvs_id"  class="form-control" placeholder="FCVS Id" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['fcvs_id'])){echo $OnBordingDetails['fcvs_id'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Issue Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="issue_date" id="issue_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['issue_date'])){echo $OnBordingDetails['issue_date'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Expiry Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="expiry_date" id="expiry_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['expiry_date'])){echo $OnBordingDetails['expiry_date'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">CAQH Number<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="caqh_no" id="caqh_no"  class="form-control" placeholder="CAQH Number" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['caqh_no'])){echo $OnBordingDetails['caqh_no'];} ?>"  data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">NPI #<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="npi_no" id="npi_no"  class="form-control" placeholder="NPI #" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['npi_no'])){echo $OnBordingDetails['npi_no'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">SSN<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="ssn_no" id="ssn_no"  class="form-control" placeholder="SSN" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['ssn_no'])){echo $OnBordingDetails['ssn_no'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">TIN<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" maxlength="100" <?php echo $readonly;?> name="tin_no" id="tin_no"  class="form-control" placeholder="TIN" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['tin_no'])){echo $OnBordingDetails['tin_no'];} ?>" data-is_validate="1">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4>Military Service</h4>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">Are You Currently Serving Military or have you server military previously? </label>
                            <div class="form-group">
                                <input type="radio" <?php echo $readonly;?> name="is_military_person" id="is_military_person_yes" value="1"   <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['is_military_person']) && $OnBordingDetails['is_military_person']==1){echo "checked";} ?>> <label for="is_military_person_yes">Yes</label>

                                <input type="radio" <?php echo $readonly;?> name="is_military_person" id="is_military_person_no" value="0"   <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['is_military_person']) && $OnBordingDetails['is_military_person']==0){echo "checked";} ?>> <label for="is_military_person_no">No</label>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">Are you married to, or in a domestic partnership or other legal union, with an active-duty member of the U.S. military officially assigned to duty? </label>
                            <div class="form-group">
                                <input type="radio" <?php echo $readonly;?> name="is_partner_military_person" id="is_partner_military_person_yes" value="1"   <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['is_partner_military_person']) && $OnBordingDetails['is_partner_military_person']==1){echo "checked";} ?>> <label for="is_partner_military_person_yes">Yes</label>

                                <input type="radio" <?php echo $readonly;?> name="is_partner_military_person" id="is_partner_military_person_no" value="0"   <?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['is_partner_military_person']) && $OnBordingDetails['is_partner_military_person']==0){echo "checked";} ?>> <label for="is_partner_military_person_no">No</label>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Branch<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" <?php echo $readonly;?> name="branch" class="form-control" id="branch" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['branch'])){echo $OnBordingDetails['branch'];} ?>"/>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Service Begin Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" <?php echo $readonly;?> maxlength="100" name="service_start_date" id="service_start_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['service_start_date'])){echo $OnBordingDetails['service_start_date'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label for="firstname" class="control-label">Service End Date<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" <?php echo $readonly;?> maxlength="100" name="service_end_date" id="service_end_date"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['service_end_date'])){echo $OnBordingDetails['service_end_date'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Rank At Discharge<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" <?php echo $readonly;?> maxlength="100" name="discharge_rank" id="discharge_rank"  class="form-control" placeholder="Rank At Discharge" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['discharge_rank'])){echo $OnBordingDetails['discharge_rank'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Type of Discharge<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" <?php echo $readonly;?> maxlength="100" name="discharge_type" id="discharge_type"  class="form-control" placeholder="Type of Discharge" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['discharge_type'])){echo $OnBordingDetails['discharge_type'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">If other than honorable, please explain<span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <input type="text" <?php echo $readonly;?> maxlength="255" name="other_honor_detail" id="other_honor_detail"  class="form-control" placeholder="If other than hounorable, please explain" value="<?php if(isset($_REQUEST['id']) && isset($OnBordingDetails['other_honor_detail'])){echo $OnBordingDetails['other_honor_detail'];} ?>">
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <?php 
                                if($is_readonly)
                                {
                                    ?>
                                    <a href="index.php?pid=add_boarding_form&tab=education-training&id=<?php echo $_REQUEST['id'];?>"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Next</a>
                                    <?php
                                }else
                                {
                                    ?>
                                        <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                                    <?php
                                }
                             ?>
                            
                        </div>


                    </div>
                </form>

            </div>
            
        </div>

    <!-- </div>

</div> -->