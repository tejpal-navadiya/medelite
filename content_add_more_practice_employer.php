<?php
    require_once("config.php"); 
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
            <select name="practice_type[]" class="form-control" <?php echo $disabled;?> id="practice_type<?php echo $cnt; ?>" data-is_validate="1">
                <option value="">Select Type</option>
                
                <?php
                    $sql = "SELECT id, name FROM me_practice_facility_type where is_deleted='0'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                        }
                    } else {
                        echo '<option value="">No found</option>';
                    }
                    
                ?>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Practice/Employer<span class="text-danger">*</span></label>
        <div class="form-group">
            <input type="text" name="practice_name[]" id="practice_name<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="Practice/Employer" <?php echo $readonly;?> value="<?php if(isset($cur_detail['practice_name'])){ echo $cur_detail['practice_name'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">Start Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="start_date[]" id="start_date<?php echo $cnt; ?>"  data-is_validate="1" class="form-control datepicker" placeholder="mm/dd/yyyy" <?php echo $disabled;?> value="<?php if(isset($cur_detail['start_date'])){ echo $cur_detail['start_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="firstname" class="control-label">End Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="end_date[]" id="end_date<?php echo $cnt; ?>"  data-is_validate="1" class="form-control datepicker" placeholder="mm/dd/yyyy" <?php echo $disabled;?> value="<?php if(isset($cur_detail['end_date'])){ echo $cur_detail['end_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    
    <div class="col-sm-12"><label for="firstname" class="control-label">Practice / Employer Address <span class="text-danger">*</span></label></div>
    
    <div class="col-sm-6">
        
        <div class="form-group">
            <input type="text" maxlength="150" name="address_line_1[]" id="address_line_1-<?php echo $cnt; ?>" data-is_validate="1" class="form-control" placeholder="Address Line 1" <?php echo $readonly;?> value="<?php if(isset($cur_detail['address_line_1'])){ echo $cur_detail['address_line_1'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-<?php echo $cnt; ?>"  class="form-control" placeholder="Address Line 2" <?php echo $readonly;?> value="<?php if(isset($cur_detail['address_line_2'])){ echo $cur_detail['address_line_2'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <input type="text" maxlength="100" name="address_city[]" id="address_city<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="City" <?php echo $readonly;?> value="<?php if(isset($cur_detail['address_city'])){ echo $cur_detail['address_city'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <select data-placeholder="Select State" name="address_state[]" <?php echo $disabled;?> id="address_state<?php echo $cnt; ?>"  class="form-control state_dropdown" placeholder="State"  data-val_sel="<?php if(isset($cur_detail['address_state_name_sel'])){ echo base64_encode($cur_detail['address_state_name_sel']);} ?>"></select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <input type="text" maxlength="100" name="address_zipcode[]" <?php echo $disabled;?> id="address_zipcode<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="Zip Code" value="<?php if(isset($cur_detail['address_zipcode'])){ echo $cur_detail['address_zipcode'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
        <div class="form-group">
            <select name="address_country[]" class="form-control  country_dropdown" <?php echo $disabled;?> id="address_country<?php echo $cnt; ?>" data-is_validate="1" data-val_sel="<?php if(isset($cur_detail['address_country_name_sel'])){ echo base64_encode($cur_detail['address_country_name_sel']);} ?>">
                <option value="">Select Country</option>
                
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-12">
        <label for="firstname" class="control-label">Reason for departure (If Not Current)</label>
        <div class="form-group">
            <input type="text" name="reason_deaprture[]" id="reason_deaprture<?php echo $cnt; ?>"  <?php echo $readonly;?> class="form-control" placeholder="Reason for departure" value="<?php if(isset($cur_detail['reason_deaprture'])){ echo $cur_detail['reason_deaprture'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    
    <div class="col-md-12"><h5><u>HR Contact / Supervisor</u></h5></div>
    <div class="col-sm-12"><label for="firstname" class="control-label">Name <span class="text-danger">*</span></label></div>
    
    <div class="col-sm-6 col-md-4">
        
        <div class="form-group">
            <input type="text" maxlength="150" name="hr_title[]" <?php echo $readonly;?> id="hr_title<?php echo $cnt; ?>" data-is_validate="1" class="form-control" placeholder="Title" value="<?php if(isset($cur_detail['hr_title'])){ echo $cur_detail['hr_title'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <input type="text" maxlength="100" name="hr_contact_name[]" id="hr_contact_name<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="Contact Name" <?php echo $readonly;?> value="<?php if(isset($cur_detail['hr_contact_name'])){ echo $cur_detail['hr_contact_name'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <input type="text" maxlength="100" name="hr_contract_start_date[]" id="hr_contract_start_date<?php echo $cnt; ?>" data-is_validate="1" placeholder="mm/dd/yyyy" class="form-control datepicker" <?php echo $disabled;?> placeholder="Contract Start Date" value="<?php if(isset($cur_detail['hr_contract_start_date'])){ echo $cur_detail['hr_contract_start_date'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <input type="email" maxlength="100" name="hr_email[]" id="hr_email<?php echo $cnt; ?>"  class="form-control" data-is_validate="1" placeholder="Email" <?php echo $readonly;?> value="<?php if(isset($cur_detail['hr_email'])){ echo $cur_detail['hr_email'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <input type="tel" maxlength="10" name="hr_phone[]" id="hr_phone<?php echo $cnt; ?>" <?php echo $readonly;?> class="form-control" placeholder="Phone" value="<?php if(isset($cur_detail['hr_phone'])){ echo $cur_detail['hr_phone'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
</div>