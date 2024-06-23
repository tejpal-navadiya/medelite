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
            <input type="text" name="hospital_affiliation[]" data-is_validate="1" <?php echo $readonly;?> id="hospital_affiliation<?php echo $cnt; ?>"  class="form-control" placeholder="Hospital Affiliation" value="<?php if(isset($cur_detail['hospital_affiliation'])){ echo $cur_detail['hospital_affiliation'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Start Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="start_date[]" data-is_validate="1" <?php echo $disabled;?> id="start_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['start_date'])){ echo $cur_detail['start_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">End Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="end_date[]" data-is_validate="1" <?php echo $disabled;?> id="end_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['end_date'])){ echo $cur_detail['end_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    
    <div class="col-sm-12"><label for="firstname" class="control-label">Hospital Affiliation Address <span class="text-danger">*</span></label></div>
    
    <div class="col-sm-6">
        
        <div class="form-group">
            <input type="text" maxlength="150" name="address_line_1[]" data-is_validate="1" id="address_line_1-<?php echo $cnt; ?>" class="form-control" placeholder="Address Line 1" <?php echo $readonly;?> value="<?php if(isset($cur_detail['address_line_1'])){ echo $cur_detail['address_line_1'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-<?php echo $cnt; ?>"  class="form-control" placeholder="Address Line 2"  <?php echo $readonly;?> value="<?php if(isset($cur_detail['address_line_2'])){ echo $cur_detail['address_line_2'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <input type="text" maxlength="100" name="address_city[]" data-is_validate="1" id="address_city<?php echo $cnt; ?>"  class="form-control" placeholder="City" <?php echo $readonly;?> value="<?php if(isset($cur_detail['address_city'])){ echo $cur_detail['address_city'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <!-- <input type="text" maxlength="100" name="address_state[]" id="address_state<?php echo $cnt; ?>"  class="form-control" placeholder="State" value="<?php if(isset($cur_detail['address_state'])){ echo $cur_detail['address_state'];} ?>" > -->
            <select data-placeholder="Select State" name="address_state[]" <?php echo $disabled;?> data-is_validate="1" class="form-control  state_dropdown" id="address_state<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['address_state_name_sel'])){ echo base64_encode($cur_detail['address_state_name_sel']);} ?>">
                <!-- <option value=""></option> -->
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group">
            <input type="text" maxlength="100" name="address_zipcode[]" data-is_validate="1" id="address_zipcode<?php echo $cnt; ?>"  class="form-control" placeholder="Zip Code" <?php echo $readonly;?> value="<?php if(isset($cur_detail['address_zipcode'])){ echo $cur_detail['address_zipcode'];} ?>" >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6  col-md-3">
        <!-- <label for="firstname" class="control-label">Country<span class="text-danger">*</span> </label> -->
        <div class="form-group">
            <select name="address_country[]" class="form-control country_dropdown" <?php echo $disabled;?> data-is_validate="1" id="address_country<?php echo $cnt; ?>" data-val_sel="<?php if(isset($cur_detail['address_country_name_sel'])){ echo base64_encode($cur_detail['address_country_name_sel']);} ?>">
                <option value="">Select Country</option>
                
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>

    
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Staff Category<span class="text-danger">*</span></label>
        <div class="form-group">
            <input type="text" name="staff_category[]" id="staff_category<?php echo $cnt; ?>" data-is_validate="1"  class="form-control" placeholder="Staff Category" <?php echo $readonly;?> value="<?php if(isset($cur_detail['staff_category'])){ echo $cur_detail['staff_category'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        
        <div class="form-group">
            <input type="checkbox" style="margin-top: 20px;margin-left: 10px;" value="1" name="is_primary_affiliation[<?php echo ($cnt-1); ?>]" id="is_primary_affiliation<?php echo $cnt; ?>"  class="" <?php echo $disabled;?>  <?php if(isset($cur_detail['is_primary_affiliation']) && $cur_detail['is_primary_affiliation']==1){ echo "checked";} ?>  >
            <label for="is_primary_affiliation<?php echo $cnt; ?>" class="control-label">Primary Affiliation</label>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        
        <div class="form-group">
            <input type="checkbox" style="margin-top: 20px;margin-left: 10px;" value="1" name="is_currently_affiliated[<?php echo ($cnt-1); ?>]" id="is_currently_affiliated<?php echo $cnt; ?>"  class=""  <?php echo $disabled;?> <?php if(isset($cur_detail['is_currently_affiliated']) && $cur_detail['is_currently_affiliated']==1){ echo "checked";} ?>  >
            <label for="is_primary_affiliation<?php echo $cnt; ?>" class="control-label">Currently Affiliated?</label>
            <span class="help" id="msg2"></span>
        </div>
    </div>
</div> 